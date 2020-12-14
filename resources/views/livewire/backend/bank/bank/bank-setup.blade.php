<div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-block">
                    <div class="card-header">
                        @if (session()->has('success'))
                            <div class="alert alert-success background-success mt-3">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <i class="icofont icofont-close-line-circled text-white"></i>
                                </button>
                                {!! session()->get('success') !!}
                            </div>
                        @endif

                            @if($errors->any())

                                <div class="alert alert-success background-success mt-3">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <i class="icofont icofont-close-line-circled text-white"></i>
                                    </button>
                                    {{$errors->first()}}
                                </div>

                            @endif

                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="sub-title">Setup Bank</h5>
                                </div>
                                <div class="card-block">
                                    <form wire:submit.prevent="addNewBank">
                                        <div class="form-group">
                                            <label for="">Bank Name</label>
                                            <input type="text" wire:model.debounce.90000ms="bank_name" placeholder="Bank Name" class="form-control">
                                            @error('bank_name')
                                                <i class="text-danger mt-2">{{$message}}</i>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="">Account Number </label>
                                            <input type="text" wire:model.debounce.90000ms="bank_account_number" placeholder="Account Number" class="form-control">
                                            @error('bank_account_number')
                                            <i class="text-danger mt-2">{{$message}}</i>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <label for="">Bank Branch/ Address</label>
                                           <textarea class="form-control" wire:model.debounce.90000ms="bank_branch" placeholder="Bank Address/Branch">


                                           </textarea>
                                            @error('bank_branch')
                                            <i class="text-danger mt-2">{{$message}}</i>
                                            @enderror

                                        </div>


                                        <div class="form-group">
                                            <label for="">Bank GL Code</label>
                                            <select class="form-control" wire:model.debounce.90000ms="bank_gl_code">
                                                @foreach($bank_details as $bank_detail):

                                                    <option value="{{$bank_detail->glcode}}"> {{$bank_detail->account_name." (".$bank_detail->glcode.")" ?? ''  }} </option>


                                                @endforeach;
                                            </select>

                                            @error('bank_gl_code')
                                            <i class="text-danger mt-2">{{$message}}</i>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <div class="btn-group d-flex justify-content-center">
                                                <a href="javascript:void(0);" wire:click="cancelEdit" class="btn btn-mini btn-danger"> <i class="ti-close mr-2"></i> Cancel</a>
                                                <button type="submit" class="btn btn-mini btn-success"> <i class="ti-check mr-2"></i> Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Banks</h5>
                                    <span>Registered banks with their respective codes</span>

                                </div>
                                <div class="card-block">
                                    <div class="dt-responsive table-responsive">
                                        <table id="simpletable" class="table table-striped table-bordered nowrap">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Bank Name</th>
                                                <th>Bank Account Number</th>
                                                <th> GL Code</th>
                                                <th> Bank Branch</th>
                                                 <th>Date</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                $serial = 1;
                                                @endphp
                                                @foreach($banks as $bank)
                                                    <tr>
                                                        <td>{{$serial++}}</td>
                                                        <td>{{$bank->bank_name}}</td>
                                                        <td>{{$bank->bank_account_number}}</td>
                                                        <td>{{$bank->bank_gl_code}}</td>
                                                        <td>{{$bank->bank_branch}}</td>
                                                        <td>{{date('d F, Y', strtotime($bank->created_at))}}</td>
                                                        <td>
                                                            <a href="javascript:void(0);" data-toggle="modal" data-target="#edit-bank{{$bank->id}}"> <i class="ti-pencil text-warning"></i> </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                            <tr>
                                                <th>#</th>
                                                <th>Bank Name</th>
                                                <th>Bank Account Number</th>
                                                <th> GL Code</th>
                                                <th> Bank Branch</th>
                                                <th>Date</th>
                                                <th>Action</th>
                                            </tr>
                                            </tfoot>
                                        </table>
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
