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
			<div class="col-md-4 border-right" style="height:120px; ">
				<div class="settings-tray">
					<img class="profile-image" :src="'/assets/images/avatars/thumbnails/'+auth_user.avatar" :alt="auth_user.first_name">

						<p><strong>@{{auth_user.first_name}} @{{auth_user.surname}}</strong></p>
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

				<div v-for="(user, index) in users" class="friend-drawer friend-drawer--onhover">
					<img class="profile-image" :src="'/assets/images/avatars/thumbnails/'+user.avatar" alt="">
					<div class="text">
						<h6>@{{user.first_name}} @{{user.surname}}</h6>
						<p class="text-muted">Hey, you're arrested!</p>
					</div>
					<span class="time text-muted small">13:21</span>
				</div>
			</div>
			<div class="col-md-8" style="background: url(/assets/images/chat-bg.png);">
				<div class="settings-tray">
						<div class="friend-drawer no-gutters friend-drawer--grey">
						<img class="profile-image" :src="'/assets/images/avatars/thumbnails/'+auth_user.avatar" :alt="auth_user.first_name">
						<div class="text">
							<h6>@{{auth_user.first_name}} @{{auth_user.surname}}</h6>
							<p class="text-muted">Layin' down the law since like before Christ...</p>
						</div>
						<span class="settings-tray--right">
							<i class="material-icons">cached</i>
							<i class="material-icons">message</i>
							<i class="material-icons">menu</i>
						</span>
					</div>
				</div>
				<div class="chat-panel">
					<div class="row no-gutters">
						<div class="col-md-3">
							<div class="chat-bubble chat-bubble--left">
								Hello dude!
							</div>
						</div>
					</div>
					<div class="row no-gutters">
						<div class="col-md-3 offset-md-9">
							<div class="chat-bubble chat-bubble--right">
								Hello dude!
							</div>
						</div>
					</div>
					<div class="row no-gutters">
						<div class="col-md-3 offset-md-9">
							<div class="chat-bubble chat-bubble--right">
								Hello dude!
							</div>
						</div>
					</div>
					<div class="row no-gutters">
						<div class="col-md-3">
							<div class="chat-bubble chat-bubble--left">
								Hello dude!
							</div>
						</div>
					</div>
					<div class="row no-gutters">
						<div class="col-md-3">
							<div class="chat-bubble chat-bubble--left">
								Hello dude!
							</div>
						</div>
					</div>
					<div class="row no-gutters">
						<div class="col-md-3">
							<div class="chat-bubble chat-bubble--left">
								Hello dude!
							</div>
						</div>
					</div>
					<div class="row no-gutters">
						<div class="col-md-3 offset-md-9">
							<div class="chat-bubble chat-bubble--right">
								@{{compose_message}}
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-12">
							<div class="chat-box-tray">
								<i class="material-icons">sentiment_very_satisfied</i>
								<input type="text" v-model="compose_message" style="padding: 7px; color: #B1B1B1;" placeholder="Type your message here...">
								<i class="material-icons">mic</i>
								<i class="material-icons">send</i>
							</div>
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
<script src="https://unpkg.com/vue"></script>
<script src="/js/chat.js"></script>
@endsection
