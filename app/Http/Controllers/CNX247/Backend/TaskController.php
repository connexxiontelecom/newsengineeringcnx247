<?php

namespace App\Http\Controllers\CNX247\Backend;

use App\Http\Controllers\Controller;
use App\Link;
use App\Notifications\NewPostNotification;
use App\Notifications\SubmitTask;
use App\Observer;
use App\Participant;
use App\Post;
use App\PostAttachment;
use App\PostRating;
use App\PostSubmission;
use App\PostSubmissionAttachment;
use App\Priority;
use App\ResponsiblePerson;
use App\Status;
use App\User;
use Auth;
use Illuminate\Http\Request;
use DateTime;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /*
     * Task board
     */
    public function taskBoard()
    {
        return view('backend.tasks.task-board');
    }
    /*
     * New task
     */
    public function newTask()
    {
        $users = User::select('first_name', 'surname', 'id')
            ->where('account_status', 1)->where('verified', 1)
            ->where('tenant_id', Auth::user()->tenant_id)
            ->orderBy('first_name', 'ASC')->get();
        $priorities = Priority::all();
        $statuses = Status::all();
        return view('backend.tasks.new-task', [
            'users' => $users,
            'priorities' => $priorities,
            'statuses' => $statuses,
        ]);
    }
    /*
     * edit task
     */
    public function editTask($url)
    {
        $users = User::select('first_name', 'surname', 'id')
            ->where('account_status', 1)->where('verified', 1)
            ->where('tenant_id', Auth::user()->tenant_id)
            ->orderBy('first_name', 'ASC')->get();
        $priorities = Priority::all();
        $statuses = Status::all();
        $task = Post::where('post_url', $url)->where('tenant_id', Auth::user()->tenant_id)->first();
        return view('backend.tasks.edit-task', [
            'users' => $users,
            'priorities' => $priorities,
            'statuses' => $statuses,
            'task' => $task,
        ]);
    }

    /*
     * store new task
     */
    public function storeTask(Request $request)
    {
			 //dd($request->all());

        $this->validate($request, [
            'task_title' => 'required',
            'responsible_persons' => 'required',
            'task_description' => 'required',
            'start_date' => 'required|date',
            'due_date' => 'required|date|after_or_equal:start_date',
        ]);

         $url = substr(sha1(time()), 10, 10);
        $task = new Post;
        $task->post_title = $request->task_title;
        $task->user_id = Auth::user()->id;
        $task->post_content = $request->task_description;
        $task->post_color = $request->color;
        $task->post_type = 'task';
				$task->post_url = $url;

				$startDateInstance = new DateTime($request->start_date);
				$task->start_date = $startDateInstance->format('Y-m-d H:i:s');

				$dueDateInstance = new DateTime($request->due_date);
				$task->end_date = $dueDateInstance->format('Y-m-d H:i:s');

        $task->post_priority = $request->priority;
        $task->tenant_id = Auth::user()->tenant_id;
        $task->save();
        $task_id = $task->id;
        if (!empty($request->file('attachment'))) {
            $extension = $request->file('attachment');
            $extension = $request->file('attachment')->getClientOriginalExtension(); // getting excel extension
            $dir = 'assets/uploads/attachments/';
            $filename = 'task_' . uniqid() . '_' . time() . '_' . date('Ymd') . '.' . $extension;
            $request->file('attachment')->move(public_path($dir), $filename);
        } else {
            $filename = '';
        }
        if (!empty($request->file('attachment'))) {
            $attach = new PostAttachment;
            $attach->post_id = $task_id;
            $attach->user_id = Auth::user()->id;
            $attach->attachment = $filename;
            $attach->tenant_id = Auth::user()->tenant_id;
            $attach->save();
        }
        //responsible persons
        if (!empty($request->responsible_persons)) {
            foreach ($request->responsible_persons as $participant) {
                /*  $user = User::select('first_name', 'surname', 'email', 'id')->where('id', $participant)->first();
                \Mail::to($user->email)->send(new MailTask($user, $request, $url)); */
                $part = new ResponsiblePerson;
                $part->post_id = $task_id;
                $part->post_type = 'task';
                $part->user_id = $participant;
                $part->tenant_id = Auth::user()->tenant_id;
                $part->save();
                $user = User::find($participant);
                $user->notify(new NewPostNotification($task));
            }
        }
        //participants
        if (!empty($request->participants)) {
            foreach ($request->participants as $person) {
                /*  $user = User::select('first_name', 'surname', 'email', 'id')->where('id', $participant)->first();
                \Mail::to($user->email)->send(new MailTask($user, $request, $url)); */
                $part = new Participant;
                $part->post_id = $task_id;
                $part->post_type = 'task';
                $part->user_id = $person;
                $part->tenant_id = Auth::user()->tenant_id;
                $part->save();
            }
        }
        //observers
        if (!empty($request->observers)) {
            foreach ($request->observers as $observe) {
                /*  $user = User::select('first_name', 'surname', 'email', 'id')->where('id', $participant)->first();
                \Mail::to($user->email)->send(new MailTask($user, $request, $url)); */
                $part = new Observer;
                $part->post_id = $task_id;
                $part->post_type = 'task';
                $part->user_id = $observe;
                $part->tenant_id = Auth::user()->tenant_id;
                $part->save();
            }
        }
        return redirect()->route('task-board');
    }
    /*
     * update task
     */
    public function updateTask(Request $request)
    {

        $this->validate($request, [
            'task_title' => 'required',
            'task_description' => 'required',
            'start_date' => 'required|date',
            'due_date' => 'required|date|after_or_equal:start_date',
        ]);
        $task = Post::where('post_url', $request->url)->where('tenant_id', Auth::user()->tenant_id)->first();
        $task->post_title = $request->task_title;
        $task->user_id = Auth::user()->id;
        $task->post_content = $request->task_description;
        $task->post_color = $request->color;
        $task->post_type = 'task';
        $task->post_url = $request->url;

					$startDateInstance = new DateTime($request->start_date);
				$task->start_date = $startDateInstance->format('Y-m-d H:i:s');

					$dueDateInstance = new DateTime($request->due_date);
				$task->end_date = $dueDateInstance->format('Y-m-d H:i:s');

        $task->tenant_id = Auth::user()->tenant_id;
        //$task->attachment = $filename;
        $task->save();
        session()->flash("success", "<strong>Success!</strong> Task changes saved.");
        return redirect()->route('task-board');
    }

    /*
     * New task
     */
    public function viewTask()
    {

        return view('backend.tasks.view-task');
    }

    /*
     * Task calendar
     */
    public function taskCalendar()
    {
        return view('backend.tasks.task-calendar');
    }

    /*
     * Task calendar
     */
    public function getTaskCalendarData()
    {
        $task = Post::select('post_title as title', 'start_date as start', 'end_date as end', 'post_color as color')
            ->where('post_type', 'task')
            ->where('tenant_id', Auth::user()->tenant_id)->get();
        return response($task);
    }
    /*
     * Task gantt chart [view]
     */
    public function taskGanttChart()
    {
        return view('backend.tasks.task-gantt-chart');
    }
    /*
     * Task Gantt Chart
     */
    public function getTaskGanttChartData()
    {
        $task = Post::select('post_title as text', 'start_date', 'end_date', 'post_color as color')
            ->where('post_type', 'task')
            ->where('tenant_id', Auth::user()->tenant_id)
            ->orderBy('id', 'DESC')
            ->get();
        $links = Link::all();
        return response()->json([
            'data' => $task,
            'links' => $links,
        ]);
    }

    /*
     * Task analytics
     */
    public function taskAnalytics()
    {
        return view('backend.tasks.task-analytics');
    }

    public function deleteTask(Request $request)
    {
        $this->validate($request, [
            'taskId' => 'required',
        ]);
        $task = Post::where('tenant_id', Auth::user()->tenant_id)
            ->where('id', $request->taskId)->first();
        if (!empty($task)) {
            $task->delete();
            $responsible = ResponsiblePerson::where('post_id', $request->taskId)
                ->where('tenant_id', Auth::user()->tenant_id)
                ->get();
            if (!empty($responsible)) {
                foreach ($responsible as $person) {
                    $person->delete();
                }
            }
            #Observers
            $observers = Observer::where('post_id', $request->taskId)
                ->where('tenant_id', Auth::user()->tenant_id)
                ->get();
            if (!empty($observers)) {
                foreach ($observers as $observer) {
                    $observer->delete();
                }
            }
            #Participants
            $participants = Participant::where('post_id', $request->taskId)
                ->where('tenant_id', Auth::user()->tenant_id)
                ->get();
            if (!empty($participants)) {
                foreach ($participants as $participant) {
                    $participant->delete();
                }
            }
        }
        session()->flash("success", "<strong>Success!</strong> Task deleted.");
        return redirect()->back();
    }

    public function uploadPostAttachment(Request $request)
    {
        $this->validate($request, [
            'attachment' => 'required',
            'post' => 'required',
        ]);
        if (!empty($request->file('attachment'))) {
            $extension = $request->file('attachment');
            $extension = $request->file('attachment')->getClientOriginalExtension(); // getting excel extension
            $dir = 'assets/uploads/attachments/';
            $filename = 'task_' . uniqid() . '_' . time() . '_' . date('Ymd') . '.' . $extension;
            $request->file('attachment')->move(public_path($dir), $filename);
        } else {
            $filename = '';
        }
        if (!empty($request->file('attachment'))) {
            $attach = new PostAttachment;
            $attach->post_id = $request->post;
            $attach->user_id = Auth::user()->id;
            $attach->attachment = $filename;
            $attach->tenant_id = Auth::user()->tenant_id;
            $attach->save();
        }
        if ($attach) {
            return response()->json(['message' => 'Success! Attachment uploaded.'], 200);
        } else {
            return response()->json(['error' => 'Ooops! Could not upload attachment.'], 400);

        }
    }

    public function submitTask($url)
    {
        $post = Post::where('tenant_id', Auth::user()->tenant_id)->where('post_url', $url)->first();
        if (!empty($post)) {
            return view('backend.tasks.submit-task', ['task' => $post]);
        } else {
            return redirect()->route('404');
        }
    }

    public function storeAssignedTask(Request $request)
    {
        $this->validate($request, [
            'leave_note' => 'required',
            'post' => 'required',
            'owner' => 'required',
            'type' => 'required',
        ]);
        $submit = new PostSubmission;
        $submit->post_id = $request->post;
        $submit->submitted_by = Auth::user()->id;
        $submit->owner = $request->owner;
        $submit->post_type = $request->type;
        $submit->post_id = $request->post;
        $submit->tenant_id = Auth::user()->tenant_id;
        $submit->date_submitted = now();
        $submit->note = $request->leave_note;
        $submit->save();

        if (!empty($request->file('attachment'))) {
            $extension = $request->file('attachment');
            $extension = $request->file('attachment')->getClientOriginalExtension(); // getting excel extension
            $dir = 'assets/uploads/attachments/';
            $filename = 'task_' . uniqid() . '_' . time() . '_' . date('Ymd') . '.' . $extension;
            $request->file('attachment')->move(public_path($dir), $filename);
        } else {
            $filename = '';
        }
        if (!empty($request->file('attachment'))) {
            $attach = new PostSubmissionAttachment;
            $attach->post_id = $request->post;
            $attach->attachment = $filename;
            $attach->tenant_id = Auth::user()->tenant_id;
            $attach->save();
        }
        $user = User::where('id', $request->owner)->where('tenant_id', Auth::user()->tenant_id)->first();
        $content = Post::where('id', $request->post)->where('tenant_id', Auth::user()->tenant_id)->first();
        $user->notify(new SubmitTask($submit, $content));
        session()->flash("success", "<strong>Success!</strong> Submission done.");
        return back();
    }

    public function viewAssignmentSubmissions()
    {
        return view('backend.tasks.view-task-submission');
    }

    public function rateTaskSubmitted(Request $request)
    {
        $this->validate($request, [
            'submission' => 'required',
            'responsible' => 'required',
            'review' => 'required',
            'rating' => 'required',
            'appraisal' => 'required',
        ]);
        $rating = new PostRating;
        $rating->tenant_id = Auth::user()->tenant_id;
        $rating->rated_by = Auth::user()->id;
        $rating->post_id = $request->submission;
        $rating->review = $request->review;
        $rating->user_id = $request->user;
        $rating->rating = $request->rating;
        $rating->use_for_appraisal = $request->appraisal;
        $rating->save();
        #Update submission
        $submission = PostSubmission::find($request->submission);
        $submission->status = 'approved';
        $submission->save();
        if ($request->appraisal == 1) {
            #Do appraisal
        }
        return response()->json(['message' => 'Success! Task review submitted.'], 200);
    }

    public function addResponsiblePerson(Request $request)
    {

        $this->validate($request, [
            'taskId' => 'required',
            'responsible_persons' => 'required',
        ]);

        $task = Post::where('tenant_id', Auth::user()->tenant_id)
            ->where('id', $request->taskId)->first();

        if (!empty($request->responsible_persons)) {
            foreach ($request->responsible_persons as $participant) {
                /*  $user = User::select('first_name', 'surname', 'email', 'id')->where('id', $participant)->first();
                \Mail::to($user->email)->send(new MailTask($user, $request, $url)); */
                $part = new ResponsiblePerson;

                $exists = ResponsiblePerson::where('tenant_id', Auth::user()->tenant_id)->where('user_id', $participant)->where('post_id', $request->taskId)->first();

                if (empty($exists) || is_null($exists)) {

                    $part->post_id = $request->taskId;
                    $part->post_type = 'task';
                    $part->user_id = $participant;
                    $part->tenant_id = Auth::user()->tenant_id;
                    $part->save();
                    $user = User::find($participant);
                    $user->notify(new NewPostNotification($task));

                }
            }
        }
        return redirect()->route('view-task', ["url" => $request->url]);
    }



    public function addParticipant(Request $request)
    {

        $this->validate($request, [
            'taskId' => 'required',
            'participants' => 'required',
        ]);

        $task = Post::where('tenant_id', Auth::user()->tenant_id)
            ->where('id', $request->taskId)->first();

        if (!empty($request->participants)) {
            foreach ($request->participants as $participant) {
                /*  $user = User::select('first_name', 'surname', 'email', 'id')->where('id', $participant)->first();
                \Mail::to($user->email)->send(new MailTask($user, $request, $url)); */
                $part = new Participant();

                $exists = Participant::where('tenant_id', Auth::user()->tenant_id)->where('user_id', $participant)->where('post_id', $request->taskId)->first();

                if (empty($exists) || is_null($exists)) {

                    $part->post_id = $request->taskId;
                    $part->post_type = 'task';
                    $part->user_id = $participant;
                    $part->tenant_id = Auth::user()->tenant_id;
                    $part->save();
                    $user = User::find($participant);
                    $user->notify(new NewPostNotification($task));

                }
            }
        }
        return redirect()->route('view-task', ["url" => $request->url]);
    }


    public function addObserver(Request $request)
    {

        $this->validate($request, [
            'taskId' => 'required',
            'observers' => 'required',
        ]);

        $task = Post::where('tenant_id', Auth::user()->tenant_id)
            ->where('id', $request->taskId)->first();

        if (!empty($request->observers)) {
            foreach ($request->observers as $participant) {
                /*  $user = User::select('first_name', 'surname', 'email', 'id')->where('id', $participant)->first();
                \Mail::to($user->email)->send(new MailTask($user, $request, $url)); */
                $part = new Observer();

                $exists = Observer::where('tenant_id', Auth::user()->tenant_id)->where('user_id', $participant)->where('post_id', $request->taskId)->first();

                if (empty($exists) || is_null($exists)) {

                    $part->post_id = $request->taskId;
                    $part->post_type = 'task';
                    $part->user_id = $participant;
                    $part->tenant_id = Auth::user()->tenant_id;
                    $part->save();
                    $user = User::find($participant);
                    $user->notify(new NewPostNotification($task));

                }
            }
        }
        return redirect()->route('view-task', ["url" => $request->url]);
    }

}
