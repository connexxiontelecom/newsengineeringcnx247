<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-block">
                <h5 class="sub-title">Workgroups</h5>
								<span>You can only access a workgroup to which you're a member. </span>
								@can('create workgroup')

                <a href="{{route('new-workgroup')}}" class="float-right btn btn-primary btn-mini waves-effect waves-light" ><i class="ti-plus mr-2"></i>New Workgroup</a>
								@endcan
                <div class="row">
                    @if (session()->has('error'))
                        <div class="col-md-12">
                            <div class="alert alert-warning background-warning" role="alert">
                                {!! session()->get('error') !!}
                            </div>
                        </div>
                    @endif
                    <div class="col-sm-12">
                        <div class="grid">
                            @if (count($groups) > 0)
                                @foreach ($groups as $group)
                                    <figure class="effect-winston">
                                        <img src="/assets/images/workgroup/medium/{{$group->group_image ?? 'cnx247.jpg'}}" alt="{{$group->group_name ?? ''}}">
                                        <figcaption>
                                            <h2 style="font-size: 18px; letter-spacing:1px; color:#fff;"> <a href="{{ route('view-workgroup', $group->url) }}" style="color: #fff;">{{ $group->group_name ?? ''}}</a> </h2>
                                            <span style="display:block; font-size:12px; letter-spacing:1px; text-transform:none; margin-top:30px;">{{ strip_tags($group->description) ?? '' }}</span>
                                            <p>
                                                <a href="{{ route('view-workgroup', $group->url) }}"><i class="fa fa-users"></i> <span><small style="font-size: 12px;">{{count($group->member) + count($group->workgroupModerators)}}</small></span></a>
                                                <a href="{{ route('view-workgroup', $group->url) }}"><i class="fa fa-fw fa-comments-o"></i><span><small style="font-size: 12px;">{{count($group->workgroupComments)}}</small></span></a>
                                                <a href="{{ route('view-workgroup', $group->url) }}"><i class="fa fa-folder-open"></i><span><small style="font-size: 12px;">{{count($group->workgroupAttachments)}}</small></span></a>
                                            </p>

                                        </figcaption>
                                    </figure>
                                @endforeach
                            @else
                            <h5 class="text-center text-danger">Ooops! There's no existing workgroup</h5>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@push('workgroup-script')
  <script>
      $(document).ready(function(){

        $(document).on('click', '#createWorkgroupBtn', function(e){
            e.preventDefault();
            var workgroup_name = $('#workgroup_name').val();
            var members = $('#members').val();
            var moderators = $('#moderators').val();
            var group_image = $('#group_image').val();
            var description = tinymce.get('description').getContent();
           if(workgroup_name == '' && members == '' && moderators == '' && group_image == '' && description == ''){
                $.notify("Ooops! All fields are required.", "error");
           }else{
            alert("okay");
           }
        });
      });
  </script>
@endpush
