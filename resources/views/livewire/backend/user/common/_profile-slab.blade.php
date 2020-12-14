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
        <a href="{{route('user-settings')}}" class="nav-link {{request()->routeIs('user-settings') ? 'active' : '' }}"><i class="icofont icofont-ui-settings mr-2"></i>Settings</a>
        <div class="slide"></div>
    </li>
</ul>
