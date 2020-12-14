<div class="btn-group " role="group">
    @if(empty($clocked_in))
        @if (\Carbon\Carbon::now()->between(\Carbon\Carbon::parse(Auth::user()->tenant->opening_time)->subMinutes(Auth::user()->tenant->grace_period ?? 10), \Carbon\Carbon::parse(Auth::user()->tenant->opening_time)->addMinutes(Auth::user()->tenant->grace_period ?? 10)))
            <button wire:ignore type="button"  class="btn btn-success btn-mini waves-effect waves-light clockinBtn" data-toggle="tooltip" data-placement="top" title="" data-original-title="Clock-in">
                <i class="ti-alarm-clock"></i>Clock-in
            </button>
        @endif
    @else
        @if($clocked_in->status == 1)
            @if (\Carbon\Carbon::now()->between(\Carbon\Carbon::parse(Auth::user()->tenant->opening_time), \Carbon\Carbon::parse(Auth::user()->tenant->closing_time)->addMinutes(Auth::user()->tenant->grace_period ?? 10)))
                <button wire:ignore type="button" class="btn btn-danger btn-mini waves-effect waves-light clockoutBtn" data-toggle="tooltip" data-placement="top" title="" data-original-title="Clock-out">
                    <i class="ti-alarm-clock"></i>Clock-out
                </button>
                <button type="button" class="btn btn-inverse btn-mini waves-effect waves-light" data-toggle="tooltip" data-placement="top" title="" data-original-title="When you clocked in">
                    <i class="ti-alarm-clock mr-2" wire:poll.900000ms="updateTimer"></i>{{ date('d M, Y | h:i a', strtotime($clocked_in->clock_in)) }}
                </button>
            @endif
        @endif
    @endif
</div>

@push('clocker-script')
    <script>
        $(document).ready(function(){
            $(document).on('click', '.clockinBtn', function(e){
                $('.clockinBtn').html("<i class='ti-alarm-clock'></i>Clocking in...");
                axios.post('/activity-stream/clockin')
                .then(response=>{
                    $.notify("Success! You're now clocked-in", "success");
                    location.reload();
                });
            });
            $(document).on('click', '.clockoutBtn', function(e){
                $('.clockinBtn').html("<i class='ti-alarm-clock'></i>Clocking out...");
                axios.post('/activity-stream/clockout')
                .then(response=>{
                    $.notify("Success! You're now clocked-out", "success");
                    location.reload();
                });
            });
        });
    </script>
@endpush
