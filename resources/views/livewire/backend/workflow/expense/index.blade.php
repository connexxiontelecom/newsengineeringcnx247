<div class="row">
    <div class="col-xl-12 col-lg-12  filter-bar">
        @include('livewire.backend.workflow.common._workflow-slab')
    </div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-block">
								<h5 class="sub-title">Expense Report</h5>
								@can('raise expense report')
                	<button class="btn btn-mini btn-primary float-right mb-3" data-target="#newExpenseRequestModal" data-toggle="modal"><i class="ti-plus mr-2"></i>Add New Expense Report</button>
								@endcan
                <ul class="nav nav-tabs md-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#expenseReportTab" role="tab">Expense Report</a>
                        <div class="slide"></div>
                    </li>
                </ul>
                <div class="tab-content card-block" style="margin-top: -20px;">
                    <div class="tab-pane active" id="expenseReportTab" role="tabpanel">

                         <div class="card">
                            <div class="card-block">
                                @if(session()->has('success'))
                                    <div class="alert alert-success background-success" style="padding:5px;">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <i class="icofont icofont-close-line-circled"></i>
                                        </button>
                                        <strong>Success!</strong> {!! session('success') !!}
                                    </div>
                                @endif

                                <div class="dt-responsive table-responsive">
                                    <table id="simpletable" class="table table-striped table-bordered nowrap" style="margin-top: 10px;">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Title</th>
                                            <th>Description</th>
                                            <th>Status</th>
                                            <th>Date</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $serial = 1;
                                            @endphp
                                            @foreach ($expenses as $expense)
                                                <tr>
                                                    <td>{{$serial++}}</td>
                                                    <td>
                                                        <a href="{{route('view-workflow-task', $expense->post_url)}}">{{$expense->post_title ?? ''}}</a></td>
                                                    <td>{!! strlen($expense->post_content) > 75 ? substr($expense->post_content,0,75).'...' : $expense->post_content !!}</td>
                                                    <td>
                                                        @switch($expense->post_status)
                                                            @case('in-progress')
                                                                <label for="" class="label label-warning">in-progress</label>
                                                                @break
                                                            @case('declined')
                                                                <label for="" class="label label-danger">Declined</label>
                                                                @break
                                                            @case('approved')
                                                                <label for="" class="label label-success">Approved</label>
                                                                @break
                                                            @default

                                                        @endswitch
                                                    </td>
                                                    <td>{{date(Auth::user()->tenant->dateFormat->format ?? 'd F, Y', strtotime($expense->created_at))}}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>Title</th>
                                            <th>Description</th>
                                            <th>Status</th>
                                            <th>Date</th>
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

@push('expense-script')
<script>
     $(document).ready(function(){
        var file_data = null;
        $(document).on('change', '#uploadAttachment', function(e){
            e.preventDefault();
            var extension = $('#uploadAttachment').val().split('.').pop().toLowerCase();
            if ($.inArray(extension, ['csv', 'xls', 'xlsx', 'pdf', 'doc', 'docx', 'jpeg', 'jpg', 'png']) == -1) {
                $.notify('Ooops! File format not supported.', 'error');
                $('#uploadAttachment').val('');
            }else{
                file_data = $('#uploadAttachment').prop('files')[0];

            }
        });
         $('#expenseReportForm').parsley().on('field:validated', function() {
            //var ok = $('.parsley-error').length === 0;

        }).on('form:submit', function() {
            var config = {
                        onUploadProgress: function(progressEvent) {
                        var percentCompleted = Math.round( (progressEvent.loaded * 100) / progressEvent.total );
                        }
                };
                var form_data = new FormData();
                form_data.append('amount',$('#amount').val());
                form_data.append('description',tinymce.get('description').getContent());
                form_data.append('title',$('#title').val());
                form_data.append('attachment',file_data);
                form_data.append('post_type','expense-request');
                $('#addNewExpenseBtn').text('Processing...');
                 axios.post('/expense-report',form_data, config)
                .then(response=>{
                    $.notify(response.data.message, 'success');
                    $('#addNewExpenseBtn').text('Done');
                    setTimeout(function () {
                        $("#addNewExpenseBtn").text("Save");
                        window.location.reload();
                    }, 2000);

                })
                .catch(errors=>{
                    var errs = Object.values(errors.response.data.error);
                    $.notify(errs, "error");
                    $('#addNewExpenseBtn').text('Error!');
                    setTimeout(function () {
                        $("#addNewExpenseBtn").text("Save");
                    }, 2000);
                });
                return false;
        });
        });
    </script>
@endpush
