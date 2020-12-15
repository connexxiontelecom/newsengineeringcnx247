@extends('layouts.app')

@section('title')
    Chat
@endsection

@section('extra-styles')
<link rel="stylesheet" type="text/css" href="\assets\pages\message\message.css">
<link rel="stylesheet" type="text/css" href="\assets\css\cus\chat.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/material-design-icons/3.0.1/iconfont/material-icons.min.css" rel="stylesheet">

@endsection

@section('content')
	<div class="container" id="chat">
		<div class="row no-gutters">
			<div class="col-md-4 border-right">
				<div class="settings-tray">
					<img class="profile-image" :src="'/assets/images/avatars/thumbnails/'+auth_user.avatar" :alt="auth_user.first_name">
					<span class="settings-tray--right">
						<i class="material-icons">cached</i>
						<i class="material-icons">message</i>
						<i class="material-icons">menu</i>
					</span>
				</div>
				<div class="search-box">
					<div class="input-wrapper">
						<i class="material-icons">search</i>
						<input placeholder="Search here" type="text">
					</div>
				</div>

				<div  style="height:500px; overflow-x: scroll;">
					<div v-for="(user, index) in users" class="friend-drawer friend-drawer--onhover" @click="getSelectedUser(user.id)">
						<img class="profile-image" :src="'/assets/images/avatars/thumbnails/'+user.avatar" alt="">
						<div class="live-status bg-success"></div>
						<div class="text">
							<h6>@{{user.first_name}} @{{user.surname}}</h6>
							<p class="text-muted"> Hey, you're arrested!</p>
						</div>
						<span class="time text-muted small">
							<span class="badge badge-danger" v-if="user.unread > 0 ">@{{  user.unread }}</span>
						</span>
					</div>
				</div>
			</div>
			<div class="col-md-8 " style="background: url(/assets/images/chat-bg.png);">
				<div class="settings-tray">
						<div class="friend-drawer no-gutters friend-drawer--grey">
						<img class="profile-image" :src="'/assets/images/avatars/thumbnails/'+selected_user_details.avatar" v-if="messages.length > 0" :alt="selected_user_details.first_name">
						<img class="profile-image" :src="'/assets/images/avatars/thumbnails/'+auth_user.avatar" v-if="messages.length <= 0" :alt="auth_user.first_name">
						<div class="text">
							<h6 v-if="messages.length <= 0">@{{auth_user.first_name}} @{{auth_user.surname}}</h6>
							<h6 v-if="messages.length > 0">@{{selected_user_details.first_name}} @{{selected_user_details.surname}}</h6>
							<p class="text-muted">Layin' down the law since like before Christ...</p>
						</div>
						<span class="settings-tray--right">
							<i class="material-icons">cached</i>
							<i class="material-icons">message</i>
							<i class="material-icons">menu</i>
						</span>
					</div>
				</div>
				<div class="chat-panel conversation" >

					<div class="row no-gutters" v-if="messages.length <= 0">
						<div class="col-md-8">
							<div class="chat-bubble chat-bubble--left w-100 text-primary text-center">
								Hello @{{auth_user.first_name}}, select a contact on your left to <strong>start conversation</strong>
							</div>
						</div>
					</div>
					<div class="row no-gutters" v-if="messages.length > 0" v-for="(msg,index) in messages">
						<div ref="messageWrapper" style="min-width: 190px; padding: 7px; max-width: auto;" :class="auth_user.id == msg.to_id ? '' : 'offset-md-7'">
							<div class="chat-bubble " :class="auth_user.id == msg.to_id ? 'chat-bubble--left' : 'chat-bubble--right' ">
								@{{msg.message}}
								<br>
								<p class="float-right"><small>@{{date(msg.created_at)}}</small></p>
							</div>
						</div>
					</div>

				</div>

				<div class="row" >
					<div class="col-12" >
						<div class="chat-box-tray">
							<i style="cursor: pointer;" class="material-icons">sentiment_very_satisfied</i>
							<input type="text" v-model="compose_message" @keydown.enter="sendMessage" style="padding: 7px; color: #B1B1B1;" placeholder="Type your message here...">
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
