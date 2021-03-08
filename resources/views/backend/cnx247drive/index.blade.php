@extends('layouts.app')

@section('title')
    CNX247.Drive
@endsection

@section('extra-styles')

@endsection

@section('content')
    <div class="row">
        <div class="col-md-6 col-xl-3">
            <div class="card widget-card-1">
                <div class="card-block-small">
                    <i class="icofont icofont-hard-disk bg-c-blue card1-icon"></i>
                    <span class="text-c-blue f-w-600">Space</span>
                    <h4><sup class="text-danger">{{number_format(ceil($size/1048576))}}MB</sup>/{{ $storage_size }} GB</h4>
                    <div>
                        <span class="f-left m-t-10 text-muted">
                            <i class="text-c-blue f-16 feather icon-alert-triangle m-r-10"></i>Used storage
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3">
            <div class="card widget-card-1">
                <div class="card-block-small">
                    <i class="icofont icofont-ui-folder bg-c-pink card1-icon"></i>
                    <span class="text-c-pink f-w-600">Shared</span>
                    <h4>{{number_format(count($directories))}}</h4>
                    <div>
                        <span class="f-left m-t-10 text-muted">
                            <i class="text-c-pink f-16 feather icon-calendar m-r-10"></i>All time
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3">
            <div class="card widget-card-1">
                <div class="card-block-small">
                    <i class="icofont icofont-ui-file bg-c-green card1-icon"></i>
                    <span class="text-c-green f-w-600">Files</span>
                    <h4>{{number_format(count($myFiles))}}</h4>
                    <div>
                        <span class="f-left m-t-10 text-muted">
                            <i class="text-c-green f-16 feather icon-tag m-r-10"></i>All time
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xl-3">
            <div class="card widget-card-1">
                <div class="card-block-small">
                    <i class="icofont icofont-ui-lock bg-c-yellow card1-icon"></i>
                    <span class="text-c-yellow f-w-600">Private</span>
                    <h4>{{count($myFiles) - 0}}</h4>
                    <div>
                        <span class="f-left m-t-10 text-muted">
                            <i class="text-c-yellow f-16 ti-user m-r-10"></i>Restricted
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-md-12">
            <div class="card">
							<div class="row">
							<div class="col-md-6">
								<div class="card-header">
									<div class="btn-group float-left">


										<button type="button" class=" btn btn-warning btn-mini waves-effect waves-light" data-toggle="modal" data-target="#new_folder"><i class="ti-plus mr-2"></i>New Folder</button>



										<button type="button" class="btn btn-primary btn-mini waves-effect waves-light" data-toggle="modal" data-target="#new-file"><i class="ti-plus mr-2"></i>Upload File</button>

									</div>
								</div>



							</div>
							<div class="col-md-6">

								<div class="card-header">
									<form action="{{route('search')}}" method="post">


										@csrf
										<div class="form-group row">
											<div class="col-sm-3">
											</div>
											<div class="col-sm-6">
												<input type="text" name="name" class="form-control form-control-round" required placeholder="Search..">
											</div>

											<div class="col-sm-3">
											</div>


										</div>

										<div class="form-group row">
											<div class="col-sm-4">
											</div>
											<div class="col-sm-4">
												<button type="submit"  class="btn btn-primary btn-block btn-round waves-effect waves-light btn-mini"> Search</button>

											</div>
											<div class="col-sm-4">
											</div>



										</div>

									</form>

								</div>



							</div>
							</div>








                <div class="card-block">
                    <h5 class="sub-title">My Files</h5>
                    @if (session()->has('success'))
                        <div class="alert alert-success background-success">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <i class="icofont icofont-close-line-circled text-white"></i>
                            </button>
                            {!! session()->get('success') !!}
                        </div>
                    @endif
                    <div class="card-block " id="fileDirectory">
                        <div class="row">
                            @foreach ($myFiles as $file)
                                @switch(pathinfo($file->filename, PATHINFO_EXTENSION))
                                    @case('pptx')
                                    <div class="col-md-1">
                                        <a href="button" data-toggle="tooltip" data-placement="top" title="{{$file->name ?? 'No name'}}" data-original-title="{{$file->name ?? 'No name'}}" style="cursor: pointer;">
                                            <img src="/assets/formats/ppt.png" height="64" width="64" alt="{{$file->name ?? 'No name'}}"><br>
                                            {{strlen($file->name ?? 'No name') > 10 ? substr($file->name ?? 'No name',0,7).'...' : $file->name ?? 'No name'}}
                                        </a>
                                        <div class="dropdown-secondary dropdown float-right">
                                            <button class="btn btn-default btn-mini dropdown-toggle waves-light b-none txt-muted" type="button" id="dropdown6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icofont icofont-navigation-menu"></i></button>
                                            <div class="dropdown-menu" aria-labelledby="dropdown6" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 24px, 0px); top: 0px; left: 0px; will-change: transform;">


																							<a class="dropdown-item waves-light waves-effect" href="/assets/uploads/cnxdrive/{{$file->filename}}"><i class="ti-download text-success mr-2"></i> Download</a>


																								<a class="dropdown-item waves-light waves-effect shareFile" data-toggle="modal" data-target="#shareFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-sharethis text-warning mr-2"></i> Share</a>

																								<div class="dropdown-divider"></div>


                                                <a class="dropdown-item waves-light waves-effect deleteFile" data-toggle="modal" data-target="#deleteFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-trash mr-2 text-danger"></i> Delete</a>

                                            </div>
                                        </div>
                                    </div>

                                        @break
                                    @case('pdf')
                                    <div class="col-md-1 mb-4">
                                        <a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="{{$file->name ?? 'No name'}}" data-original-title="{{$file->name ?? 'No name'}}" style="cursor: pointer;">
                                            <img src="/assets/formats/pdf.png" height="64" width="64" alt="{{$file->name ?? 'No name'}}"> <br>
                                            {{strlen($file->name ?? 'No name') > 10 ? substr($file->name ?? 'No name',0,7).'...' : $file->name ?? 'No name'}}
                                        </a>
                                        <div class="dropdown-secondary dropdown float-right">
                                            <button class="btn btn-default btn-mini dropdown-toggle waves-light b-none txt-muted" type="button" id="dropdown6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icofont icofont-navigation-menu"></i></button>
                                            <div class="dropdown-menu" aria-labelledby="dropdown6" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 24px, 0px); top: 0px; left: 0px; will-change: transform;">


																							<a class="dropdown-item waves-light waves-effect" href="/assets/uploads/cnxdrive/{{$file->filename}}"><i class="ti-download text-success mr-2"></i> Download</a>


																								<a class="dropdown-item waves-light waves-effect shareFile" data-toggle="modal" data-target="#shareFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-sharethis text-warning mr-2"></i> Share</a>

                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item waves-light waves-effect deleteFile" data-toggle="modal" data-target="#deleteFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-trash mr-2 text-danger"></i> Delete</a>

                                            </div>
                                        </div>
                                    </div>
                                    @break

                                    @case('csv')
                                    <div class="col-md-1">
                                        <a href="button" style="cursor: pointer;"  data-toggle="tooltip" data-placement="top" title="{{$file->name ?? 'No name'}}" data-original-title="{{$file->name ?? 'No name'}}">
                                            <img src="/assets/formats/csv.png" height="64" width="64" alt="{{$file->name ?? 'No name'}}"><br>
                                            {{strlen($file->name ?? 'No name') > 10 ? substr($file->name ?? 'No name',0,7).'...' : $file->name ?? 'No name'}}
                                        </a>
                                        <div class="dropdown-secondary dropdown float-right">
                                            <button class="btn btn-default btn-mini dropdown-toggle waves-light b-none txt-muted" type="button" id="dropdown6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icofont icofont-navigation-menu"></i></button>
                                            <div class="dropdown-menu" aria-labelledby="dropdown6" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 24px, 0px); top: 0px; left: 0px; will-change: transform;">


																							<a class="dropdown-item waves-light waves-effect" href="/assets/uploads/cnxdrive/{{$file->filename}}"><i class="ti-download text-success mr-2"></i> Download</a>

																								<a class="dropdown-item waves-light waves-effect shareFile" data-toggle="modal" data-target="#shareFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-sharethis text-warning mr-2"></i> Share</a>

                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item waves-light waves-effect deleteFile" data-toggle="modal" data-target="#deleteFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-trash mr-2 text-danger"></i> Delete</a>

                                            </div>
                                        </div>
                                    </div>
                                    @break
                                    @case('xls')
                                    <div class="col-md-1">
                                        <a href="button" style="cursor: pointer;"  data-toggle="tooltip" data-placement="top" title="{{$file->name ?? 'No name'}}" data-original-title="{{$file->name ?? 'No name'}}">
                                            <img src="/assets/formats/xls.png" height="64" width="64" alt="{{$file->name ?? 'No name'}}"><br>
                                            {{strlen($file->name ?? 'No name') > 10 ? substr($file->name ?? 'No name',0,7).'...' : $file->name ?? 'No name'}}
                                        </a>
                                        <div class="dropdown-secondary dropdown float-right">
                                            <button class="btn btn-default btn-mini dropdown-toggle waves-light b-none txt-muted" type="button" id="dropdown6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icofont icofont-navigation-menu"></i></button>
                                            <div class="dropdown-menu" aria-labelledby="dropdown6" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 24px, 0px); top: 0px; left: 0px; will-change: transform;">


																							<a class="dropdown-item waves-light waves-effect" href="/assets/uploads/cnxdrive/{{$file->filename}}"><i class="ti-download text-success mr-2"></i> Download</a>

																								<a class="dropdown-item waves-light waves-effect shareFile" data-toggle="modal" data-target="#shareFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-sharethis text-warning mr-2"></i> Share</a>

                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item waves-light waves-effect deleteFile" data-toggle="modal" data-target="#deleteFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-trash mr-2 text-danger"></i> Delete</a>

                                            </div>
                                        </div>
                                    </div>
                                    @break
                                    @case('xlsx')
                                    <div class="col-md-1">
                                        <a href="button" style="cursor: pointer;"  data-toggle="tooltip" data-placement="top" title="{{$file->name ?? 'No name'}}" data-original-title="{{$file->name ?? 'No name'}}">
                                            <img src="/assets/formats/xls.png" height="64" width="64" alt="{{$file->name ?? 'No name'}}"><br>
                                            {{strlen($file->name ?? 'No name') > 10 ? substr($file->name ?? 'No name',0,7).'...' : $file->name ?? 'No name'}}
                                        </a>
                                        <div class="dropdown-secondary dropdown float-right">
                                            <button class="btn btn-default btn-mini dropdown-toggle waves-light b-none txt-muted" type="button" id="dropdown6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icofont icofont-navigation-menu"></i></button>
                                            <div class="dropdown-menu" aria-labelledby="dropdown6" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 24px, 0px); top: 0px; left: 0px; will-change: transform;">


																							<a class="dropdown-item waves-light waves-effect" href="/assets/uploads/cnxdrive/{{$file->filename}}"><i class="ti-download text-success mr-2"></i> Download</a>

																								<a class="dropdown-item waves-light waves-effect shareFile" data-toggle="modal" data-target="#shareFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-sharethis text-warning mr-2"></i> Share</a>


                                                <div class="dropdown-divider"></div>
                                                <a class="dropdown-item waves-light waves-effect deleteFile" data-toggle="modal" data-target="#deleteFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-trash mr-2 text-danger"></i> Delete</a>

                                            </div>
                                        </div>
                                    </div>
                                    @break
                                    @case('doc')
                                    <div class="col-md-1">
                                        <a href="button" style="cursor: pointer;"  data-toggle="tooltip" data-placement="top" title="{{$file->name ?? 'No name'}}" data-original-title="{{$file->name ?? 'No name'}}">
                                            <img src="/assets/formats/doc.png" height="64" width="64" alt="{{$file->name ?? 'No name'}}"><br>
                                            {{strlen($file->name ?? 'No name') > 10 ? substr($file->name ?? 'No name',0,7).'...' : $file->name ?? 'No name'}}
                                        </a>
                                        <div class="dropdown-secondary dropdown float-right">
                                            <button class="btn btn-default btn-mini dropdown-toggle waves-light b-none txt-muted" type="button" id="dropdown6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icofont icofont-navigation-menu"></i></button>
                                            <div class="dropdown-menu" aria-labelledby="dropdown6" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 24px, 0px); top: 0px; left: 0px; will-change: transform;">
                                                @if (file_exists(public_path("/assets/uploads/cnxdrive/".$file->filename)))


																								<a class="dropdown-item waves-light waves-effect" href="/assets/uploads/cnxdrive/{{$file->filename}}"><i class="ti-download text-success mr-2"></i> Download</a>

																								@endif


                                                <a class="dropdown-item waves-light waves-effect shareFile" data-toggle="modal" data-target="#shareFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-sharethis text-warning mr-2"></i> Share</a>

																								<div class="dropdown-divider"></div>

                                                <a class="dropdown-item waves-light waves-effect deleteFile" data-toggle="modal" data-target="#deleteFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-trash mr-2 text-danger"></i> Delete</a>

                                            </div>
                                        </div>
                                    </div>
                                    @break
                                    @case('docx')
                                    <div class="col-md-1">
                                        <a href="button" style="cursor: pointer;" data-toggle="tooltip" data-placement="top" title="{{$file->name ?? 'No name'}}" data-original-title="{{$file->name ?? 'No name'}}">
                                            <img src="/assets/formats/doc.png" height="64" width="64" alt="{{$file->name ?? 'No name'}}"><br>
                                            {{strlen($file->name ?? 'No name') > 10 ? substr($file->name ?? 'No name',0,7).'...' : $file->name ?? 'No name'}}
                                        </a>
                                        <div class="dropdown-secondary dropdown float-right">
                                            <button class="btn btn-default btn-mini dropdown-toggle waves-light b-none txt-muted" type="button" id="dropdown6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icofont icofont-navigation-menu"></i></button>
                                            <div class="dropdown-menu" aria-labelledby="dropdown6" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 24px, 0px); top: 0px; left: 0px; will-change: transform;">


																							<a class="dropdown-item waves-light waves-effect" href="/assets/uploads/cnxdrive/{{$file->filename}}"><i class="ti-download text-success mr-2"></i> Download</a>


																								<a class="dropdown-item waves-light waves-effect shareFile" data-toggle="modal" data-target="#shareFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-sharethis text-warning mr-2"></i> Share</a>

																								<div class="dropdown-divider"></div>

                                                <a class="dropdown-item waves-light waves-effect deleteFile" data-toggle="modal" data-target="#deleteFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-trash mr-2 text-danger"></i> Delete</a>

                                            </div>
                                        </div>
                                    </div>
                                    @break
                                    @case('jpeg')
                                    <div class="col-md-1">
                                        <a href="button" style="cursor: pointer;"  data-toggle="tooltip" data-placement="top" title="{{$file->name ?? 'No name'}}" data-original-title="{{$file->name ?? 'No name'}}">
                                            <img src="/assets/formats/jpeg.png" height="64" width="64" alt="{{$file->name ?? 'No name'}}"><br>
                                            {{strlen($file->name ?? 'No name') > 10 ? substr($file->name ?? 'No name',0,7).'...' : $file->name ?? 'No name'}}
                                        </a>
                                        <div class="dropdown-secondary dropdown float-right">
                                            <button class="btn btn-default btn-mini dropdown-toggle waves-light b-none txt-muted" type="button" id="dropdown6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icofont icofont-navigation-menu"></i></button>
                                            <div class="dropdown-menu" aria-labelledby="dropdown6" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 24px, 0px); top: 0px; left: 0px; will-change: transform;">


																							<a class="dropdown-item waves-light waves-effect" href="/assets/uploads/cnxdrive/{{$file->filename}}"><i class="ti-download text-success mr-2"></i> Download</a>


																								<a class="dropdown-item waves-light waves-effect shareFile" data-toggle="modal" data-target="#shareFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-sharethis text-warning mr-2"></i> Share</a>



                                                <div class="dropdown-divider"></div>

																								<a class="dropdown-item waves-light waves-effect deleteFile" data-toggle="modal" data-target="#deleteFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-trash mr-2 text-danger"></i> Delete</a>

                                            </div>
                                        </div>
                                    </div>
                                    @break
                                    @case('jpg')
                                        <div class="col-md-1">
                                            <a href="button" style="cursor: pointer;"  data-toggle="tooltip" data-placement="top" title="{{$file->name ?? 'No name'}}" data-original-title="{{$file->name ?? 'No name'}}">
                                                <img src="/assets/formats/jpg.png" height="64" width="64" alt="{{$file->name ?? 'No name'}}"><br>
                                                {{strlen($file->name ?? 'No name') > 10 ? substr($file->name ?? 'No name',0,7).'...' : $file->name ?? 'No name'}}
                                            </a>
                                            <div class="dropdown-secondary dropdown float-right">
                                                <button class="btn btn-default btn-mini dropdown-toggle waves-light b-none txt-muted" type="button" id="dropdown6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icofont icofont-navigation-menu"></i></button>
                                                <div class="dropdown-menu" aria-labelledby="dropdown6" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 24px, 0px); top: 0px; left: 0px; will-change: transform;">


																									<a class="dropdown-item waves-light waves-effect" href="/assets/uploads/cnxdrive/{{$file->filename}}"><i class="ti-download text-success mr-2"></i> Download</a>


																										<a class="dropdown-item waves-light waves-effect shareFile" data-toggle="modal" data-target="#shareFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-sharethis text-warning mr-2"></i> Share</a>

																										<div class="dropdown-divider"></div>

                                                    <a class="dropdown-item waves-light waves-effect deleteFile" data-toggle="modal" data-target="#deleteFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-trash mr-2 text-danger"></i> Delete</a>

                                                </div>
                                            </div>
                                        </div>
                                    @break
                                    @case('png')
                                    <div class="col-md-1">
                                        <a href="button" style="cursor: pointer;"  data-toggle="tooltip" data-placement="top" title="{{$file->name ?? 'No name'}}" data-original-title="{{$file->name ?? 'No name'}}">
                                            <img src="/assets/formats/png.png" height="64" width="64" alt="{{$file->name ?? 'No name'}}"><br>
                                            {{strlen($file->name ?? 'No name') > 10 ? substr($file->name ?? 'No name',0,7).'...' : $file->name ?? 'No name'}}
                                        </a>
                                        <div class="dropdown-secondary dropdown float-right">
                                            <button class="btn btn-default btn-mini dropdown-toggle waves-light b-none txt-muted" type="button" id="dropdown6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icofont icofont-navigation-menu"></i></button>
                                            <div class="dropdown-menu" aria-labelledby="dropdown6" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 24px, 0px); top: 0px; left: 0px; will-change: transform;">


																							<a class="dropdown-item waves-light waves-effect" href="/assets/uploads/cnxdrive/{{$file->filename}}"><i class="ti-download text-success mr-2"></i> Download</a>


																								<a class="dropdown-item waves-light waves-effect shareFile" data-toggle="modal" data-target="#shareFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-sharethis text-warning mr-2"></i> Share</a>

																								<div class="dropdown-divider"></div>

                                                <a class="dropdown-item waves-light waves-effect deleteFile" data-toggle="modal" data-target="#deleteFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-trash mr-2 text-danger"></i> Delete</a>

                                            </div>
                                        </div>
                                    </div>
                                    @break
                                    @case('gif')
                                    <div class="col-md-1">
                                        <a href="button" style="cursor: pointer;" data-toggle="tooltip" data-placement="top" title="{{$file->name ?? 'No name'}}" data-original-title="{{$file->name ?? 'No name'}}">
                                            <img src="/assets/formats/gif.png" height="64" width="64" alt="{{$file->name ?? 'No name'}}"><br>
                                            {{strlen($file->name ?? 'No name') > 10 ? substr($file->name ?? 'No name',0,7).'...' : $file->name ?? 'No name'}}
                                        </a>
                                        <div class="dropdown-secondary dropdown float-right">
                                            <button class="btn btn-default btn-mini dropdown-toggle waves-light b-none txt-muted" type="button" id="dropdown6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icofont icofont-navigation-menu"></i></button>
                                            <div class="dropdown-menu" aria-labelledby="dropdown6" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 24px, 0px); top: 0px; left: 0px; will-change: transform;">


																							<a class="dropdown-item waves-light waves-effect" href="/assets/uploads/cnxdrive/{{$file->filename}}"><i class="ti-download text-success mr-2"></i> Download</a>


																								<a class="dropdown-item waves-light waves-effect shareFile" data-toggle="modal" data-target="#shareFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-sharethis text-warning mr-2"></i> Share</a>

																								<div class="dropdown-divider"></div>

                                                <a class="dropdown-item waves-light waves-effect deleteFile" data-toggle="modal" data-target="#deleteFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-trash mr-2 text-danger"></i> Delete</a>

                                            </div>
                                        </div>
                                    </div>
                                    @break
                                    @case('ppt')
                                    <div class="col-md-1">
                                        <a href="button" style="cursor: pointer;" data-toggle="tooltip" data-placement="top" title="{{$file->name ?? 'No name'}}" data-original-title="{{$file->name ?? 'No name'}}">
                                            <img src="/assets/formats/ppt.png" height="64" width="64" alt="{{$file->name ?? 'No name'}}"><br>
                                            {{strlen($file->name ?? 'No name') > 10 ? substr($file->name ?? 'No name',0,7).'...' : $file->name ?? 'No name'}}
                                        </a>
                                        <div class="dropdown-secondary dropdown float-right">
                                            <button class="btn btn-default btn-mini dropdown-toggle waves-light b-none txt-muted" type="button" id="dropdown6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icofont icofont-navigation-menu"></i></button>
                                            <div class="dropdown-menu" aria-labelledby="dropdown6" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 24px, 0px); top: 0px; left: 0px; will-change: transform;">


																							<a class="dropdown-item waves-light waves-effect" href="/assets/uploads/cnxdrive/{{$file->filename}}"><i class="ti-download text-success mr-2"></i> Download</a>

																								<a class="dropdown-item waves-light waves-effect shareFile" data-toggle="modal" data-target="#shareFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-sharethis text-warning mr-2"></i> Share</a>

																								<div class="dropdown-divider"></div>

                                                <a class="dropdown-item waves-light waves-effect deleteFile" data-toggle="modal" data-target="#deleteFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-trash mr-2 text-danger"></i> Delete</a>

                                            </div>
                                        </div>
                                    </div>
                                    @break
                                    @case('txt')
                                    <div class="col-md-1">
                                        <a href="button" style="cursor: pointer;" data-toggle="tooltip" data-placement="top" title="{{$file->name ?? 'No name'}}" data-original-title="{{$file->name ?? 'No name'}}">
                                            <img src="/assets/formats/txt.png" height="64" width="64" alt="{{$file->name ?? 'No name'}}"><br>
                                            {{strlen($file->name ?? 'No name') > 10 ? substr($file->name ?? 'No name',0,7).'...' : $file->name ?? 'No name'}}
                                        </a>
                                        <div class="dropdown-secondary dropdown float-right">
                                            <button class="btn btn-default btn-mini dropdown-toggle waves-light b-none txt-muted" type="button" id="dropdown6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icofont icofont-navigation-menu"></i></button>
                                            <div class="dropdown-menu" aria-labelledby="dropdown6" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 24px, 0px); top: 0px; left: 0px; will-change: transform;">


																							<a class="dropdown-item waves-light waves-effect" href="/assets/uploads/cnxdrive/{{$file->filename}}"><i class="ti-download text-success mr-2"></i> Download</a>


																								<a class="dropdown-item waves-light waves-effect shareFile" data-toggle="modal" data-target="#shareFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-sharethis text-warning mr-2"></i> Share</a>

																								<div class="dropdown-divider"></div>

                                                <a class="dropdown-item waves-light waves-effect deleteFile" data-toggle="modal" data-target="#deleteFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-trash mr-2 text-danger"></i> Delete</a>

                                            </div>
                                        </div>
                                    </div>
                                    @break
                                    @case('css')
                                    <div class="col-md-1">
                                        <a href="button" style="cursor: pointer;" data-toggle="tooltip" data-placement="top" title="{{$file->name ?? 'No name'}}" data-original-title="{{$file->name ?? 'No name'}}">
                                            <img src="/assets/formats/css.png" height="64" width="64" alt="{{$file->name ?? 'No name'}}"> <br>
                                            {{strlen($file->name ?? 'No name') > 10 ? substr($file->name ?? 'No name',0,7).'...' : $file->name ?? 'No name'}}
                                        </a>
                                        <div class="dropdown-secondary dropdown float-right">
                                            <button class="btn btn-default btn-mini dropdown-toggle waves-light b-none txt-muted" type="button" id="dropdown6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icofont icofont-navigation-menu"></i></button>
                                            <div class="dropdown-menu" aria-labelledby="dropdown6" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 24px, 0px); top: 0px; left: 0px; will-change: transform;">


																							<a class="dropdown-item waves-light waves-effect" href="/assets/uploads/cnxdrive/{{$file->filename}}"><i class="ti-download text-success mr-2"></i> Download</a>

																								<a class="dropdown-item waves-light waves-effect shareFile" data-toggle="modal" data-target="#shareFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-sharethis text-warning mr-2"></i> Share</a>

																								<div class="dropdown-divider"></div>

                                                <a class="dropdown-item waves-light waves-effect deleteFile" data-toggle="modal" data-target="#deleteFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-trash mr-2 text-danger"></i> Delete</a>

                                            </div>
                                        </div>
                                    </div>
                                    @break
                                    @case('mp3')
                                    <div class="col-md-1">
                                        <a href="button" style="cursor: pointer;" data-toggle="tooltip" data-placement="top" title="{{$file->name ?? 'No name'}}" data-original-title="{{$file->name ?? 'No name'}}">
                                            <img src="/assets/formats/mp3.png" height="64" width="64" alt=""><br>
                                            {{strlen($file->name ?? 'No name') > 10 ? substr($file->name ?? 'No name',0,7).'...' : $file->name ?? 'No name'}}
                                        </a>
                                        <div class="dropdown-secondary dropdown float-right">
                                            <button class="btn btn-default btn-mini dropdown-toggle waves-light b-none txt-muted" type="button" id="dropdown6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icofont icofont-navigation-menu"></i></button>
                                            <div class="dropdown-menu" aria-labelledby="dropdown6" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 24px, 0px); top: 0px; left: 0px; will-change: transform;">


																							<a class="dropdown-item waves-light waves-effect" href="/assets/uploads/cnxdrive/{{$file->filename}}"><i class="ti-download text-success mr-2"></i> Download</a>


																								<a class="dropdown-item waves-light waves-effect shareFile" data-toggle="modal" data-target="#shareFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-sharethis text-warning mr-2"></i> Share</a>

																								<div class="dropdown-divider"></div>

                                                <a class="dropdown-item waves-light waves-effect deleteFile" data-toggle="modal" data-target="#deleteFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-trash mr-2 text-danger"></i> Delete</a>

                                            </div>
                                        </div>
                                    </div>
                                    @break
                                    @case('mp4')
                                    <div class="col-md-1">
                                        <a href="button" style="cursor: pointer;" data-toggle="tooltip" data-placement="top" title="{{$file->name ?? 'No name'}}" data-original-title="{{$file->name ?? 'No name'}}">
                                            <img src="/assets/formats/mp4.png" height="64" width="64" alt="{{$file->name ?? 'No name'}}"><br>
                                            {{strlen($file->name ?? 'No name') > 10 ? substr($file->name ?? 'No name',0,7).'...' : $file->name ?? 'No name'}}
                                        </a>
                                        <div class="dropdown-secondary dropdown float-right">
                                            <button class="btn btn-default btn-mini dropdown-toggle waves-light b-none txt-muted" type="button" id="dropdown6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icofont icofont-navigation-menu"></i></button>
                                            <div class="dropdown-menu" aria-labelledby="dropdown6" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 24px, 0px); top: 0px; left: 0px; will-change: transform;">


																								<a class="dropdown-item waves-light waves-effect" href="/assets/uploads/cnxdrive/{{$file->filename}}"><i class="ti-download text-success mr-2"></i> Download</a>


																								<a class="dropdown-item waves-light waves-effect shareFile" data-toggle="modal" data-target="#shareFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-sharethis text-warning mr-2"></i> Share</a>

																								<div class="dropdown-divider"></div>


                                                <a class="dropdown-item waves-light waves-effect deleteFile" data-toggle="modal" data-target="#deleteFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-trash mr-2 text-danger"></i> Delete</a>

                                            </div>
                                        </div>
                                    </div>
                                    @break
                                    @case('svg')
                                    <div class="col-md-1">
                                        <a href="button" style="cursor: pointer;" data-toggle="tooltip" data-placement="top" title="{{$file->name ?? 'No name'}}" data-original-title="{{$file->name ?? 'No name'}}">
                                            <img src="/assets/formats/svg.png" height="64" width="64" alt="{{$file->name ?? 'No name'}}"><br>
                                            {{strlen($file->name ?? 'No name') > 10 ? substr($file->name ?? 'No name',0,7).'...' : $file->name ?? 'No name'}}
                                        </a>
                                        <div class="dropdown-secondary dropdown float-right">
                                            <button class="btn btn-default btn-mini dropdown-toggle waves-light b-none txt-muted" type="button" id="dropdown6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icofont icofont-navigation-menu"></i></button>
                                            <div class="dropdown-menu" aria-labelledby="dropdown6" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 24px, 0px); top: 0px; left: 0px; will-change: transform;">


																							<a class="dropdown-item waves-light waves-effect" href="/assets/uploads/cnxdrive/{{$file->filename}}"><i class="ti-download text-success mr-2"></i> Download</a>


																							<a class="dropdown-item waves-light waves-effect shareFile" data-toggle="modal" data-target="#shareFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-sharethis text-warning mr-2"></i> Share</a>


                                                <div class="dropdown-divider"></div>


																							<a class="dropdown-item waves-light waves-effect deleteFile" data-toggle="modal" data-target="#deleteFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-trash mr-2 text-danger"></i> Delete</a>

                                            </div>
                                        </div>
                                    </div>
                                    @break
                                    @case('xml')
                                    <div class="col-md-1">
                                        <a href="button" style="cursor: pointer;" data-toggle="tooltip" data-placement="top" title="{{$file->name ?? 'No name'}}" data-original-title="{{$file->name ?? 'No name'}}">
                                            <img src="/assets/formats/xml.png" height="64" width="64" alt="{{$file->name ?? 'No name'}}"><br>
                                            {{strlen($file->name ?? 'No name') > 10 ? substr($file->name ?? 'No name',0,7).'...' : $file->name ?? 'No name'}}
                                        </a>
                                        <div class="dropdown-secondary dropdown float-right">
                                            <button class="btn btn-default btn-mini dropdown-toggle waves-light b-none txt-muted" type="button" id="dropdown6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icofont icofont-navigation-menu"></i></button>
                                            <div class="dropdown-menu" aria-labelledby="dropdown6" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 24px, 0px); top: 0px; left: 0px; will-change: transform;">


																							<a class="dropdown-item waves-light waves-effect" href="/assets/uploads/cnxdrive/{{$file->filename}}"><i class="ti-download text-success mr-2"></i> Download</a>


																							<a class="dropdown-item waves-light waves-effect shareFile" data-toggle="modal" data-target="#shareFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-sharethis text-warning mr-2"></i> Share</a>

																								<div class="dropdown-divider"></div>


                                                <a class="dropdown-item waves-light waves-effect deleteFile" data-toggle="modal" data-target="#deleteFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-trash mr-2 text-danger"></i> Delete</a>

                                            </div>
                                        </div>
                                    </div>
                                    @break
                                    @case('zip')
                                    <div class="col-md-1">
                                        <a href="button" style="cursor: pointer;" data-toggle="tooltip" data-placement="top" title="{{$file->name ?? 'No name'}}" data-original-title="{{$file->name ?? 'No name'}}">
                                            <img src="/assets/formats/zip.png" height="64" width="64" alt="{{$file->name ?? 'No name'}}"><br>
                                            {{strlen($file->name ?? 'No name') > 10 ? substr($file->name ?? 'No name',0,7).'...' : $file->name ?? 'No name'}}
                                        </a>
                                        <div class="dropdown-secondary dropdown float-right">
                                            <button class="btn btn-default btn-mini dropdown-toggle waves-light b-none txt-muted" type="button" id="dropdown6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icofont icofont-navigation-menu"></i></button>
                                            <div class="dropdown-menu" aria-labelledby="dropdown6" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 24px, 0px); top: 0px; left: 0px; will-change: transform;">


																							<a class="dropdown-item waves-light waves-effect" href="/assets/uploads/cnxdrive/{{$file->filename}}"><i class="ti-download text-success mr-2"></i> Download</a>


																							<a class="dropdown-item waves-light waves-effect shareFile" data-toggle="modal" data-target="#shareFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-sharethis text-warning mr-2"></i> Share</a>

																								<div class="dropdown-divider"></div>


                                                <a class="dropdown-item waves-light waves-effect deleteFile" data-toggle="modal" data-target="#deleteFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-trash mr-2 text-danger"></i> Delete</a>

                                            </div>
                                        </div>
                                    </div>
                                    @break
                                @endswitch
                            @endforeach
                        </div>
                    </div>
                </div>
							<div class="card-block">
								<h5 class="sub-title">My Folders</h5>
								@if (session()->has('success'))
									<div class="alert alert-success background-success">
										<button type="button" class="close" data-dismiss="alert" aria-label="Close">
											<i class="icofont icofont-close-line-circled text-white"></i>
										</button>
										{!! session()->get('success') !!}
									</div>
								@endif
								<div class="card-block " id="fileDirectory">
									<div class="row">
										@foreach ($myFolders as $folder)
											<div class="col-md-1">
												<a href="{{route('folder', $folder->id)}}" title="{{$folder->name ?? 'No name'}}" data-original-title="{{$folder->name ?? 'No name'}}" style="cursor: pointer;">
													<img src="/assets/formats/folder.png" height="64" width="64" alt="{{$folder->name ?? 'No name'}}"><br>
													{{strlen($folder->name ?? 'No name') > 10 ? substr($folder->name ?? 'No name',0,7).'...' : $folder->name ?? 'No name'}}
												</a>
												<div class="dropdown-secondary dropdown float-right">
													<button class="btn btn-default btn-mini dropdown-toggle waves-light b-none txt-muted" type="button" id="dropdown6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icofont icofont-navigation-menu"></i></button>
													<div class="dropdown-menu" aria-labelledby="dropdown6" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 24px, 0px); top: 0px; left: 0px; will-change: transform;">

														<a class="dropdown-item waves-light waves-effect shareFolder" data-toggle="modal" data-target="#shareFolderModal" data-directory="{{$folder->name}}" data-file="{{$folder->name ?? 'Folder name'}}" data-unique="{{$folder->id}}" href="javascript:void(0);"><i class="ti-sharethis text-warning mr-2"></i> Share</a>
														<div class="dropdown-divider"></div>
														<a class="dropdown-item waves-light waves-effect deleteFolder" data-toggle="modal" data-target="#deleteFolderModal" data-directory="{{$folder->name}}" data-file="{{$folder->name ?? 'File name'}}" data-unique="{{$folder->id}}" href="javascript:void(0);"><i class="ti-trash mr-2 text-danger"></i> Delete</a>
													</div>
												</div>
											</div>
										@endforeach
									</div>
								</div>
							</div>
                <div class="card-block">
                    <h5 class="sub-title">Shared Items/Public Items</h5>

                    @if (session()->has('success'))
                        <div class="alert alert-success background-success">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <i class="icofont icofont-close-line-circled text-white"></i>
                            </button>
                            {!! session()->get('success') !!}
                        </div>
                    @endif
                    <div class="card-block " id="fileDirectory">
                        <div class="row">
                            @foreach ($sharedFiles as $share)
                                @foreach ($share->originalFile as $file)
                                    @switch(pathinfo($file->filename, PATHINFO_EXTENSION))
                                        @case('pptx')
                                        <div class="col-md-1">
                                            <a href="button" data-toggle="tooltip" data-placement="top" title="{{$file->name ?? 'No name'}}" data-original-title="{{$file->name ?? 'No name'}}" style="cursor: pointer;">
                                                <img src="/assets/formats/ppt.png" height="64" width="64" alt="{{$file->name ?? 'No name'}}"><br>
                                                {{strlen($file->name ?? 'No name') > 10 ? substr($file->name ?? 'No name',0,7).'...' : $file->name ?? 'No name'}}
                                            </a>
                                            <div class="dropdown-secondary dropdown float-right">
                                                <button class="btn btn-default btn-mini dropdown-toggle waves-light b-none txt-muted" type="button" id="dropdown6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icofont icofont-navigation-menu"></i></button>
                                                <div class="dropdown-menu" aria-labelledby="dropdown6" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 24px, 0px); top: 0px; left: 0px; will-change: transform;">


																									<a class="dropdown-item waves-light waves-effect" href="/assets/uploads/cnxdrive/{{$file->filename}}"><i class="ti-download text-success mr-2"></i> Download</a>


																									<a class="dropdown-item waves-light waves-effect shareFile" data-toggle="modal" data-target="#shareFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-sharethis text-warning mr-2"></i> Share</a>

																										<div class="dropdown-divider"></div>


                                                    <a class="dropdown-item waves-light waves-effect deleteFile" data-toggle="modal" data-target="#deleteFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-trash mr-2 text-danger"></i> Delete</a>

                                                </div>
                                            </div>
                                        </div>

                                            @break
                                        @case('pdf')
                                        <div class="col-md-1 mb-4">
                                            <a href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="{{$file->name ?? 'No name'}}" data-original-title="{{$file->name ?? 'No name'}}" style="cursor: pointer;">
                                                <img src="/assets/formats/pdf.png" height="64" width="64" alt="{{$file->name ?? 'No name'}}"> <br>
                                                {{strlen($file->name ?? 'No name') > 10 ? substr($file->name ?? 'No name',0,7).'...' : $file->name ?? 'No name'}}
                                            </a>
                                            <div class="dropdown-secondary dropdown float-right">
                                                <button class="btn btn-default btn-mini dropdown-toggle waves-light b-none txt-muted" type="button" id="dropdown6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icofont icofont-navigation-menu"></i></button>
                                                <div class="dropdown-menu" aria-labelledby="dropdown6" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 24px, 0px); top: 0px; left: 0px; will-change: transform;">


																									<a class="dropdown-item waves-light waves-effect" href="/assets/uploads/cnxdrive/{{$file->filename}}"><i class="ti-download text-success mr-2"></i> Download</a>


																									<a class="dropdown-item waves-light waves-effect shareFile" data-toggle="modal" data-target="#shareFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-sharethis text-warning mr-2"></i> Share</a>

																										<div class="dropdown-divider"></div>


                                                    <a class="dropdown-item waves-light waves-effect deleteFile" data-toggle="modal" data-target="#deleteFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-trash mr-2 text-danger"></i> Delete</a>

                                                </div>
                                            </div>
                                        </div>
                                        @break

                                        @case('csv')
                                        <div class="col-md-1">
                                            <a href="button" style="cursor: pointer;"  data-toggle="tooltip" data-placement="top" title="{{$file->name ?? 'No name'}}" data-original-title="{{$file->name ?? 'No name'}}">
                                                <img src="/assets/formats/csv.png" height="64" width="64" alt="{{$file->name ?? 'No name'}}"><br>
                                                {{strlen($file->name ?? 'No name') > 10 ? substr($file->name ?? 'No name',0,7).'...' : $file->name ?? 'No name'}}
                                            </a>
                                            <div class="dropdown-secondary dropdown float-right">
                                                <button class="btn btn-default btn-mini dropdown-toggle waves-light b-none txt-muted" type="button" id="dropdown6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icofont icofont-navigation-menu"></i></button>
                                                <div class="dropdown-menu" aria-labelledby="dropdown6" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 24px, 0px); top: 0px; left: 0px; will-change: transform;">


																									<a class="dropdown-item waves-light waves-effect" href="/assets/uploads/cnxdrive/{{$file->filename}}"><i class="ti-download text-success mr-2"></i> Download</a>


																									<a class="dropdown-item waves-light waves-effect shareFile" data-toggle="modal" data-target="#shareFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-sharethis text-warning mr-2"></i> Share</a>

																										<div class="dropdown-divider"></div>


                                                    <a class="dropdown-item waves-light waves-effect deleteFile" data-toggle="modal" data-target="#deleteFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-trash mr-2 text-danger"></i> Delete</a>

                                                </div>
                                            </div>
                                        </div>
                                        @break
                                        @case('xls')
                                        <div class="col-md-1">
                                            <a href="button" style="cursor: pointer;"  data-toggle="tooltip" data-placement="top" title="{{$file->name ?? 'No name'}}" data-original-title="{{$file->name ?? 'No name'}}">
                                                <img src="/assets/formats/xls.png" height="64" width="64" alt="{{$file->name ?? 'No name'}}"><br>
                                                {{strlen($file->name ?? 'No name') > 10 ? substr($file->name ?? 'No name',0,7).'...' : $file->name ?? 'No name'}}
                                            </a>
                                            <div class="dropdown-secondary dropdown float-right">
                                                <button class="btn btn-default btn-mini dropdown-toggle waves-light b-none txt-muted" type="button" id="dropdown6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icofont icofont-navigation-menu"></i></button>
                                                <div class="dropdown-menu" aria-labelledby="dropdown6" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 24px, 0px); top: 0px; left: 0px; will-change: transform;">


																									<a class="dropdown-item waves-light waves-effect" href="/assets/uploads/cnxdrive/{{$file->filename}}"><i class="ti-download text-success mr-2"></i> Download</a>


																									<a class="dropdown-item waves-light waves-effect shareFile" data-toggle="modal" data-target="#shareFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-sharethis text-warning mr-2"></i> Share</a>

																										<div class="dropdown-divider"></div>


                                                    <a class="dropdown-item waves-light waves-effect deleteFile" data-toggle="modal" data-target="#deleteFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-trash mr-2 text-danger"></i> Delete</a>

                                                </div>
                                            </div>
                                        </div>
                                        @break
                                        @case('xlsx')
                                        <div class="col-md-1">
                                            <a href="button" style="cursor: pointer;"  data-toggle="tooltip" data-placement="top" title="{{$file->name ?? 'No name'}}" data-original-title="{{$file->name ?? 'No name'}}">
                                                <img src="/assets/formats/xls.png" height="64" width="64" alt="{{$file->name ?? 'No name'}}"><br>
                                                {{strlen($file->name ?? 'No name') > 10 ? substr($file->name ?? 'No name',0,7).'...' : $file->name ?? 'No name'}}
                                            </a>
                                            <div class="dropdown-secondary dropdown float-right">
                                                <button class="btn btn-default btn-mini dropdown-toggle waves-light b-none txt-muted" type="button" id="dropdown6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icofont icofont-navigation-menu"></i></button>
                                                <div class="dropdown-menu" aria-labelledby="dropdown6" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 24px, 0px); top: 0px; left: 0px; will-change: transform;">


																									<a class="dropdown-item waves-light waves-effect" href="/assets/uploads/cnxdrive/{{$file->filename}}"><i class="ti-download text-success mr-2"></i> Download</a>


																									<a class="dropdown-item waves-light waves-effect shareFile" data-toggle="modal" data-target="#shareFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-sharethis text-warning mr-2"></i> Share</a>

																										<div class="dropdown-divider"></div>


                                                    <a class="dropdown-item waves-light waves-effect deleteFile" data-toggle="modal" data-target="#deleteFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-trash mr-2 text-danger"></i> Delete</a>

                                                </div>
                                            </div>
                                        </div>
                                        @break
                                        @case('doc')
                                        <div class="col-md-1">
                                            <a href="button" style="cursor: pointer;"  data-toggle="tooltip" data-placement="top" title="{{$file->name ?? 'No name'}}" data-original-title="{{$file->name ?? 'No name'}}">
                                                <img src="/assets/formats/doc.png" height="64" width="64" alt="{{$file->name ?? 'No name'}}"><br>
                                                {{strlen($file->name ?? 'No name') > 10 ? substr($file->name ?? 'No name',0,7).'...' : $file->name ?? 'No name'}}
                                            </a>
                                            <div class="dropdown-secondary dropdown float-right">
                                                <button class="btn btn-default btn-mini dropdown-toggle waves-light b-none txt-muted" type="button" id="dropdown6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icofont icofont-navigation-menu"></i></button>
                                                <div class="dropdown-menu" aria-labelledby="dropdown6" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 24px, 0px); top: 0px; left: 0px; will-change: transform;">


																									<a class="dropdown-item waves-light waves-effect" href="/assets/uploads/cnxdrive/{{$file->filename}}"><i class="ti-download text-success mr-2"></i> Download</a>


																									<a class="dropdown-item waves-light waves-effect shareFile" data-toggle="modal" data-target="#shareFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-sharethis text-warning mr-2"></i> Share</a>

																										<div class="dropdown-divider"></div>


                                                    <a class="dropdown-item waves-light waves-effect deleteFile" data-toggle="modal" data-target="#deleteFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-trash mr-2 text-danger"></i> Delete</a>

                                                </div>
                                            </div>
                                        </div>
                                        @break
                                        @case('doc')
                                        <div class="col-md-1">
                                            <a href="button" style="cursor: pointer;" data-toggle="tooltip" data-placement="top" title="{{$file->name ?? 'No name'}}" data-original-title="{{$file->name ?? 'No name'}}">
                                                <img src="/assets/formats/doc.png" height="64" width="64" alt="{{$file->name ?? 'No name'}}"><br>
                                                {{strlen($file->name ?? 'No name') > 10 ? substr($file->name ?? 'No name',0,7).'...' : $file->name ?? 'No name'}}
                                            </a>
                                            <div class="dropdown-secondary dropdown float-right">
                                                <button class="btn btn-default btn-mini dropdown-toggle waves-light b-none txt-muted" type="button" id="dropdown6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icofont icofont-navigation-menu"></i></button>
                                                <div class="dropdown-menu" aria-labelledby="dropdown6" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 24px, 0px); top: 0px; left: 0px; will-change: transform;">


																									<a class="dropdown-item waves-light waves-effect" href="/assets/uploads/cnxdrive/{{$file->filename}}"><i class="ti-download text-success mr-2"></i> Download</a>


																									<a class="dropdown-item waves-light waves-effect shareFile" data-toggle="modal" data-target="#shareFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-sharethis text-warning mr-2"></i> Share</a>

																										<div class="dropdown-divider"></div>


                                                    <a class="dropdown-item waves-light waves-effect deleteFile" data-toggle="modal" data-target="#deleteFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-trash mr-2 text-danger"></i> Delete</a>

                                                </div>
                                            </div>
                                        </div>
                                        @break
                                        @case('docx')
                                        <div class="col-md-1">
                                            <a href="button" style="cursor: pointer;" data-toggle="tooltip" data-placement="top" title="{{$file->name ?? 'No name'}}" data-original-title="{{$file->name ?? 'No name'}}">
                                                <img src="/assets/formats/doc.png" height="64" width="64" alt="{{$file->name ?? 'No name'}}"><br>
                                                {{strlen($file->name ?? 'No name') > 10 ? substr($file->name ?? 'No name',0,7).'...' : $file->name ?? 'No name'}}
                                            </a>
                                            <div class="dropdown-secondary dropdown float-right">
                                                <button class="btn btn-default btn-mini dropdown-toggle waves-light b-none txt-muted" type="button" id="dropdown6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icofont icofont-navigation-menu"></i></button>
                                                <div class="dropdown-menu" aria-labelledby="dropdown6" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 24px, 0px); top: 0px; left: 0px; will-change: transform;">


																									<a class="dropdown-item waves-light waves-effect" href="/assets/uploads/cnxdrive/{{$file->filename}}"><i class="ti-download text-success mr-2"></i> Download</a>


																									<a class="dropdown-item waves-light waves-effect shareFile" data-toggle="modal" data-target="#shareFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-sharethis text-warning mr-2"></i> Share</a>

																										<div class="dropdown-divider"></div>


                                                    <a class="dropdown-item waves-light waves-effect deleteFile" data-toggle="modal" data-target="#deleteFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-trash mr-2 text-danger"></i> Delete</a>

                                                </div>
                                            </div>
                                        </div>
                                        @break
                                        @case('jpeg')
                                        <div class="col-md-1">
                                            <a href="button" style="cursor: pointer;"  data-toggle="tooltip" data-placement="top" title="{{$file->name ?? 'No name'}}" data-original-title="{{$file->name ?? 'No name'}}">
                                                <img src="/assets/formats/jpeg.png" height="64" width="64" alt="{{$file->name ?? 'No name'}}"><br>
                                                {{strlen($file->name ?? 'No name') > 10 ? substr($file->name ?? 'No name',0,7).'...' : $file->name ?? 'No name'}}
                                            </a>
                                            <div class="dropdown-secondary dropdown float-right">
                                                <button class="btn btn-default btn-mini dropdown-toggle waves-light b-none txt-muted" type="button" id="dropdown6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icofont icofont-navigation-menu"></i></button>
                                                <div class="dropdown-menu" aria-labelledby="dropdown6" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 24px, 0px); top: 0px; left: 0px; will-change: transform;">


																									<a class="dropdown-item waves-light waves-effect" href="/assets/uploads/cnxdrive/{{$file->filename}}"><i class="ti-download text-success mr-2"></i> Download</a>


																									<a class="dropdown-item waves-light waves-effect shareFile" data-toggle="modal" data-target="#shareFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-sharethis text-warning mr-2"></i> Share</a>

																										<div class="dropdown-divider"></div>

                                                    <a class="dropdown-item waves-light waves-effect deleteFile" data-toggle="modal" data-target="#deleteFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-trash mr-2 text-danger"></i> Delete</a>

                                                </div>
                                            </div>
                                        </div>
                                        @break
                                        @case('jpg')
                                            <div class="col-md-1">
                                                <a href="button" style="cursor: pointer;"  data-toggle="tooltip" data-placement="top" title="{{$file->name ?? 'No name'}}" data-original-title="{{$file->name ?? 'No name'}}">
                                                    <img src="/assets/formats/jpg.png" height="64" width="64" alt="{{$file->name ?? 'No name'}}"><br>
                                                    {{strlen($file->name ?? 'No name') > 10 ? substr($file->name ?? 'No name',0,7).'...' : $file->name ?? 'No name'}}
                                                </a>
                                                <div class="dropdown-secondary dropdown float-right">
                                                    <button class="btn btn-default btn-mini dropdown-toggle waves-light b-none txt-muted" type="button" id="dropdown6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icofont icofont-navigation-menu"></i></button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdown6" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 24px, 0px); top: 0px; left: 0px; will-change: transform;">


																											<a class="dropdown-item waves-light waves-effect" href="/assets/uploads/cnxdrive/{{$file->filename}}"><i class="ti-download text-success mr-2"></i> Download</a>


																											<a class="dropdown-item waves-light waves-effect shareFile" data-toggle="modal" data-target="#shareFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-sharethis text-warning mr-2"></i> Share</a>

																												<div class="dropdown-divider"></div>


                                                        <a class="dropdown-item waves-light waves-effect deleteFile" data-toggle="modal" data-target="#deleteFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-trash mr-2 text-danger"></i> Delete</a>

                                                    </div>
                                                </div>
                                            </div>
                                        @break
                                        @case('png')
                                        <div class="col-md-1">
                                            <a href="button" style="cursor: pointer;"  data-toggle="tooltip" data-placement="top" title="{{$file->name ?? 'No name'}}" data-original-title="{{$file->name ?? 'No name'}}">
                                                <img src="/assets/formats/png.png" height="64" width="64" alt="{{$file->name ?? 'No name'}}"><br>
                                                {{strlen($file->name ?? 'No name') > 10 ? substr($file->name ?? 'No name',0,7).'...' : $file->name ?? 'No name'}}
                                            </a>
                                            <div class="dropdown-secondary dropdown float-right">
                                                <button class="btn btn-default btn-mini dropdown-toggle waves-light b-none txt-muted" type="button" id="dropdown6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icofont icofont-navigation-menu"></i></button>
                                                <div class="dropdown-menu" aria-labelledby="dropdown6" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 24px, 0px); top: 0px; left: 0px; will-change: transform;">


																									<a class="dropdown-item waves-light waves-effect" href="/assets/uploads/cnxdrive/{{$file->filename}}"><i class="ti-download text-success mr-2"></i> Download</a>


																									<a class="dropdown-item waves-light waves-effect shareFile" data-toggle="modal" data-target="#shareFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-sharethis text-warning mr-2"></i> Share</a>

																										<div class="dropdown-divider"></div>


                                                    <a class="dropdown-item waves-light waves-effect deleteFile" data-toggle="modal" data-target="#deleteFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-trash mr-2 text-danger"></i> Delete</a>

                                                </div>
                                            </div>
                                        </div>
                                        @break
                                        @case('gif')
                                        <div class="col-md-1">
                                            <a href="button" style="cursor: pointer;" data-toggle="tooltip" data-placement="top" title="{{$file->name ?? 'No name'}}" data-original-title="{{$file->name ?? 'No name'}}">
                                                <img src="/assets/formats/gif.png" height="64" width="64" alt="{{$file->name ?? 'No name'}}"><br>
                                                {{strlen($file->name ?? 'No name') > 10 ? substr($file->name ?? 'No name',0,7).'...' : $file->name ?? 'No name'}}
                                            </a>
                                            <div class="dropdown-secondary dropdown float-right">
                                                <button class="btn btn-default btn-mini dropdown-toggle waves-light b-none txt-muted" type="button" id="dropdown6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icofont icofont-navigation-menu"></i></button>
                                                <div class="dropdown-menu" aria-labelledby="dropdown6" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 24px, 0px); top: 0px; left: 0px; will-change: transform;">


																									<a class="dropdown-item waves-light waves-effect" href="/assets/uploads/cnxdrive/{{$file->filename}}"><i class="ti-download text-success mr-2"></i> Download</a>


																									<a class="dropdown-item waves-light waves-effect shareFile" data-toggle="modal" data-target="#shareFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-sharethis text-warning mr-2"></i> Share</a>

																										<div class="dropdown-divider"></div>


                                                    <a class="dropdown-item waves-light waves-effect deleteFile" data-toggle="modal" data-target="#deleteFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-trash mr-2 text-danger"></i> Delete</a>

                                                </div>
                                            </div>
                                        </div>
                                        @break
                                        @case('ppt')
                                        <div class="col-md-1">
                                            <a href="button" style="cursor: pointer;" data-toggle="tooltip" data-placement="top" title="{{$file->name ?? 'No name'}}" data-original-title="{{$file->name ?? 'No name'}}">
                                                <img src="/assets/formats/ppt.png" height="64" width="64" alt="{{$file->name ?? 'No name'}}"><br>
                                                {{strlen($file->name ?? 'No name') > 10 ? substr($file->name ?? 'No name',0,7).'...' : $file->name ?? 'No name'}}
                                            </a>
                                            <div class="dropdown-secondary dropdown float-right">
                                                <button class="btn btn-default btn-mini dropdown-toggle waves-light b-none txt-muted" type="button" id="dropdown6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icofont icofont-navigation-menu"></i></button>
                                                <div class="dropdown-menu" aria-labelledby="dropdown6" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 24px, 0px); top: 0px; left: 0px; will-change: transform;">


																									<a class="dropdown-item waves-light waves-effect" href="/assets/uploads/cnxdrive/{{$file->filename}}"><i class="ti-download text-success mr-2"></i> Download</a>


																									<a class="dropdown-item waves-light waves-effect shareFile" data-toggle="modal" data-target="#shareFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-sharethis text-warning mr-2"></i> Share</a>

																										<div class="dropdown-divider"></div>


                                                    <a class="dropdown-item waves-light waves-effect deleteFile" data-toggle="modal" data-target="#deleteFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-trash mr-2 text-danger"></i> Delete</a>

                                                </div>
                                            </div>
                                        </div>
                                        @break
                                        @case('txt')
                                        <div class="col-md-1">
                                            <a href="button" style="cursor: pointer;" data-toggle="tooltip" data-placement="top" title="{{$file->name ?? 'No name'}}" data-original-title="{{$file->name ?? 'No name'}}">
                                                <img src="/assets/formats/txt.png" height="64" width="64" alt="{{$file->name ?? 'No name'}}"><br>
                                                {{strlen($file->name ?? 'No name') > 10 ? substr($file->name ?? 'No name',0,7).'...' : $file->name ?? 'No name'}}
                                            </a>
                                            <div class="dropdown-secondary dropdown float-right">
                                                <button class="btn btn-default btn-mini dropdown-toggle waves-light b-none txt-muted" type="button" id="dropdown6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icofont icofont-navigation-menu"></i></button>
                                                <div class="dropdown-menu" aria-labelledby="dropdown6" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 24px, 0px); top: 0px; left: 0px; will-change: transform;">


																									<a class="dropdown-item waves-light waves-effect" href="/assets/uploads/cnxdrive/{{$file->filename}}"><i class="ti-download text-success mr-2"></i> Download</a>


																									<a class="dropdown-item waves-light waves-effect shareFile" data-toggle="modal" data-target="#shareFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-sharethis text-warning mr-2"></i> Share</a>

																										<div class="dropdown-divider"></div>


                                                    <a class="dropdown-item waves-light waves-effect deleteFile" data-toggle="modal" data-target="#deleteFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-trash mr-2 text-danger"></i> Delete</a>

                                                </div>
                                            </div>
                                        </div>
                                        @break
                                        @case('css')
                                        <div class="col-md-1">
                                            <a href="button" style="cursor: pointer;" data-toggle="tooltip" data-placement="top" title="{{$file->name ?? 'No name'}}" data-original-title="{{$file->name ?? 'No name'}}">
                                                <img src="/assets/formats/css.png" height="64" width="64" alt="{{$file->name ?? 'No name'}}"> <br>
                                                {{strlen($file->name ?? 'No name') > 10 ? substr($file->name ?? 'No name',0,7).'...' : $file->name ?? 'No name'}}
                                            </a>
                                            <div class="dropdown-secondary dropdown float-right">
                                                <button class="btn btn-default btn-mini dropdown-toggle waves-light b-none txt-muted" type="button" id="dropdown6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icofont icofont-navigation-menu"></i></button>
                                                <div class="dropdown-menu" aria-labelledby="dropdown6" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 24px, 0px); top: 0px; left: 0px; will-change: transform;">


																									<a class="dropdown-item waves-light waves-effect" href="/assets/uploads/cnxdrive/{{$file->filename}}"><i class="ti-download text-success mr-2"></i> Download</a>

																									<a class="dropdown-item waves-light waves-effect shareFile" data-toggle="modal" data-target="#shareFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-sharethis text-warning mr-2"></i> Share</a>

																										<div class="dropdown-divider"></div>


                                                    <a class="dropdown-item waves-light waves-effect deleteFile" data-toggle="modal" data-target="#deleteFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-trash mr-2 text-danger"></i> Delete</a>

                                                </div>
                                            </div>
                                        </div>
                                        @break
                                        @case('mp3')
                                        <div class="col-md-1">
                                            <a href="button" style="cursor: pointer;" data-toggle="tooltip" data-placement="top" title="{{$file->name ?? 'No name'}}" data-original-title="{{$file->name ?? 'No name'}}">
                                                <img src="/assets/formats/mp3.png" height="64" width="64" alt=""><br>
                                                {{strlen($file->name ?? 'No name') > 10 ? substr($file->name ?? 'No name',0,7).'...' : $file->name ?? 'No name'}}
                                            </a>
                                            <div class="dropdown-secondary dropdown float-right">
                                                <button class="btn btn-default btn-mini dropdown-toggle waves-light b-none txt-muted" type="button" id="dropdown6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icofont icofont-navigation-menu"></i></button>
                                                <div class="dropdown-menu" aria-labelledby="dropdown6" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 24px, 0px); top: 0px; left: 0px; will-change: transform;">


																									<a class="dropdown-item waves-light waves-effect" href="/assets/uploads/cnxdrive/{{$file->filename}}"><i class="ti-download text-success mr-2"></i> Download</a>


																									<a class="dropdown-item waves-light waves-effect shareFile" data-toggle="modal" data-target="#shareFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-sharethis text-warning mr-2"></i> Share</a>

																										<div class="dropdown-divider"></div>


                                                    <a class="dropdown-item waves-light waves-effect deleteFile" data-toggle="modal" data-target="#deleteFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-trash mr-2 text-danger"></i> Delete</a>

                                                </div>
                                            </div>
                                        </div>
                                        @break
                                        @case('mp4')
                                        <div class="col-md-1">
                                            <a href="button" style="cursor: pointer;" data-toggle="tooltip" data-placement="top" title="{{$file->name ?? 'No name'}}" data-original-title="{{$file->name ?? 'No name'}}">
                                                <img src="/assets/formats/mp4.png" height="64" width="64" alt="{{$file->name ?? 'No name'}}"><br>
                                                {{strlen($file->name ?? 'No name') > 10 ? substr($file->name ?? 'No name',0,7).'...' : $file->name ?? 'No name'}}
                                            </a>
                                            <div class="dropdown-secondary dropdown float-right">
                                                <button class="btn btn-default btn-mini dropdown-toggle waves-light b-none txt-muted" type="button" id="dropdown6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icofont icofont-navigation-menu"></i></button>
                                                <div class="dropdown-menu" aria-labelledby="dropdown6" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 24px, 0px); top: 0px; left: 0px; will-change: transform;">


																									<a class="dropdown-item waves-light waves-effect" href="/assets/uploads/cnxdrive/{{$file->filename}}"><i class="ti-download text-success mr-2"></i> Download</a>


																									<a class="dropdown-item waves-light waves-effect shareFile" data-toggle="modal" data-target="#shareFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-sharethis text-warning mr-2"></i> Share</a>

																										<div class="dropdown-divider"></div>


                                                    <a class="dropdown-item waves-light waves-effect deleteFile" data-toggle="modal" data-target="#deleteFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-trash mr-2 text-danger"></i> Delete</a>

                                                </div>
                                            </div>
                                        </div>
                                        @break
                                        @case('svg')
                                        <div class="col-md-1">
                                            <a href="button" style="cursor: pointer;" data-toggle="tooltip" data-placement="top" title="{{$file->name ?? 'No name'}}" data-original-title="{{$file->name ?? 'No name'}}">
                                                <img src="/assets/formats/svg.png" height="64" width="64" alt="{{$file->name ?? 'No name'}}"><br>
                                                {{strlen($file->name ?? 'No name') > 10 ? substr($file->name ?? 'No name',0,7).'...' : $file->name ?? 'No name'}}
                                            </a>
                                            <div class="dropdown-secondary dropdown float-right">
                                                <button class="btn btn-default btn-mini dropdown-toggle waves-light b-none txt-muted" type="button" id="dropdown6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icofont icofont-navigation-menu"></i></button>
                                                <div class="dropdown-menu" aria-labelledby="dropdown6" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 24px, 0px); top: 0px; left: 0px; will-change: transform;">


																									<a class="dropdown-item waves-light waves-effect" href="/assets/uploads/cnxdrive/{{$file->filename}}"><i class="ti-download text-success mr-2"></i> Download</a>


																									<a class="dropdown-item waves-light waves-effect shareFile" data-toggle="modal" data-target="#shareFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-sharethis text-warning mr-2"></i> Share</a>

																										<div class="dropdown-divider"></div>


                                                    <a class="dropdown-item waves-light waves-effect deleteFile" data-toggle="modal" data-target="#deleteFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-trash mr-2 text-danger"></i> Delete</a>

                                                </div>
                                            </div>
                                        </div>
                                        @break
                                        @case('xml')
                                        <div class="col-md-1">
                                            <a href="button" style="cursor: pointer;" data-toggle="tooltip" data-placement="top" title="{{$file->name ?? 'No name'}}" data-original-title="{{$file->name ?? 'No name'}}">
                                                <img src="/assets/formats/xml.png" height="64" width="64" alt="{{$file->name ?? 'No name'}}"><br>
                                                {{strlen($file->name ?? 'No name') > 10 ? substr($file->name ?? 'No name',0,7).'...' : $file->name ?? 'No name'}}
                                            </a>
                                            <div class="dropdown-secondary dropdown float-right">
                                                <button class="btn btn-default btn-mini dropdown-toggle waves-light b-none txt-muted" type="button" id="dropdown6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icofont icofont-navigation-menu"></i></button>
                                                <div class="dropdown-menu" aria-labelledby="dropdown6" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 24px, 0px); top: 0px; left: 0px; will-change: transform;">


																									<a class="dropdown-item waves-light waves-effect" href="/assets/uploads/cnxdrive/{{$file->filename}}"><i class="ti-download text-success mr-2"></i> Download</a>


																									<a class="dropdown-item waves-light waves-effect shareFile" data-toggle="modal" data-target="#shareFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-sharethis text-warning mr-2"></i> Share</a>

																										<div class="dropdown-divider"></div>


                                                    <a class="dropdown-item waves-light waves-effect deleteFile" data-toggle="modal" data-target="#deleteFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-trash mr-2 text-danger"></i> Delete</a>

                                                </div>
                                            </div>
                                        </div>
                                        @break
                                        @case('zip')
                                        <div class="col-md-1">
                                            <a href="button" style="cursor: pointer;" data-toggle="tooltip" data-placement="top" title="{{$file->name ?? 'No name'}}" data-original-title="{{$file->name ?? 'No name'}}">
                                                <img src="/assets/formats/zip.png" height="64" width="64" alt="{{$file->name ?? 'No name'}}"><br>
                                                {{strlen($file->name ?? 'No name') > 10 ? substr($file->name ?? 'No name',0,7).'...' : $file->name ?? 'No name'}}
                                            </a>
                                            <div class="dropdown-secondary dropdown float-right">
                                                <button class="btn btn-default btn-mini dropdown-toggle waves-light b-none txt-muted" type="button" id="dropdown6" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icofont icofont-navigation-menu"></i></button>
                                                <div class="dropdown-menu" aria-labelledby="dropdown6" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 24px, 0px); top: 0px; left: 0px; will-change: transform;">


																									<a class="dropdown-item waves-light waves-effect" href="/assets/uploads/cnxdrive/{{$file->filename}}"><i class="ti-download text-success mr-2"></i> Download</a>


																									<a class="dropdown-item waves-light waves-effect shareFile" data-toggle="modal" data-target="#shareFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-sharethis text-warning mr-2"></i> Share</a>

																										<div class="dropdown-divider"></div>


                                                    <a class="dropdown-item waves-light waves-effect deleteFile" data-toggle="modal" data-target="#deleteFileModal" data-directory="{{$file->filename}}" data-file="{{$file->name ?? 'File name'}}" data-unique="{{$file->id}}" href="javascript:void(0);"><i class="ti-trash mr-2 text-danger"></i> Delete</a>

                                                </div>
                                            </div>
                                        </div>
                                        @break
                                    @endswitch
                                @endforeach
                            @endforeach


															@foreach ($sharedFolders as $folder)


																<div class="col-md-1">
																	<a href="{{route('shared-folder', $folder->folder_id)}}" title="{{$folder->name ?? 'No name'}}" data-original-title="{{$folder->name ?? 'No name'}}" style="cursor: pointer;" data-toggle="tooltip" title="{{ $folder->first_name }} {{ $folder->surname }}">
																		<img src="/assets/formats/folder.png" height="64" width="64" alt="{{$folder->name ?? 'No name'}}"><br>
																		{{strlen($folder->name ?? 'No name') > 10 ? substr($folder->name ?? 'No name',0,7).'...' : $folder->name ?? 'No name'}}

																	</a>

																</div>
															@endforeach


															@foreach ($publicFolders as $folder)
																<div class="col-md-1">
																	<a href="{{route('shared-folder', $folder->id)}}" title="{{$folder->name ?? 'No name'}}" data-original-title="{{$folder->name ?? 'No name'}}" style="cursor: pointer;">
																		<img src="/assets/formats/public-folder.png" height="64" width="64" alt="{{$folder->name ?? 'No name'}}"><br>
																		{{strlen($folder->name ?? 'No name') > 10 ? substr($folder->name ?? 'No name',0,7).'...' : $folder->name ?? 'No name'}}
																	</a>

																</div>
															@endforeach
                        </div>
                    </div>
                </div>


                </div>
            </div>



        </div>
    </div>
@endsection
@section('dialog-section')
    <style>
        .context-menu{
            width: 200px;
            height: auto;
            box-shadow: 0 0 20px 0 #ccc;
            position: absolute;
            display: none;
            z-index: 999;
            background: #fff;
        }
        .context-menu ul{
            list-style: none;
            padding: 5px 0px 5px 0px;
        }
        .context-menu ul li:not(.separator){
            padding: 10px 5px;
            border-left: 2px solid transparent;
            cursor: pointer;
        }
        .context-menu ul li:hover{
            background: #eee;
            border-left: 4px solid #A8CF45;
        }
        .separator{
            height: 1px;
            background: #ddd;
            margin: 2px 0px;
        }
    </style>


    <div class="modal fade" id="new_folder" tabindex="-1" role="dialog">
        <div class="modal-dialog " role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h6 class="modal-title"> <i class="ti-share text-white mr-2"></i> New Folder</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="text-white">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">

                                <form>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Name of Folder</label>
                                        <div class="col-sm-10">
                                            <input name="name_of_folder" id="name_of_folder" type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Parent Folder</label>
                                        <div class="col-sm-10">
                                            <select name="parent_folder" id="parent_folder" class="form-control">
                                                <option value="0">None</option>
                                                @foreach ($myFolders as $folder)
                                                <option value="{{ $folder->id }}"> {{ $folder->name  }}</option>
                                                @endforeach
                                            </select>

                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Visibility</label>
                                        <div class="col-sm-10">
                                            <select name="visibility" id="visibility" class="form-control">
                                                <option value="0">Private</option>
                                                <option value="1">Public</option>

                                            </select>

                                        </div>
                                    </div>


                                </form>



                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <div class="btn-group">
                        <button type="button" class="btn btn-danger waves-effect btn-mini" data-dismiss="modal"><i class="ti-close mr-2"></i>Cancel</button>
                        <button type="button" id="new_folder_btn" class="btn btn-primary waves-effect waves-light btn-mini"> <i class="ti-check mr-2"></i>Create Folder</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

<div class="modal fade" id="shareFileModal" tabindex="-1" role="dialog">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h6 class="modal-title"> <i class="ti-share text-white mr-2"></i> Share File</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-white">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <p>Share <strong id="fileToShare"></strong> with...</p>
                            <hr>
                            <div class="form-group">
                                <div class="checkbox-fade fade-in-primary">
                                    <label>
                                        <input type="checkbox" value="32" name="all_employee" id="all_employee">
                                        <span class="cr">
                                            <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                        </span>
                                        <span>All employees</span>
                                    </label>
                                </div>
                            </div>
                            <hr>
                            <div class="form-group">
                                @foreach ($employees as $employee)
                                    <div class="checkbox-fade fade-in-primary">
                                        <label>
                                            <input type="checkbox" value="{{$employee->id}}" name="employee" id="employee[]">
                                            <span class="cr">
                                                <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                            </span>
                                            <span>{{$employee->first_name ?? ''}} {{$employee->surname ?? ''}}</span>
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <div class="btn-group">
                    <button type="button" class="btn btn-danger waves-effect btn-mini" data-dismiss="modal"><i class="ti-close mr-2"></i>Cancel</button>
                    <button type="button" id="shareFileBtn" class="btn btn-primary waves-effect waves-light btn-mini"> <i class="ti-check mr-2"></i>Share File</button>
                </div>
            </div>
        </div>
    </div>
</div>

		<div class="modal fade" id="shareFolderModal" tabindex="-1" role="dialog">
			<div class="modal-dialog " role="document">
				<div class="modal-content">
					<div class="modal-header bg-primary">
						<h6 class="modal-title"> <i class="ti-share text-white mr-2"></i> Share Folder</h6>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true" class="text-white">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="container">
							<div class="row">
								<div class="col-md-12">
									<p>Share <strong id="fileToShare"></strong> with...</p>
									<hr>
									<div class="form-group">
										<div class="checkbox-fade fade-in-primary">
											<label>
												<input type="checkbox" value="32" name="all_employees" id="all_employees">
												<span class="cr">
                                            <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                        </span>
												<span>All employees</span>
											</label>
										</div>
									</div>
									<hr>
									<div class="form-group">
										@foreach ($employees as $employee)
											<div class="checkbox-fade fade-in-primary">
												<label>
													<input type="checkbox" value="{{$employee->id}}" name="employees" id="employees[]">
													<span class="cr">
                                                <i class="cr-icon icofont icofont-ui-check txt-primary"></i>
                                            </span>
													<span>{{$employee->first_name ?? ''}} {{$employee->surname ?? ''}}</span>
												</label>
											</div>
										@endforeach
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer d-flex justify-content-center">
						<div class="btn-group">
							<button type="button" class="btn btn-danger waves-effect btn-mini" data-dismiss="modal"><i class="ti-close mr-2"></i>Cancel</button>
							<button type="button" id="shareFolderBtn" class="btn btn-primary waves-effect waves-light btn-mini"> <i class="ti-check mr-2"></i>Share Folder</button>
						</div>
					</div>
				</div>
			</div>
		</div>


<div class="modal fade" id="deleteFileModal" tabindex="-1" role="dialog">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h6 class="modal-title"> <i class="ti-trash text-white mr-2"></i> Are you sure?</h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-white">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <p>This action cannot be undone. Are you sure you want to delete <strong id="fileToDelete"></strong> ?</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer d-flex justify-content-center">
                <div class="btn-group">
                    <button type="button" class="btn btn-primary waves-effect btn-mini" data-dismiss="modal"><i class="ti-close mr-2"></i>Cancel</button>
                    <button type="button" id="deleteFileBtn" class="btn btn-danger waves-effect waves-light btn-mini"> <i class="ti-check mr-2"></i>Delete File</button>
                </div>
            </div>
        </div>
    </div>
</div>

		<div class="modal fade" id="deleteFolderModal" tabindex="-1" role="dialog">
			<div class="modal-dialog " role="document">
				<div class="modal-content">
					<div class="modal-header bg-danger">
						<h6 class="modal-title"> <i class="ti-trash text-white mr-2"></i> Are you sure?</h6>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true" class="text-white">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="container">
							<div class="row">
								<div class="col-md-12">
									<p>This action cannot be undone, Files in this folder would be deleted too Are you sure you want to delete? <strong id="folderToDelete"></strong> ?</p>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer d-flex justify-content-center">
						<div class="btn-group">
							<button type="button" class="btn btn-primary waves-effect btn-mini" data-dismiss="modal"><i class="ti-close mr-2"></i>Cancel</button>
							<button type="button" id="deleteFolderBtn" class="btn btn-danger waves-effect waves-light btn-mini"> <i class="ti-check mr-2"></i>Delete Folder</button>
						</div>
					</div>
				</div>
			</div>
		</div>



		<div class="modal fade" id="new-file" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h6 class="modal-title"><i class="ti-upload mr-2"></i> Upload File</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="text-white">&times;</span>
                    </button>
                </div>
                <form id="fileUploadForm">
                <div class="modal-body">
                    <div class="container">
                        <div class="form-group">
                            <label class="">File Name</label>
                            <div class="col-sm-12">
                                <input type="text" name="filename"  id="filename" class="form-control" placeholder="File name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="">Choose File</label>
                            <div class="col-sm-8">
                                <input type="file" name="uploadAttachment"  id="uploadAttachment" class="form-control-file">
                                @error('uploadAttachment')
                                    <i class="text-danger">{{ $message }}</i>
                                @enderror
                            </div>
                        </div>


                    </div>
                </div>
                <div class="modal-footer ">
                    <div class="btn-group d-flex justify-content-center">
                        <button type="button" class="btn btn-danger waves-effect btn-mini" data-dismiss="modal"> <i class="ti-close mr-2"></i>Close</button>
                        <button type="submit" class="btn btn-primary waves-effect waves-light btn-mini" id="uploadAttachmentBtn"><i class="ti-check mr-2"></i>Upload File</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('extra-scripts')
<script>
    $(document).ready(function(){
        var file_data = null;
        var all_employee = null;
        //create folder button
        $(document).on('click', '#createFolder', function(e){
            e.preventDefault();
            if($('#folder_name').val() != ""){
                axios.post('/drive/make-directory', {folder_name:$('#folder_name').val()})
                .then(response=>{
                    console.log(response.data.message);
                });
            }else{
                return;
            }
        });

        $(document).on('change', '#uploadAttachment', function(e){
            e.preventDefault();
            var extension = $('#uploadAttachment').val().split('.').pop().toLowerCase();
            var formats = ['csv', 'xls', 'xlsx', 'pdf',
                        'doc', 'docx', 'jpeg', 'jpg',
                        'png', 'gif', 'ppt', 'pptx','zip',
                        'txt', 'css','mp3', 'mp4', 'svg','xml'
                    ];
            if ($.inArray(extension, formats) == -1) {
                $.notify('Error! Please upload a valid file', 'error');
            }else{
               file_data = $('#uploadAttachment').prop('files')[0];
            }

        });
        $(document).on('submit','#fileUploadForm', function(e){
            e.preventDefault();
            var config = {
                onUploadProgress: function(progressEvent) {
                var percentCompleted = Math.round( (progressEvent.loaded * 100) / progressEvent.total );
                        }
                };

               var form_data = new FormData();
                form_data.append('attachment',file_data);
                form_data.append('filename',$('#filename').val());
                 axios.post('/upload-attachment', form_data, config)
                .then(response=>{
                    $('#new-file').modal('hide');
                    $("#fileDirectory").load(location.href + " #fileDirectory");
                    $.notify(response.message, "success");
                })
                .catch(error=>{
                    $.notify(error.response.data.error, "error");
                });


        });

        $(document).on('click', '.downloadFile', function(e){
            e.preventDefault();
            var directory = $(this).data('directory');
            var extension = directory.substr(directory.indexOf(".") + 1);
            var id = $(this).data('unique');
            axios.post("/cnx247-drive/download",{
                attachment:directory,
                extension:extension,
                id:id
            })
            .then(response=>{

            })
            .catch(error=>{

            });
        });
        $(document).on('change','#all_employee', function(e){
            e.preventDefault();
            if ($("#all_employee").is(':checked'))
                all_employee = 32; //all employees
            else {
                all_employee = null;
            }
        });
        $(document).on('click', '.shareFile', function(e){
            var name = $(this).data('file');
            var id = $(this).data('unique');
            $('#fileToShare').text(name);
            $(document).on('click', '#shareFileBtn', function(event){
                var employees = []
                $("input:checkbox[name=employee]:checked").each(
                    function(){employees.push($(this).val());
                    });
                axios.post('/cnx247-drive/share',{
                    employees:employees,
                    id:id,
                    all:all_employee
                })
                .then(response=>{
                    $.notify(response.data.message, 'success');
                    $('#shareFileModal').modal('hide');
                })
                .catch(error=>{
                    $.notify(error.response.data.error, 'error');
                });
            });
        });

			$(document).on('change','#all_employees', function(e){
				e.preventDefault();
				if ($("#all_employees").is(':checked'))
					all_employee = 32; //all employees
				else {
					all_employee = null;
				}
			});



			$(document).on('click', '.shareFolder', function(e){


				var name = $(this).data('file');
				var id = $(this).data('unique');


				// $('#folderToShare').text(name);
				$(document).on('click', '#shareFolderBtn', function(event){
					var employees = []


					$("input:checkbox[name=employees]:checked").each(


						function(){employees.push($(this).val());
						});


					axios.post('/cnx247-drive/share-folder',{
						employees:employees,
						id:id,
						all:all_employee
					})
						.then(response=>{
							$.notify(response.data.message, 'success');
							$('#shareFolderModal').modal('hide');
							})
						.catch(error=>{
							$.notify(error.response.data.error, 'error');
						});
				});
			});



            $(document).on('click', '#new_folder_btn', function(event){
                    var name_of_folder = $('#name_of_folder').val();
                    var parent_folder = $('#parent_folder').val();
                    var visibility = $('#visibility').val();
                axios.post('/cnx247-drive/new_folder',{
                    name_of_folder: name_of_folder,
                    parent_folder: parent_folder,
                    visibility: visibility
                })
                    .then(response=>{
                        $.notify(response.data.message, 'success');
                        $('#new_folder').modal('hide');
											location.reload();
                    })
                    .catch(error=>{
                        $.notify(error.response.data.error, 'error');
                    });
            });


        $(document).on('click', '.deleteFile', function(e){
            var name = $(this).data('file');
            var directory = $(this).data('directory');
            var id = $(this).data('unique');
            $('#fileToDelete').text(name);
            $(document).on('click', '#deleteFileBtn', function(event){
                axios.post('/cnx247-drive/delete',{
                    id:id,
                    directory:directory
                })
                .then(response=>{
                    $.notify(response.data.message, 'success');
                    $('#deleteFileModal').modal('hide');
                    location.reload();
                })
                .catch(error=>{
                    $.notify(error.response.data.error, 'error');
                });
            });
        });

			$(document).on('click', '.deleteFolder', function(e){
				var name = $(this).data('file');
				var directory = $(this).data('directory');
				var id = $(this).data('unique');
				$('#folderToDelete').text(name);
				$(document).on('click', '#deleteFolderBtn', function(event){
					axios.post('/cnx247-drive/delete-folder',{
						id:id,
						directory:directory
					})

						.then(response=>{
							$.notify(response.data.message, 'success');
							$('#deleteFolderModal').modal('hide');
							location.reload();
						})
						.catch(error=>{
							//$.notify(error.response.data.error, 'error');
							console.log(error.response.data.error);
						});
					//alert(directory);
				});
			});
    });
</script>
@endsection
