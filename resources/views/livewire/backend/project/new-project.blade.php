<div class="card">
    <div class="card-header">
        <h5>New Project</h5>
    </div>
    <div class="card-block">
        <div class="row">
            <div class="col-md-12 btn-add-task">
                @if(session()->has('success'))
                            <div class="alert alert-success border-success" style="padding:5px;">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <i class="icofont icofont-close-line-circled"></i>
                                </button>
                                <strong>Success!</strong> {!! session('success') !!}
                            </div>
                        @endif
                <form wire:submit.prevent="createProject">
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Project Name <sup class="text-danger" style="cursor: pointer;"> <abbr title="Required">*</abbr> </sup></label>
                        <div class="col-sm-10">
                            <input type="text" wire:model.lazy="project_name" class="form-control form-control-normal mb-2" placeholder="Project Name">
                            @error('project_name')
                                <i class="text-danger">{{$message}}</i>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Project Sponsor/Owner </label>
                        <div class="row ml-1">
                            <div class="col-md-6 col-lg-6">
                                <label for="">Project Sponsor/Owner<sup class="text-danger" style="cursor: pointer;"> <abbr title="Required">*</abbr> </sup></label>
                                <input type="text" wire:model.lazy="project_sponsor" class="form-control form-control-normal mb-2" placeholder="Project Sponsor/Owner">
                                    @error('project_sponsor')
                                        <i class="text-danger">{{$message}}</i>
                                    @enderror
                            </div>
                            <div class="col-md-6 col-lg-6">
                                <label for="">Project Manager<sup class="text-danger" style="cursor: pointer;"> <abbr title="Required">*</abbr> </sup></label>
                                <select  wire:model.lazy="project_manager" class="form-control form-control-normal mb-2">
                                    @foreach ($users as $user)
                                    <option value="{{$user->id}}">{{$user->first_name}} {{$user->surname ?? ''}}</option>
                                        
                                    @endforeach
                                </select>
                                    @error('project_manager')
                                        <i class="text-danger">{{$message}}</i>
                                    @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row mb-2">
                        <label class="col-sm-2 col-form-label"></label>
                        <div class="row ml-1">
                            <div class="col-md-6">
                                <label>Due Date <sup class="text-danger" style="cursor: pointer;"> <abbr title="Required">*</abbr> </sup></label>
                                    <input type="datetime-local" wire:model.lazy="due_date" class="form-control form-control-normal" placeholder="Due date">
                                    @error('due_date')
                                        <i class="text-danger">{{$message}}</i>
                                    @enderror
                            </div>
                            <div class="col-md-6">
                                <label >Start Date <i>(Optional)</i></label>
                                    <input type="datetime-local" wire:model.lazy="start_date" class="form-control form-control-normal" placeholder="Start Date">
                            </div>
                            <div class="col-md-6 mt-2">
                                <label >Priority </label>
                                <select wire:model.lazy="priority" class="form-control form-control-normal">
                                    <option value="1">Highest priority</option>
                                    <option value="2">High priority</option>
                                    <option value="3">Normal priority</option>
                                    <option value="4">Low priority</option>
                                </select>
                            </div>
                            <div class="col-md-6 mt-2">
                                <label >Status </label>
                                <select wire:model.lazy="status" class="form-control form-control-normal">
                                    <option value="1">Open</option>
                                    <option value="2">on Hold</option>
                                    <option value="3">Resolved</option>
                                    <option value="4">Closed</option>
                                    <option value="5">At Risk</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-group row mt-4">
                        <label class="col-sm-2 col-form-label">Responsible Person(s) <sup class="text-danger" style="cursor: pointer;"> <abbr title="Required">*</abbr> </sup></label>
                        <div class="col-sm-10 col-md-10" wire:ignore>
                            <select id="responsible_persons" class="js-example-basic-multiple col-sm-12" multiple="multiple">
                                <option selected disabled>Add Responsible Person(s)</option>
                                @foreach($users as $user)
                                    <option value="{{$user->id}}">{{$user->first_name ?? ''}} {{$user->surname ?? ''}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Participant(s) <i>(Optional)</i> </label>
                        <div class="col-sm-10 col-md-10" wire:ignore>
                            <select id="participants" class="js-example-basic-multiple col-sm-12" multiple="multiple">
                                <option selected disabled>Add Participant(s)</option>
                                @foreach($users as $user)
                                    <option value="{{$user->id}}">{{$user->first_name ?? ''}} {{$user->surname ?? ''}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Observer(s) <i>(Optional)</i> </label>
                        <div class="col-sm-10 col-md-10" wire:ignore>
                            <select id="observers" class="js-example-basic-multiple col-sm-12" multiple="multiple">
                                <option selected disabled>Add Observer(s)</option>
                                @foreach($users as $user)
                                    <option value="{{$user->id}}">{{$user->first_name ?? ''}} {{$user->surname ?? ''}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Attachment</label>
                        <div class="col-sm-10 col-md-4">
                            <button class="btn btn-primary btn-sm">Upload attachment</button>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Project Description <sup class="text-danger" style="cursor: pointer;"> <abbr title="Required">*</abbr> </sup></label>
                        <div class="col-sm-10" >
                            <textarea wire:model.lazy="project_description"  cols="5" rows="5" id="project_description" class="form-control form-control-normal mb-2" placeholder="Your description may include project goals, objective, scope, risk, issues, timescale, etc."></textarea>
                            @error('project_description')
                                <i class="text-danger">{{$message}}</i>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 d-flex justify-content-center">
                            <button class="btn btn-primary btn-sm" type="submit">Submit</button>
                            <div class="preloader3 loader-block" wire:loading wire.target="createProject">
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

@push('project-scripts')
    <script>
        $(document).ready(function(){
            //responsible persons
            $('#responsible_persons').select2();
            $('#responsible_persons').on('change', function(e){
                var data = $('#responsible_persons').select2("val");
                @this.set('responsible_persons', data);
            });
            //participants
            $('#participants').select2();
            $('#participants').on('change', function(e){
                var part = $('#participants').select2("val");
                @this.set('participants', part);
            });
            //observers
            $('#observers').select2();
            $('#observers').on('change', function(e){
                var obs = $('#observers').select2("val");
                @this.set('observers', obs);
            });

            
/*             function projectContent() {
                if (tinyMCE.isDirty()) {
                    @this.set('project_description', 'Content updated');
                    console.log('hello');
                }
                }
            setInterval(projectContent, 2000); */
        });

    </script>
@endpush