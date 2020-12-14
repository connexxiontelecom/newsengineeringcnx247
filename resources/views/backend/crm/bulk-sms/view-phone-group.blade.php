@extends('layouts.app')

@section('title')
    Phone Group
@endsection

@section('extra-styles')

<style>
/* The heart of the matter */

.horizontal-scrollable > .row {
            overflow-x: auto;
            white-space: nowrap;
    }

.horizontal-scrollable {
    overflow-x: scroll;
    overflow-y: hidden;
    white-space: nowrap;
    }
</style>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12 col-xl-12">
        <div class="card">
            <div class="card-block">
                @include('livewire.backend.crm.common._slab-menu')
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-block">
                <h4 class="sub-title">Phone Group > {{$group->phone_group_name ?? ''}}</h4>
                @if (session()->has('success'))
                    <div class="alert alert-success background-success mt-3">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <i class="icofont icofont-close-line-circled text-white"></i>
                        </button>
                        {!! session()->get('success') !!}
                    </div>
                @endif
                @if (session()->has('error'))
                    <div class="alert alert-warning background-warning mt-3">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <i class="icofont icofont-close-line-circled text-white"></i>
                        </button>
                        {!! session()->get('error') !!}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="card" style="margin-top:-30px;">
    <div class="card-block email-card">
        <div class="row">
            <div class="col-lg-3 col-xl-3 col-sm-4 col-md-4">
                @include('backend.crm.bulk-sms.common._navigation')
            </div>
            <div class="col-lg-9 col-xl-9 col-sm-8 col-md-8">
                <div class="card-block ">
                    <h5 class="sub-title">Update Phone Group ({{$group->phone_group_name}})</h5>
                    <form action="{{route('update-phone-group')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-lg-12">
                                <div class="form-group">
                                    <label>Phone Group Name</label>
                                    <input type="text" class="form-control" placeholder="Phone Group Name" name="phone_group_name" value="{{old('phone_group_name', $group->phone_group_name)}}"/>
                                    @error('phone_group_name')
                                        <i class="text-danger mt-2">{{$message}}</i>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Phone Numbers</label>
                                    <textarea class="form-control" rows="8" cols="50" name="phone_numbers" style="resize:none;" placeholder="Enter phone numbers separated by comma in any of these formats 070.., 23470... or +234. Duplicate numbers will be removed before saving.">{{old('phone_numbers', $group->phone_numbers)}}</textarea>
                                    @error('phone_numbers')
                                        <i class="text-danger mt-2">{{$message}}</i>
                                    @enderror
                                    <input type="hidden" name="id" value="{{$group->id}}"/>
                                </div>
                                <hr>
                                <div class="form-group d-flex justify-content-center">
                                    <button type="submit" class="btn btn-mini btn-primary"><i class="ti-check mr-2"></i>Update Phone Group</button>
                                </div>
                                <div class="form-group d-flex justify-content-end">
                                    <a href="{{route('delete-phone-group', $group->slug)}}" class="btn btn-mini btn-danger"><i class="ti-close mr-2"></i>Delete Phone Group</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('dialog-section')

@endsection
@section('extra-scripts')
<script src="{{asset('/assets/js/cus/axios.min.js')}}"></script>
<script>
    $(document).ready(function(){
        var contacts = [];
        $("#selectAll").click(function(){
            $('input:checkbox').not(this).prop('checked', this.checked);
        });
        
        //Selected contacts
        $(document).on('click', '#selectedContactsBtn', function(e){
            $("input:checked").each(function () {
                contacts.push( $(this).val());
                $('#mobileNumbers').val(contacts);
            });
            $('input:checkbox').removeAttr('checked');
        });
        //Send message
        $(document).on('click', '#sendSMSBtn', function(e){
            e.preventDefault();
            var mobileNumbers = $('#mobileNumbers').val();
            var message = $('#message').val();
            $('#sendSMSBtn').text("Processing...");
            axios.post('/crm/bulk-sms/send', {mobileNumbers:mobileNumbers, message:message})
            .then(response=>{
                $('#sendSMSBtn').text("Sent!");
                $('#sendSMSBtn').removeClass("btn-danger");
                $('#sendSMSBtn').addClass("btn-success");
                $('#sendSMS').modal("hide");
            })
            .catch(error=>{
                $('#sendSMSBtn').text("Error");
                $('#sendSMSBtn').removeClass("btn-primary");
                $('#sendSMSBtn').addClass("btn-danger");
            });
        });
    })
</script>
@endsection
