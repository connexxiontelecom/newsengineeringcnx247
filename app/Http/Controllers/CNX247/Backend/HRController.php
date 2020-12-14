<?php

namespace App\Http\Controllers\CNX247\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Notifications\QueryEmployeeNotification;
use App\ModuleManager;
use App\QueryEmployee;
use Carbon\Carbon;
use App\Clocker;
use App\Resignation;
use App\Department;
use App\QuestionSelf;
use App\QuestionQuantitative;
use App\QuestionQualitative;
use App\EmployeeAppraisal;
use App\EmploymentTerminationLog;
use App\User;
use App\AnswerSelf;
use App\AnswerQuantitative;
use App\AnswerQualitative;
use App\Supervisor;
use App\IdeaBox;
use App\JobRole;
use App\Post;
use Auth;
use DB;


class HRController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /*
    * HR dashboard
    */
    public function hrDashboard(){
        $now = Carbon::now();
        $birthdays = User::where('tenant_id', Auth::user()->tenant_id)
                            ->whereBetween('birth_date', [$now->startOfWeek()->format('Y-m-d H:i'), $now->addMonths(3)])
                            ->take(5)->get();
        $employees = User::where('tenant_id', Auth::user()->tenant_id)->get();
        $announcement = Post::where('tenant_id', Auth::user()->tenant_id)->where('post_type', 'announcement')->take(10)->get();
        $leaves = Post::where('tenant_id', Auth::user()->tenant_id)->where('post_type', 'leave-request')->where('post_status', 'approved')->count();
        $departments = Department::where('tenant_id', Auth::user()->tenant_id)->count();
        $attendance = Clocker::distinct('user_id')->where('tenant_id', Auth::user()->tenant_id)
                            ->whereDate('clock_in', Carbon::today())->get();

        return view('backend.hr.dashboard', [
            'employees'=>$employees,
            'attendance'=>$attendance,
            'departments'=>$departments,
            'birthdays'=>$birthdays,
            'announcement'=>$announcement,
            'leaves'=>$leaves
        ]);
    }
    /*
    * Get list of all employees
    */
    public function index(){
        $data['employeees'] = User::where('tenant_id', Auth::user()->tenant_id)->get();
       //print_r($data);
        return view('backend.hr.employees', $data);
    }

    /*
    * Employee attendance is based on clock-in/out activities
    */
    public function attendance(){
        $attendance = Clocker::distinct('clock_in')->where('tenant_id', Auth::user()->tenant_id)->orderBy('id', 'DESC')->get();
        return view('backend.hr.attendance', ['attendance'=>$attendance]);
    }

    /*
    * Leave management
    */
    public function leaveManagement(){
        return view('backend.hr.leave-management');
    }
    /*
    * Leave wallet
    */
    public function leaveWallet(){

        return view('backend.hr.leave-wallet');
    }
    /*
    * Leave types
    */
    public function leaveType(){

        return view('backend.hr.leave-types');
    }
    /*
    * Timesheet
    */
    public function timesheet(){

        return view('backend.hr.timesheet');
    }

    /*
    * Performance indicator
    */
    public function performanceIndicator(){
        $selfQuestions = QuestionSelf::where('tenant_id', Auth::user()->tenant_id)->get();
        $quantitativeQuestions = QuestionQuantitative::where('tenant_id', Auth::user()->tenant_id)->get();
        $qualitativeQuestions = QuestionQualitative::where('tenant_id', Auth::user()->tenant_id)->get();
        $roles = JobRole::where('tenant_id', Auth::user()->tenant_id)->get();
        return view('backend.hr.indicator',[
            'self'=>$selfQuestions,
            'quantitatives'=>$quantitativeQuestions,
            'qualitatives'=>$qualitativeQuestions,
            'roles'=>$roles
        ]);
    }

    public function jobRoleQuestions($id){
        $role = JobRole::where('id', $id)->where('tenant_id', Auth::user()->tenant_id)->first();
        if(!empty($role)){
            $questions = QuestionQuantitative::where('tenant_id', Auth::user()->tenant_id)
                        ->where('role_id', $id)
                        ->get();
            return view('backend.hr.job-role-questions', ['questions'=>$questions,'id'=>$id, 'role'=>$role]);
        }
    }
    /*
    *Employee appreciation
    */
    public function appreciation(){
        return view('backend.hr.appreciation');
    }

    /*
    *Employee resignation
    */
    public function resignation(){
        return view('backend.hr.resignation');
    }

    /*
    *Submit resignation letter
    */
    public function submitResignation(Request $request){
        $this->validate($request,[
            'subject'=>'required',
            'content'=>'required',
            'effective_date'=>'required'
        ]);
        $resign = new Resignation;
        $resign->subject = $request->subject;
        $resign->effective_date = $request->effective_date;
        $resign->content = $request->content;
        $resign->user_id = Auth::user()->id;
        $resign->tenant_id = Auth::user()->tenant_id;
        $resign->slug = sha1(time());
        $resign->save();
        if($resign){
            return response()->json(['message'=>'Success! Resignation submitted.'],200);
        }else{
            return response()->json(['error'=>'Ooops! Could not submit. Try again.'],400);
        }
    }

    /*
    *Complaints
    */
    public function complaints(){
        return view('backend.hr.complaint');
    }
    /*
    *staff onBoarding
    */
    public function onBoarding(){
        return view('backend.hr.on-boarding');
    }

    /*
    * HR Configurations
    */
    public function hrConfigurations(){
        return view('backend.hr.hr-configurations');
    }

    /*
    * Assign Permission to employee
    */
    public function assignPermissionToEmployee($url){
        #User to assign permission
        $user = User::where('url',$url)->first();
        #Get plans/role for this tenant
        #The role table is used for pricing plan also. What differentiate role from price plan is TYPE
        $role = Role::find(Auth::user()->tenant->plan_id)->first();
        #role_has_permissions [get permission ID]
        $permissionObj = DB::table('role_has_permissions')
                            ->select('permission_id')
                            ->distinct()
                            ->where('role_id', Auth::user()->tenant->plan_id)->get();

        #Convert $permissionObj to array
        $permissionIds = array();
        foreach ($permissionObj as $per) {
            array_push($permissionIds,$per->permission_id);
        }
        #Use permission IDs to get module Obj
        $moduleObj = Permission::select('module')->whereIn('id', $permissionIds)->distinct()->get();
        #Convert $moduleObj to array
        $moduleIds = array();
        foreach($moduleObj as $mod){
            array_push($moduleIds, $mod->module);
        }
        #Get list of modules for this tenant
        $modules = ModuleManager::whereIn('id', $moduleIds)->orderBy('module_name', 'ASC')->get();
        return view('backend.hr.assign-permission-to-user',
        ['user'=>$user,
        'modules'=>$modules
        ]);
    }

    /*
    * Assign permission to user [store]
    */
    public function storeUserPermission(Request $request){
        $user = User::find($request->user);
        $user->syncPermissions($request->permission); //revoke & add new permissions in one go
        session()->flash("success", "<strong>Success!</strong> Permissions assigned to ".$user->first_name);
        return back();
    }

    /*
    * Assign role to employee
    */
    public function assignRoleToEmployee($url){
        //$user = User::where('url',$url)->first();
        //$user->giveRoleTo();

    }

    /*
    * Query employee
    */
    public function queryEmployee($url){
        $employee = User::where('url', $url)->where('tenant_id', Auth::user()->tenant_id)->first();
        return view('backend.hr.query-employee', ['employee'=>$employee]);
    }

    public function storeQueryEmployee(Request $request){
        $this->validate($request,[
            'subject'=>'required',
            'query_type'=>'required',
            'query_content'=>'required',
            'employee_id'=>'required'
        ]);
        $query = new QueryEmployee;
        $query->subject = $request->subject;
        $query->query_type = $request->query_type;
        $query->query_content = $request->query_content;
        $query->user_id = $request->employee_id;
        $query->queried_by = Auth::user()->id;
        $query->tenant_id = Auth::user()->tenant_id;
        $query->slug = substr(sha1(time()), 23,40);
        $query->save();
        $user = User::find($request->employee_id);
        $user->notify(new QueryEmployeeNotification($query));
        session()->flash("success", "Query submitted.");
        return redirect()->route('queries');
    }

    public function queries(){
        $queries = QueryEmployee::where('tenant_id', Auth::user()->tenant_id)->orderBy('id', 'DESC')->get();
        return view('backend.hr.queries', ['queries'=>$queries]);
    }

    public function viewQuery($slug){
        $query = QueryEmployee::where('tenant_id', Auth::user()->tenant_id)->where('slug', $slug)->first();
        if(!empty($query) ){
            return view('backend.hr.view-query');
        }else{
            return redirect()->route('404');
        }
    }

    public function selfAssessmentQuestion(Request $request){
        $this->validate($request,[
            'question'=>'required'
        ]);
        $question = new QuestionSelf;
        $question->question = $request->question;
        $question->tenant_id = Auth::user()->tenant_id;
        $question->added_by = Auth::user()->id;
        $question->save();
        return response()->json(['message'=>'Success! New question saved.'],200);
    }
    public function editSelfAssessmentQuestion(Request $request){
        $this->validate($request,[
            'question'=>'required'
        ]);
        $question =  QuestionSelf::where('tenant_id', Auth::user()->tenant_id)->where('id',$request->id)->first();
        $question->question = $request->question;
        $question->tenant_id = Auth::user()->tenant_id;
        $question->added_by = Auth::user()->id;
        $question->save();
        return response()->json(['message'=>'Success! Changes saved.'],200);
    }

    public function quantitativeAssessmentQuestion(Request $request){
        $this->validate($request,[
            'question'=>'required',
            'role'=>'required'
        ]);
        $department = JobRole::where('id', $request->role)->where('tenant_id', Auth::user()->tenant_id)->first();
        $question = new QuestionQuantitative;
        $question->question = $request->question;
        $question->tenant_id = Auth::user()->tenant_id;
        $question->added_by = Auth::user()->id;
        $question->role_id = $request->role;
        $question->department_id = $department->department_id;
        $question->save();
        return response()->json(['message'=>'Success! New question saved.'],200);
    }
    public function editQuantitativeAssessmentQuestion(Request $request){
        $this->validate($request,[
            'question'=>'required'
        ]);
        $question =  QuestionQuantitative::where('tenant_id', Auth::user()->tenant_id)
                                            ->where('id',$request->id)
                                            ->first();
        $question->question = $request->question;
        $question->tenant_id = Auth::user()->tenant_id;
        $question->added_by = Auth::user()->id;
        $question->save();
        return response()->json(['message'=>'Success! Changes saved.'],200);
    }
    public function qualitativeAssessmentQuestion(Request $request){
        $this->validate($request,[
            'question'=>'required'
        ]);
        $question = new QuestionQualitative;
        $question->question = $request->question;
        $question->tenant_id = Auth::user()->tenant_id;
        $question->added_by = Auth::user()->id;
        $question->save();
        return response()->json(['message'=>'Success! New question saved.'],200);
    }
    public function editQualitativeAssessmentQuestion(Request $request){
        $this->validate($request,[
            'question'=>'required'
        ]);
        $question =  QuestionQualitative::where('tenant_id', Auth::user()->tenant_id)
                                            ->where('id',$request->id)
                                            ->first();
        $question->question = $request->question;
        $question->tenant_id = Auth::user()->tenant_id;
        $question->added_by = Auth::user()->id;
        $question->save();
        return response()->json(['message'=>'Success! Changes saved.'],200);
    }

    public function employeePerformance(){
        $employees = User::where('tenant_id', Auth::user()->tenant_id)->get();
        $supervisors = Supervisor::where('tenant_id', Auth::user()->tenant_id)->get();
        $appraisals = EmployeeAppraisal::where('tenant_id', Auth::user()->tenant_id)->orderBy('id', 'DESC')->get();
        return view('backend.hr.employee-appraisal',
        ['employees'=>$employees,
        'supervisors'=>$supervisors,
        'appraisals'=>$appraisals
        ]);
    }

    public function storeAppraisal(Request $request){
        $this->validate($request,[
            'employee'=>'required',
            'supervisor'=>'required',
            'start_date'=>'required|date',
            'end_date'=>'required|date|after_or_equal:start_date'
        ]);
        $appraisal = new EmployeeAppraisal;
        $appraisal->employee = $request->employee;
        $appraisal->supervisor = $request->supervisor;
        $appraisal->start_date = $request->start_date;
        $appraisal->end_date = $request->end_date;
        $appraisal->appraisal_id = substr(sha1(time()), 25,40);
        $appraisal->tenant_id = Auth::user()->tenant_id;
        $appraisal->save();
        return response()->json(['message'=>'Success! New appraisal registered.']);
    }
    public function storeBulkAppraisal(Request $request){
        $this->validate($request,[
            'employees'=>'required',
            'supervisor'=>'required',
            'start_date'=>'required|date',
            'end_date'=>'required|date|after_or_equal:start_date'
        ]);

        foreach($request->employees as $employee)
        {
            $appraisal = new EmployeeAppraisal;
            $appraisal->employee = $employee;
            $appraisal->supervisor = $request->supervisor;
            $appraisal->start_date = $request->start_date;
            $appraisal->end_date = $request->end_date;
            $appraisal->appraisal_id = substr(sha1(time()), 25,40);
            $appraisal->tenant_id = Auth::user()->tenant_id;
            $appraisal->save();
        }
        return response()->json(['message'=>'Success! New appraisal registered.']);
    }

    public function selfAppraisal($appraisal_id){
        $appraisal = EmployeeAppraisal::where('appraisal_id', $appraisal_id)
                                        ->where('tenant_id', Auth::user()->tenant_id)
                                        ->first();
        if(!empty($appraisal) ){
            $questions = QuestionSelf::where('tenant_id', Auth::user()->tenant_id)->get();
            return view('backend.hr.employee-appraisal-self',
            ['questions'=>$questions, 'type'=>'self', 'appraisal_id'=>$appraisal_id]);
        }else{
            return redirect()->route('404');
        }
    }

    public function storeSelfAppraisal(Request $request){
       // return dd($request->all());
        $this->validate($request,[
            'questions'=>'required'
        ]);
        for($i = 0; $i<count($request->questions); $i++){
            $self = new AnswerSelf;
            $self->question_id = $request->questions[$i];
            $self->answer = $request->answers[$i];
            $self->appraisal_id = $request->appraisal_id;
            $self->tenant_id = Auth::user()->tenant_id;
            $self->user_id = Auth::user()->id;
            $self->save();
        }
        $appraisal = EmployeeAppraisal::where('tenant_id', Auth::user()->tenant_id)
                                        ->where('appraisal_id', $request->appraisal_id)->first();
        if(!empty($appraisal) ){
            $appraisal->employee_status = 1; //done
            $appraisal->appraisal_status =  $appraisal->supervisor_status == 1 ? 1 : 0; //done
            $appraisal->save();
        }
        session()->flash("success", "<strong>Success!</strong> Employee appraisal done.");
        return redirect()->route('user-administration');
    }
    public function supervisorAppraisal($appraisal_id){
        $appraisal = EmployeeAppraisal::where('appraisal_id', $appraisal_id)
                                        ->where('tenant_id', Auth::user()->tenant_id)
                                        ->first();
        if(!empty($appraisal) ){
            $user = User::where('tenant_id', Auth::user()->tenant_id)->first();
            $quantitatives = QuestionQuantitative::where('tenant_id', Auth::user()->tenant_id)
                                                    ->where('role_id', $user->job_role)->get();
            $qualitatives = QuestionQualitative::where('tenant_id', Auth::user()->tenant_id)->get();
            return view('backend.hr.employee-appraisal-supervisor',
            [
                'quantitatives'=>$quantitatives,
                'qualitatives'=>$qualitatives,
                'appraisal'=>$appraisal
                ]);
        }else{
            return redirect()->route('404');
        }
    }

    public function storeSupervisorAppraisal(Request $request){
        //return dd($request->all());
        $this->validate($request,[
            'quantitative'=>'required',
            'qualitative'=>'required',
            'quantitative_rating'=>'required',
            'qualitative_rating'=>'required'
        ]);
        for($i = 0; $i<count($request->quantitative); $i++){
            $self = new AnswerQuantitative;
            $self->question_id = $request->quantitative[$i];
            $self->rating = $request->quantitative_rating[$i];
            $self->appraisal_id = $request->appraisal_id;
            $self->tenant_id = Auth::user()->tenant_id;
            $self->user_id = $request->user_id;
            $self->supervisor = Auth::user()->id;
            $self->save();
        }
        for($i = 0; $i<count($request->qualitative); $i++){
            $self = new AnswerQualitative;
            $self->question_id = $request->qualitative[$i];
            $self->rating = $request->qualitative_rating[$i];
            $self->appraisal_id = $request->appraisal_id;
            $self->tenant_id = Auth::user()->tenant_id;
            $self->user_id = $request->user_id;
            $self->supervisor = Auth::user()->id;
            $self->save();
        }
        $appraisal = EmployeeAppraisal::where('tenant_id', Auth::user()->tenant_id)
                                        ->where('appraisal_id', $request->appraisal_id)->first();
        if(!empty($appraisal) ){
            $appraisal->supervisor_status = 1; //done
            $appraisal->appraisal_status =  $appraisal->employee_status == 1 ? 1 : 0; //done
            $appraisal->save();
        }
        session()->flash("success", "<strong>Success!</strong> Employee appraisal done.");
        return redirect()->route('user-administration');
    }

    public function appraisalResult($appraisal_id){
        $appraisal = EmployeeAppraisal::where('tenant_id', Auth::user()->tenant_id)
                                        ->where('appraisal_id', $appraisal_id)
                                        ->first();
        $self = AnswerSelf::where('tenant_id', Auth::user()->tenant_id)
                            ->where('appraisal_id', $appraisal_id)
                            ->get();
        $qualitative = AnswerQualitative::where('tenant_id', Auth::user()->tenant_id)
                            ->where('appraisal_id', $appraisal_id)
                            ->get();
        $quantitative = AnswerQuantitative::where('tenant_id', Auth::user()->tenant_id)
                            ->where('appraisal_id', $appraisal_id)
                            ->get();
        if(!empty($self)  && !empty($qualitative) && !empty($quantitative) && !empty($appraisal) ){
            return view('backend.hr.employee-appraisal-result',[
                'appraisal'=>$appraisal,
                'self'=>$self,
                'qualitative'=>$qualitative,
                'quantitative'=>$quantitative
            ]);
        }

    }


    public function viewResignation($url){

        $post = Resignation::where('tenant_id', Auth::user()->tenant_id)->where('slug', $url)->first();
        if(!empty($post)){
            return view('backend.hr.view-resignation');
        }else{
            return redirect()->route('404');
        }
    }

    public function ideaBox(){
        $ideas = IdeaBox::where('tenant_id', Auth::user()->tenant_id)
                        ->where('user_id', Auth::user()->id)->get();
        return view('backend.hr.idea-box',['ideas'=>$ideas]);
    }

    public function terminateEmployment(Request $request){
        $this->validate($request,[
            'user'=>'required'
        ]);
        $user = User::where('id', $request->user)->where('tenant_id', Auth::user()->tenant_id)->first();
        if(!empty($user)){
            $user->account_status = 2;
            $user->save();
            #Register log
            $log = new EmploymentTerminationLog;
            $log->terminated_by = Auth::user()->id;
            $log->tenant_id = Auth::user()->tenant_id;
            $log->effective_date = now();
            $log->user_id = $request->user;
            $log->save();
            return response()->json(["message"=>"Success! ".$user->first_name."'s employment terminated"],200);
        }else{
            session()->flash("error", "<strong>Ooops!</strong> Could not terminate employment");
            return redirect()->back();
        }
    }

    public function terminatedEmployment(){
        $now = Carbon::now();
        $terminations = EmploymentTerminationLog::where('tenant_id', Auth::user()->tenant_id)->get();
        $thisYear = EmploymentTerminationLog::where('tenant_id', Auth::user()->tenant_id)
                                ->whereYear('effective_date', date('Y'))
                                ->count();
        $thisMonth = EmploymentTerminationLog::where('tenant_id', Auth::user()->tenant_id)
                                ->whereMonth('effective_date', date('m'))
                                ->whereYear('effective_date', date('Y'))
                                ->count();
        $lastMonth = EmploymentTerminationLog::where('tenant_id', Auth::user()->tenant_id)
                            ->whereMonth('effective_date', '=', $now->subMonth()->month)
                            ->count();
        $thisWeek = EmploymentTerminationLog::where('tenant_id', Auth::user()->tenant_id)
                                ->whereBetween('effective_date', [$now->startOfWeek()->format('Y-m-d H:i'), $now->endOfWeek()->format('Y-m-d H:i')])
                                ->count();
        return view('backend.hr.terminated-employment', [
            'terminations'=>$terminations,
            'thisMonth'=>$thisMonth,
            'thisYear'=>$thisYear,
            'thisWeek'=>$thisWeek,
            'lastMonth'=>$lastMonth
            ]);
    }
}
