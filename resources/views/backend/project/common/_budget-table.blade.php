<div class="dt-responsive table-responsive">
    <table id="simpletable" class="table table-striped table-bordered nowrap">
        <thead>
        <tr>
            <th>#</th>
            <th>Budget Title</th>
            <th>Budget Amount</th>
            <th>Actual Amount</th>
            <th>Remarks/Comment</th>
        </tr>
        </thead>
        <tbody>
            @php
                $serial = 1;
            @endphp
            <tr>
                <td>1</td>
                <td>{{$budget->budget_title ?? ''}}</td>
                <td>{{Auth::user()->tenant->currency->symbol ?? 'N'}}{{number_format($budget->budget_amount,2) ?? ''}}</td>
                <td>{{Auth::user()->tenant->currency->symbol ?? 'N'}}{{number_format($budget->actual_amount,2) ?? ''}}</td>
                <td>{{$budget->comment ?? ''}}</td>
            </tr>
        </tbody>
        <tfoot>
        <tr>
            <th>#</th>
            <th>Budget Title</th>
            <th>Budget Amount</th>
            <th>Actual Amount</th>
            <th>Remarks/Comment</th>
        </tr>
        </tfoot>
    </table>
</div>
