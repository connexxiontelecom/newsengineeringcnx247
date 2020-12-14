<div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-block">
                    <h4 class="sub-title">Ticket History</h4>
                    <div class="btn-group d-flex justify-content-end">
                        <a href="{{route('ticket')}}" class="btn btn-mini btn-primary" type="button"><i class="ti-plus"></i> New Support Ticket</a>
                        <a href="{{route('ticket-history')}}" class="btn btn-mini btn-danger"><i class="ti-support"></i> Ticket History</a>
                    </div>
                    @if (session()->has('success'))
                        <div class="alert alert-success background-success mt-3">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <i class="icofont icofont-close-line-circled text-white"></i>
                            </button>
                            {!! session()->get('success') !!}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="card" style="margin-top:-30px;">
        <div class="card-block email-card">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-block">
                            <div class="row mt-3">
                                <div class="col-md-12 btn-add-task">
                                    <div class="dt-responsive table-responsive">
                                        <table id="simpletable" class="table table-striped table-bordered nowrap">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Subject</th>
                                                <th>Ticket No.</th>
                                                <th>Status</th>
                                                <th>Category</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $i = 1;
                                                @endphp
                                                @if (count($tickets) > 0)
                                                    @foreach ($tickets as $ticket)
                                                        <tr>
                                                            <td>{{$i++}}</td>
                                                            <td>
                                                                <a href="{{route('view-ticket', $ticket->slug)}}">{{$ticket->subject}}</a>
                                                            </td>
                                                            <td><label for="" class="label label-primary">{{$ticket->ticket_no}}</label></td>
                                                            <td>
                                                                @if ($ticket->status == 0)
                                                                    <label for="" class="label label-warning">Open</label></td>
                                                                @elseif($ticket->status == 1)
                                                                    <label for="" class="label label-success">Closed</label></td>
                                                                @endif
                                                            <td>
                                                               <label for="" class="label label-danger">{{$ticket->category}}</label>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @else
                                                    <tr>
                                                        <td colspan="6" class="text-center">No records found...</td>
                                                    </tr>
                                                @endif
                                            </tbody>
                                            <tfoot>
                                            <tr>
                                                <th>#</th>
                                                <th>Subject</th>
                                                <th>Ticket No.</th>
                                                <th>Status</th>
                                                <th>Category</th>
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
