<ul class="nav nav-tabs md-tabs tabs-left b-none" role="tablist">
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('user-settings') ? 'active' : '' }}"  href="{{route('user-settings')}}">Edit Profile</a>
        <div class="slide"></div>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('education') ? 'active' : '' }}" href="{{route('education')}}">Education</a>
        <div class="slide"></div>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#messages5" role="tab">Bank</a>
        <div class="slide"></div>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#messages5" role="tab">Security</a>
        <div class="slide"></div>
    </li>
    <li class="nav-item">
        <a class="nav-link {{request()->routeIs('work-experience') ? 'active' : ''}}" href="{{route('work-experience')}}">Work Experience</a>
        <div class="slide"></div>
    </li>
</ul>
