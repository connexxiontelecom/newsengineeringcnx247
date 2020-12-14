@extends('layouts.app')

@section('title')
    Livestreaming {{$roomName}}
@endsection

@section('extra-styles')
<script src="//media.twiliocdn.com/sdk/js/video/v1/twilio-video.min.js"></script>
<script>

    Twilio.Video.createLocalTracks({
       audio: true,
       video: { width: 300 }
    }).then(function(localTracks) {
       return Twilio.Video.connect('{{ $accessToken }}', {
           name: '{{ $roomName }}',
           tracks: localTracks,
           video: { width: 300 }
       });
    }).then(function(room) {
       //console.log('Successfully joined a Room: ', room.name);

       room.participants.forEach(participantConnected);

       var previewContainer = document.getElementById(room.localParticipant.sid);
       if (!previewContainer || !previewContainer.querySelector('video')) {
           participantConnected(room.localParticipant);
       }

       room.on('participantConnected', function(participant) {
           //console.log("Joining: '"   participant.identity   "'");
           participantConnected(participant);
       });

       room.on('participantDisconnected', function(participant) {
           //console.log("Disconnected: '"   participant.identity   "'");
           participantDisconnected(participant);
       });
    });
    // additional functions will be added after this point
    function participantConnected(participant) {
   console.log('Participant "%s" connected', participant.identity);

   const div = document.createElement('div');
   div.id = participant.sid;
   div.setAttribute("style", "float: left; margin: 10px;");
   div.innerHTML = "<div style='clear:both; margin-bottom:5px;'>"+ "<label class='label label-primary'>"+participant.identity +"</label></div>";

   participant.tracks.forEach(function(track) {
       trackAdded(div, track)
   });

   participant.on('trackAdded', function(track) {
       trackAdded(div, track)
   });
   participant.on('trackRemoved', trackRemoved);

   document.getElementById('media-stream').appendChild(div);
}

function participantDisconnected(participant) {
   console.log('Participant "%s" disconnected', participant.identity);

   participant.tracks.forEach(trackRemoved);
   document.getElementById(participant.sid).remove();
}



function trackAdded(div, track) {
   div.appendChild(track.attach());
   var video = div.getElementsByTagName("video")[0];
   if (video) {
       video.setAttribute("style", "max-width:100%;");
   }
}

function trackRemoved(track) {
   track.detach().forEach( function(element) { element.remove() });
}
</script>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card widget-card-1">
                <div class="card-block-small" id="dominantSpeaker">

                </div>
            </div>
        </div>
        <div class="col-md-12 col-xl-12">
            <div class="card widget-card-1">
                <div class="card-header">
                    <a href="{{ url()->previous() }}" class="btn-mini btn-secondary btn float-left mr-2"> <i class="ti-back-left"></i> Back</a>
                    <h5 class="float-left">{{$roomName}}</h5>
                </div>
                <div class="card-block-small">
                    <div class="row">
                        <div class="col-md-12" id="media-stream">

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 col-xl-12">
            <div class="card">
                <div class="card-block-small">
                    <div class="row">
                        <div class="col-md-12 table-responsive">
                            <p>
                                Created By: <label for="" class="label label-primary">{{$room->user->first_name ?? ''}} {{$room->user->surname ?? ''}}</label>
                            </p>
                            <h5 class="sub-title">{{$roomName}} Log</h5>
                            <table class="table">
                                <thead>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Date</th>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 1;
                                    @endphp

                                    @foreach ($room->log as $log)
                                        <tr>
                                            <td>{{$i++}}</td>
                                            <td>{{$log->user->first_name ?? ''}} {{$log->user->surname ?? ''}}</td>
                                            <td>{{date(Auth::user()->tenant->dateFormat->format ?? 'd F, Y', strtotime($log->created_at))}} @ <small>{{date('h:ia', strtotime($log->created_at))}}</small></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
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

</script>
@endsection
