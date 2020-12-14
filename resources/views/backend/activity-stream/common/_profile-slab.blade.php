
<ul class="nav nav-tabs md-tabs " role="tablist">
    <li class="nav-item">
        <a href="{{route('my-profile')}}" class="nav-link {{ request()->routeIs('my-profile') ? 'active' : '' }}" ><i class="icofont icofont-throne mr-2"></i>My Profile</a>
        <div class="slide"></div>
    </li>
    <li class="nav-item">
        <a href="{{route('user-administration')}}" class="nav-link {{request()->routeIs('user-administration') ? 'active' : '' }}"><i class="icofont icofont-business-man-alt-3 mr-2"></i>Administration</a>
        <div class="slide"></div>
    </li>
    <li class="nav-item">
        <div class="btn-group">
            <a href="{{route('query-employee', $user->url)}}" data-toggle="tooltip" data-placement="top" title="Query {{$user->first_name}}"> <i class="ti-help-alt mr-4 text-danger"></i></a>
            <a href="{{route('assign-permission-to-employee', $user->url)}}" data-toggle="tooltip" data-placement="top" title="Assign Role to {{$user->first_name}}"> <i class="icofont icofont-chart-flow-alt-1 mr-4 text-warning"></i></a>
            <a href="" data-toggle="tooltip" data-placement="top" title="Terminate {{$user->first_name}}'s employement"> <i class="ti-na mr-4 text-danger"></i></a>
        </div>
    </li>
</ul>
