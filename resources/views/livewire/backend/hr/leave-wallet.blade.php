<div>
    <div class="row">
        <div class="col-md-12 col-xl-12">
            <div class="card">
                <div class="card-block">
                    <div class="row">
                        <div class="d-inline-block">
                            <a class="btn btn-primary btn-mini btn-round text-white"><i class="icofont icofont-wallet"></i>  Leave Wallet</a>
                            <a class="btn btn-info btn-mini btn-round text-white"><i class="icofont icofont-wall-clock"></i>  Reminder</a>
                            <a class="btn btn-danger btn-mini btn-round text-white"><i class="icofont icofont-tasks"></i>  Query</a>
                            <a class="btn btn-secondary btn-mini btn-round text-white"><i class="icofont icofont-safety"></i>  Leave Balance</a>
                            <a class="btn btn-success btn-mini btn-round text-white"><i class="icofont icofont-star"></i>  Leave Type</a>
                            <a class="btn btn-info btn-mini btn-round text-white"><i class="icofont icofont-airplane-alt"></i>  Holiday </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
   </div>


   <div class="row">
    <div class="col-md-12 col-xl-12">
        <div class="card table-card">
            <div class="card-header">
                <h5>Leave Wallet</h5>
                <p>Assign Leave wallet to employee</p>
            </div>
            <div class="card-block">
                <div class="col-lg-12 col-xl-12">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs md-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#single" role="tab">Single Action</a>
                            <div class="slide"></div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#bulk" role="tab">Bulk Action</a>
                            <div class="slide"></div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#listing" role="tab">Leave Wallet Listing</a>
                            <div class="slide"></div>
                        </li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content card-block mt-2">
                        <div class="tab-pane active" id="single" role="tabpanel">
                            <div class="container">
                                @if(session()->has('success'))
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="alert alert-success">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <i class="icofont icofont-close-line-circled"></i>
                                                </button>
                                                {!! session()->get('success') !!}
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <form wire:submit.prevent="addToIndividualWallet">
                                <div class="row">
                                   
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Employee</label>
                                                <select wire:model.lazy="employee" name="employee" id="" class="form-control">
                                                    <option selected disabled>Select employee</option>
                                                    @foreach ($employees as $employee)
                                                    <option value="{{ $employee->id }}">{{$employee->first_name }} {{ $employee->surname ?? ''}}</option>
                                                    @endforeach
                                                </select>
                                                @error('employee')
                                                    <i class="text-danger mt-2">{{$message}}</i>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Amount</label>
                                                <input type="number" wire:model.lazy="amount" placeholder="Amount" name="amount" class="form-control">
                                                    @error('amount')
                                                        <i class="text-danger mt-2">{{$message}}</i>
                                                    @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Expires</label>
                                                <input type="datetime-local" wire:model.lazy="expires" name="expires" placeholder="Expires" class="form-control">
                                                    @error('expires')
                                                        <i class="text-danger mt-2">{{$message}}</i>
                                                    @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12 d-flex justify-content-center">
                                            <button class="btn btn-mini btn-primary">Submit</button>
                                            <div class="preloader3 loader-block" wire:target="addToIndividualWallet" wire:loading>
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
                        <div class="tab-pane" id="bulk" role="tabpanel">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12">
                                        <form action="#" method="post" class="j-forms" id="j-forms" novalidate="">
                                            <!-- end /.header-->
                                            <div class="content">
                                                <!-- end cloned left side buttons element -->
                                                <div class="divider-text gap-top-45 gap-bottom-45">
                                                    <span>Cloning with links</span>
                                                </div>
                                                <!-- start cloned link elements -->
                                                <div class="clone-link cloneya-wrap">
                                                    <div class="toclone cloneya">
                                                        <button class=" clone btn btn-primary btn-mini m-b-15">add new person</button>
                                                        <button class=" delete  btn btn-danger btn-mini m-b-15">delete a person</button>
                                                        <div class="j-row">
                                                            <div class="span6 unit">
                                                                <div class="input">
                                                                    <input type="text" placeholder="first name">
                                                                </div>
                                                            </div>
                                                            <div class="span6 unit">
                                                                <div class="input">
                                                                    <input type="text" placeholder="last name">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="unit">
                                                            <div class="input">
                                                                <input type="email" placeholder="email">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- end /.toclone -->
                                                </div>
                                                <!-- end cloned link elements -->
                                            </div>
                                            <!-- end /.content -->
                                            <div class="footer">
                                                <button type="submit" class="btn btn-primary m-b-0">Send</button>
                                            </div>
                                            <!-- end /.footer -->
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="listing" role="tabpanel">
                            <div class="row">
                                <div class="col-sm-12">
                                    <!-- Zero config.table start -->
                                    <div class="card">
                                        <div class="card-header">
                                            <h5>Leave Wallet Listing</h5>
                                            <span>The table below shows employees with their respective leave entitlement.</span>

                                        </div>
                                        <div class="card-block">
                                            <div class="dt-responsive table-responsive">
                                                <div id="simpletable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                                    <div class="row ml-3">
                                                        <div class="col-xs-12 col-sm-12 col-sm-12 col-md-6">
                                                            <div class="dataTables_length" id="simpletable_length">
                                                                <label>Show 
                                                                    <select name="simpletable_length" aria-controls="simpletable" class="form-control input-sm">
                                                                        <option value="10">10</option>
                                                                        <option value="25">25</option>
                                                                        <option value="50">50</option>
                                                                        <option value="100">100</option>
                                                                    </select> entries
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-xs-12 col-sm-12 col-md-6">
                                                            <div id="simpletable_filter" class="dataTables_filter">
                                                                <label>Search:
                                                                    <input type="search" class="form-control input-sm" placeholder="" aria-controls="simpletable">
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-xs-12 col-sm-12">
                                                            <table id="simpletable" class="table table-striped table-bordered nowrap dataTable" role="grid" aria-describedby="simpletable_info">
                                                    <thead>
                                                        <tr role="row">
                                                            <th class="sorting_asc" tabindex="0" aria-controls="simpletable" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 30px;">#</th>
                                                            <th class="sorting" tabindex="0" aria-controls="simpletable" rowspan="1" colspan="1" aria-label="Employee Name: activate to sort column ascending" style="width: 282px;">Employee Name</th>
                                                            <th class="sorting" tabindex="0" aria-controls="simpletable" rowspan="1" colspan="1" aria-label="Amount: activate to sort column ascending" style="width: 10px;">Amount</th>
                                                            <th class="sorting" tabindex="0" aria-controls="simpletable" rowspan="1" colspan="1" aria-label="Balance: activate to sort column ascending" style="width: 10px;">Balance</th>
                                                            <th class="sorting" tabindex="0" aria-controls="simpletable" rowspan="1" colspan="1" aria-label="Expires date: activate to sort column ascending" style="width: 140.4px;">Expires</th>
                                                            <th class="sorting" tabindex="0" aria-controls="simpletable" rowspan="1" colspan="1" aria-label="Action: activate to sort column ascending" style="width: 96.4px;">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php
                                                            $index = 1;
                                                        @endphp
                                                        @foreach ($wallet as $wall)
                                                            <tr role="row" class="odd">
                                                                    <td class="sorting_1">{{$index++}}</td>
                                                                    <td><img src="{{$wall->user->avatar ?? '\assets\images\user.png'}}" class="img-40" alt="{{$wall->user->first_name}}">
                                                                        <a href="/activity-stream/profile/{{ $wall->user->url}}">{{$wall->user->first_name }} {{ $wall->user->surname ?? ''}}</a>    
                                                                    </td>
                                                                    <td>
                                                                        <label class="badge badge-info">{{number_format($wall->amount) ?? ''}}</label>
                                                                    </td>
                                                                    <td>
                                                                        <label for="" class="badge badge-warning text-white">{{ number_format($wall->amount - $wall->balance)  }}</label>
                                                                    </td>
                                                                    <td>
                                                                        <label for="" class="label label-danger">{{date('d F, Y', strtotime($wall->expires)) ?? ''}}</label>
                                                                    </td>
                                                                    <td>
                                                                        <div class="btn-group">
                                                                            <button class="btn btn-mini btn-warning text-white">Edit</button>
                                                                            <button class="btn btn-mini btn-danger">Delete</button>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            
                                                        @endforeach
                                                    </tbody>
                                                    <tfoot>
                                                    <tr>
                                                        <th rowspan="1" colspan="1">#</th>
                                                        <th rowspan="1" colspan="1">Employee Name</th>
                                                        <th rowspan="1" colspan="1">Amount</th>
                                                        <th rowspan="1" colspan="1">Balance</th>
                                                        <th rowspan="1" colspan="1">Expires</th>
                                                        <th rowspan="1" colspan="1">Action</th></tr>
                                                    </tfoot>
                                                </table>
                                            </div></div><div class="row"><div class="col-xs-12 col-sm-12 col-md-5"><div class="dataTables_info" id="simpletable_info" role="status" aria-live="polite">Showing 1 to 10 of 20 entries</div></div><div class="col-xs-12 col-sm-12 col-md-7"><div class="dataTables_paginate paging_simple_numbers" id="simpletable_paginate"><ul class="pagination"><li class="paginate_button page-item previous disabled" id="simpletable_previous"><a href="#" aria-controls="simpletable" data-dt-idx="0" tabindex="0" class="page-link">Previous</a></li><li class="paginate_button page-item active"><a href="#" aria-controls="simpletable" data-dt-idx="1" tabindex="0" class="page-link">1</a></li><li class="paginate_button page-item "><a href="#" aria-controls="simpletable" data-dt-idx="2" tabindex="0" class="page-link">2</a></li><li class="paginate_button page-item next" id="simpletable_next"><a href="#" aria-controls="simpletable" data-dt-idx="3" tabindex="0" class="page-link">Next</a></li></ul></div></div></div></div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Zero config.table end -->
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
