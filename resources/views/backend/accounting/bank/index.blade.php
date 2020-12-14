@extends('layouts.app')

@section('title')
    Banks
@endsection

@section('extra-styles')
    <link rel="stylesheet" type="text/css" href="\assets\bower_components\datatables.net-bs4\css\dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="\assets\pages\data-table\css\buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="\assets\bower_components\datatables.net-responsive-bs4\css\responsive.bootstrap4.min.css">
@endsection

@section('content')

    @livewire('backend.bank.bank-set-up')
@endsection

@section('dialog-section')

    @foreach($banks as $bank)

         <div class="modal fade" id="edit-bank{{$bank->id}}" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">{{ $bank->bank_name." (". $bank->bank_account_number .")" }}</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="card-block">
                            <form action="/update-bank" method="post"  >
                                @csrf
                                <div class="form-group">
                                    <label for="">Bank Name</label>
                                    <input type="text" name="bank_name" value="{{ $bank->bank_name }}" disabled placeholder="Bank Name" class="form-control">
                                    @error('bank_name')
                                    <i class="text-danger mt-2">{{$message}}</i>
                                    @enderror
                                </div>

                                <input type="hidden" name="edit_mode"  value="1" class="form-control">

                                <input type="hidden" name="bank_id" value="{{ $bank->id  }}" class="form-control">
                                <div class="form-group">
                                    <label for="">Account Number </label>
                                    <input type="text" name="bank_account_number" disabled value="{{ $bank->bank_account_number  }}"  placeholder="Account Number" class="form-control">
                                    @error('bank_account_number')
                                    <i class="text-danger mt-2">{{$message}}</i>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="">Bank Branch/ Address</label>
                                    <textarea class="form-control" name="bank_branch" disabled placeholder="Bank Address/Branch">

                                            {{ $bank->bank_branch  }}
                                           </textarea>
                                    @error('bank_branch')
                                    <i class="text-danger mt-2">{{$message}}</i>
                                    @enderror

                                </div>


                                <div class="form-group">
                                    <label for="">Bank GL Code</label>
                                    <select class="form-control" name="bank_gl_code">
                                        @foreach($bank_details as $bank_detail):

                                        <option value="{{$bank_detail->glcode}}"  @if($bank_detail->glcode == $bank->bank_gl_code): {{'selected'}}   @endif > {{$bank_detail->account_name." (".$bank_detail->glcode.")" ?? ''  }} </option>


                                        @endforeach;
                                    </select>

                                    @error('bank_gl_code')
                                    <i class="text-danger mt-2">{{$message}}</i>
                                    @enderror
                                </div>
                                <hr/>
                                <div class="form-group">
                                    <div class="btn-group d-flex justify-content-center">
                                        <a href="javascript:void(0);"  class="btn btn-mini btn-danger"> <i class="ti-close mr-2"></i> Cancel</a>
                                        <button type="submit" class="btn btn-mini btn-success"> <i class="ti-check mr-2"></i> Save Changes </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>



    @endforeach

@endsection

@section('extra-scripts')
    <script src="\assets\bower_components\datatables.net\js\jquery.dataTables.min.js"></script>

    <script src="\assets\bower_components\datatables.net-buttons\js\dataTables.buttons.min.js"></script>
    <script src="\assets\pages\data-table\js\jszip.min.js"></script>
    <script src="\assets\pages\data-table\js\pdfmake.min.js"></script>
    <script src="\assets\pages\data-table\js\vfs_fonts.js"></script>
    <script src="\bower_components\datatables.net-buttons\js\buttons.print.min.js"></script>
    <script src="\assets\bower_components\datatables.net-buttons\js\buttons.html5.min.js"></script>

    <script src="\assets\bower_components\datatables.net-bs4\js\dataTables.bootstrap4.min.js"></script>
    <script src="\assets\bower_components\datatables.net-responsive\js\dataTables.responsive.min.js"></script>
    <script src="\assets\bower_components\datatables.net-responsive-bs4\js\responsive.bootstrap4.min.js"></script>

    <script src="\assets\pages\data-table\js\data-table-custom.js"></script>


@endsection
