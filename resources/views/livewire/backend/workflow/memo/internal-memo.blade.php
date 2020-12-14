<div class="row">
    <div class="col-xl-12 col-lg-12  filter-bar">
        @include('livewire.backend.workflow.common._workflow-slab')
    </div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-block">
                <div class="sub-title">Internal Memo</div>
                <ul class="nav nav-tabs md-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#expenseReportTab" role="tab">Internal Memo</a>
                        <div class="slide"></div>
                    </li>
                </ul>
                <div class="tab-content card-block">
                    <div class="tab-pane active" id="expenseReportTab" role="tabpanel">

                         <div class="card">
                            <div class="card-block">
                                <h5 class="sub-title">Internal Memo</h5>
                                @if(session()->has('success'))
                                    <div class="alert alert-success background-success" style="padding:5px;">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <i class="icofont icofont-close-line-circled"></i>
                                        </button>
                                        <strong>Success!</strong> {!! session('success') !!}
                                    </div>
                                @endif

                            <form action="{{route('internal-memo')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label class="">Subject</label>
                                    <input name="subject" value="{{old('subject')}}" type="text" class="form-control form-control-normal col-md-12" placeholder="Subject">
                                    @error('subject')
                                        <span class="mt-3">
                                            <i class="text-danger">{{ $message }}</i>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="">Content</label>
                                    <textarea name="content" class="form-control form-control-normal content col-md-10" placeholder="Type memo here...">{{old('content')}}</textarea>
                                    @error('content')
                                        <span class="mt-3">
                                            <i class="text-danger">{{ $message }}</i>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="">To</label>
                                    <select name="to" id="to" class="form-control col-md-4">
                                        <option value="0">All employees</option>
                                        <option value="1">Department</option>
                                        <option value="2">Specific employee(s)</option>
                                    </select>
                                </div>
                                <div class="form-group" id="departmentSelection">
                                    <label class="">Department</label>
                                        <select name="department" class="form-control form-control-normal col-md-4">
                                            <option disabled selected>Select department</option>
                                            @foreach ($departments as $depart)
                                            <option value="{{$depart->id}}">{{$depart->department_name}}</option>
                                            @endforeach
                                        </select>
                                </div>
                                <div class="form-group" id="employeeSelection">
                                    <label class="">Employee(s)</label>
                                    <select id="employees" name="employees[]" class="js-example-responsive col-sm-12 col-md-8" multiple="multiple" style="width:75%;">
                                        <option selected disabled>Select person(s)</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->first_name}} {{ $user->surname ?? '' }}</option>

                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
																	@if($storage_capacity == 1)
                                    <label class="">Attachment <br> <i>(Optional)</i></label>
                                    <div  class="col-sm-10 col-md-2">
                                        <input type="file" id="attachment" name="attachment">
                                    </div>

																		@endif

																	@if($storage_capacity == 0)

																		Drive Capacity Full, Please Upgrade to Upload More Files
																	@endif
                                </div>
                                <div class=" row m-t-30 d-flex justify-content-center">
                                    <div class="col-sm-10 col-md-12">
                                        <div class="btn-group d-flex justify-content-center">
                                            <button class="btn btn-danger btn-mini"><i class="ti-close mr-2"></i>Cancel</button>
                                            <button class="btn btn-primary btn-mini"  type="submit"><i class="ti-check mr-2"></i>Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('memo-script')
    <script>
        $(document).ready(function(){
            $('#departmentSelection').hide();
            $('#employeeSelection').hide();
            $(document).on('change', '#to', function(e){
                var selection = $(this).val();
                switch(selection){
                    case '0':
                    $('#departmentSelection').hide();
                    $('#employeeSelection').hide();
                    break;
                    case '1':
                    $('#departmentSelection').show();
                    $('#employeeSelection').hide();
                    break;
                    case '2':
                    $('#departmentSelection').hide();
                    $('#employeeSelection').show();
                }
            });
        });
    </script>
@endpush
