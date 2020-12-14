@extends('layouts.frontend-layout')

@section('title')
    Frequently Asked Questions
@endsection

@section('extra-styles')
    <style>
        .card{
            border-radius: 0px !important;
        }
    </style>
@endsection

@section('content')
        <section class="bg-half bg-light d-table w-100">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-12 text-center">
                        <div class="page-next-level">
                            <h4 class="title"> Frequently Asked Questions </h4>
                            <p class="text-muted">Explore a collection of questions that have appeared often in our search engine.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="section">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-md-5 col-12 d-none d-md-block">
                        <div class="rounded shadow p-4 sticky-bar">
                            <ul class="list-unstyled mb-0">
                                <li><a href="#product" class="mouse-down h6 text-dark">Product Questions</a></li>
                                <li class="mt-4"><a href="#general" class="mouse-down h6 text-dark">General Questions</a></li>
                                <li class="mt-4"><a href="#payment" class="mouse-down h6 text-dark">Payments Questions</a></li>
                                <li class="mt-4"><a href="#support" class="mouse-down h6 text-dark">Support Questions</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-7 col-12">
                        <div class="section-title" id="product">
                            <h4>Buying Product</h4>
                        </div>
                        <div class="faq-content mt-4 pt-2">
                            <div class="accordion" id="accordionExampleProduct">
                                @foreach ($faqs as $faq)
                                    @if ($faq->category == 'product')
                                        <div class="card border-0 rounded mb-2">
                                            <a data-toggle="collapse" href="#collapse_{{$faq->id}}" class="faq position-relative" aria-expanded="true" aria-controls="collapse_{{$faq->id}}">
                                                <div class="card-header border-0 bg-light p-3 pr-5" id="headingfif_{{$faq->id}}">
                                                    <h6 class="title mb-0"> {{$faq->question ?? ''}}</h6>
                                                </div>
                                            </a>
                                            <div id="collapse_{{$faq->id}}" class="collapse show" aria-labelledby="headingfif_{{$faq->id}}" data-parent="#accordionExampleProduct">
                                                <div class="card-body px-2 py-4">
                                                    {!! $faq->answer ?? ''!!}
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>

                        <div class="section-title mt-5" id="general">
                            <h4>General Questions</h4>
                        </div>

                        <div class="faq-content mt-4 pt-3">
                            <div class="accordion" id="accordionExampleGeneral">
                                @foreach ($faqs as $faq)
                                    @if ($faq->category == 'general')
                                        <div class="card border-0 rounded mb-2">
                                            <a data-toggle="collapse" href="#collapse_g{{$faq->id}}" class="faq position-relative" aria-expanded="true" aria-controls="collapse_g{{$faq->id}}">
                                                <div class="card-header border-0 bg-light p-3 pr-5" id="headingfif_g{{$faq->id}}">
                                                    <h6 class="title mb-0"> {{$faq->question ?? ''}}</h6>
                                                </div>
                                            </a>
                                            <div id="collapse_g{{$faq->id}}" class="collapse show" aria-labelledby="headingfif_g{{$faq->id}}" data-parent="#accordionExampleGeneral">
                                                <div class="card-body px-2 py-4">
                                                    {!! $faq->answer ?? ''!!}
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>

                        <div class="section-title mt-5" id="payment">
                            <h4>Payments Questions</h4>
                        </div>

                        <div class="faq-content mt-4 pt-3">
                            <div class="accordion" id="accordionExamplePayment">
                                @foreach ($faqs as $faq)
                                    @if ($faq->category == 'payment')
                                        <div class="card border-0 rounded mb-2">
                                            <a data-toggle="collapse" href="#collapse_p{{$faq->id}}" class="faq position-relative" aria-expanded="true" aria-controls="collapse_p{{$faq->id}}">
                                                <div class="card-header border-0 bg-light p-3 pr-5" id="headingfif_p{{$faq->id}}">
                                                    <h6 class="title mb-0"> {{$faq->question ?? ''}}</h6>
                                                </div>
                                            </a>
                                            <div id="collapse_p{{$faq->id}}" class="collapse show" aria-labelledby="headingfif_p{{$faq->id}}" data-parent="#accordionExamplePayment">
                                                <div class="card-body px-2 py-4">
                                                    {!! $faq->answer ?? ''!!}
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>

                        <div class="section-title mt-5" id="support">
                            <h4>Support Questions</h4>
                        </div>

                        <div class="faq-content mt-4 pt-3">
                            <div class="accordion" id="accordionExampleSupport">
                                @foreach ($faqs as $faq)
                                    @if ($faq->category == 'support')
                                        <div class="card border-0 rounded mb-2">
                                            <a data-toggle="collapse" href="#collapse_s{{$faq->id}}" class="faq position-relative" aria-expanded="true" aria-controls="collapse_s{{$faq->id}}">
                                                <div class="card-header border-0 bg-light p-3 pr-5" id="headingfif_{{$faq->id}}">
                                                    <h6 class="title mb-0"> {{$faq->question ?? ''}}</h6>
                                                </div>
                                            </a>
                                            <div id="collapse_s{{$faq->id}}" class="collapse show" aria-labelledby="headingfif_s{{$faq->id}}" data-parent="#accordionExampleSupport">
                                                <div class="card-body px-2 py-4">
                                                    {!! $faq->answer ?? ''!!}
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @include('partials.frontend._cta')
        </section>
@endsection
