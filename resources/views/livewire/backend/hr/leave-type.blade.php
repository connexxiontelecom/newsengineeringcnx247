<div>
    <div class="row">
        <div class="col-md-12 col-xl-12">
            <div class="card">
                <div class="card-block">
                    @include('livewire.backend.hr.common._slab-menu')
                </div>
            </div>
        </div>
   </div>
   <div class="row">
       <div class="col-md-6 col-xl-6">
           <div class="card">
               <div class="card-block">
                   @if ($action != 'edit')
                    <form wire:submit.prevent="submitLeaveType">
                        @if (session()->has('success'))
                            <div class="alert alert-success background-success" role="alert">
                                {!! session()->get('success') !!}
                            </div>
                        @endif
                        <div class="form-group">
                            <label for="">Leave Name</label>
                            <input type="text" wire:model.lazy="leave_name" placeholder="Leave Name (e.g Sick Leave)" class="form-control">
                            @error('leave_name')
                                <i class="text-danger mt-2">{{$message}}</i>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Leave Duration</label>
                            <input type="number" wire:model.lazy="leave_duration" placeholder="Duration" class="form-control">
                            @error('leave_duration')
                                <i class="text-danger mt-2">{{$message}}</i>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-md-12 d-flex justify-content-center">
                                    <button class="btn btn-mini btn-primary" type="submit"><i class="ti-check mr-2"></i> Submit</button>
                                    <div class="preloader3 loader-block" wire:target="submitLeaveType" wire:loading>
                                        <div class="circ1 loader-primary"></div>
                                        <div class="circ2 loader-primary"></div>
                                        <div class="circ3 loader-primary"></div>
                                        <div class="circ4 loader-primary"></div>
                                    </div>
                            </div>
                        </div>
                    </form>
                   @endif
                  @if ($action == 'edit')
                    <form wire:submit.prevent="saveLeaveTypeChanges">
                        @if (session()->has('success'))
                            <div class="alert alert-success background-success" role="alert">
                                {!! session()->get('success') !!}
                            </div>
                        @endif
                        <div class="form-group">
                            <label for="">Leave Name</label>
                            <input type="text" wire:model.lazy="leave_name" placeholder="Leave Name (e.g Sick Leave)" class="form-control">
                            @error('leave_name')
                                <i class="text-danger mt-2">{{$message}}</i>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Leave Duration</label>
                            <input type="number" wire:model.lazy="leave_duration" placeholder="Duration" class="form-control">
                            @error('leave_duration')
                                <i class="text-danger mt-2">{{$message}}</i>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-md-12 d-flex justify-content-center">
                                <button class="btn btn-mini btn-danger" type="button" wire:click="cancelEdit"><i class="ti-close mr-2"></i> Cancel</button>
                                <button class="btn btn-mini btn-primary" type="submit"><i class="ti-check mr-2"></i> Save changes</button>
                                <div class="preloader3 loader-block" wire:target="saveLeaveTypeChanges" wire:loading>
                                    <div class="circ1 loader-primary"></div>
                                    <div class="circ2 loader-primary"></div>
                                    <div class="circ3 loader-primary"></div>
                                    <div class="circ4 loader-primary"></div>
                                </div>
                            </div>
                        </div>
                    </form>
                  @endif
               </div>
           </div>
       </div>
       <div class="col-md-6 col-xl-6">
           <div class="card">
               <div class="card-block">
                 <div class="card-header">
                     <h5>Leave Types</h5>
                   </div>
                   <div class="table-responsive">
                       <table class="table table-bordered">
                           <thead>
                               <th>#</th>
                               <th>Leave Name</th>
                               <th>Duration</th>
                               <th>Date</th>
                               <th>Action</th>
                           </thead>
                           @php
                               $index = 1;
                           @endphp
                           @foreach ($leaves as $leave)
                           <tr>
                               <td>{{ $index++ }}</td>
                               <td>{{$leave->leave_name ?? ''}}</td>
                               <td> <label for="" class="label label-info">{{$leave->duration ?? '-'}} days</label> </td>
                               <td>{{date('d F, Y', strtotime($leave->created_at)) ?? ''}}</td>
                               <td>
                                   <div class="btn-group">
                                       <i class="icofont icofont-ui-edit  text-warning" style="cursor: pointer;" wire:click="editLeaveType({{$leave->id}})"></i>
                                   </div>
                               </td>
                           </tr>
                           @endforeach
                       </table>
                   </div>
               </div>
           </div>
       </div>
   </div>
</div>



