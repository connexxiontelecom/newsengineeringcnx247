@extends('layouts.app')

@section('title')
    Leads
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
    /* Decorations */ 
/*         
.col-xs-4 { 
        color: white; 
        font-size: 24px; 
        padding-bottom: 20px; 
        padding-top: 18px; 
    } 
        
.col-xs-4:nth-child(2n+1) { 
        background: green; 
    } 
        
.col-xs-4:nth-child(2n+2) { 
        background: black; 
    }  */
</style>
@endsection

@section('content')
    @livewire('backend.crm.leads')
@endsection

@section('dialog-section')
<div class="modal fade" id="default-Modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title text-uppercase">New Lead</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing lorem impus dolorsit.onsectetur adipiscing</p>
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <button type="button" class="btn btn-default waves-effect btn-mini " data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary waves-effect waves-light btn-mini">Submit</button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('extra-scripts')

@endsection