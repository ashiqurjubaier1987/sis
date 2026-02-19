@push('styles')
    <style>
        /* Hide the arrow for items that have no submenu */
        .pcoded-hasmenu.no-submenu>a::after {
            display: none !important;
        }

        /* Prevent submenu from opening (if JS tries to open it) */
        .pcoded-hasmenu.no-submenu .pcoded-submenu {
            display: none !important;
        }
    </style>
@endpush

<nav class="pcoded-navbar">
    <div class="pcoded-inner-navbar">
        <ul class="pcoded-item pcoded-left-item">

            <!-- ⚙️ Dashboard -->
            <li class="pcoded-hasmenu no-submenu">
                <a href="{{ url('dashboard') }}">
                    <span class="pcoded-micon"><i class="feather icon-home"></i></span>
                    <span class="pcoded-mtext">Dashboard</span>
                </a>
            </li>

            <!-- 📚 Academic Management -->
            <li class="pcoded-hasmenu">
                <a href="javascript:void(0)">
                    <span class="pcoded-micon"><i class="feather icon-book"></i></span>
                    <span class="pcoded-mtext">Academic Management</span>
                    <span class="pcoded-mcaret"></span>
                </a>
                <ul class="pcoded-submenu">
                    <!-- Class Subject -->
                    <li>
                        <a href="{{url('subjects')}}">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.dash.default">Subject List</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <!-- Batch & Sections -->
                    <li class="pcoded-hasmenu">
                        <a href="javascript:void(0)">
                            <span class="pcoded-micon"><i class="ti-home"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.dash.main">Batch & Sections</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                        <ul class="pcoded-submenu">
                            <li>
                                <a href="#">
                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                    <span class="pcoded-mtext" data-i18n="nav.dash.default">Batch List</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                    <span class="pcoded-mtext" data-i18n="nav.dash.default">Section List</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>
                            <!-- <li>
                                <a href="#">
                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                    <span class="pcoded-mtext" data-i18n="nav.dash.default">Slot List</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li> -->
                        </ul>
                    </li>

                    <!-- Class Routine -->
                    <li class="pcoded-hasmenu">
                        <a href="javascript:void(0)">
                            <span class="pcoded-micon"><i class="ti-home"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.dash.main">Class Routine</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                        <ul class="pcoded-submenu">
                            <li>
                                <a href="#">
                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                    <span class="pcoded-mtext" data-i18n="nav.dash.main">Routine List</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                    <span class="pcoded-mtext" data-i18n="nav.dash.main">Student Enrolled
                                        Routines</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                    <span class="pcoded-mtext" data-i18n="nav.dash.main">Class Schedule for
                                        Device</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href="#">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.dash.main">Recorded Lessons</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- 👨‍🎓 Student Management -->
            <li class="pcoded-hasmenu">
                <a href="javascript:void(0)">
                    <span class="pcoded-micon"><i class="feather icon-users"></i></span>
                    <span class="pcoded-mtext">Student Management</span>
                    <span class="pcoded-mcaret"></span>
                </a>
                <ul class="pcoded-submenu">
                    <!-- Registration -->
                    <li class="pcoded-hasmenu">
                        <a href="javascript:void(0)">
                            <span class="pcoded-micon"><i class="ti-home"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.dash.main">Registration</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                        <ul class="pcoded-submenu">
                            <li>
                                <a href="#">
                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                    <span class="pcoded-mtext" data-i18n="nav.dash.default">Student Registration</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                    <span class="pcoded-mtext" data-i18n="nav.dash.default">Student Waiting
                                        List</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Student Lists -->
                    <li class="pcoded-hasmenu">
                        <a href="javascript:void(0)">
                            <span class="pcoded-micon"><i class="ti-home"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.dash.main">Student Lists</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                        <ul class="pcoded-submenu">
                            <li>
                                <a href="#">
                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                    <span class="pcoded-mtext" data-i18n="nav.dash.default">Assigned Student
                                        List</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                    <span class="pcoded-mtext" data-i18n="nav.dash.default">Assign to Courses</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                    <span class="pcoded-mtext" data-i18n="nav.dash.default">Approve Student
                                        List</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                    <span class="pcoded-mtext" data-i18n="nav.dash.default">Deleted Student
                                        List</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                    <span class="pcoded-mtext" data-i18n="nav.dash.default">Student Migration</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                    <span class="pcoded-mtext" data-i18n="nav.dash.default">All Student List</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Profiles & History -->
                    <li class="pcoded-hasmenu">
                        <a href="javascript:void(0)">
                            <span class="pcoded-micon"><i class="ti-home"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.dash.main">Profiles & History</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                        <ul class="pcoded-submenu">
                            <li>
                                <a href="#">
                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                    <span class="pcoded-mtext" data-i18n="nav.dash.default">Edit Profile</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                    <span class="pcoded-mtext" data-i18n="nav.dash.default">Student History</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Attendance -->
                    <li class="pcoded-hasmenu">
                        <a href="javascript:void(0)">
                            <span class="pcoded-micon"><i class="ti-home"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.dash.main">Attendance</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                        <ul class="pcoded-submenu">
                            <li>
                                <a href="#">
                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                    <span class="pcoded-mtext" data-i18n="nav.dash.default">Take Attendance</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                    <span class="pcoded-mtext" data-i18n="nav.dash.default">Attendance Report</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                    <span class="pcoded-mtext" data-i18n="nav.dash.default">SMS Weekly/Daily
                                        Attendance</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                    <span class="pcoded-mtext" data-i18n="nav.dash.default">Print Attendance
                                        Report</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                    <span class="pcoded-mtext" data-i18n="nav.dash.default">Full Month Report</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                    <span class="pcoded-mtext" data-i18n="nav.dash.default">Excel Output Report</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.dash.default">Report Card</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- 💰 Finance -->
            <li class="pcoded-hasmenu">
                <a href="javascript:void(0)">
                    <span class="pcoded-micon"><i class="feather icon-credit-card"></i></span>
                    <span class="pcoded-mtext">Finance</span>
                    <span class="pcoded-mcaret"></span>
                </a>
                <ul class="pcoded-submenu">
                    <!-- Payments -->
                    <li class="pcoded-hasmenu">
                        <a href="javascript:void(0)">
                            <span class="pcoded-micon"><i class="ti-home"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.dash.main">Payments</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                        <ul class="pcoded-submenu">
                            <li>
                                <a href="#">
                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                    <span class="pcoded-mtext" data-i18n="nav.dash.default">Receive Payment</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                    <span class="pcoded-mtext" data-i18n="nav.dash.default">Temporary Receive
                                        Payment</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                    <span class="pcoded-mtext" data-i18n="nav.dash.default">Delete Payment</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>

                            <!-- Payment Reports -->
                            <li class="pcoded-hasmenu">
                                <a href="javascript:void(0)">
                                    <span class="pcoded-micon"><i class="ti-home"></i></span>
                                    <span class="pcoded-mtext" data-i18n="nav.dash.main">Payment Reports</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                                <ul class="pcoded-submenu">
                                    <li>
                                        <a href="#">
                                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                            <span class="pcoded-mtext" data-i18n="nav.dash.default">Report On Date
                                                Range</span>
                                            <span class="pcoded-mcaret"></span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                            <span class="pcoded-mtext" data-i18n="nav.dash.default">Unpaid List</span>
                                            <span class="pcoded-mcaret"></span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </li>

                    <!-- Monthly Subscription Fee -->
                    <li>
                        <a href="#">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.dash.default">Monthly Subscription Fee</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>

                    <!-- Withdrawal -->
                    <li class="pcoded-hasmenu">
                        <a href="javascript:void(0)">
                            <span class="pcoded-micon"><i class="ti-home"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.dash.main">Withdrawal</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                        <ul class="pcoded-submenu">
                            <li>
                                <a href="#">
                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                    <span class="pcoded-mtext" data-i18n="nav.dash.default">Cash Withdrawal</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                    <span class="pcoded-mtext" data-i18n="nav.dash.default">Delete Transaction</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                    <span class="pcoded-mtext" data-i18n="nav.dash.default">Withdrawal Report</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>

            <!-- 📝 Exams -->
            <li class="pcoded-hasmenu">
                <a href="javascript:void(0)">
                    <span class="pcoded-micon"><i class="feather icon-file-text"></i></span>
                    <span class="pcoded-mtext">Exams</span>
                    <span class="pcoded-mcaret"></span>
                </a>
                <ul class="pcoded-submenu">
                    <li>
                        <a href="#">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.dash.default">Exam List</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.dash.default">Enrol Students to Exam</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.dash.default">Marks Entry</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.dash.default">SMS Exam Marks</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.dash.default">Marksheet</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.dash.default">Excel Output Marksheet</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- 📢 Communication -->
            <li class="pcoded-hasmenu">
                <a href="javascript:void(0)">
                    <span class="pcoded-micon"><i class="feather icon-message-circle"></i></span>
                    <span class="pcoded-mtext">Communication</span>
                    <span class="pcoded-mcaret"></span>
                </a>
                <ul class="pcoded-submenu">
                    <li class="pcoded-hasmenu">
                        <a href="javascript:void(0)">
                            <span class="pcoded-micon"><i class="ti-home"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.dash.main">SMS Panel</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                        <ul class="pcoded-submenu">
                            <li>
                                <a href="#">
                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                    <span class="pcoded-mtext" data-i18n="nav.dash.default">SMS to All Students</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                    <span class="pcoded-mtext" data-i18n="nav.dash.default">SMS to Unpaid
                                        Students</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                                    <span class="pcoded-mtext" data-i18n="nav.dash.default">SMS Report</span>
                                    <span class="pcoded-mcaret"></span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.dash.default">Notice List</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                </ul>
            </li>

            <!-- ⚙️ Administration -->
            <li class="pcoded-hasmenu">
                <a href="javascript:void(0)">
                    <span class="pcoded-micon"><i class="feather icon-settings"></i></span>
                    <span class="pcoded-mtext">Administration</span>
                    <span class="pcoded-mcaret"></span>
                </a>
                <ul class="pcoded-submenu">
                    <li>
                        <a href="#">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.dash.default">User Management</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li>
                    <!-- <li>
                        <a href="#">
                            <span class="pcoded-micon"><i class="ti-angle-right"></i></span>
                            <span class="pcoded-mtext" data-i18n="nav.dash.default">Database Backup</span>
                            <span class="pcoded-mcaret"></span>
                        </a>
                    </li> -->
                </ul>
            </li>

        </ul>
    </div>
</nav>
