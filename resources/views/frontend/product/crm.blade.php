@extends('layouts.frontend-layout')

@section('title')
  CRM
@endsection

@section('extra-styles')

  <style>
    .card{
      border-radius: 0px !important;
    }
  </style>
@endsection

@section('content')
  <!-- Hero Start -->
  <section class="bg-half bg-dark d-table w-100" style="background-image:url('{{asset('/frontend/images/bg-5.jpg')}}'); background-size:auto ;box-shadow:inset 0 0 0 2000px rgba(0, 0, 0, 0.60);">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-12 text-center">
          <div class="page-next-level">
            <h4 class="title text-light"> CRM </h4>
            <div class="page-next">
              <nav aria-label="breadcrumb" class="d-inline-block">
                <ul class="breadcrumb bg-white rounded shadow mb-0">
                  <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                  <li class="breadcrumb-item">Product</li>
                  <li class="breadcrumb-item active" aria-current="page">CRM</li>
                </ul>
              </nav>
            </div>
          </div>
        </div>  <!--end col-->
      </div><!--end row-->
    </div> <!--end container-->
  </section><!--end section-->
  <!-- Hero End -->
  <section class="section">
    <div class="container">
      <div class="row align-items-center" id="counter">
        <div class="col-md-6">
          <img src="{{asset('/frontend/images/crm-dashboard.png')}}" class="img-fluid" alt="">
        </div><!--end col-->

        <div class="col-md-6 mt-4 pt-2 mt-sm-0 pt-sm-0">
          <div class="ml-lg-4">
            <div class="section-title">
              <h4 class="title mb-4">Customer Relationship Management</h4>
              <p class="text-muted">
                <span class="text-primary font-weight-bold">CNX247</span> provides you with a detailed overview of each customer, an ability to track your opportunities and deals in real time, and compile personalized invoices efficiently.
              </p>
            </div>
          </div>
        </div><!--end col-->
      </div><!--end row-->

      <div class="container mt-100 mt-60">
        <div class="row align-items-end mb-2 pb-2">
          <div class="col-md-8">
            <div class="section-title text-center text-md-left">
              <h6 class="text-primary">Services</h6>
              <h4 class="title mb-4">What does our CRM Offer?</h4>
              {{--            <p class="text-muted mb-0 para-desc">Start working with <span class="text-primary font-weight-bold">Landrick</span> that can provide everything you need to generate awareness, drive traffic, connect.</p>--}}
            </div>
          </div><!--end col-->
        </div><!--end row-->
        <div class="row">
          <div class="col-md-4 mt-0 pt-0">
            <ul class="nav nav-pills nav-justified flex-column bg-white rounded shadow p-3 mb-0 sticky-bar" id="pills-tab" role="tablist">
              <li class="nav-item">
                <a class="nav-link rounded active" id="webdeveloping" data-toggle="pill" href="#onboarding" role="tab" aria-controls="developing" aria-selected="false">
                  <div class="text-center pt-1 pb-1">
                    <h6 class="title font-weight-normal mb-0">Clients, Leads, and Deals</h6>
                  </div>
                </a><!--end nav link-->
              </li><!--end nav item-->

              <li class="nav-item mt-2">
                <a class="nav-link rounded" id="database" data-toggle="pill" href="#data-analise" role="tab" aria-controls="data-analise" aria-selected="false">
                  <div class="text-center pt-1 pb-1">
                    <h6 class="title font-weight-normal mb-0">Bulk SMS and Email Campaigns</h6>
                  </div>
                </a><!--end nav link-->
              </li><!--end nav item-->

              <li class="nav-item mt-2">
                <a class="nav-link rounded" id="server" data-toggle="pill" href="#security" role="tab" aria-controls="security" aria-selected="false">
                  <div class="text-center pt-1 pb-1">
                    <h6 class="title font-weight-normal mb-0">Invoice and Receipts</h6>
                  </div>
                </a><!--end nav link-->
              </li><!--end nav item-->

{{--              <li class="nav-item mt-2">--}}
{{--                <a class="nav-link rounded" id="webdesigning" data-toggle="pill" href="#designing" role="tab" aria-controls="designing" aria-selected="false">--}}
{{--                  <div class="text-center pt-1 pb-1">--}}
{{--                    <h6 class="title font-weight-normal mb-0">Employee Directory</h6>--}}
{{--                  </div>--}}
{{--                </a><!--end nav link-->--}}
{{--              </li><!--end nav item-->--}}
            </ul><!--end nav pills-->
          </div><!--end col-->

          <div class="col-md-8 col-12 mt-0 pt-0">
            <div class="tab-content" id="pills-tabContent">
              <div class="tab-pane fade bg-white show active p-4 rounded shadow" id="onboarding" role="tabpanel" aria-labelledby="webdeveloping">
                <img src="{{asset('/frontend/images/clients.png')}}" class="img-fluid" alt="">
                <div class="mt-0">
                  <p class="text-muted">Manage your customers' details from the initial stage of your business relationship to the conclusion of your deal.</p>
                </div>
              </div><!--end teb pane-->

              <div class="tab-pane fade bg-white p-4 rounded shadow" id="data-analise" role="tabpanel" aria-labelledby="database">
                <img src="{{asset('/frontend/images/bulk_sms.png')}}" class="img-fluid" alt="">
                <div class="mt-0">
                  <p class="text-muted">Connect with your clients wherever they are through both sms and email channels.</p>
                </div>
              </div><!--end teb pane-->

              <div class="tab-pane fade bg-white p-4 rounded shadow" id="security" role="tabpanel" aria-labelledby="server">
                <img src="{{asset('/frontend/images/invoices.png')}}" class="img-fluid" alt="">
                <div class="mt-0">
                  <p class="text-muted">Centralized management of paid and unpaid invoices and receipts for tracking client payments.</p>
                </div>
              </div><!--end teb pane-->

{{--              <div class="tab-pane fade bg-white p-4 rounded shadow" id="designing" role="tabpanel" aria-labelledby="webdesigning">--}}
{{--                <img src="{{asset('/frontend/images/employee-directory.png')}}" class="img-fluid" alt="">--}}
{{--                <div class="mt-0">--}}
{{--                  <p class="text-muted">Easily searchable directory of current and former employees and an overview of employee details.</p>--}}
{{--                </div>--}}
{{--              </div><!--end teb pane-->--}}
            </div><!--end tab content-->
          </div><!--end col-->
        </div><!--end row-->
      </div><!--end container-->
    </div><!--end container-->
  </section>
@endsection