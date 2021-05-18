@extends('layouts.app')

@section('title')
    Chat
@endsection

@section('extra-styles')
<link rel="stylesheet" type="text/css" href="\assets\pages\message\message.css">
<link rel="stylesheet" type="text/css" href="\assets\css\cus\chat.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/material-design-icons/3.0.1/iconfont/material-icons.min.css" rel="stylesheet">
<style>
/* width */
::-webkit-scrollbar {
  width: 10px;
}

/* Track */
::-webkit-scrollbar-track {
  background: #f1f1f1;
}

/* Handle */
::-webkit-scrollbar-thumb {
  background: #888;
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
  background: #555;
}
</style>
@endsection

@section('content')
	<div class="chat-container" id="chat" style="margin-top:-20px;">
		<div class="row no-gutters">
			<div class="col-md-4 border-right">
				<div class="settings-tray">
					<img class="profile-image" :src="'/assets/images/avatars/thumbnails/'+auth_user.avatar" :alt="auth_user.first_name">
					<span class="settings-tray--right">
						<i class="material-icons" @click="initializeChat">cached</i>
					</span>
				</div>
				<div class="search-box">
					<div class="input-wrapper">
						<i class="material-icons">search</i>
						<input placeholder="Search here" type="text" v-model="searchText" @keyup="searchContact">
					</div>
				</div>

				<div  style="overflow-y: scroll; height:500px;background: transparent;">
					<div v-for="user in sortedContacts"  class="friend-drawer friend-drawer--onhover" @click="getSelectedUser(user.id)">
						<img class="profile-image" :src="'/assets/images/avatars/thumbnails/'+user.avatar" alt="">
						<div class="live-status" :class="user.is_online == 1 ? 'bg-success' : 'bg-danger'"></div>
						<div class="text">
							<h6>@{{user.first_name}} @{{user.surname}}</h6>
							<p class="text-muted"> @{{user.email}}</p>
						</div>
						<span class="time text-muted small">
							<span class="badge badge-danger" v-if="user.unread > 0 ">@{{  user.unread }}</span>
						</span>
					</div>
					<div class="text" v-if="noRecord">
						<div><h6 class="text-center">No record match your search</h6></div>
						<hr>
						<div class="btn-group d-flex justify-content-center">
							<button class="btn btn-mini btn-light"><i class="material-icons" @click="initializeChat()">cached</i></button>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-8 " style="background: url(/assets/images/chat-bg.png);">
				<div class="settings-tray">
						<div class="friend-drawer no-gutters friend-drawer--grey">
						<img class="profile-image" :src="'/assets/images/avatars/thumbnails/'+selected_user_details.avatar" v-if="selected_user" :alt="selected_user_details.first_name">
						<img class="profile-image" :src="'/assets/images/avatars/thumbnails/'+auth_user.avatar" v-else :alt="auth_user.first_name">
						<div class="text">
							<h6 v-if="!selected_user">@{{auth_user.first_name}} @{{auth_user.surname}}</h6>
							<h6 v-else>@{{selected_user_details.first_name}} @{{selected_user_details.surname}}</h6>
							<p v-if="selected_user">@{{selected_user_details.position}} <small v-if="selected_user_details.is_online == 1">Online</small> <small v-else>Offline</small></p>
							<p v-else>@{{auth_user.position}}</p>
						</div>
						<span class="settings-tray--right dropdown" v-if="selected_user">
							<i class="material-icons" @click="getSelectedUser(selected_user)">cached</i>
						{{-- 	<i class="material-icons">call</i> --}}
							<i class="material-icons dropdown-toggle" data-toggle="dropdown" >menu</i>
							<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
								<a class="dropdown-item" :href=`/activity-stream/profile/${selected_user_details.url}`>Contact info</a>
								<a class="dropdown-item" href="javascript:void(0);" @click="clearMessages(selected_user)">Clear messages</a>
							</div>
						</span>
					</div>
				</div>
				<div class="chat-panel conversation" id="messageWrapper">
					<div class="row no-gutters"  v-if="!selected_user">
							<div class="col-md-8">
									<div class="chat-bubble chat-bubble--left w-100 text-primary text-center">
											Hello @{{auth_user.first_name}}, select a contact on your left to <strong>start a conversation</strong>
									</div>
							</div>
					</div>
					<div class="row no-gutters"  v-for="(msg,index) in messages">
						<div :class="`col-md-5${msg.from_id != auth_user.id ? ' ' : ' offset-md-7'}`">
							<div :class="`chat-bubble${msg.from_id != auth_user.id ? ' chat-bubble--left' : ' chat-bubble--right'}`" :key="msg.id">
								<div v-if="msg.message">
									@{{msg.message}} <br>
									<small class="ml-3 text-muted">@{{date(msg.created_at)}}</small>
								</div>
								<div v-else>
									<a :href="'/assets/uploads/attachments/'+msg.attachment" target="_blank" style="cursor: pointer;" data-toggle="tooltip" data-placement="top" >
										<img src="/assets/formats/file.png" height="32" width="32" >
									</a>
									<small class="ml-3 text-muted">@{{date(msg.created_at)}}</small>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="row" >
					<div class="col-12" v-if="selected_user">
						<div class="chat-box-tray">
							<i style="cursor: pointer;" class="material-icons"  @click="triggerFileUpload">attachment</i>
							<input type="file" hidden id="attachment" ref="attachment" >
							<input type="text" v-model="compose_message" @keydown.enter="sendMessage" style="padding: 7px; color: #000000; height:50px;" placeholder="Type your message here...">
							{{-- <i class="material-icons">mic</i> --}}
							<i style="cursor: pointer;" class="material-icons" @click="sendMessage">send</i>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
@endsection

@section('dialog-section')

@endsection
@section('extra-scripts')

<script>
	$(document).ready(function(){
		$( '.friend-drawer--onhover' ).on( 'click',  function() {

			$( '.chat-bubble' ).hide('slow').show('slow');
		});
	});


</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="https://unpkg.com/vue"></script>
<script src="/js/chat.js"></script>
@endsection
