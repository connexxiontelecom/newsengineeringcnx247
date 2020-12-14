<div class="card">

    <div class="row">
        <div class="col-lg-12">
            <div class="cover-profile">
                <div class="profile-bg-img">
                    <img class="profile-bg-img img-fluid" id="cover-preview" src="/assets/images/cover-photos/{{Auth::user()->cover ?? 'cover.jpeg'}}" width="1202" height="217" alt="bg-img">
                    <div class="card-block user-info">
                        <div class="col-md-12">
                            <div class="media-left">
                                <a href="#" class="profile-image">
                                    <span id="avatarHandler" class="btn btn-primary btn-mini waves-effect waves-light mb-2"><i class="ti-user mr-2" title="Change profile picture"></i>Change picture</span> <br>
                                    <input type="file" id="avatar" hidden>
                                    <img height="108" width="108" class="user-img img-radius" id="avatar-preview" src="/assets/images/avatars/medium/{{Auth::user()->avatar ?? 'avatar.png'}}" alt="user-img">
                                </a>
                            </div>
                            <div class="media-body row">
                                <div class="col-lg-12">
                                    <div class="user-title">
                                        <h2>{{Auth::user()->first_name ?? ''}} {{Auth::user()->surname ?? ''}}</h2>
                                        <span class="text-white">{{Auth::user()->position ?? ''}}</span>

                                    </div>
                                </div>
                                <div>
                                    <div class="pull-right cover-btn">
                                        <button class="btn btn-inverse btn-sm" id="coverPhotoHandle"><i class="ti-cloud-up"></i>Upload cover photo</button>
                                        <input type="file" id="cover_photo" hidden>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 d-flex justify-content-end">
            <div class="btn-group">
                <a href="javascript:void(0);" class="btn btn-mini btn-danger" data-toggle="modal" data-target="#newResignationModal"><i class="icofont icofont-plus"></i>  New Resignation</a>
                <a href="{{route('my-ideas')}}" class="btn btn-mini btn-warning text-white"><i class="icofont icofont-brain-alt"></i>  My Ideas</a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-xl-12 col-md-12">
            @include('livewire.backend.user.common._profile-slab')
        </div>
    </div>
</div>
@push('profile-script')
 <script src="{{asset('/assets/js/cus/profile.js')}}"></script>
@endpush
