{{-- This file is used to store sidebar items, inside the Backpack admin panel --}}
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>

<li class="nav-item"><a class="nav-link" href="{{ backpack_url('level') }}"><i class="nav-icon la la-question"></i> Levels</a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('course') }}"><i class="nav-icon la la-question"></i> Courses</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('backup') }}'><i class='nav-icon la la-hdd-o'></i> Backups</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('log') }}'><i class='nav-icon la la-terminal'></i> Logs</a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('grade') }}"><i class="nav-icon la la-question"></i> Grades</a></li>
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('sup') }}"><i class="nav-icon la la-question"></i> Sups</a></li>