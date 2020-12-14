<?php

namespace App\Http\Controllers\CNX247\API;

use App\BusinessLog;
use App\Driver;
use App\FileModel;
use App\Http\Controllers\Controller;
use App\Message;
use App\Notifications\NewPostNotification;
use App\Notifications\SubmitTask;
use App\Observer;
use App\Participant;
use App\Post;
use App\PostAttachment;
use App\PostComment;
use App\PostLike;
use App\PostSubmission;
use App\PostSubmissionAttachment;
use App\Priority;
use App\RequestApprover;
use App\ResponsiblePerson;
use App\Tenant;
use App\User;
use App\WorkgroupAttachment;
use function PHPSTORM_META\type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StreamController extends Controller
{
    //
    public function index(Request $request)
    {

        $tenant_id = $request->input("tenant_id");

        $allposts = array();
        $posts = Post::where('posts.tenant_id', $tenant_id)->orderBy('id', 'DESC')->get();

        foreach ($posts as $post) {
            $postArray = array();
            $user = User::where('id', $post->user_id)->get();

            /* parse profile picture */
            $user[0]["avatar"] = url("/assets/images/avatars/thumbnails/" . $user[0]["avatar"]);

            /* parse comments */
            //$comments =
            //$post->postComments;//
            $comments = PostComment::where('post_id', $post->id)->join('users', 'users.id', 'post_comments.user_id')->orderBy('post_comments.id', 'DESC')->get();
            foreach ($comments as $comment) {
                $comment['avatar'] = url("/assets/images/avatars/thumbnails/" . $comment['avatar']);
            }
            $post['comments'] = $comments;

            /* parse post likes */

            $postLikes = PostLike::where("post_id", $post->id)->join('users', 'post_likes.user_id', '=', 'users.id')->get();
            $post['likes'] = count($postLikes);
            $post['post_likes'] = $postLikes;
            $post['posted'] = date('M j , Y', strtotime($post->created_at));

            $responsible = ResponsiblePerson::where('post_id', $post->id)->join('users', 'responsible_people.user_id', '=', 'users.id')->get();
            foreach ($responsible as $resp) {
                $resp["avatar"] = url("/assets/images/avatars/thumbnails/" . $resp["avatar"]);
            }

            $observers = Observer::where('post_id', $post->id)->join('users', 'observers.user_id', '=', 'users.id')->get();
            foreach ($observers as $resp) {
                $resp["avatar"] = url("/assets/images/avatars/thumbnails/" . $resp["avatar"]);
            }

            $participants = Participant::where('post_id', $post->id)->join('users', 'participants.user_id', '=', 'users.id')->get();
            foreach ($participants as $resp) {
                $resp["avatar"] = url("/assets/images/avatars/thumbnails/" . $resp["avatar"]);
            }

            $attachments = PostAttachment::where('post_id', $post->id)->get();

            /* Parse Attachments */
            foreach ($attachments as $attachment) {
                $attachment["attachment"] = url("/assets/uploads/attachments/" . $attachment['attachment']);
            }

            $postArray["user"] = $user;
            $postArray['post'] = $post;
            $postArray['responsible'] = $responsible;
            $postArray['participants'] = $participants;
            $postArray['observers'] = $observers;
            $postArray['attachments'] = $attachments;
            $allposts[] = $postArray;
            //return response()->json(['posts' =>$post], 500);
        }

        return response()->json(['posts' => $allposts,
        ], 500);

    }

    public function StreamPost(Request $request)
    {

        $tenant_id = $request->input("tenant_id");
        $post_id = $request->input("post_id");

        $allposts = array();
        $posts = Post::where('posts.tenant_id', $tenant_id)->where('posts.id', $post_id)->get();

        foreach ($posts as $post) {
            $postArray = array();
            $user = User::where('id', $post->user_id)->get();

            /* parse profile picture */
            $user[0]["avatar"] = url("/assets/images/avatars/thumbnails/" . $user[0]["avatar"]);

            /* parse comments */
            //$comments =
            //$post->postComments;//
            $comments = PostComment::where('post_id', $post->id)->join('users', 'users.id', 'post_comments.user_id')->orderBy('post_comments.id', 'DESC')->get();
            foreach ($comments as $comment) {
                $comment['avatar'] = url("/assets/images/avatars/thumbnails/" . $comment['avatar']);
            }
            $post['comments'] = $comments;

            /* parse post likes */

            $postLikes = PostLike::where("post_id", $post->id)->join('users', 'post_likes.user_id', '=', 'users.id')->get();
            $post['likes'] = count($postLikes);
            $post['post_likes'] = $postLikes;
            $post['posted'] = date('M j , Y', strtotime($post->created_at));

            $responsible = ResponsiblePerson::where('post_id', $post->id)->join('users', 'responsible_people.user_id', '=', 'users.id')->get();
            foreach ($responsible as $resp) {
                $resp["avatar"] = url("/assets/images/avatars/thumbnails/" . $resp["avatar"]);
            }

            $observers = Observer::where('post_id', $post->id)->join('users', 'observers.user_id', '=', 'users.id')->get();
            foreach ($observers as $resp) {
                $resp["avatar"] = url("/assets/images/avatars/thumbnails/" . $resp["avatar"]);
            }

            $participants = Participant::where('post_id', $post->id)->join('users', 'participants.user_id', '=', 'users.id')->get();
            foreach ($participants as $resp) {
                $resp["avatar"] = url("/assets/images/avatars/thumbnails/" . $resp["avatar"]);
            }
            $attachments = PostAttachment::where('post_id', $post->id)->get();

            /* Parse Attachments */
            foreach ($attachments as $attachment) {
                $attachment["attachment"] = url("/assets/uploads/attachments/" . $attachment['attachment']);
            }

            $postArray["user"] = $user;
            $postArray['post'] = $post;
            $postArray['responsible'] = $responsible;
            $postArray['participants'] = $participants;
            $postArray['observers'] = $observers;
            $postArray['attachments'] = $attachments;
            $allposts[] = $postArray;
            //return response()->json(['posts' =>$post], 500);
        }

        return response()->json(['posts' => $allposts,
        ], 200);

    }

    public function like(Request $request)
    {
        $user_id = $request->input("user_id");
        $tenant_id = $request->input("tenant_id");
        $post_id = $request->input("post_id");

        $like = new PostLike();
        $like->post_id = $post_id;
        $like->user_id = $user_id;
        $like->tenant_id = $tenant_id;
        $like->save();
        return response()->json(['status' => 200]);
    }

    public function comment(Request $request)
    {
        $user_id = $request->input("user_id");
        $tenant_id = $request->input("tenant_id");
        $post_id = $request->input("post_id");
        $comment = $request->input("comment");

        $com = new PostComment;
        $com->user_id = $user_id;
        $com->post_id = $post_id;
        $com->comment = $comment;
        $com->tenant_id = $tenant_id;
        $com->save();
        return response()->json(['status' => 200]);
    }

    public function storeTask(Request $request)
    {
        $darray = array();
        $url = substr(sha1(time()), 10, 10);
        $task = new Post;
        $task->post_title = $request->task_title;
        $task->user_id = $request->user_id;
        $task->post_content = $request->task_description;
        //$task->post_color = $request->color;
        $task->post_type = 'task';
        $task->post_url = $url;
        $task->start_date = $request->start_date ?? '';
        $task->end_date = $request->due_date;
        $task->post_priority = $request->priority;
        $task->tenant_id = $request->tenant_id;
        $task->save();
        $task_id = $task->id;

        //Attachment
        if (!empty($request->attachment)) {
            $attach = new PostAttachment;
            $attach->post_id = $task_id;
            $attach->user_id = $request->user_id;
            $attach->attachment = $request->attachment;
            $attach->tenant_id = $request->tenant_id;
            $attach->save();
        }

        //responsible persons
        if (!empty($request->persons)) {
            foreach ($request->persons as $person) {

                $part = new ResponsiblePerson;
                $part->post_id = $task_id;
                $part->post_type = 'task';
                $part->user_id = $person["id"];
                $part->tenant_id = $request->tenant_id;
                $part->save();
                $darray["persons"][] = $person["id"];
                $user = User::find($person['id']);
								$user->notify(new NewPostNotification($task));
								$body = "New Task";
								$title = "You have a new task";
								$this->ToSpecificUser($request->tenant_id, $title, $body,$person['id']);
            }
        }
        //participants
        if (!empty($request->participants)) {
            foreach ($request->participants as $participant) {
                /*  $user = User::select('first_name', 'surname', 'email', 'id')->where('id', $participant)->first();
                \Mail::to($user->email)->send(new MailTask($user, $request, $url)); */
                $part = new Participant;
                $part->post_id = $task_id;
                $part->post_type = 'task';
                $part->user_id = $participant["id"];
                $part->tenant_id = $request->tenant_id;
                $part->save();
								$darray["participants"][] = $participant["id"];
								$body = "New Task";
								$title = "You have a new task";
								$this->ToSpecificUser($request->tenant_id, $title, $body,$person['id']);
            }
        }
        //observers
        if (!empty($request->observers)) {
            foreach ($request->observers as $observer) {
                /*  $user = User::select('first_name', 'surname', 'email', 'id')->where('id', $participant)->first();
                \Mail::to($user->email)->send(new MailTask($user, $request, $url)); */
                $part = new Observer;
                $part->post_id = $task_id;
                $part->post_type = 'task';
                $part->user_id = $observer["id"];
                $part->tenant_id = $request->tenant_id;
                $part->save();
								$darray["observes"][] = $observer["id"];
								$body = "New Task";
								$title = "You have a new task";
								$this->ToSpecificUser($request->tenant_id, $title, $body,$person['id']);

            }
        }
        return response()->json(['message' => 'Success! Task created.', "parsed" => $darray], 200);
    }

    public function storeProject(Request $request)
    {
        $url = substr(sha1(time()), 10, 10);
        $project = new Post;
        $project->post_title = $request->project_title;
        $project->user_id = $request->user_id;
        $project->post_content = $request->project_description;
        $project->post_color = $request->color;
        $project->project_manager_id = $request->project_manager;
        $project->post_type = 'project';
        $project->post_url = $url;
        //$project->budget = $request->budget ?? '';
        $project->sponsor = $request->project_sponsor;
        $project->start_date = $request->start_date ?? '';
        $project->end_date = $request->due_date;
        $project->post_priority = $request->priority;
        $project->tenant_id = $request->tenant_id;
        //$task->attachment = $filename;
        $project->save();
        $project_id = $project->id;

        //Attachment
        if (!empty($request->attachment)) {
            $attach = new PostAttachment;
            $attach->post_id = $project_id;
            $attach->user_id = $request->user_id;
            $attach->attachment = $request->attachment;
            $attach->tenant_id = $request->tenant_id;
            $attach->save();
        }

        //responsible persons
        if (!empty($request->persons)) {
            foreach ($request->persons as $person) {

                $part = new ResponsiblePerson;
                $part->post_id = $project_id;
                $part->post_type = 'project';
                $part->user_id = $person["id"];
                $part->tenant_id = $request->tenant_id;
                $part->save();
                $darray["persons"][] = $person["id"];
                $user = User::find($person['id']);
                //$user->notify(new NewPostNotification($task));
            }
        }
        //participants
        if (!empty($request->participants)) {
            foreach ($request->participants as $participant) {
                /*  $user = User::select('first_name', 'surname', 'email', 'id')->where('id', $participant)->first();
                \Mail::to($user->email)->send(new MailTask($user, $request, $url)); */
                $part = new Participant;
                $part->post_id = $project_id;
                $part->post_type = 'project';
                $part->user_id = $participant["id"];
                $part->tenant_id = $request->tenant_id;
                $part->save();
                $darray["participants"][] = $participant["id"];
            }
        }
        //observers
        if (!empty($request->observers)) {
            foreach ($request->observers as $observer) {
                /*  $user = User::select('first_name', 'surname', 'email', 'id')->where('id', $participant)->first();
                \Mail::to($user->email)->send(new MailTask($user, $request, $url)); */
                $part = new Observer;
                $part->post_id = $project_id;
                $part->post_type = 'project';
                $part->user_id = $observer["id"];
                $part->tenant_id = $request->tenant_id;
                $part->save();
                $darray["observes"][] = $observer["id"];

            }
        }

        return response()->json(['message' => 'Success! Task created.'], 200);
    }

    public function storeAnnouncement(Request $request)
    {

        $url = substr(sha1(time()), 10, 10);
        $announcement = new Post;
        $announcement->post_title = $request->subject;
        $announcement->user_id = $request->user_id;
        $announcement->tenant_id = $request->tenant_id;
        $announcement->post_content = $request->description;
        $announcement->post_type = 'announcement';
        $announcement->post_url = $url;
        $announcement->save();
        $announcement_id = $announcement->id;

        //notify
        $user = $announcement->user;
        $user->notify(new NewPostNotification($announcement));

        //save attachment
        if (!empty($request->attachment)) {
            $attach = new PostAttachment;
            $attach->post_id = $announcement_id;
            $attach->user_id = $request->user_id;
            $attach->tenant_id = $request->tenant_id;
            $attach->attachment = $request->attachment;
            $attach->save();
        }
        //responsible persons
        if ($request->recipient == 0) {
            $part = new ResponsiblePerson;
            $part->post_id = $announcement_id;
            $part->post_type = 'announcement';
            $part->user_id = 32;
            $part->tenant_id = $request->tenant_id;
						$part->save();
						$body = "Announcement";
						$title = "You have a new announcement";
						$this->ToAllUsers($request->tenant_id, $title, $body);
        } else {
            if (!empty($request->persons)) {

                foreach ($request->persons as $person) {

                    /*  $user = User::select('first_name', 'surname', 'email', 'id')->where('id', $participant)->first();
                    \Mail::to($user->email)->send(new MailTask($user, $request, $url)); */
                    $part = new ResponsiblePerson;
                    $part->post_id = $announcement_id;
                    $part->post_type = 'announcement';
                    $part->user_id = $person["id"];
                    $part->tenant_id = $request->tenant_id;
                    $part->save();
                    //send notification
                    $user = User::find($person['id']);
										$user->notify(new NewPostNotification($announcement));
										$body = "New Announcement";
										$title = "You have a new announcement";
										$this->ToSpecificUser($request->tenant_id, $title, $body,$person['id']);

                }
            }
        }
        if ($announcement) {
            return response()->json(['message' => 'Success!'], 200);
        } else {
            return response()->json(['error' => 'Ooops! Something went wrong. Try again.'], 400);
        }
    }

    public function storeEvent(Request $request)
    {

        $url = substr(sha1(time()), 10, 10);
        $event = new Post;
        $event->post_title = $request->subject;
        $event->user_id = $request->user_id;
        $event->post_content = $request->description;
        $event->post_type = 'event';
        $event->post_url = $url;
        $event->tenant_id = $request->tenant_id;
        $event->start_date = $request->start_date ?? '';
        $event->end_date = $request->due_date ?? '';
        $event->save();
        $event_id = $event->id;
        //send notification
        $user = $event->user;
        $user->notify(new NewPostNotification($event));

        //Attachment
        if (!empty($request->attachment)) {
            $attach = new PostAttachment;
            $attach->post_id = $event_id;
            $attach->user_id = $request->user_id;
            $attach->attachment = $request->attachment;
            $attach->tenant_id = $request->tenant_id;
            $attach->save();
        }

        //responsible persons
        if ($request->recipient == 0) {
            $part = new ResponsiblePerson;
            $part->post_id = $event_id;
            $part->post_type = 'event';
            $part->user_id = 32;
            $part->tenant_id = $request->tenant_id;
						$part->save();
						$body = "New Event";
						$title = "You have a new event";
						$this->ToAllUsers($request->tenant_id, $title, $body);
        } else {
            if (!empty($request->persons)) {
                foreach ($request->persons as $person) {
                    /*  $user = User::select('first_name', 'surname', 'email', 'id')->where('id', $participant)->first();
                    \Mail::to($user->email)->send(new MailTask($user, $request, $url)); */
                    $part = new ResponsiblePerson;
                    $part->post_id = $event_id;
                    $part->post_type = 'event';
                    $part->user_id = $person["id"];
                    $part->tenant_id = $request->tenant_id;
                    $part->save();
                    //send notification
                    $user = User::find($person['id']);
										$user->notify(new NewPostNotification($event));
										$body = "New Event";
										$title = "You have a new event";
										$this->ToSpecificUser($request->tenant_id, $title, $body,$person['id']);
                }
            }
        }
        if ($event) {
            return response()->json(['message' => 'Success! Event registered.'], 200);
        } else {
            return response()->json(['error' => 'Success! Ooops! Something went wrong. Try again.'], 400);
        }
    }

    public function storeReport(Request $request)
    {

        $department_id = $request->department_id;
        $tenant_id = $request->tenant_id;
        $reporttype = $request->type;
        $processor = RequestApprover::select('user_id')
            ->where('request_type', 'expense-report')
            ->where('depart_id', $department_id)
            ->where('tenant_id', $tenant_id)
            ->first();
        if (empty($processor)) {
            return;
        } else {

            $url = substr(sha1(time()), 10, 10);
            $expense = new Post;
            $expense->post_title = $request->subject;
            $expense->budget = $request->amount;
            $expense->currency = $request->currency;
            $expense->post_type = $reporttype; //'expense-report';
            $expense->post_content = $request->description;
            $expense->post_status = 'in-progress';
            $expense->user_id = $request->user_id;
            $expense->tenant_id = $request->tenant_id;
            $expense->post_url = $url;

            $expense->save();
            $id = $expense->id;

            //Attachment
            if (!empty($request->attachment)) {
                $attach = new PostAttachment;
                $attach->post_id = $id;
                $attach->user_id = $request->user_id;
                $attach->attachment = $request->attachment;
                $attach->tenant_id = $request->tenant_id;
                $attach->save();
            }

            $event = new ResponsiblePerson;
            $event->post_id = $id;
            $event->post_type = $request->type;
            $event->user_id = $processor->user_id;
            $event->tenant_id = $request->user_id;
            $event->save();
            $user = User::find($processor->user_id);
						$user->notify(new NewPostNotification($expense));

						$body = "New Requistion";
						$title = "You have a request";
						$this->ToSpecificUser($request->tenant_id, $title, $body, $person['id']);

            //Register business process log
            $log = new BusinessLog;
            $log->request_id = $id;
            $log->user_id = $request->user_id;
            $log->note = "Approval for expense report " . $request->subject . " registered.";
            $log->name = "Registering expense report";
            $log->tenant_id = $request->tenant_id;
            $log->save();

            //identify supervisor
            $supervise = new BusinessLog;
            $supervise->request_id = $id;
            $supervise->user_id = $request->user_id;
            $supervise->name = "Log entry";
            $supervise->note = "Identifying processor for " . $request->first_name . " " . $request->surname;
            $supervise->tenant_id = $request->tenant_id;
            $supervise->save();

            return response()->json(['message' => 'Success! Expense report submitted.']);

        }
    }

    public function deletePost(Request $request)
    {

        $post = Post::where('tenant_id', $request->tenant_id)->where('id', $request->post_id)->first();
        if (!empty($post)) {
            $post->delete();
            $responsible = ResponsiblePerson::where('post_id', $request->post_id)->where('tenant_id', $request->tenant_id)->get();
            if (!empty($responsible)) {
                foreach ($responsible as $person) {
                    $person->delete();
                }
            }

            #Observers
            $observers = Observer::where('post_id', $request->post_id)->where('tenant_id', $request->tenant_id)
                ->get();
            if (!empty($observers)) {
                foreach ($observers as $observer) {
                    $observer->delete();
                }
            }

            #Participants
            $participants = Participant::where('post_id', $request->post_id)->where('tenant_id', $request->tenant_id)
                ->get();
            if (!empty($participants)) {
                foreach ($participants as $participant) {
                    $participant->delete();
                }
            }

            return response()->json(['Response' => 'Success!'], 200);
        }

    }

    public function updatePost(Request $request)
    {
        $task = Post::where('post_url', $request->post_url)->where('tenant_id', $request->tenant_id)->first();
        $task->post_title = $request->post_title;
        $task->user_id = $request->user_id;
        $task->post_content = $request->post_description;
        $task->post_type = $request->post_type;
        $task->post_url = $request->post_url;
        $task->start_date = $request->start_date ?? '';
        $task->end_date = $request->due_date;
        $task->tenant_id = $request->tenant_id;
        $task->save();
        return response()->json(['Response' => 'Success!'], 200);
    }

    public function submitPost(Request $request)
    {

        $submit = new PostSubmission;
        $submit->post_id = $request->post_id;
        $submit->submitted_by = $request->user_id;
        $submit->owner = $request->owner;
        $submit->post_type = $request->post_type;
        $submit->post_id = $request->post_id;
        $submit->tenant_id = $request->tenant_id;
        $submit->date_submitted = now();
        $submit->note = $request->leave_note;
				$submit->save();



        if (!empty($request->attachment)) {
            $attach = new PostSubmissionAttachment;
            $attach->post_id = $request->post_id;
            $attach->attachment = $request->attachment;
            $attach->tenant_id = $request->tenant_id;
            $attach->save();
        }

        $user = User::where('id', $request->owner)->where('tenant_id', $request->tenant_id)->first();
        $content = Post::where('id', $request->post_id)->where('tenant_id', $request->tenant_id)->first();
				$user->notify(new SubmitTask($submit, $content));
				$user  = User::find($request->user_id);
				$body = $user["first_name"]."   ".$user['surname']."Just made a Submission";
				$title = "Task Submission";
				$this->ToSpecificUser($request->tenant_id, $title, $body,$request->owner);
        return response()->json(['Response' => 'Success!'], 200);

    }

    /*
     * Share file within the activity stream
     */
    public function shareFile(Request $request)
    {

        $url = substr(sha1(time()), 10, 10);
        $file = new Post;
        $file->post_title = $request->file_name;
        $file->user_id = $request->user_id;
        $file->tenant_id = $request->tenant_id;
        $file->post_content = $request->first_name . ' ' . $request->surname . ' shared a file titled <strong>' . $request->file_name . ' </strong>.';
        $file->post_type = 'file';
        $file->post_url = $url;
        $file->save();
        $file_id = $file->id;
        //Attachment
        if (!empty($request->attachment)) {
            $attach = new PostAttachment;
            $attach->post_id = $file_id;
            $attach->user_id = $request->user_id;
            $attach->attachment = $request->attachment;
            $attach->tenant_id = $request->tenant_id;
            $attach->save();
        }
        //responsible persons
        if ($request->recipient == 0) {
            $part = new ResponsiblePerson;
            $part->post_id = $file_id;
            $part->post_type = 'file';
            $part->user_id = 32;
            $part->tenant_id = $request->tenant_id;
						$part->save();

						$body = "A new file was shared with you";
						$title = "File Shared";
						$this->ToAllUsers($request->tenant_id, $title, $body);

        } else {

            if (!empty($request->persons)) {
                foreach ($request->persons as $person) {
                    $part = new ResponsiblePerson;
                    $part->post_id = $file_id;
                    $part->post_type = 'file';
                    $part->user_id = $person["id"];
                    $part->tenant_id = $request->tenant_id;
                    $part->save();
                    //send notification
                    $user = User::find($person['id']);
										$user->notify(new NewPostNotification($file));

										$body = "A new file was shared with you";
										$title = "File Shared";
										$this->ToSpecificUser($request->tenant_id, $title, $body,$part->user_id);

                }
            }
            //$user = User::find($person['id']);
            //$user->notify(new NewPostNotification($file));
        }

        if ($file) {
            return response()->json(['message' => 'Success! File shared.'], 200);
        } else {
            return response()->json(['error' => 'Ooops! Something went wrong. Try again.'], 400);
        }
    }

    public function priorities()
    {
        $priorites = Priority::all();
        return response()->json(['priorities' => $priorites], 500);
    }

    public function addResponsiblePerson(Request $request)
    {

        $post = Post::where('tenant_id', $request->tenant_id)->where('id', $request->post_id)->first();

        if (!empty($request->persons)) {
            foreach ($request->persons as $person) {

                $part = new ResponsiblePerson;

                $exists = ResponsiblePerson::where('tenant_id', $request->tenant_id)->where('user_id', $person["id"])->where('post_id', $request->post_id)->first();

                if (empty($exists) || is_null($exists)) {

                    $part->post_id = $request->post_id;
                    $part->post_type = $request->post_type;
                    $part->user_id = $person["id"];
                    $part->tenant_id = $request->tenant_id;
                    $part->save();
                    $user = User::find($person["id"]);
										$user->notify(new NewPostNotification($post));

										$body = "New Task";
										$title = "You have a new task";
										$this->ToSpecificUser($request->tenant_id, $title, $body,$person['id']);
                }
            }

            return response()->json(['Response' => 'Success!'], 200);
        }

    }

    public function addParticipant(Request $request)
    {
        $post = Post::where('tenant_id', $request->tenant_id)->where('id', $request->post_id)->first();
        if (!empty($request->persons)) {
            foreach ($request->persons as $person) {
                $part = new Participant();
                $exists = Participant::where('tenant_id', $request->tenant_id)->where('user_id', $person["id"])->where('post_id', $request->post_id)->first();
                if (empty($exists) || is_null($exists)) {
                    $part->post_id = $request->post_id;
                    $part->post_type = $request->post_type;
                    $part->user_id = $person["id"];
                    $part->tenant_id = $request->tenant_id;
                    $part->save();
                    $user = User::find($person["id"]);
										$user->notify(new NewPostNotification($post));

										$body = "New Task";
										$title = "You have a new task";
										$this->ToSpecificUser($request->tenant_id, $title, $body,$person['id']);
                }
            }

            return response()->json(['Response' => 'Success!'], 200);
        }
    }

    public function addObserver(Request $request)
    {
        $post = Post::where('tenant_id', $request->tenant_id)->where('id', $request->post_id)->first();
        if (!empty($request->persons)) {
            foreach ($request->persons as $person) {
                $part = new Observer();
                $exists = Observer::where('tenant_id', $request->tenant_id)->where('user_id', $person["id"])->where('post_id', $request->post_id)->first();
                if (empty($exists) || is_null($exists)) {
                    $part->post_id = $request->post_id;
                    $part->post_type = $request->post_type;
                    $part->user_id = $person["id"];
                    $part->tenant_id = $request->tenant_id;
                    $part->save();
                    $user = User::find($person["id"]);
										$user->notify(new NewPostNotification($post));

										$body = "New Task";
										$title = "You have a new task";
										$this->ToSpecificUser($request->tenant_id, $title, $body,$person['id']);
                }
            }

            return response()->json(['Response' => 'Success!'], 200);
        }
    }

    public function markAsComplete(Request $request)
    {
        $post = Post::where('id', $request->post_id)->where('tenant_id', $request->tenant_id)->first();
        $post->post_status = 'completed';
        $post->save();
        return response()->json(['Response' => 'Success!'], 200);
    }

    public function markAsRisk(Request $request)
    {
        $post = Post::where('id', $request->post_id)->where('tenant_id', $request->tenant_id)->first();
        $post->post_status = 'at-risk';
        $post->save();
        return response()->json(['Response' => 'Success!'], 200);
    }

    public function markAsHold(Request $request)
    {
        $post = Post::where('id', $request->post_id)->where('tenant_id', $request->tenant_id)->first();
        $post->post_status = 'on-hold';
        $post->save();
        return response()->json(['Response' => 'Success!'], 200);
    }

    public function markAsResolved(Request $request)
    {
        $post = Post::where('id', $request->post_id)->where('tenant_id', $request->tenant_id)->first();
        $post->post_status = 'resolved';
        $post->save();
        return response()->json(['Response' => 'Success!'], 200);
    }

    public function markAsClosed(Request $request)
    {
        $post = Post::where('id', $request->post_id)->where('tenant_id', $request->tenant_id)->first();
        $post->post_status = 'closed';
        $post->save();
        return response()->json(['Response' => 'Success!'], 200);

    }

    public function removeResponsiblePerson(Request $request)
    {
        $responsiblePerson = ResponsiblePerson::where('tenant_id', $request->tenant_id)->where('user_id', $request->user_id)->where('post_id', $request->post_id)->first();
        if (!empty($responsiblePerson)) {
            $responsiblePerson->delete();
        }
        return response()->json(['Response' => 'Success!'], 200);
    }

    public function removeObserver(Request $request)
    {
        $observer = Observer::where('tenant_id', $request->tenant_id)->where('user_id', $request->user_id)->where('post_id', $request->post_id)->first();
        if (!empty($observer)) {
            $observer->delete();
        }
        return response()->json(['Response' => 'Success!'], 200);
    }

    public function removeParticipant(Request $request)
    {
        $participant = Participant::where('tenant_id', $request->tenant_id)->where('user_id', $request->user_id)->where('post_id', $request->post_id)->first();
        if (!empty($participant)) {
            $participant->delete();
        }
        return response()->json(['Response' => 'Success!'], 200);
    }

    public function uploadReport(Request $request)
    {

        $driveCapacity = $this->getDriveSize($request);

        $used = $driveCapacity['used']; //in megabytes

        $capacity = $driveCapacity['capacity'];

        $capacity = ($capacity * 1024); // converting GB to megabytes;

        if ($used >= $capacity) {
            return response()->json(['Response' => "full"], 400);
        }

        if (!empty($request->file('attachment'))) {
            $extension = $request->file('attachment');
            $extension = $request->file('attachment')->getClientOriginalExtension();
            $size = $request->file('attachment')->getSize();
            $dir = 'assets/uploads/requisition/';
            $filename = uniqid() . '_' . time() . '_' . date('Ymd') . '.' . $extension;
            $request->file('attachment')->move(public_path($dir), $filename);
            return response()->json(['Response' => $filename], 200);
        } else {
            $filename = '';
            return response()->json(['Response' => ""], 204);
        }

    }

    public function upload(Request $request)
    {

        $driveCapacity = $this->getDriveSize($request);

        $used = $driveCapacity['used']; //in megabytes

        $capacity = $driveCapacity['capacity'];

        $capacity = ($capacity * 1024); // converting GB to megabytes;

        if ($used >= $capacity) {
            return response()->json(['Response' => "full"], 400);
        }

        if (!empty($request->file('attachment'))) {
            $extension = $request->file('attachment');
            $extension = $request->file('attachment')->getClientOriginalExtension(); // getting excel extension
            $dir = 'assets/uploads/attachments/';
            $filename = 'task_' . uniqid() . '_' . time() . '_' . date('Ymd') . '.' . $extension;
            $request->file('attachment')->move(public_path($dir), $filename);
            return response()->json(['Response' => $filename], 200);
        } else {
            $filename = '';
            return response()->json(['Response' => ""], 204);
        }

    }

    public function projectUpload(Request $request)
    {

        $driveCapacity = $this->getDriveSize($request);

        $used = $driveCapacity['used']; //in megabytes

        $capacity = $driveCapacity['capacity'];

        $capacity = ($capacity * 1024); // converting GB to megabytes;

        if ($used >= $capacity) {
            return response()->json(['Response' => "full"], 400);
        }

        if (!empty($request->file('attachment'))) {
            $extension = $request->file('attachment');
            $extension = $request->file('attachment')->getClientOriginalExtension(); // getting excel extension
            $dir = 'assets/uploads/attachments/';
            $filename = 'project_' . uniqid() . '_' . time() . '_' . date('Ymd') . '.' . $extension;
            $request->file('attachment')->move(public_path($dir), $filename);
            return response()->json(['Response' => $filename], 200);
        } else {
            $filename = '';
            return response()->json(['Response' => ""], );
        }

    }

    public function getmessages(Request $request)
    {

        $my_id = $request->my_id;
        $user_id = $request->user_id;
        $tenant_id = $request->tenant_id;
        $messages = Message::where(function ($query) use ($user_id, $my_id) {
            $query->where('from_id', $user_id)->where('to_id', $my_id);
        })->oRwhere(function ($query) use ($user_id, $my_id) {
            $query->where('from_id', $my_id)->where('to_id', $user_id);
        })->get();

        foreach ($messages as $message) {
            $message["date_sent"] = date('M j h:i a , Y', strtotime($message->created_at));
        }
        return response()->json(['Response' => $messages], 200);

    }

    public function sendChat(Request $request)
    {
        $send = new Message;
        $send->message = $request->message;
        $send->to_id = $request->receiver;
        $send->from_id = $request->sender_id;
        $send->tenant_id = $request->tenant_id;
				$send->save();
				$user = User::find($request->sender_id);
				$title = $user->first_name ." ".$user->surname;
				$this->ToSpecificUser($request->tenant_id, $title, $request->message, $request->sender_id);
        return response()->json(['Response' => "Sent"], 200);
    }

    public function verifyCode(Request $request)
    {

        $tenant_id = $request->tenant_id;
        $id = $request->post_id;
        $transactionPassword = $request->password;
        $user_id = $request->user_id;
        $userAction = $request->action;

        $user = User::where('users.tenant_id', $tenant_id)->where('users.id', $user_id)->get();

        //    var_dump($user[0]['surname']);
        //    return;

        $_transactionPassword = $user[0]["transaction_password"];

        if (Hash::check($transactionPassword, $_transactionPassword)) {
            $details = Post::find($id);
            if ($userAction == 'approved') {
                $action = ResponsiblePerson::where('post_id', $id)->where('user_id', $user_id)->first();
                $action->status = $userAction;
                $action->save();

                //Register business process log
                $log = new BusinessLog;
                $log->request_id = $id;
                $log->user_id = $user_id;
                $log->name = "Approved";
                $log->note = str_replace('-', ' ', $details->post_type) . " " . $log->name . " by " . $user[0]['first_name'] . " " . $user[0]['surname'] ?? " ";
                $log->save();
                $responsiblePersons = ResponsiblePerson::where('post_id', $id)->get();
                $responsiblePersonIds = [];
                foreach ($responsiblePersons as $per) {
                    array_push($responsiblePersonIds, $per->user_id);
                }

                //search for processor
                $approvers = RequestApprover::where('request_type', $details->post_type)->where('depart_id', $details->user->department_id)->where('tenant_id', $tenant_id)->get();
                $approverIds = [];
                if (!empty($approvers)) {
                    foreach ($approvers as $approver) {
                        array_push($approverIds, $approver->user_id);
                    }
                }
                $remainingProcessors = array_diff($approverIds, $responsiblePersonIds);
                //identify next supervisor
                $supervise = new BusinessLog;
                $supervise->request_id = $id;
                $supervise->user_id = $user_id;
                $supervise->name = 'Log entry';
                $supervise->note = "Identifying next processor for " . str_replace('-', ' ', $details->post_type) . ": " . $details->post_title;
                $supervise->save();
                //Assign next processor
                if (!empty($remainingProcessors)) {
                    $reset = array_values($remainingProcessors);
                    for ($i = 0; $i < count($reset); $i++) {
                        $next = new ResponsiblePerson;
                        $next->post_id = $id;
                        $next->post_type = $details->post_type;
                        $next->user_id = $reset[$i];
                        $next->tenant_id = $tenant_id;
                        $next->save();
                        $user = User::find($reset[$i]);
                        $user->notify(new NewPostNotification($details));
                        return response()->json(['Response' => "success"], 200);
                        break;
                    }
                } else {
                    $status = Post::find($id);
                    $status->post_status = $userAction;
                    $status->save();
                    return response()->json(['Response' => "success"], 200);
                    #Requisition to GL flow takes over from here
                }
                //    $this->actionStatus = 0;
                //    $this->verificationPostId = null;

            } else {
                $action = ResponsiblePerson::where('post_id', $id)->where('user_id', $user_id)->first();
                $action->status = $userAction;
                $action->save();
                //Register business process log
                $log = new BusinessLog;
                $log->request_id = $id;
                $log->user_id = $user_id;
                $log->name = $userAction;
                $log->note = str_replace('-', ' ', $details->post_type) . " " . $userAction . " by " . $user[0]["first_name"] . " " . $user[0]["surname"];
                $log->save();
                //update request table finally
                $status = Post::find($id);
                $status->post_status = $userAction;
                $status->save();
                return response()->json(['Response' => "success"], 200);
                //    $this->actionStatus = 0;
                //    $this->verificationPostId = null;

            }
        } else {
            //error
            return response()->json(['Response' => "An error has occured"], 200);
        }

    }

    public function getDriveSize(Request $request)
    {

        $tenant = Tenant::where("tenant_id", $request->tenant_id)->get();
        $planId = $tenant[0]['plan_id'];

        $plan_details = DB::table('plan_features')
            ->where('plan_id', '=', $planId)->first();

        //    return response()->json(["details"=>$plan_details,], 200);

        $storage_size = $plan_details->storage_size;

        $size = FileModel::where('tenant_id', $request->tenant_id)
            ->where('uploaded_by', $request->user_id)->sum('size');

        $postAttachments = PostAttachment::where('tenant_id', $request->tenant_id)->get();
        //print_r($postAttachments);

        $sum_post_attachment = 0;
        foreach ($postAttachments as $postAttachment) {
            if (file_exists(public_path('assets\uploads\attachments\\' . $postAttachment->attachment))) {
                $fileSize = \File::size(public_path('assets\uploads\attachments\\' . $postAttachment->attachment));
                //echo $fileSize;
                $sum_post_attachment = $sum_post_attachment + $fileSize;
            }

            if (file_exists(public_path('assets\uploads\requisition\\' . $postAttachment->attachment))) {
                $fileSize = \File::size(public_path('assets\uploads\requisition\\' . $postAttachment->attachment));
                //echo $fileSize;
                $sum_post_attachment = $sum_post_attachment + $fileSize;
            }

        }

        $workgroupAttachments = WorkgroupAttachment::where('tenant_id', $request->tenant_id)->get();

        $sum_workgroup_attachment = 0;
        foreach ($workgroupAttachments as $workgroupAttachment) {
            if (file_exists(public_path('assets\uploads\attachments\\' . $workgroupAttachment->attachment))) {
                $fileSize = \File::size(public_path('assets\uploads\attachments\\' . $workgroupAttachment->attachment));

                $sum_workgroup_attachment = $sum_workgroup_attachment + $fileSize;
            }

        }

        $drivers = Driver::where('tenant_id', $request->tenant_id)->get();

        $sum_driver_attachment = 0;

        foreach ($drivers as $driver):
            if (file_exists(public_path('assets\uploads\logistics\\' . $driver->attachment))):
                $fileSize = \File::size(public_path('assets\uploads\logistics\\' . $driver->attachment));
                //echo $fileSize;
                $sum_driver_attachment = $sum_driver_attachment + $fileSize;
            endif;
        endforeach;

        $size = ($sum_post_attachment + $sum_driver_attachment + $sum_workgroup_attachment + $size); /// 1000000000;

        //$size =     number_format(ceil($size/1024));
        $size = ceil(($size) / 1024 / 1024);

        $Array = array();
        $Array['used'] = $size; //in megabytes
        $Array['capacity'] = $storage_size; //in gigabytes

        //var_dump($Array);

        return $Array; //response()->json(["used" => $size, "size" => $storage_size, "formated" => number_format($size)], 200);

    }

    public function pushtoToken($token, $title, $body, $userId, $tenantId)
    {
        //$token, $title, $body, $userId, $tenantId

        $ch = curl_init("https://fcm.googleapis.com/fcm/send");

        $data = array("clickaction" => "FLUTTERNOTIFICATIONCLICK", "user" => $userId, "tenant_id" => $tenantId);

        //Creating the notification array.
        $notification = array('title' => $title, 'body' => $body);

        //This array contains, the token and the notification. The 'to' attribute stores the token.
        $arrayToSend = array('to' =>$token, 'notification' => $notification, 'data' => $data);

        //Generating JSON encoded string form the above array.
        $json = json_encode($arrayToSend);

        $url = "https://fcm.googleapis.com/fcm/send";
        //Setup headers:
        $headers = array();
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'Authorization: key=AAAAQ6WOcsM:APA91bGx5qqTvsZoFYEMdLiNuM-DlH509sszesHzH5IdW-_OqyRNAw8UrT1VfimR0ITKpF4sJCK7GOoeI0zPYvhkQu4gmow783ZG77Qrj8seV_0QgWkkCBGZ7oSSzdVoTKIckOusTI8x';

        //Setup curl, add headers and post parameters.
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($ch);
       // print($result);

        //Send the request
        //curl_exec($ch);

        //Close request
        curl_close($ch);
		}



		public function ToAllUsers($tenant_id, $title, $body, $userId="32")
		{
			$token = "/topics/all";
			$this->pushtoToken($token, $title, $body, $userId, $tenant_id);
		}


		public function ToSpecificUser($tenant_id, $title, $body, $userId)
		{
			$users = User::where('users.tenant_id', $tenant_id)->where('users.id', $userId)->get();
			foreach($users as $user)
			{
					 $token= $user['device_token'];
					 if($token !=null && !empty($token))
						{
							$this->pushtoToken($token, $title, $body, $userId, $tenant_id);
						}
			}
		}










}
