@extends('layouts.app')

@section('title')
    Themes
@endsection

@section('extra-styles')
<link rel="stylesheet" type="text/css" href="\assets\pages\toolbar\jquery.toolbar.css">
<link rel="stylesheet" type="text/css" href="\assets\pages\toolbar\custom-toolbar.css">
@endsection

@section('content')
<div class="row">
	<div class="col-md-12 col-sm-12">
		<div class="card">
			<div class="card-block">
				<div class="btn-group d-flex justify-content-end mb-3">

					<button type="button" class="btn btn-success waves-effect btn-mini waves-light" id="saveThemeChangesBtn"> <i class="ti-check text-white mr-2"></i> Save Changes</button>
					<button type="button" class="btn btn-secondary waves-effect btn-mini waves-light float-right" data-toggle="modal" data-target="#customModal" id="custome"> <i class="ti-user text-white mr-2"></i> Custom Theme</button>
			</div>
				<h5 class="sub-title">Background Theme</h5>
							<div class="row" style="height: 500px; overflow-y: scroll;" id="theme-collection">
								@foreach ($themes as $theme)
										<div class="col-lg-4 col-sm-6">
												<label style="cursor: pointer;">
														<input type="radio" @if($theme->id == Auth::user()->userTheme->active_theme) checked="checked" @endif name="backgroundTheme" value="{{$theme->id}}" data-background="{{$theme->theme}}" data-scheme="{{$theme->color_scheme}}">
														<span class="haha-img"></span>
														{{$theme->theme_name ?? ''}}
													</label>
												<div class="thumbnail">
														<div class="thumb" style="cursor: pointer;">
																<img src="/assets/uploads/themes/{{$theme->theme ?? ''}}" alt="{{$theme->theme_name ?? ''}}" class="img-fluid img-thumbnail theme-wrapper" data-themeid="{{$theme->id}}">
														</div>
												</div>
										</div>
								@endforeach
						</div>
			</div>
		</div>
	</div>
</div>

@endsection

@section('dialog-section')
<div class="modal fade" id="customModal" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
			<div class="modal-content">
					<div class="modal-body">
							<div class="row">
									<div class="col-lg-12 col-sm-12">
											<div class="card">
													<div class="card-block" style="background: #EEF2F4;">
															<h6 class="sub-title">Use Your Own Theme</h6>
															<form id="customeThemeForm" data-parsley-validate>
																	<div class="form-group">
																			<label for="">Background Image</label> <br>
																			<img src="/assets/uploads/themes/{{Auth::user()->userTheme->theme ?? ''}}" class="mb-2" height="48" width="48" alt="">
																			<input type="file" required name="custom_background_image" id="custom_background_image" class="form-control-file">
																	</div>
																	<div class="checkbox-fade fade-in-primary">
																			<label>
																					<input type="checkbox"  name="custom_color_scheme" id="custom_color_scheme">
																					<span class="cr">
																							<i class="cr-icon icofont icofont-ui-check txt-primary"></i>
																					</span>
																					<span>Dark Color Scheme</span>
																			</label>
																	</div>
																	<p><strong class="text-danger">Note:</strong> The default color scheme is light.</p>
																	<div class="btn-group d-flex justify-content-center">
																			<button type="button" class="btn btn-danger waves-effect btn-mini" data-dismiss="modal"><i class="ti-close text-white mr-2"></i> Close</button>
																			<button type="submit" class="btn btn-success waves-effect btn-mini waves-light" id="customBackgroundBtn"> <i class="ti-check text-white mr-2"></i> Use Mine</button>
																	</div>
															</form>
													</div>
											</div>
									</div>
							</div>
					</div>
			</div>
	</div>
</div>
@endsection

@section('extra-scripts')

@endsection
