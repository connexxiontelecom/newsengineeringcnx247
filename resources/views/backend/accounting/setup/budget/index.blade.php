@extends('layouts.app')

@section('title')
    Budget Profile
@endsection

@section('extra-styles')
    <link rel="stylesheet" type="text/css" href="\assets\bower_components\datatables.net-bs4\css\dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="\assets\pages\data-table\css\buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="\assets\bower_components\datatables.net-responsive-bs4\css\responsive.bootstrap4.min.css">
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-block">
                    @if (session()->has('success'))
                        <div class="alert alert-success background-success mt-3">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <i class="icofont icofont-close-line-circled text-white"></i>
                            </button>
                            {!! session()->get('success') !!}
                        </div>
                    @endif
                    <h5 class="sub-title">Budget Profile</h5>
                    <button class="btn btn-mini btn-primary float-right mb-3" data-toggle="modal" data-target="#budgetModal"><i class="ti-plus mr-2"></i> New Budget</button>
                    <div class="dt-responsive table-responsive">
                        <table id="simpletable" class="table table-striped table-bordered nowrap">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Budget Title</th>
                                <th>Type</th>
                                <th>Month Start</th>
                                <th>Month End</th>
                                <th>Year</th>
                                <th>Date</th>
                                <th>Created By</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $serial = 1;
                            @endphp
                            @foreach($profiles as $profile)
                                <tr>
                                    <td>{{$serial++}}</td>
                                    <td>{{$profile->budget_title}}</td>
                                    <td>{{$profile->budget_type}}</td>
                                    <td> <label for="" class="label label-success">
                                        @switch($profile->month_start)
                                            @case(1)
                                                January
                                                @break
                                            @case(2)
                                                February
                                                @break
                                            @case(3)
                                                March
                                                @break
                                            @case(4)
                                                April
                                                @break
                                            @case(5)
                                                May
                                                @break
                                            @case(6)
                                                June
                                                @break
                                            @case(7)
                                                July
                                                @break
                                            @case(8)
                                                August
                                                @break
                                            @case(9)
                                                September
                                                @break
                                            @case(10)
                                                October
                                                @break
                                            @case(11)
                                                November
                                                @break
                                            @case(12)
                                                December
                                                @break
                                        @endswitch
                                    </label>

                                    </td>
                                    <td><label for="" class="label label-danger">
                                        @switch($profile->month_end)
                                        @case(1)
                                            January
                                            @break
                                        @case(2)
                                            February
                                            @break
                                        @case(3)
                                            March
                                            @break
                                        @case(4)
                                            April
                                            @break
                                        @case(5)
                                            May
                                            @break
                                        @case(6)
                                            June
                                            @break
                                        @case(7)
                                            July
                                            @break
                                        @case(8)
                                            August
                                            @break
                                        @case(9)
                                            September
                                            @break
                                        @case(10)
                                            October
                                            @break
                                        @case(11)
                                            November
                                            @break
                                        @case(12)
                                            December
                                            @break
                                        @endswitch </label>
                                    </td>
                                    <td>{{$profile->year}}</td>
                                    <td>{{date('d F, Y', strtotime($profile->created_at))}}</td>
                                    <td>
                                        {{$profile->user->first_name ?? ''}} {{$profile->user->surname ?? ''}}
                                    </td>
                                    <td>Action</td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Budget Title</th>
                                <th>Type</th>
                                <th>Month Start</th>
                                <th>Month End</th>
                                <th>Year</th>
                                <th>Date</th>
                                <th>Created By</th>
                                <th>Action</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('dialog-section')
    <div class="modal fade" id="budgetModal" tabindex="-1" role="dialog">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h6 class="modal-title text-uppercase">Budget Profile</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span class="text-white" aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="">Budget Title <sup class="text-danger">*</sup></label>
                            <input type="text" placeholder="Budget Title" id="budget_title" class="form-control">
                            <div  class="text-white background-danger mt-2 p-2" style="display: none;" id="gl_code_error">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Budget Type <sup class="text-danger">*</sup></label>
                            <select type="text" id="budget_type" class="form-control col-md-6">
                                <option value="Monthly">Monthly</option>
                                <option value="Quarterly">Quarterly</option>
                                <option value="Yearly">Yearly</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Period <sup class="text-danger">*</sup></label>
                            <div class="row" id="monthly">
                                <div class="col-md-6">
                                    <select type="text"  class="form-control" id="month">
                                        <option value="1">January</option>
                                        <option value="2">February</option>
                                        <option value="3">March</option>
                                        <option value="4">April</option>
                                        <option value="5">May</option>
                                        <option value="6">June</option>
                                        <option value="7">July</option>
                                        <option value="8">August</option>
                                        <option value="9">September</option>
                                        <option value="10">October</option>
                                        <option value="11">November</option>
                                        <option value="12">December</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Year" id="year">
                                    </div>
                                </div>
                            </div>
                            <div class="row" id="quarterly">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Choose Quarter</label>
                                        <select type="text" id="quarter" class="form-control">
                                            <option value="1">First  Quarter</option>
                                            <option value="2">Second Quarter</option>
                                            <option value="3">Third Quarter</option>
                                            <option value="4">Fourth Quarter</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Year</label>
                                        <input type="number" class="form-control" id="quarter_year" placeholder="Year">
                                    </div>
                                </div>
                            </div>
                            <input type="text" class="form-control col-md-6 mt-2" placeholder="Yearly" id="yearly">
                        </div>
                    </form>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button type="button" class="btn btn-danger waves-effect btn-mini" data-dismiss="modal"> <i class="ti-close mr-2"></i>Close</button>
                    <button type="button" class="btn btn-primary waves-effect btn-mini waves-light" id="saveBudgetProfileBtn"> <i class="ti-check mr-2"></i>Submit</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('extra-scripts')

    <script src="\assets\bower_components\datatables.net\js\jquery.dataTables.min.js"></script>
    <script src="\assets\bower_components\datatables.net-buttons\js\dataTables.buttons.min.js"></script>
    <script src="\assets\pages\data-table\js\jszip.min.js"></script>
    <script src="\assets\pages\data-table\js\pdfmake.min.js"></script>
    <script src="\assets\pages\data-table\js\vfs_fonts.js"></script>
    <script src="\assets\bower_components\datatables.net-buttons\js\buttons.html5.min.js"></script>

    <script src="\assets\bower_components\datatables.net-bs4\js\dataTables.bootstrap4.min.js"></script>
    <script src="\assets\bower_components\datatables.net-responsive\js\dataTables.responsive.min.js"></script>
    <script src="\assets\bower_components\datatables.net-responsive-bs4\js\responsive.bootstrap4.min.js"></script>
    <script src="\assets\pages\data-table\js\data-table-custom.js"></script>
    <script>
        $(document).ready(function(){
           $('#quarterly').hide();
           $('#yearly').hide();
           $(document).on('change','#budget_type',function(e){
               e.preventDefault();
               var type = $(this).val();
               switch(type){
                   case 'Monthly':
                       $('#quarterly').hide();
                       $('#yearly').hide();
                       $('#monthly').show();
                       break;
                   case 'Quarterly':
                       $('#monthly').hide();
                       $('#yearly').hide();
                       $('#quarterly').show();
                       break;
                   case 'Yearly':
                       $('#quarterly').hide();
                       $('#monthly').hide();
                       $('#yearly').show();
                       break;

               }
           });
           $(document).on('click', '#saveBudgetProfileBtn', function(e){
               e.preventDefault();
               var budget_title = $('#budget_title').val();
               var budget_type = $('#budget_type').val();
               var month = $('#month').val();
               var monthly = $('#monthly').val();
               var year = $('#year').val();
               var quarter_year = $('#quarter_year').val();
               var quarter = $('#quarter').val();
               var yearly = $('#yearly').val();
               if(budget_title == '' || budget_type == ''){
                    Toastify({
                      text: 'Ooops! Budget title and type is required.',
                      duration: 3000,
                      close: true,
                      gravity: "top",
                      position: 'right',
                      backgroundColor: "linear-gradient(to right, #EB3422, #FF0000)",
                      stopOnFocus: true,
                      onClick: function(){}
                    }).showToast();
               }else{
                   axios.post('/budget-profile',{
                       budget_title:budget_title,
                       budget_type:budget_type,
                       month:month,
                       monthly:monthly,
                       quarter_year:quarter_year,
                       quarter:quarter,
                       year:year,
                       yearly:yearly
                   })
                   .then(response=>{
                       Toastify({
                        text: 'Success! Budget profile registered',
                        duration: 3000,
                        close: true,
                        gravity: "top",
                        position: 'right',
                        backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)",
                        stopOnFocus: true,
                        onClick: function(){}
                        }).showToast();
                       $('#budgetModal').modal('hide');
                       location.reload();
                   })
                   .catch(error=>{
                       Toastify({
                        text: error.response.data.error,
                        duration: 3000,
                        close: true,
                        gravity: "top",
                        position: 'right',
                        backgroundColor: "linear-gradient(to right, #EB3422, #FF0000)",
                        stopOnFocus: true,
                        onClick: function(){}
                        }).showToast();
                   });
               }
           });
        });
    </script>
@endsection
