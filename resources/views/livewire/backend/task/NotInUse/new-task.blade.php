<div class="card">
    <div class="card-header">
        <h5>New Task</h5>
    </div>
    <div class="card-block">
        <div class="row">
            <div class="col-md-12 btn-add-task">
                <form wire:submit.prevent="createTask">
                    @if (session()->has('success'))
                        <div class="alert alert-success background-success mt-3">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <i class="icofont icofont-close-line-circled text-white"></i>
                            </button>
                            {!! session()->get('success') !!}
                        </div>
                    @endif
                    <div class=" row">
                        <div class="form-group col-md-6">
                            <label class="">Task Title</label>
                            <input type="text" wire:model.debounce.90000ms="task_title" class="form-control mb-2" placeholder="Task title">
                            @error('task_title')
                                <i class="text-danger">{{$message}}</i>
                            @enderror
                        </div>
                    </div>
                    <div class=" row">
                        <div class=" form-group col-md-6">
                            <label class="">Task Description</label>
                            <textarea wire:model.debounce.90000ms="task_description"  cols="5" rows="5" class="form-control form-control-normal mb-2" placeholder="Task Description"></textarea>
                            @error('task_description')
                                <i class="text-danger">{{$message}}</i>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label class="">Start Date</label>
                            <input type="datetime-local" wire:model.debounce.90000ms="start_date" class="form-control form-control-normal" placeholder="Task title">
                            @error('start_date')
                                <i class="text-danger">{{$message}}</i>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label class="">Due Date</label>
                            <input type="datetime-local" wire:model.debounce.90000ms="due_date" class="form-control form-control-normal" placeholder="Due date">
                            @error('due_date')
                                <i class="text-danger">{{$message}}</i>
                            @enderror
                        </div>
                    </div>
                    <div class=" row">
                        <div class="form-group col-md-3">
                            <label class="">Choose Color <abbr title="Quickly identify this task on task board by assigning a color to it.">?</abbr></label>
                            <input type="color" wire:model.debounce.90000ms="color" class="form-control form-control-normal">
                        </div>
                    </div>
                    <div class="row" wire:ignore>
                        <div class="form-group  col-md-4">
                            <label class="">Responsible Person(s)</label>
                            <select id="responsible_persons" class="js-example-basic-multiple col-sm-12" multiple="multiple">
                                <option selected disabled>Add Responsible Person(s)</option>
                                @foreach($users as $user)
                                    <option value="{{$user->id}}">{{$user->first_name ?? ''}} {{$user->surname ?? ''}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row" wire:ignore>
                        <div class="form-group  col-md-4">
                            <label class="">Participant(s) <i>(Optional)</i></label>
                            <select id="participants" class="js-example-basic-multiple col-sm-12" multiple="multiple">
                                <option selected disabled>Add Participant(s)</option>
                                @foreach($users as $user)
                                    <option value="{{$user->id}}">{{$user->first_name ?? ''}} {{$user->surname ?? ''}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row" wire:ignore>
                        <div class="form-group  col-md-4">
                            <label class="">Observer(s) <i>(Optional)</i></label>
                            <select id="observers" class="js-example-basic-multiple col-sm-12" multiple="multiple">
                                <option selected disabled>Add Observer(s)</option>
                                @foreach($users as $user)
                                    <option value="{{$user->id}}">{{$user->first_name ?? ''}} {{$user->surname ?? ''}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class=" row">
                        <div class="form-group col-md-4">
                            <label class="">Attachment</label>
                            <input type="file" class="form-control-file" wire:change.debounce.90000ms="attachment">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Priority</label>
                        <div class="col-sm-10 col-md-3">
                            <select wire:change.debounce.40000ms="priority" class="form-control form-control-normal">
                                @foreach ($priorities as $priority)
                                    <option value="{{$priority->id}}">{{$priority->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Status</label>
                        <div class="col-sm-10 col-md-3">
                            <select wire:change.debounce.40000ms="status" class="form-control form-control-normal">
                                @foreach ($statuses as $status)
                                    <option value="{{$status->id}}">{{$status->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 d-flex justify-content-center">
                            <button class="btn btn-primary btn-mini" type="submit"> <i class="ti-check mr-2"></i> Submit</button>
                            <div class="preloader3 loader-block" wire:loading wire.target="createTask">
                                <div class="circ1 loader-primary"></div>
                                <div class="circ2 loader-primary"></div>
                                <div class="circ3 loader-primary"></div>
                                <div class="circ4 loader-primary"></div>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

@push('custom-scripts')
    <script>
        $(document).ready(function(){
            //Responsible
            $('#responsible_persons').select2();
            $('#responsible_persons').on('change', function(e){
                var data = $('#responsible_persons').select2("val");
                @this.set('responsible_persons', data);
            });
            //Participants
            $('#participants').select2();
            $('#participants').on('change', function(e){
                var data = $('#participants').select2("val");
                @this.set('participants', data);
            });
            //Observers
            $('#observers').select2();
            $('#observers').on('change', function(e){
                var data = $('#observers').select2("val");
                @this.set('observers', data);
            });
        });
    </script>
@endpush
