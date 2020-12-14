<?php

namespace App\Http\Controllers\CNX247\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use Auth;

class TaskControllerAPI extends Controller
{

    public function getTaskCalendarData(){
        $task = Post::select('post_title as title', 'start_date as start', 'end_date as end', 'post_color as color')
                    ->where('post_type', 'task')
                    ->where('tenant_id', Auth::user()->tenant_id)->get();
        return response($task);
    }
}
