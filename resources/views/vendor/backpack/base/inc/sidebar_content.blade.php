{{-- This file is used to store sidebar items, inside the Backpack admin panel --}}
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i
            class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>

<li class="nav-item"><a class="nav-link" href="{{ backpack_url('level') }}"><i class="nav-icon la la-sort-amount-up-alt"></i>
        Cấp độ</a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('course') }}"><i class="nav-icon la la-scroll"></i>
        Khóa học</a></li>

<li class="nav-item"><a class="nav-link" href="{{ backpack_url('student') }}"><i class="nav-icon la la-graduation-cap"></i>
        Học sinh</a></li>

<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-list"></i>Lớp học</a>
    <ul class="nav-dropdown-items">
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('grade') }}"><i
                    class="nav-icon la la-chalkboard"></i> DS Lớp học</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('lesson') }}"><i
                    class="nav-icon la la-history"></i> Buổi học</a></li>
    </ul>
</li>
<li class="nav-item nav-dropdown">
    <a class="nav-link nav-dropdown-toggle" href="#"><i class="nav-icon la la-list"></i>Lớp học bổ trợ</a>
    <ul class="nav-dropdown-items">
        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('sup') }}"><i
                    class="nav-icon la la-chalkboard"></i>
                DS Lớp học bổ trợ</a></li>

        <li class="nav-item"><a class="nav-link" href="{{ backpack_url('supplement') }}"><i
                    class="nav-icon la la-history"></i>
                Buổi học bổ trợ</a></li>
    </ul>
</li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('backup') }}'><i class='nav-icon la la-hdd-o'></i>
        Backups</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('log') }}'><i class='nav-icon la la-terminal'></i>
        Logs</a></li>
