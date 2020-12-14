<div class="card">
    <div class="card-header">
        <h5 class="sub-title">Create New Workgroup</h5>
    </div>
    <div class="card-block">
        <div class="row">
                <div class="container">
                    @if(session()->has('success'))
                    <div class="alert alert-success border-success">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <i class="icofont icofont-close-line-circled"></i>
                        </button>

                       {!! session('success') !!}

                    </div>
                @endif
                    <form wire:submit.prevent="createWorkgroup">
                        <div class=" row">
                            <div class="col-sm-8 offset-md-2 form-group">
                                <label class="">Workgroup Name</label>
                                <input type="text" wire:model.lazy="workgroup_name" class="form-control form-control-normal" placeholder="Workgroup Name">
                                @error('workgroup_name')
                                    <i class="text-danger" style="font-size: 12px;">{{ $message }}</i>
                                @enderror
                            </div>
                        </div>
                        <div class=" row" wire:ignore>
                            <div class="col-sm-8 offset-md-2 form-group">
                                <label class="">Members</label>
                                <select id="workgroup_members" class="js-example-basic-multiple col-sm-12" multiple="multiple">
                                    <option selected disabled>Add Member(s)</option>
                                    @foreach($users as $user)
                                        <option value="{{$user->id}}">{{$user->first_name ?? ''}} {{$user->surname ?? ''}}</option>
                                    @endforeach
                                </select>
                                @error('workgroup_members')
                                    <i class="text-danger">{{ $message }}</i>
                                @enderror
                            </div>
                        </div>
                        <div class=" row" wire:ignore>
                            <div class="col-sm-8 offset-md-2 form-group">
                                <label class="">Moderators</label>
                                <select id="moderators" class="js-example-basic-multiple col-sm-12" multiple="multiple">
                                    <option selected disabled>Add Moderator(s)</option>
                                    @foreach($users as $user)
                                        <option value="{{$user->id}}">{{$user->first_name ?? ''}} {{$user->surname ?? ''}}</option>
                                    @endforeach
                                </select>
                                @error('moderators')
                                    <i class="text-danger">{{ $message }}</i>
                                @enderror
                            </div>
                        </div>
                        <div class=" row">
                            <div class="col-sm-8 offset-md-2 form-group">
                                <label class="">Group Image</label>
                                <input type="file" wire:model="group_image" class="form-control-file">
                                @error('group_image')
                                    <i class="text-danger">{{ $message }}</i>
                                @enderror
                            </div>
                        </div>
                        <div class=" row">
                            <div class="col-sm-8 offset-md-2 form-group">
                                <label class="">Description</label>
                                <textarea wire:model.lazy="description" cols="10" rows="5" style="resize: none;" class="form-control form-control-normal" placeholder="In few words, describe this workgroup"></textarea>
                                @error('description')
                                    <i class="text-danger" style="font-size: 12px;">{{ $message }}</i>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 d-flex justify-content-center">
                                <div class="btn-group">
                                    <a href="{{url()->previous()}}" class="btn btn-danger waves-effect btn-mini"> <i class="ti-close mr-2"></i> Close</a>
                                    <button type="submit" class="btn btn-primary waves-effect waves-light btn-mini"> <i class="ti-check mr-2"></i> Submit</button>
                                </div>
                                <div class="preloader3 loader-block" wire:loading wire.target="createWorkgroup">
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
             $('#workgroup_members').select2();
            $('#workgroup_members').on('change', function(e){
                var data = $('#workgroup_members').select2("val");
                @this.set('workgroup_members', data);
            });
            //moderators/responsible persons
            $('#moderators').select2();
            $('#moderators').on('change', function(e){
                var getModerators = $('#moderators').select2("val");
                @this.set('moderators', getModerators);
            });
        });
    </script>
@endpush
