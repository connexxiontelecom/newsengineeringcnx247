@extends('layouts.frontend-layout')

@section('title')
  Home
@endsection

@section('content')
<!-- Hero Start -->
<section class="main-slider">
  <ul class="slides">
    <li class="bg-slider d-flex align-items-center" style="background-image:url('{{asset('/frontend/images/bg-2.jpg')}}')">
      <div class="bg-overlay"></div>
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-12 text-center">
            <div class="title-heading text-white mt-4">
              <h1 class="display-4 title-dark font-weight-bold mb-3">Manage Your Business Smartly</h1>
              <p class="para-desc para-dark mx-auto text-light">An enterprise resource planning solution designed to suit the modern African workplace.</p>
              <div class="mt-4">
                <a href="{{route('pricing')}}" class="btn btn-primary mt-2 mouse-down">Get Started</a>
              </div>
            </div>
          </div><!--end col-->
        </div><!--end row-->
      </div>
    </li>
    <li class="bg-slider d-flex align-items-center" style="background-image:url('{{asset('/frontend/images/bg-4.jpg')}}')">
      <div class="bg-overlay"></div>
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-12 text-center">
            <div class="title-heading text-white mt-4">
              <h1 class="display-4 title-dark font-weight-bold mb-3">Your Enterprise Rediscovered</h1>
              <p class="para-desc para-dark mx-auto text-light">Seamlessly integrate the management of your organization's key business processes with CNX247.</p>
              <div class="mt-4">
                <a href="{{route('pricing')}}" class="btn btn-primary mt-2 mouse-down">Get Started</a>
              </div>
            </div>
          </div><!--end col-->
        </div><!--end row-->
      </div>
    </li>
  </ul>
</section><!--end section-->
<!-- Hero End -->
<!-- FEATURES START -->
<section class="section">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-12">
        <div class="features-absolute">
          <div class="row">
            <div class="col-lg-3 col-md-6 col-12">
              <div class="card features explore-feature p-4 px-md-3 border-0 rounded-md shadow text-center">
                <div class="icons rounded h2 text-center text-primary px-3">
                  <img src="{{asset('/frontend/images/icon/big.svg')}}" class="avatar avatar-small" alt="">
                </div>
                <div class="card-body p-0 content">
                  <h5 class="mt-4"><a href="javascript:void(0)" class="title text-dark">Structure</a></h5>
                  <p class="text-muted">Tailored modules that help to promote your unique business processes, increase productivity and prevent overwhelming you with information.</p>
                </div>
              </div>
            </div><!--end col-->

            <div class="col-lg-3 col-md-6 col-12 mt-4 mt-md-0 pt-2 pt-md-0">
              <div class="card features explore-feature p-4 px-md-3 border-0 rounded-md shadow text-center">
                <div class="icons rounded h2 text-center text-primary px-3">
                  <img src="{{asset('/frontend/images/icon/cloud.svg')}}" class="avatar avatar-small" alt="">
                </div>
                <div class="card-body p-0 content">
                  <h5 class="mt-4"><a href="javascript:void(0)" class="title text-dark">Cohesion</a></h5>
                  <p class="text-muted">Digital space that transcends the local office setting and provides access to your organization tasks across devices so you don't waste your time.</p>
                </div>
              </div>
            </div><!--end col-->

            <div class="col-lg-3 col-md-6 col-12 mt-4 mt-lg-0 pt-2 pt-lg-0">
              <div class="card features explore-feature p-4 px-md-3 border-0 rounded-md shadow text-center">
                <div class="icons rounded h2 text-center text-primary px-3">
                  <img src="{{asset('/frontend/images/icon/computer.svg')}}" class="avatar avatar-small" alt="">
                </div>
                <div class="card-body p-0 content">
                  <h5 class="mt-4"><a href="javascript:void(0)" class="title text-dark">Accessibility</a></h5>
                  <p class="text-muted">Software interface that eliminates complexity and bloatware allowing you to focus on what is important to you so you can get more done with less.</p>
                </div>
              </div>
            </div><!--end col-->

            <div class="col-lg-3 col-md-6 col-12 mt-4 mt-lg-0 pt-2 pt-lg-0">
              <div class="card features explore-feature p-4 px-md-3 border-0 rounded-md shadow text-center">
                <div class="icons rounded h2 text-center text-primary px-3">
                  <img src="{{asset('/frontend/images/icon/customer-service.svg')}}" class="avatar avatar-small" alt="">
                </div>
                <div class="card-body p-0 content">
                  <h5 class="mt-4"><a href="javascript:void(0)" class="title text-dark">Collaboration</a></h5>
                  <p class="text-muted">Software tools that minimize the necessary steps and enhances collaborative activities between multiple departments to accomplish complex tasks.</p>
                </div>
              </div>
            </div><!--end col-->
          </div>
        </div>
      </div>
    </div><!--end row-->
  </div><!--end container-->
</section><!--end section-->
<!-- FEATURES END -->

<section class="section pt-0">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-12 text-center">
        <div class="section-title mb-4 pb-2">
          <h4 class="title mb-3">How We Transform Your Business</h4>
          <p class="text-muted para-desc mb-0 mx-auto">Start working with <span class="text-primary font-weight-bold">CNX247</span> modules to centralize your business processes, simplify file storage, and enhance teamwork.</p>
        </div>
      </div><!--end col-->
    </div><!--end row-->
    <div class="row">
      <div class="col-lg-3 col-md-4 mt-4 pt-2">
        <div class="card features fea-primary rounded p-4 bg-light text-center position-relative overflow-hidden border-0">
          <span class="h1 icon2 text-primary">
            <i class="uil uil-chart-line"></i>
          </span>
          <div class="card-body p-0 content">
            <h5>Accounting</h5>
            <p class="para text-muted mb-0">Financial tools to enhance your back office operations.</p>
          </div>
          <span class="big-icon text-center">
            <i class="uil uil-chart-line"></i>
          </span>
        </div>
      </div><!--end col-->

      <div class="col-lg-3 col-md-4 mt-4 pt-2">
        <div class="card features fea-primary rounded p-4 bg-light text-center position-relative overflow-hidden border-0">
          <span class="h1 icon2 text-primary">
            <i class="uil uil-folder"></i>
          </span>
          <div class="card-body p-0 content">
            <h5>File Management</h5>
            <p class="para text-muted mb-0">Share and organize files securely among your team.</p>
          </div>
          <span class="big-icon text-center">
            <i class="uil uil-folder"></i>
          </span>
        </div>
      </div><!--end col-->

      <div class="col-lg-3 col-md-4 mt-4 pt-2">
        <div class="card features fea-primary rounded p-4 bg-light text-center position-relative overflow-hidden border-0">
          <span class="h1 icon2 text-primary">
            <i class="uil uil-briefcase-alt"></i>
          </span>
          <div class="card-body p-0 content">
            <h5>CRM</h5>
            <p class="para text-muted mb-0">Convert leads and engage with clients to grow revenue.</p>
          </div>
          <span class="big-icon text-center">
            <i class="uil uil-briefcase-alt"></i>
          </span>
        </div>
      </div><!--end col-->

      <div class="col-lg-3 col-md-4 mt-4 pt-2">
        <div class="card features fea-primary rounded p-4 bg-light text-center position-relative overflow-hidden border-0">
          <span class="h1 icon2 text-primary">
            <i class="uil uil-map"></i>
          </span>
          <div class="card-body p-0 content">
            <h5>Logistics</h5>
            <p class="para text-muted mb-0">Centralized management of your company's vehicles.</p>
          </div>
          <span class="big-icon text-center">
            <i class="uil uil-map"></i>
          </span>
        </div>
      </div><!--end col-->

      <div class="col-lg-3 col-md-4 mt-4 pt-2">
        <div class="card features fea-primary rounded p-4 bg-light text-center position-relative overflow-hidden border-0">
          <span class="h1 icon2 text-primary">
            <i class="uil uil-transaction"></i>
          </span>
          <div class="card-body p-0 content">
            <h5>Procurement</h5>
            <p class="para text-muted mb-0">Order management tools to streamline your purchases.</p>
          </div>
          <span class="big-icon text-center">
            <i class="uil uil-transaction"></i>
          </span>
        </div>
      </div><!--end col-->

      <div class="col-lg-3 col-md-4 mt-4 pt-2">
        <div class="card features fea-primary rounded p-4 bg-light text-center position-relative overflow-hidden border-0">
          <span class="h1 icon2 text-primary">
            <i class="uil uil-users-alt"></i>
          </span>
          <div class="card-body p-0 content">
            <h5>HR Management</h5>
            <p class="para text-muted mb-0">Tools for HR processes so you can manage your team.</p>
          </div>
          <span class="big-icon text-center">
            <i class="uil uil-users-alt"></i>
          </span>
        </div>
      </div><!--end col-->

      <div class="col-lg-3 col-md-4 mt-4 pt-2">
        <div class="card features fea-primary rounded p-4 bg-light text-center position-relative overflow-hidden border-0">
          <span class="h1 icon2 text-primary">
            <i class="uil uil-envelopes"></i>
          </span>
          <div class="card-body p-0 content">
            <h5>Communication</h5>
            <p class="para text-muted mb-0">Keep in touch with your team, wherever you are.</p>
          </div>
          <span class="big-icon text-center">
            <i class="uil uil-envelopes"></i>
          </span>
        </div>
      </div><!--end col-->

      <div class="col-lg-3 col-md-4 mt-4 pt-2">
        <div class="card features fea-primary rounded p-4 bg-light text-center position-relative overflow-hidden border-0">
          <span class="h1 icon2 text-primary">
            <i class="uil uil-schedule"></i>
          </span>
          <div class="card-body p-0 content">
            <h5>Project Management</h5>
            <p class="para text-muted mb-0">Plan and assign tasks efficiently for your projects.</p>
          </div>
          <span class="big-icon text-center">
            <i class="uil uil-schedule"></i>
          </span>
        </div>
      </div><!--end col-->
    </div><!--end row-->
  </div>
  <div class="container mt-100">
    <div class="row justify-content-start">
      <div class="col-12 text-left">
        <div class="section-title mb-4 pb-2">
          <h4 class="title mb-2"><span class="text-primary">Unlimited</span> Productivity</h4>
          <p class="text-muted mb-0 mx-auto">
            <span class="text-primary font-weight-bold">CNX247</span> allows you bring your office with you on the go. Keep up
            <br> with all the latest activities, assign and view your daily tasks, and
            <br> generate or respond to the workflows in your organization remotely.
          </p>
        </div>
      </div><!--end col-->
    </div><!--end row-->
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-5">
          <ul class="nav nav-pills nav-justified flex-column rounded" id="pills-tab" role="tablist">
            <li class="nav-item">
              <a class="nav-link rounded active" id="pills-cloud-tab" data-toggle="pill" href="#pills-cloud" role="tab" aria-controls="pills-cloud" aria-selected="false">
                <div class="p-3 text-left">
                  <h4 class="title font-weight-bold">Activity Stream</h4>
                  <p class="text-muted tab-para mb-0">Keep up with all the latest activities, news & events that concern you and your organization as a whole regardless of where you are or the role you play.</p>
{{--                  <p class="text-muted tab-para mb-0">Dummy text is text that is used in the publishing industry or by web designers to occupy the space which will later be filled with 'real' content.</p>--}}
                </div>
              </a><!--end nav link-->
            </li><!--end nav item-->

            <li class="nav-item">
              <a class="nav-link border-top rounded" id="pills-smart-tab" data-toggle="pill" href="#pills-smart" role="tab" aria-controls="pills-smart" aria-selected="false">
                <div class="p-3 text-left">
                  <h4 class="title font-weight-bold">Project & Task Management</h4>
                  <p class="text-muted tab-para mb-0">Breakdown projects into manageable tasks and monitor each task through its various stages from start to finish with the goal of successfully completing it.</p>
{{--                  <p class="text-muted tab-para mb-0">Dummy text is text that is used in the publishing industry or by web designers to occupy the space which will later be filled with 'real' content.</p>--}}
                </div>
              </a><!--end nav link-->
            </li><!--end nav item-->

            <li class="nav-item">
              <a class="nav-link border-top rounded" id="pills-apps-tab" data-toggle="pill" href="#pills-apps" role="tab" aria-controls="pills-apps" aria-selected="false">
                <div class="p-3 text-left">
                  <h4 class="title font-weight-bold">Workflows</h4>
                  <p class="text-muted tab-para mb-0">Automate the multilevel approval workflow processes in your organization to get things done quickly and effectively.</p>
                </div>
              </a><!--end nav link-->
            </li><!--end nav item-->
          </ul><!--end nav pills-->
        </div><!--end col-->

        <div class="col-md-7 col-12 mt-4 pt-2 mt-sm-0 pt-sm-0">
          <div class="position-relative">
            <div class="tab-content ml-lg-4" id="pills-tabContent">
              <div class="tab-pane fade show active" id="pills-cloud" role="tabpanel" aria-labelledby="pills-cloud-tab">
                <img src="{{asset('/frontend/images/activity-stream.png')}}" class="img-fluid mx-auto" alt="">
              </div><!--end teb pane-->

              <div class="tab-pane fade" id="pills-smart" role="tabpanel" aria-labelledby="pills-smart-tab">
                <img src="{{asset('/frontend/images/project.png')}}" class="img-fluid mx-auto" alt="">
              </div><!--end teb pane-->

              <div class="tab-pane fade" id="pills-apps" role="tabpanel" aria-labelledby="pills-apps-tab">
                <img src="{{asset('/frontend/images/workflows.png')}}" class="img-fluid mx-auto" alt="">
              </div><!--end teb pane-->
            </div><!--end tab content-->
          </div>
        </div><!--end col-->
      </div><!--end row-->
    </div><!--end container-->
  </div><!--end container-->

	<div class="container mt-100">
		<div class="row justify-content-start">
			<div class="col-12 text-left">
				<div class="section-title mb-4 pb-2">
					<h4 class="title mb-2"><span class="text-primary">Seamless</span> Collaboration</h4>
					<p class="text-muted mb-0 mx-auto">
						Send and receive messages, host meetings, and webinars,
						<br> create, store, share, and collaborate on your files and documents
						<br> all remotely with <span class="text-primary font-weight-bold">CNX247</span>.
					</p>
				</div>
			</div><!--end col-->
		</div><!--end row-->
		<div class="container">
			<div class="row align-items-center">
				<div class="col-md-5">
					<ul class="nav nav-pills nav-justified flex-column rounded" id="pills-tab" role="tablist">
						<li class="nav-item">
							<a class="nav-link rounded active" id="pills-cloud-tab" data-toggle="pill" href="#pills-cloud-1" role="tab" aria-controls="pills-cloud" aria-selected="false">
								<div class="p-3 text-left">
									<h4 class="title font-weight-bold">Chats & Calls</h4>
									<p class="text-muted tab-para mb-0">Send and receive messages and make phone calls to your team efficiently with the simple and interactive chat & call features.</p>
								</div>
							</a><!--end nav link-->
						</li><!--end nav item-->

						<li class="nav-item">
							<a class="nav-link border-top rounded" id="pills-smart-tab" data-toggle="pill" href="#pills-smart-1" role="tab" aria-controls="pills-smart" aria-selected="false">
								<div class="p-3 text-left">
									<h4 class="title font-weight-bold">CNX247 Stream</h4>
									<p class="text-muted tab-para mb-0">Easily set up web conferencing meetings from any location with CNX247 Stream to collaborate with your team across multiple locations.</p>
								</div>
							</a><!--end nav link-->
						</li><!--end nav item-->

						<li class="nav-item">
							<a class="nav-link border-top rounded" id="pills-apps-tab" data-toggle="pill" href="#pills-apps-1" role="tab" aria-controls="pills-apps" aria-selected="false">
								<div class="p-3 text-left">
									<h4 class="title font-weight-bold">CNX247 Drive</h4>
									<p class="text-muted tab-para mb-0">Upload and store documents, images, videos, and audios on CNX247 Drive for sharing with other individuals in your team.</p>
								</div>
							</a><!--end nav link-->
						</li><!--end nav item-->
					</ul><!--end nav pills-->
				</div><!--end col-->

				<div class="col-md-7 col-12 mt-4 pt-2 mt-sm-0 pt-sm-0">
					<div class="position-relative">
						<div class="tab-content ml-lg-4" id="pills-tabContent">
							<div class="tab-pane fade show active" id="pills-cloud-1" role="tabpanel" aria-labelledby="pills-cloud-tab">
								<img src="{{asset('/frontend/images/chat-calls.png')}}" class="img-fluid mx-auto" alt="">
							</div><!--end teb pane-->

							<div class="tab-pane fade" id="pills-smart-1" role="tabpanel" aria-labelledby="pills-smart-tab">
								<img src="{{asset('/frontend/images/cnx247stream.png')}}" class="img-fluid mx-auto" alt="">
							</div><!--end teb pane-->

							<div class="tab-pane fade" id="pills-apps-1" role="tabpanel" aria-labelledby="pills-apps-tab">
								<img src="{{asset('/frontend/images/cnx247drive.png')}}" class="img-fluid mx-auto" alt="">
							</div><!--end teb pane-->
						</div><!--end tab content-->
					</div>
				</div><!--end col-->
			</div><!--end row-->
		</div><!--end container-->
	</div>
	<div class="container mt-100 mt-60">
		<div class="rounded bg-primary p-lg-5 p-4">
			<div class="row align-items-end">
				<div class="col-md-8">
					<div class="section-title text-md-left text-center">
						<h4 class="title mb-3 text-white title-dark">Start your free 2 week trial today</h4>
						<p class="text-white-50 mb-0">Start working with CNX247 free today to see how we suit your business needs.</p>
					</div>
				</div><!--end col-->
				<div class="col-md-4 mt-4 mt-sm-0">
					<div class="text-md-right text-center">
						<a href="{{route('start-trial')}}" class="btn btn-light">Start Free</a>
					</div>
				</div><!--end col-->
			</div><!--end row-->
		</div>
	</div><!--end container-->

	<div class="container mt-100 mt-60">
		<div class="row justify-content-center">
			<div class="col-lg-4 col-12">
				<div class="sticky-bar">
					<div class="section-title text-lg-left text-center mb-4 mb-lg-0 pb-2 pb-lg-0">
						<h4 class="title mb-4">Flexible Pricing Hubs Suited To Your Use Case</h4>
{{--						<p class="text-muted para-desc mb-0 mx-auto">Start working with <span class="text-primary font-weight-bold">Landrick</span> that can provide everything you need to generate awareness, drive traffic, connect.</p>--}}
					</div>
				</div>
			</div><!--end col-->

			<div class="col-lg-8 col-12">
				<div class="row align-items-center">
					<div class="col-md-6">
						<div class="row">
							<div class="col-12 mt-4 mt-lg-0 pt-2 pt-lg-0">
								<div class="card features fea-primary work-process border-0 rounded shadow">
									<div class="card-body">
										<h4 class="title">Sales Hub</h4>
										<ul class="list-unstyled d-flex justify-content-between mb-0 mt-2">
											<li class="h6 mb-2 font-weight-light">₦ 17,500 per month</li>
										</ul>
										<p class="text-muted para">Reduce the paperwork involved with maintaining an overview of your clients, leads, & deals and engaging basic accounting features.</p>
									</div>
								</div>
							</div><!--end col-->

							<div class="col-12 mt-4 pt-2">
								<div class="card features fea-primary work-process border-0 rounded shadow">
									<div class="card-body">
										<h4 class="title">Project Hub</h4>
										<ul class="list-unstyled d-flex justify-content-between mb-0 mt-2">
											<li class="h6 mb-2 font-weight-light">₦ 35,750 per month</li>
										</ul>
										<p class="text-muted para">Centralize the processes involved in the management of your projects and teams to efficiently reach your organization's goals.</p>
									</div>
								</div>
							</div><!--end col-->

							<div class="col-12 mt-4 pt-2">
								<div class="card features fea-primary work-process border-0 rounded shadow">
									<div class="card-body">
										<h4 class="title">Professional Hub</h4>
										<ul class="list-unstyled d-flex justify-content-between mb-0 mt-2">
											<li class="h6 mb-2 font-weight-light">₦ 74,000 per month</li>
										</ul>
										<p class="text-muted para">Bring all your teams of professionals together and enjoy the experience of the full capabilities of the CNX247 ERP Solution.</p>
									</div>
								</div>
							</div><!--end col-->
						</div><!--end row-->
					</div><!--end col-->

					<div class="col-md-6">
						<div class="row">
							<div class="col-12 mt-4 mt-sm-0 pt-2 pt-sm-0">
								<div class="card features fea-primary work-process border-0 rounded shadow">
									<div class="card-body">
										<h4 class="title">Essential Sales Hub</h4>
										<ul class="list-unstyled d-flex justify-content-between mb-0 mt-2">
											<li class="h6 mb-2 font-weight-light">₦ 24,800 per month</li>
										</ul>
										<p class="text-muted para">Extend the Sales Hub features to meet the demands of a larger team including reporting & analytics capabilities and the activity stream.</p>
									</div>
								</div>
							</div><!--end col-->

							<div class="col-12 mt-4 pt-2">
								<div class="card features fea-primary work-process border-0 rounded shadow">
									<div class="card-body">
										<h4 class="title">Work Hub</h4>
										<ul class="list-unstyled d-flex justify-content-between mb-0 mt-2">
											<li class="h6 mb-2 font-weight-light">₦ 44,000 per month</li>
										</ul>
										<p class="text-muted para">Move your workplace online and streamline your workflows with communication, procurement, time management, and HR features.</p>
									</div>
								</div>
							</div><!--end col-->

							<div class="col-12 mt-4 pt-2 text-center text-md-left">
								<a href="{{route('pricing')}}" class="btn btn-primary">View Details <i data-feather="arrow-right" class="fea icon-sm"></i></a>
							</div><!--end col-->
						</div><!--end row-->
					</div><!--end col-->
				</div><!--end row-->
			</div><!--end col-->
		</div><!--end row-->
	</div><!--end container-->

	<div class="container mb-md-1 mb-1 mt-100 mt-60">
		<div class="row justify-content-center">
			<div class="col-12 text-center">
				<div class="section-title">
					<h4 class="title mb-4">See everything about your employee in one place.</h4>
					<p class="text-muted para-desc mx-auto mb-0">Start working with <span class="text-primary font-weight-bold">{{config('app.name')}}</span>. The application provides everything you need to keep tabs on your staff or colleagues, get update on recent happenings and much more.</p>

					<div class="mt-4">
						<a href="{{route('pricing')}}" class="btn btn-primary mt-2 mr-2">Get Started Now</a>
{{--              <a href="{{route('faqs')}}" class="btn btn-outline-primary mt-2">Learn More</a>--}}
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection
