@extends('layouts.app')

@section('title')
    Internal Memo
@endsection

@section('extra-styles')
    <link rel="stylesheet" type="text/css" href="/assets/pages/notification/notification.css">
<style>
    .md-content h3{
        border-radius: 0px !important;
    }

</style>
@endsection

@section('content')
<div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-block">
                    <h4 class="sub-title">Internal Memo</h4>
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
    <div class="card" id="queryContainer">
        <div class="row invoice-contact ">
            <div class="col-md-12 d-flex justify-content-center">
                <div class="invoice-box row">
                    <div class="col-sm-12 ">
                        <table class="table table-responsive invoice-table table-borderless">
                            <tbody>
                                <tr>
                                    <td><img height="72" width="120" src="{{asset('/assets/images/company-assets/logos/'.Auth::user()->tenant->logo ?? 'logo.png')}}" class="m-b-10" alt="{{Auth::user()->tenant->company_name ?? ''}}"></td>
                                </tr>
                                <tr>
                                    <td>{{Auth::user()->tenant->street_1 ?? 'Address here'}}  {{Auth::user()->tenant->postal_code ?? 'Postal code here'}}, {{Auth::user()->tenant->city ?? 'City here'}}</td>
                                </tr>
                                <tr>
                                    <td><strong>Email: </strong><a href="mailto:{{Auth::user()->tenant->email}}" target="_top"><span class="__cf_email__" data-cfemail="690d0c0406290e04080005470a0604">[{{Auth::user()->tenant->email}}]</span>, </a> <br> <strong>Phone: </strong>{{Auth::user()->tenant->phone ?? ''}} <br> <strong>Date: </strong>{{date(Auth::user()->tenant->dateFormat->format ?? 'd F, Y', strtotime($memo->created_at))}}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-block">
            <div class="row">
                <div class="col-sm-12">
                    <h5 class="sub-title">{{$memo->post_title ?? ''}}</h5>
                    {!! $memo->post_content ?? '' !!}
                    @foreach ($memo->postAttachment as $attach)
                    @switch(pathinfo($attach->attachment, PATHINFO_EXTENSION))
                        @case('pptx')
                        <a href="/assets/uploads/attachments/{{$attach->attachment}}" target="_blank" data-toggle="tooltip" data-placement="top" title="{{$post->post_title ?? 'No name'}}" data-original-title="{{$post->post_title ?? 'Downlaod attachment'}}" style="cursor: pointer;">
                            <img src="/assets/formats/ppt.png" height="64" width="64" alt="{{$post->post_title ?? 'No name'}}"><br>
                            {{strlen($post->post_title ?? 'Download attachment') > 10 ? substr($post->post_title ?? 'No name',0,7).'...' : $post->post_title ?? 'Downlaod attachment'}}
                        </a>
                        @break
                        @case('xls')
                        <a href="/assets/uploads/attachments/{{$attach->attachment}}" target="_blank" data-toggle="tooltip" data-placement="top" title="{{$post->post_title ?? 'No name'}}" data-original-title="{{$post->post_title ?? 'Downlaod attachment'}}" style="cursor: pointer;">
                            <img src="/assets/formats/xls.png" height="64" width="64" alt="{{$post->post_title ?? 'No name'}}"><br>
                            {{strlen($post->post_title ?? 'Download attachment') > 10 ? substr($post->post_title ?? 'No name',0,7).'...' : $post->post_title ?? 'Downlaod attachment'}}
                        </a>
                        @break
                        @case('xlsx')
                            <a href="/assets/uploads/attachments/{{$attach->attachment}}" target="_blank" data-toggle="tooltip" data-placement="top" title="{{$post->post_title ?? 'No name'}}" data-original-title="{{$post->post_title ?? 'Downlaod attachment'}}" style="cursor: pointer;">
                                <img src="/assets/formats/xls.png" height="64" width="64" alt="{{$post->post_title ?? 'No name'}}"><br>
                                {{strlen($post->post_title ?? 'Download attachment') > 10 ? substr($post->post_title ?? 'No name',0,7).'...' : $post->post_title ?? 'Downlaod attachment'}}
                            </a>
                        @break
                        @case('pdf')
                            <a href="/assets/uploads/attachments/{{$attach->attachment}}" target="_blank" data-toggle="tooltip" data-placement="top" title="{{$post->post_title ?? 'No name'}}" data-original-title="{{$post->post_title ?? 'Downlaod attachment'}}" style="cursor: pointer;">
                                <img src="/assets/formats/pdf.png" height="64" width="64" alt="{{$post->post_title ?? 'No name'}}"><br>
                                {{strlen($post->post_title ?? 'Download attachment') > 10 ? substr($post->post_title ?? 'No name',0,7).'...' : $post->post_title ?? 'Downlaod attachment'}}
                            </a>
                        @break
                        @case('doc')
                            <a href="/assets/uploads/attachments/{{$attach->attachment}}" target="_blank" data-toggle="tooltip" data-placement="top" title="{{$post->post_title ?? 'No name'}}" data-original-title="{{$post->post_title ?? 'Downlaod attachment'}}" style="cursor: pointer;">
                                <img src="/assets/formats/doc.png" height="64" width="64" alt="{{$post->post_title ?? 'No name'}}"><br>
                                {{strlen($post->post_title ?? 'Download attachment') > 10 ? substr($post->post_title ?? 'No name',0,7).'...' : $post->post_title ?? 'Downlaod attachment'}}
                            </a>
                        @break
                        @case('docx')
                            <a href="/assets/uploads/attachments/{{$attach->attachment}}" target="_blank" data-toggle="tooltip" data-placement="top" title="{{$post->post_title ?? 'No name'}}" data-original-title="{{$post->post_title ?? 'Downlaod attachment'}}" style="cursor: pointer;">
                                <img src="/assets/formats/doc.png" height="64" width="64" alt="{{$post->post_title ?? 'No name'}}"><br>
                                {{strlen($post->post_title ?? 'Download attachment') > 10 ? substr($post->post_title ?? 'No name',0,7).'...' : $post->post_title ?? 'Downlaod attachment'}}
                            </a>
                        @break
                        @default
                            <a href="/assets/uploads/attachments/{{$attach->attachment}}" target="_blank" data-toggle="tooltip" data-placement="top" title="{{$post->post_title ?? 'No name'}}" data-original-title="{{$post->post_title ?? 'Downlaod attachment'}}" style="cursor: pointer;">
                                <img src="/assets/formats/file.png" height="64" width="64" alt="{{$post->post_title ?? 'No name'}}"><br>
                                {{strlen($post->post_title ?? 'Download attachment') > 10 ? substr($post->post_title ?? 'No name',0,7).'...' : $post->post_title ?? 'Downlaod attachment'}}
                            </a>
                        @break

                    @endswitch
                @endforeach
                </div>
            </div>

        </div>
    </div>
    <div class="card" style="margin-top:-25px;">
        <div class="card-block">
            <div class="row">
                <div class="col-sm-12 d-flex justify-content-center">

                        <div class="btn-group ">
                            <a href="{{route('queries')}}" class="btn btn-mini btn-danger"><i class="ti-close"></i> Cancel</a>
                            <button class="btn-primary btn-mini btn" id="printQuery"><i class="ti-printer mr-2"></i> Print</button>
                        </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('extra-scripts')
    <script type="text/javascript" src="/assets/js/modal.js"></script>
    <script type="text/javascript" src="/assets/js/modalEffects.js"></script>
    <script type="text/javascript" src="/assets/js/classie.js"></script>
    <script src="{{asset('/assets/js/cus/printThis.js')}}"></script>
    <script>
        $(document).ready(function(){
            $(document).on('click', '#printQuery', function(event){
            $('#queryContainer').printThis({
                header:"<p></p>",
                    footer:"<p></p>",
                });
            });
        });
    </script>
@endsection

