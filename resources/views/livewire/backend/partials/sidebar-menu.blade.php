<nav class="pcoded-navbar">
    <div class="pcoded-inner-navbar main-menu" style="background: none;">
        <div class="pcoded-navigatio-lavel">Navigation</div>
        <ul class="pcoded-item pcoded-left-item">
						<li class="">
								<a href="{{route('activity-stream')}}">
										<span class="pcoded-micon"><i class="ti-layers-alt"></i></span>
										<span class="pcoded-mtext">Activity Stream</span>
								</a>
						</li>

            <li class="">
                <a href="{{route('workflow-tasks')}}">
                    <span class="pcoded-micon"><i class="ti-menu"></i></span>
                    <span class="pcoded-mtext">Workflows
                        @if(count(Auth::user()->myResponsibilities()->whereIn('post_type', ['expense-report', 'purchase-request', 'business-trip', 'general-request', 'leave-request'])->where('status', 'in-progress')->get()) > 0)
                            <label for="" class="badge badge-danger">{{count(Auth::user()->myResponsibilities()->whereIn('post_type', ['expense-report', 'purchase-request', 'business-trip', 'general-request', 'leave-request'])->where('status', 'in-progress')->get())}}</label>
                        @endif
                    </span>
                </a>
            </li>

            <li class="">
                <a href="{{ route('chat-n-calls') }}">
                    <span class="pcoded-micon"><i class="ti-comment-alt"></i></span>
                    <span class="pcoded-mtext">Chat & Calls
                        @if(count($unreadMessages) > 0)
                        <label for="" class="badge badge-danger">{{number_format(count($unreadMessages))}}</label>
                    @endif
                    </span>
                </a>
						</li>
							<li class="">
									<a href="{{ route('cnx247-stream') }}">
											<span class="pcoded-micon"><i class="ti-video-camera"></i></span>
											<span class="pcoded-mtext">CNX247 Stream</span>
									</a>
							</li>
							<li class="">
									<a href="{{ route('project-board')  }}">
											<span class="pcoded-micon"><i class="ti-briefcase"></i></span>
											<span class="pcoded-mtext">Projects
													@if(count(Auth::user()->myResponsibilities()->where('post_type', 'project')->where('status', 'in-progress')->get()) > 0)
															<label for="" class="badge badge-danger">{{count(Auth::user()->myResponsibilities()->where('post_type', 'project')->where('status', 'in-progress')->get())}}</label>
													@endif
											</span>
									</a>
							</li>

							<li class="">
									<a href="{{ route('task-board')  }}">
											<span class="pcoded-micon"><i class="ti-check-box"></i></span>
											<span class="pcoded-mtext">Tasks
													@if(count(Auth::user()->myResponsibilities()->where('post_type', 'task')->where('status', 'in-progress')->get()) > 0)
															<label for="" class="badge badge-danger">{{count(Auth::user()->myResponsibilities()->where('post_type', 'task')->where('status', 'in-progress')->get())}}</label>
													@endif
											</span>
									</a>
							</li>

								<li class="">
										<a href="{{route('workgroups')}}">
												<span class="pcoded-micon"><i class="ti-infinite"></i></span>
												<span class="pcoded-mtext">Workgroups</span>
										</a>
								</li>
								<li class="">
										<a href="{{ route('cnx247-drive') }}">
												<span class="pcoded-micon"><i class="ti-harddrive"></i></span>
												<span class="pcoded-mtext">CNX247.Drive</span>
										</a>
								</li>

								<li class="">
										<a href="{{route('my-event-list')}}">
												<span class="pcoded-micon"><i class="ti-calendar"></i></span>
												<span class="pcoded-mtext">Events</span>
										</a>
								</li>

				</ul>
					<div class="pcoded-navigatio-lavel">Human Resource</div>
					<ul class="pcoded-item pcoded-left-item">
							<li class="pcoded-hasmenu">
									<a href="javascript:void(0)">
											<span class="pcoded-micon"><i class="ti-id-badge"></i></span>
											<span class="pcoded-mtext">HR</span>
									</a>
									<ul class="pcoded-submenu">
										@can('hr dashboard')

										<li class=" ">
												<a href="{{route('hr-dashboard')}}">
														<span class="pcoded-mtext">HR Dashboard</span>
												</a>
										</li>
										@endcan
										@can('view employees')
											<li class=" ">
													<a href="{{route('employees')}}">
															<span class="pcoded-mtext">Employees</span>
													</a>
											</li>

										@endcan
										@can('view appreciation')

										<li class=" ">
												<a href="{{ route('appreciation') }}">
														<span class="pcoded-mtext">Appreciation</span>
												</a>
										</li>
										@endcan
										@can('view resignation')

										<li class=" ">
												<a href="{{ route('resignation') }}">
														<span class="pcoded-mtext">Resignation</span>
												</a>
										</li>
										@endcan
										@can('view termination')

										<li class=" ">
												<a href="{{ route('terminated-employment') }}">
														<span class="pcoded-mtext">Termination</span>
												</a>
										</li>
										@endcan
										@can('view ideabox')

										<li class=" ">
												<a href="{{route('hr-ideabox')}}">
														<span class="pcoded-mtext">IdeaBox</span>
												</a>
										</li>
										@endcan
										@can('view queries')

										<li class=" ">
												<a href="{{route('queries')}}">
														<span class="pcoded-mtext">Queries</span>
												</a>
										</li>
										@endcan
										@can('onboard employee')

										<li class=" ">
												<a href="{{route('on-boarding')}}">
														<span class="pcoded-mtext">onBoarding</span>
												</a>
										</li>
										@endcan
										@can('view hr config')

										<li class=" ">
												<a href="{{route('hr-configurations')}}">
														<span class="pcoded-mtext">HR Configurations</span>
												</a>
										</li>
										@endcan

									</ul>
							</li>
							<li class="pcoded-hasmenu">
									<a href="javascript:void(0)">
											<span class="pcoded-micon"><i class="ti-calendar"></i></span>
											<span class="pcoded-mtext">Timesheet</span>
									</a>
									<ul class="pcoded-submenu">
										@can('view attendance')

										<li class=" ">
												<a href="{{route('attendance')}}">
														<span class="pcoded-mtext">Attendance</span>
												</a>
										</li>
										@endcan
										@can('manage leave')

										<li class=" ">
												<a href="{{ route('leave-management') }}">
														<span class="pcoded-mtext">Leave Management</span>
												</a>
										</li>
										@endcan
										@can('set leave type')

										<li class=" ">
												<a href="{{ route('leave-type') }}">
														<span class="pcoded-mtext">Leave Types</span>
												</a>
										</li>
										@endcan
									</ul>
							</li>
							<li class="pcoded-hasmenu">
									<a href="javascript:void(0)">
											<span class="pcoded-micon"><i class="ti-bar-chart"></i></span>
											<span class="pcoded-mtext">Performance</span>
									</a>
									<ul class="pcoded-submenu">
										@can('set performance indicator')

										<li class=" ">
												<a href="{{route('performance-indicator')}}">
														<span class="pcoded-mtext">Performance Indicator</span>
												</a>
										</li>
										@endcan
										@can('employee appraisal')

										<li class=" ">
												<a href="{{route('employees-appraisal')}}">
														<span class="pcoded-mtext">Employee Appraisal</span>
												</a>
										</li>
										@endcan
									</ul>
							</li>
					</ul>

					<div class="pcoded-navigatio-lavel">Marketing</div>
					<ul class="pcoded-item pcoded-left-item">
							<li class="pcoded-hasmenu">
									<a href="javascript:void(0)">
											<span class="pcoded-micon"><i class="feather icon-box"></i></span>
											<span class="pcoded-mtext">CRM</span>
									</a>
									<ul class="pcoded-submenu">
										@can('crm dashboard')
											<li class=" ">
													<a href="{{route('crm-dashboard')}}">
															<span class="pcoded-mtext">Dashboard</span>
													</a>
											</li>

										@endcan
											<li class=" ">
													<a href="{{route('clients')}}">
															<span class="pcoded-mtext">Clients</span>
													</a>
											</li>
											<li class=" ">
													<a href="{{route('leads')}}">
															<span class="pcoded-mtext">Leads</span>
													</a>
											</li>
											<li class=" ">
													<a href="{{route('deals')}}">
															<span class="pcoded-mtext">Deals</span>
													</a>
											</li>
											<li class=" ">
													<a href="{{route('invoice-list')}}">
															<span class="pcoded-mtext">Invoices</span>
													</a>
											</li>
											<li class=" ">
													<a href="{{route('receipt-list')}}">
															<span class="pcoded-mtext">Receipts</span>
													</a>
											</li>
											<li class=" ">
													<a href="{{route('bulk-sms')}}">
															<span class="pcoded-mtext">Bulk SMS</span>
													</a>
											</li>
											<li class=" ">
													<a href="{{route('email-campaigns')}}">
															<span class="pcoded-mtext">Email Campaigns</span>
													</a>
											</li>
									</ul>
							</li>
					</ul>

				@can('accounting')
					<div class="pcoded-navigatio-lavel">Accounting</div>
					<ul class="pcoded-item pcoded-left-item">
							<li class="pcoded-hasmenu">
									<a href="javascript:void(0)">
											<span class="pcoded-micon"><i class="icofont icofont-money-bag"></i></span>
											<span class="pcoded-mtext">Account</span>
									</a>
									<ul class="pcoded-submenu">
										@can('view chart of accounts')

										<li class=" ">
												<a href="{{route('chart-of-accounts')}}">
														<span class="pcoded-mtext">Chart of Accounts</span>
												</a>
										</li>
										@endcan
										@can('set budget profile')

										<li class=" ">
												<a href="{{route('budget-profile')}}">
														<span class="pcoded-mtext">Budget Profile</span>
												</a>
										</li>
										@endcan
										@can('set budget')

										<li class=" ">
												<a href="{{route('budget-setup')}}">
														<span class="pcoded-mtext">Budget Setup</span>
												</a>
										</li>
										@endcan
										@can('set opening balance')

											<li class=" ">
													<a href="{{route('opening-balance')}}">
															<span class="pcoded-mtext">Opening Balance</span>
													</a>
											</li>
										@endcan
											<li class=" ">
													<a href="{{route('accounting-vat')}}">
															<span class="pcoded-mtext">VAT</span>
													</a>
											</li>
											<li class=" ">
													<a href="{{route('ledger-default-variables')}}">
															<span class="pcoded-mtext">Ledger Defaults</span>
													</a>
											</li>
									</ul>
							</li>
					</ul>

				@endcan
				@can('access vendors')
        <ul class="pcoded-item pcoded-left-item">
            <li class="pcoded-hasmenu">
                <a href="javascript:void(0)">
                    <span class="pcoded-micon"><i class="icofont icofont-deal"></i></span>
                    <span class="pcoded-mtext">Vendors</span>
                </a>
                <ul class="pcoded-submenu">
									@can('view vendor bills')

									<li class=" ">
											<a href="{{route('vendor-bills')}}">
													<span class="pcoded-mtext">Vendor Bills</span>
											</a>
									</li>
									@endcan
                </ul>
            </li>
        </ul>

				@endcan
				@can('access customers')
        <ul class="pcoded-item pcoded-left-item">
            <li class="pcoded-hasmenu">
                <a href="javascript:void(0)">
                    <span class="pcoded-micon"><i class="icofont icofont-transparent"></i></span>
                    <span class="pcoded-mtext">Customers</span>
                </a>
                <ul class="pcoded-submenu">
                    <li class=" ">
                        <a href="{{route('clients')}}">
                            <span class="pcoded-mtext">Customers</span>
                        </a>
                    </li>
                    <li class=" ">
                        <a href="{{route('invoice-list')}}">
                            <span class="pcoded-mtext">Invoices</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>

				@endcan
				@can('post transactions')
					<ul class="pcoded-item pcoded-left-item">
							<li class="pcoded-hasmenu">
									<a href="javascript:void(0)">
											<span class="pcoded-micon"><i class="icofont icofont-paper-plane"></i></span>
											<span class="pcoded-mtext">Postings</span>
									</a>
									<ul class="pcoded-submenu">
										@can('post transactions')

											<li class=" ">
													<a href="{{route('receipt-posting')}}">
															<span class="pcoded-mtext">Receipt</span>
													</a>
											</li>
											<li class=" ">
													<a href="{{route('payments')}}">
															<span class="pcoded-mtext">Payment</span>
													</a>
											</li>
											<li class=" ">
													<a href="{{route('journal-entries')}}">
															<span class="pcoded-mtext">Journal Voucher</span>
													</a>
											</li>
											<li class=" ">
													<a href="{{route('budget-setup')}}">
															<span class="pcoded-mtext">Workflow</span>
													</a>
											</li>
										@endcan
									</ul>
							</li>
					</ul>

				@endcan
				@can('generate report')
					<ul class="pcoded-item pcoded-left-item">
							<li class="pcoded-hasmenu">
									<a href="javascript:void(0)">
											<span class="pcoded-micon"><i class="icofont icofont-coins"></i></span>
											<span class="pcoded-mtext">Reports</span>
									</a>
									<ul class="pcoded-submenu">
										@can('acess trial balance')

											<li class=" ">
													<a href="{{route('trial-balance')}}">
															<span class="pcoded-mtext">Trial Balance</span>
													</a>
											</li>
										@endcan
										@can('access balance sheet')
											<li class=" ">
													<a href="{{route('balance-sheet')}}">
															<span class="pcoded-mtext">Balance Sheet</span>
													</a>
											</li>

										@endcan
										@can('access profit or loss')

										<li class=" ">
												<a href="{{route('profit-o-loss')}}">
														<span class="pcoded-mtext">Profit/Loss</span>
												</a>
										</li>
										@endcan
									</ul>
							</li>
					</ul>

				@endcan
				@can('procurement')
					<div class="pcoded-navigatio-lavel">Procurement</div>
					<ul class="pcoded-item pcoded-left-item">
							<li class="pcoded-hasmenu">
									<a href="javascript:void(0);">
											<span class="pcoded-micon"><i class="icofont icofont-bar-code"></i></span>
											<span class="pcoded-mtext">Procurement</span>
									</a>
									<ul class="pcoded-submenu">
										@can('add vendor')

										<li class=" ">
												<a href="{{route('new-supplier')}}">
														<span class="pcoded-mtext">Add New Vendor</span>
												</a>
										</li>
										@endcan
											@can('view vendors')
												<li class=" ">
														<a href="{{route('suppliers')}}">
																<span class="pcoded-mtext">Vendors</span>
														</a>
												</li>

											@endcan
											@can('view purchase orders')

											<li class=" ">
													<a href="{{route('purchase-orders')}}">
															<span class="pcoded-mtext">Purchase Orders</span>
													</a>
											</li>
											@endcan
											@can('view services')

											<li class=" ">
													<a href="{{route('vendor-services')}}">
															<span class="pcoded-mtext">Services</span>
													</a>
											</li>
											@endcan
									</ul>
							</li>
					</ul>

				@endcan
				@can('access logistics')
					<div class="pcoded-navigatio-lavel">Logistics</div>
					<ul class="pcoded-item pcoded-left-item">
							<li class="pcoded-hasmenu">
									<a href="javascript:void(0);">
											<span class="pcoded-micon"><i class="icofont icofont-fire-truck"></i></span>
											<span class="pcoded-mtext">Logistics</span>
									</a>
									<ul class="pcoded-submenu">
										@can('view drivers')

										<li class=" ">
												<a href="{{route('logistics-drivers')}}">
														<span class="pcoded-mtext">Drivers</span>
												</a>
										</li>
										@endcan
										@can('view customers')
											<li class=" ">
													<a href="{{route('logistics-customers')}}">
															<span class="pcoded-mtext">Customers</span>
													</a>
											</li>

										@endcan
										@can('view vehicles')

										<li class=" ">
												<a href="{{route('logistics-vehicles')}}">
														<span class="pcoded-mtext">Vehicles</span>
												</a>
										</li>
										@endcan
										@can('view logistics log')
											<li class=" ">
													<a href="{{route('all-logs')}}">
															<span class="pcoded-mtext">Log</span>
													</a>
											</li>

										@endcan
									</ul>
							</li>
					</ul>

				@endcan
				@can('update general settings')
					<div class="pcoded-navigatio-lavel">System Settings</div>
					<ul class="pcoded-item pcoded-left-item">
							<li class="pcoded-hasmenu">
									<a href="javascript:void(0)">
											<span class="pcoded-micon"><i class="feather icon-credit-card"></i></span>
											<span class="pcoded-mtext">General Settings</span>
									</a>
									<ul class="pcoded-submenu">
											<li class=" ">
													<a href="{{route('general-settings')}}">
															<span class="pcoded-mtext">General Settings</span>
													</a>
											</li>
									</ul>
							</li>
					</ul>

				@endcan
				@can('access administrative area')
					<div class="pcoded-navigatio-lavel">Administration</div>
					<ul class="pcoded-item pcoded-left-item">
							<li class="pcoded-hasmenu">
									<a href="javascript:void(0)">
											<span class="pcoded-micon"><i class="ti-briefcase"></i></span>
											<span class="pcoded-mtext">Administration</span>
									</a>
									<ul class="pcoded-submenu">
											<li class=" ">
													<a href="{{route('admin-support')}}">
															<span class="pcoded-mtext">Support Ticket</span>
													</a>
											</li>
											<li class=" ">
													<a href="{{route('feedbacks')}}">
															<span class="pcoded-mtext">Feedback</span>
													</a>
											</li>
											<li class=" ">
													<a href="{{route('tenants')}}">
															<span class="pcoded-mtext">Tenants</span>
													</a>
											</li>
											<li class=" ">
													<a href="{{route('plans-n-features')}}">
															<span class="pcoded-mtext">Plans & Features</span>
													</a>
											</li>
											<li class=" ">
													<a href="{{route('tenant-financials')}}">
															<span class="pcoded-mtext">Financials</span>
													</a>
											</li>
											<li class=" ">
													<a href="{{route('tenant-memberships')}}">
															<span class="pcoded-mtext">Membership</span>
													</a>
											</li>
											<li class=" ">
													<a href="{{route('constants')}}">
															<span class="pcoded-mtext">Constants</span>
													</a>
											</li>
											<li class=" ">
													<a href="{{route('roles')}}">
															<span class="pcoded-mtext">Roles</span>
													</a>
											</li>
											<li class=" ">
													<a href="{{route('permissions')}}">
															<span class="pcoded-mtext">Permissions</span>
													</a>
											</li>
											<li class=" ">
													<a href="{{route('module-manager')}}">
															<span class="pcoded-mtext">Module Manager</span>
													</a>
											</li>
											<li class=" ">
													<a href="{{route('terms-n-conditions')}}">
															<span class="pcoded-mtext">Terms & Conditions</span>
													</a>
											</li>
											<li class=" ">
													<a href="{{route('admin-theme-gallery')}}">
															<span class="pcoded-mtext">Themes</span>
													</a>
											</li>
											<li class=" ">
													<a href="{{route('access-faqs')}}">
															<span class="pcoded-mtext">FAQs</span>
													</a>
											</li>
											<li class=" ">
													<a href="{{route('privacy-policy')}}">
															<span class="pcoded-mtext">Privacy Policy</span>
													</a>
											</li>
									</ul>
							</li>
					</ul>

				@endcan
    </div>
</nav>
