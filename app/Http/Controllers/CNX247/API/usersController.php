<?php

namespace App\Http\Controllers\CNX247\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Message;
class usersController extends Controller
{
		//
		public function users(Request $request)
		{
			$tenant_id = $request->input("tenant_id");
			$my_id = $request->input("user_id");
			$users = User::where('users.tenant_id', $tenant_id)->get();
			foreach($users as $user)
			{
				   /* parse profile picture */
					 $user["avatar"] = url("/assets/images/avatars/thumbnails/" . $user["avatar"]);
					 $user_id = $user['id'];
				 $messages = Message::where(function ($query) use ($user_id, $my_id) {
					$query->where('from_id', $user_id)->where('to_id', $my_id);
				})->oRwhere(function ($query) use ($user_id, $my_id) {
						$query->where('from_id', $my_id)->where('to_id', $user_id);
				})->get();


				foreach ($messages as $message) {
					$message["date_sent"] = date('M j h:i a , Y', strtotime($message->created_at));
			}

			$user["msgs"] = $messages;

			}
			return response()->json(['users' => $users,
		], 500);
		}



		public function saveUserDeviceToken(Request $request)
		{

			$tenant_id = $request->tenant_id;
			$user_id = $request->user_id;
			$token = $request->token;
			$user  = User::find($user_id);
			$user->device_token =$token;
			$user->save();

		}





}//end class
