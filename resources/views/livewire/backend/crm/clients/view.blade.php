<div>
    <div class="row">
        <div class="col-md-12 col-xl-12">
            <div class="card">
                <div class="card-block">
                    @include('livewire.backend.crm.common._slab-menu')
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-xl-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-header-text"> {{ $client->first_name ?? ''}} {{$client->surname ?? ''}}</h5>
                    <div class="btn-group d-flex justify-content-end">


											<a href="{{route('new-client')}}" class="btn btn-mini btn-primary"><i class="ti-plus"></i> Add New Client</a>

                        <a href="{{route('clients')}}" class="btn btn-mini btn-danger"><i class="ti-user"></i> All Clients</a>


												<a href="{{route('convert-to-lead', $client->slug)}}" class="btn btn-mini btn-info"><i class="ti-control-shuffle"></i> Convert to Lead</a>

                        <button type="button" class="btn btn-mini btn-default" data-toggle="modal" data-target="#sendEmailModal"><i class="ti-email"></i> Send Email</button>
                        <button type="button" class="btn btn-mini btn-secondary" data-toggle="modal" data-target="#sendSMS"><i class="ti-comment-alt"></i> Send SMS</button>
                    </div>
                </div>
                <div class="card-block p-b-0">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-3 col-lg-3">
                                    <div class="card">
                                        <div class="card-block user-radial-card">
                                            <div class="btn-group mr-3">
                                                <a href="{{route('edit-client', $client->slug)}}"><i class="ti-pencil text-warning p-2"></i></a>
                                            </div>
                                            <div data-label="50%" class="radial-bar radial-bar-60 radial-bar-lg radial-bar-primary">
                                                <img src="/assets/images/clients/avatars/thumbnails/{{$client->avatar ?? 'avatar.png'}}" alt="" class="img-100">
                                            </div>
                                            <div style="text-align: left;" class="mt-2">
                                                <p><label class="label label-primary">Full Name</label></p>
                                                <label>{{$client->title ?? ''}} {{$client->first_name ?? ''}} {{$client->surname ?? ''}}</label>

                                                <p><label class="label label-primary">Mobile</label></p>
                                                <label>{{$client->mobile_no ?? ''}}</label>

                                                <p><label class="label label-primary">Email</label></p>
                                                <label>{{$client->email ?? ''}}</label>

                                                <p><label class="label label-primary">Website</label></p>
                                                <label><a href="{{$client->website ?? 'http://www.cnx247.com'}}" target="_blank">{{$client->website ?? ''}}</a></label>

                                                <p><label class="label label-primary">Street 1</label></p>
                                                <label>{{$client->street_1 ?? ''}}</label>

                                                <p><label class="label label-primary">Street 2</label></p>
                                                <label>{{$client->street_2 ?? ''}}</label>

                                                <p><label class="label label-primary">City</label></p>
                                                <label>{{$client->city ?? ''}}</label>

                                                <p><label class="label label-primary">Postal Code</label></p>
                                                <label>{{$client->postal_code ?? ''}}</label>

                                                <p><label class="label label-primary">Note</label></p>
                                                <p>{!! $client->note ?? '' !!}</p>

                                                <p><label class="label label-danger">Date Registered</label></p>
                                                <label>{{date('d F, Y', strtotime($client->created_at)) ?? ''}}</label>

                                                <p><label class="label label-success">Owner</label></p>
                                                <label>{{$client->addedBy->first_name ?? ''}} {{$client->addedBy->surname ?? ''}}</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="row">
                                        <div class="col-md-9">
                                            <div class="card">
                                                <div class="card-block">
                                                    <h5 class="sub-title">Conversation</h5>
                                                    <div class="card-block accordion-block">
                                                        <div id="accordion" role="tablist" aria-multiselectable="true">
                                                            @if (count($conversations) > 0)
                                                                @foreach ($conversations as $convo)
                                                                    <div class="accordion-panel">
                                                                        <div class="accordion-heading" role="tab" id="headingOne_{{$convo->id}}">
                                                                            <h3 class="card-title accordion-title">
                                                                            <a class="accordion-msg scale_active collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseOne_{{$convo->id}}" aria-expanded="false" aria-controls="collapseOne_{{$convo->id}}">
                                                                                <img src="/assets/images/avatars/thumbnails/{{$convo->user->avatar ?? 'avatar.png'}}" class="img-30" alt="{{$convo->user->first_name ?? ''}}">  {{$convo->subject ?? ''}} <sup><i class="ti-comment-alt text-success"></i></sup> <span class="float-right"><small>{{date('d F, Y', strtotime($convo->created_at))}} @ {{date('h:i a', strtotime($convo->created_at))}}</small></span>
                                                                            </a>
                                                                        </h3>
                                                                        </div>
                                                                        <div id="collapseOne_{{$convo->id}}" class="panel-collapse in collapse" role="tabpanel" aria-labelledby="headingOne_{{$convo->id}}" style="">
                                                                            <div class="accordion-content accordion-desc">
                                                                                <p>
                                                                                    {!! $convo->conversation ?? '' !!}
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            @else
                                                                <p class="text-center mb-3">Be the first to start a conversation with <strong>{{$client->title ?? ''}}  {{$client->first_name}}</strong></p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <form wire:submit.prevent="submitConversation">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="card">
                                                                    <div class="card-block">
                                                                        <div class="form-group">
                                                                            <label for="">Subject</label>
                                                                            <input type="text" placeholder="Subject" class="form-control" wire:model="subject">
                                                                            @error('subject')
                                                                                <i class="text-danger">{{$message}}</i>
                                                                            @enderror
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="">Conversation</label>
                                                                            <textarea style="resize: none;" wire:model="conversation" placeholder="What was the nature of your conversation with {{$client->title ?? ''}} {{ $client->first_name ?? ''}}?" class="form-control"></textarea>
                                                                            @error('conversation')
                                                                                <i class="text-danger">{{$message}}</i>
                                                                            @enderror
                                                                        </div>
                                                                        <div class="form-group d-flex justify-content-center">
                                                                            <input type="hidden" value="{{$client->id}}" wire:model="client_id">
                                                                            <button class="btn btn-primary btn-mini" type="submit">Submit</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="card">
                                                <div class="card-block" >
																										<h5 class="sub-title">Activity Log</h5>
																										<div style="height: 500px; overflow-y: scroll;">
																											<ul>
																													@foreach ($logs as $log)
																															<li>
																																	<i class="icofont icofont-hand-right text-info"></i> {{$log->log}} <small class="text-info">{{date('d F, Y', strtotime($log->created_at))}} @ {{date('h:i a', strtotime($log->created_at))}}</small>
																															</li>
																															<hr>
																													@endforeach
																											</ul>
																										</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@push('client-script')
<script>
    $(document).ready(function(){
    $('#sendClientEmailForm').parsley().on('field:validated', function() {

        }).on('form:submit', function() {
            var config = {
                        onUploadProgress: function(progressEvent) {
                        var percentCompleted = Math.round( (progressEvent.loaded * 100) / progressEvent.total );
                        }
                };
                var client = $('#clientId').val();
                var email = $('#email').val();
                var subject = $('#email_subject').val();
                var content = tinymce.get('email_message').getContent();
                $('#sendMailBtn').text('Sending...');
                axios.post('/messaging/client/email', {subject:subject, content:content,email:email,client:client})
                .then(response=>{
                    $.notify(response.data.message, 'success');
                    $('#sendEmailModal').modal('hide');
                })
                .catch(error=>{
                    $.notify(error.data.error, 'error');
                });
            return false;
        });
    });
</script>

@endpush


