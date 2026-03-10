@extends('layouts.app')

@section('title', $title ?? 'Subjects')

@push('styles')
@endpush

@section('content')
    <div class="page-body">

        <!-- Page-header start -->
        <div class="page-header">
            <div class="row align-items-end">
                <div class="col-lg-8">
                    <div class="page-header-title">
                        <h4 class="f-w-600 m-b-5">Subject</h4>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="page-header-breadcrumb">
                        <ul class="breadcrumb-title">
                            <li class="breadcrumb-item" style="float:left;">
                                <a href="{{ route('dashboard') }}"><i class="feather icon-home"></i></a>
                            </li>
                            <li class="breadcrumb-item" style="float:left;">
                                <a href="#!">Academic Management</a>
                            </li>
                            <li class="breadcrumb-item" style="float:left;">
                                <a href="#!">Subject</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page-header end -->

        {{-- SweetAlert flash (picked up by SIS.showFlash) --}}
        @if (session('success'))
            <div id="sis-flash-success" data-message="{{ session('success') }}"></div>
        @endif

        <div class="row">
            <div class="col-sm-12">

                {{-- ===== FILTER CARD ===== --}}
                <div class="card m-b-20">
                    <div class="card-block">
                        <div class="d-flex align-items-center m-b-15">
                            <div class="filter-icon-badge">
                                <i class="feather icon-filter text-c-blue"></i>
                            </div>
                            <div>
                                <h6 class="m-b-0 f-w-600">Filter Subjects</h6>
                                <small class="text-muted">Search and filter by name, code, or status</small>
                            </div>
                        </div>
                        <div class="row align-items-end">

                            {{-- Search --}}
                            <div class="col-md-5">
                                <label class="f-w-600 f-13">Search Subject</label>
                                <div class="search-input-wrap">
                                    <i class="feather icon-search search-icon"></i>
                                    <input type="text" id="searchInput" class="form-control form-control-lg"
                                        placeholder="Search by name or code...">
                                </div>
                            </div>

                            {{-- Status --}}
                            <div class="col-md-3">
                                <label class="f-w-600 f-13">Status</label>
                                <select id="statusFilter" class="form-control">
                                    <option value="">— All Statuses —</option>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>

                            {{-- Show + Reset --}}
                            <div class="col-md-4">
                                <label class="f-w-600 f-13 text-muted">Show</label>
                                <div class="show-row">
                                    <select id="perPageSelect" class="form-control d-inline-block align-middle col-sm-2">
                                        <option value="10">10</option>
                                        <option value="25">25</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                    </select>
                                    <button id="resetFilterBtn" class="btn btn-light" title="Reset filters">
                                        <i class="feather icon-rotate-ccw m-r-5"></i> Reset
                                    </button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                {{-- ===== TOOLBAR ===== --}}
                <div class="d-flex justify-content-between align-items-center m-b-15">
                    <p class="text-muted m-b-0 f-13" id="tableInfo">
                        Showing <strong class="text-c-blue">0</strong> of
                        <strong class="text-c-blue">0</strong> subjects
                    </p>
                    <div class="toolbar-group">

                        {{-- Export --}}
                        <div class="btn-group">
                            <button class="btn btn-light btn-sm dropdown-toggle" data-toggle="dropdown">
                                <i class="feather icon-download m-r-5"></i> Export
                            </button>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <li><a class="dropdown-item export-btn" href="javascript:void(0)" data-type="xlsx">
                                        <i class="feather icon-file m-r-5"></i> Excel (.xlsx)
                                    </a></li>
                                <li><a class="dropdown-item export-btn" href="javascript:void(0)" data-type="csv">
                                        <i class="feather icon-file-text m-r-5"></i> CSV
                                    </a></li>
                                <li><a class="dropdown-item export-btn" href="javascript:void(0)" data-type="pdf">
                                        <i class="feather icon-file-minus m-r-5"></i> PDF
                                    </a></li>
                            </ul>
                        </div>

                        {{-- Add Subject --}}
                        @can('subject.create')
                            <a href="{{ route('subjects.create') }}" class="btn btn-primary btn-sm">
                                <i class="feather icon-plus m-r-5"></i> Add Subject
                            </a>
                        @endcan

                        {{-- View Toggle --}}
                        <div class="btn-group" id="viewToggle">
                            <button class="btn btn-light btn-sm active" id="cardViewBtn" title="Card View">
                                <i class="feather icon-grid"></i>
                            </button>
                            <button class="btn btn-light btn-sm" id="listViewBtn" title="List View">
                                <i class="feather icon-list"></i>
                            </button>
                        </div>

                    </div>
                </div>

                {{-- ===== LOADING SPINNER ===== --}}
                <div id="loadingSpinner" class="text-center p-t-30 p-b-30 d-none">
                    <i class="feather icon-loader spin f-24 text-c-blue"></i>
                    <p class="text-muted m-t-10">Loading subjects...</p>
                </div>

                {{-- ===== CARD VIEW ===== --}}
                <div id="cardView">
                    <div class="row" id="cardContainer"></div>
                </div>

                {{-- ===== LIST / TABLE VIEW ===== --}}
                <div id="listView" class="d-none">
                    <div class="card">
                        <div class="card-header">
                            <h5>Subject List</h5>
                            <div class="card-header-right">
                                <span class="text-muted f-13" id="listRecordCount"></span>
                            </div>
                        </div>
                        <div class="card-block p-0">
                            <div class="table-responsive">
                                <table class="table table-hover m-b-0" id="subjectTable">
                                    <thead>
                                        <tr>
                                            <th width="50" class="p-l-20">#</th>
                                            <th class="sortable" data-field="name">
                                                SUBJECT <i class="feather icon-chevron-down sort-icon f-12"></i>
                                            </th>
                                            <th class="sortable" data-field="code">
                                                CODE <i class="feather icon-chevron-down sort-icon f-12"></i>
                                            </th>
                                            <th>TEACHER</th>
                                            <th>STATUS</th>
                                            <th class="text-right p-r-20">ACTIONS</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tableBody"></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ===== EMPTY STATE ===== --}}
                <div id="emptyState" class="text-center p-t-40 p-b-40 d-none">
                    <i class="feather icon-book f-40 text-muted"></i>
                    <h6 class="text-muted m-t-15">No subjects found</h6>
                    <p class="text-muted f-13">Try adjusting your search or filter criteria.</p>
                </div>

                {{-- ===== PAGINATION ===== --}}
                <div class="d-flex justify-content-between align-items-center m-t-20 m-b-40" id="paginationWrapper">
                    {{-- <small class="text-muted" id="paginationInfo"></small> --}}
                    <ul class="pagination m-b-0 d-inline-flex" id="paginationLinks"></ul>
                </div>

            </div>
        </div>
    </div>

    {{-- ============================================================
     SHOW MODAL
     ============================================================ --}}
    <div class="modal fade" id="showSubjectModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title f-w-600">
                        <i class="feather icon-book text-c-blue m-r-5"></i> Subject Details
                    </h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body p-0">
                    <table class="table table-borderless m-b-0">
                        <tr>
                            <th width="35%" class="text-muted f-w-600 p-l-20">Name</th>
                            <td id="show_name" class="f-w-600">—</td>
                        </tr>
                        <tr>
                            <th class="text-muted f-w-600 p-l-20">Code</th>
                            <td id="show_code">—</td>
                        </tr>
                        <tr>
                            <th class="text-muted f-w-600 p-l-20">Level</th>
                            <td id="show_level">—</td>
                        </tr>
                        <tr>
                            <th class="text-muted f-w-600 p-l-20">Teacher(s)</th>
                            <td id="show_teachers">—</td>
                        </tr>
                        <tr>
                            <th class="text-muted f-w-600 p-l-20">Description</th>
                            <td id="show_description">—</td>
                        </tr>
                        <tr>
                            <th class="text-muted f-w-600 p-l-20">Notifications</th>
                            <td id="show_notifications">—</td>
                        </tr>
                        <tr>
                            <th class="text-muted f-w-600 p-l-20">Device ID</th>
                            <td id="show_device_id">—</td>
                        </tr>
                        <tr>
                            <th class="text-muted f-w-600 p-l-20">Status</th>
                            <td id="show_status">—</td>
                        </tr>
                        <tr>
                            <th class="text-muted f-w-600 p-l-20">Created At</th>
                            <td id="show_created_at">—</td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {

            /*---------------------------------------------------------------
             | State
             *--------------------------------------------------------------*/
            let currentPage = 1;
            let sortField = 'id';
            let sortOrder = 'desc';
            let searchTimeout = null;

            const blColors = ['b-l-primary', 'b-l-warning', 'b-l-success', 'b-l-danger', 'b-l-info'];
            @can('subject.view')
                const canView = true;
            @else
                const canView = false;
            @endcan
            @can('subject.edit')
                const canEdit = true;
            @else
                const canEdit = false;
            @endcan
            @can('subject.toggle')
                const canToggle = true;
            @else
                const canToggle = false;
            @endcan
            @can('subject.delete')
                const canDelete = true;
            @else
                const canDelete = false;
            @endcan

            /*---------------------------------------------------------------
             | Helpers
             *--------------------------------------------------------------*/
            function teacherNames(teachers) {
                if (!teachers || teachers.length === 0) return '<span class="text-muted">—</span>';
                return teachers.map(t => t.name).join(', ');
            }

            function statusBadge(val) {
                return (val == 1 || val === true) ?
                    `<span class="badge-active"><span class="status-dot dot-active"></span>Active</span>` :
                    `<span class="badge-inactive"><span class="status-dot dot-inactive"></span>Inactive</span>`;
            }

            function actionButtons(s) {
                const archiveIcon = (s.is_active == 1) ? 'icon-toggle-right' : 'icon-toggle-left';
                const archiveTitle = (s.is_active == 1) ? 'Set Inactive' : 'Set Active';
                let btns = '';

                if (canView) {
                    btns += `
            <li>
                <button class="act-view btn-show" data-id="${s.id}" title="View">
                    <i class="feather icon-eye"></i>
                </button>
            </li>`;
                }
                if (canEdit) {
                    btns += `
            <li>
                <a href="/subjects/${s.id}/edit" class="act-edit" title="Edit">
                    <i class="feather icon-edit-2"></i>
                </a>
            </li>`;
                }
                if (canToggle) {
                    btns += `
            <li>
                <button class="act-archive btn-toggle-status"
                    data-id="${s.id}" data-name="${s.name}" data-status="${s.is_active}"
                    title="${archiveTitle}">
                    <i class="feather ${archiveIcon}"></i>
                </button>
            </li>`;
                }
                if (canDelete) {
                    btns += `
            <li>
                <button class="act-delete btn-delete"
                    data-id="${s.id}" data-name="${s.name}" title="Delete">
                    <i class="feather icon-trash-2"></i>
                </button>
            </li>`;
                }
                return btns;
            }

            /*---------------------------------------------------------------
             | AJAX Load
             | isPageChange=true  → silent data swap (pagination/sorting)
             | isPageChange=false → full load with spinner (init/filter change)
             *--------------------------------------------------------------*/
            function loadSubjects(page = 1, isPageChange = false) {
                currentPage = page;

                if (!isPageChange) {
                    // Full load — show spinner, clear everything
                    $('#loadingSpinner').removeClass('d-none');
                    $('#cardContainer, #tableBody').html('');
                    $('#emptyState').addClass('d-none');
                    $('#paginationWrapper').addClass('d-none');
                } else {
                    // Pagination / sort — just dim the data, no layout change
                    $('#cardContainer, #tableBody').css('opacity', '0.4');
                }

                $.ajax({
                    url: '{{ route('subjects.data') }}',
                    method: 'GET',
                    data: {
                        page: page,
                        search: $('#searchInput').val(),
                        is_active: $('#statusFilter').val(),
                        per_page: $('#perPageSelect').val(),
                        sort_field: sortField,
                        sort_order: sortOrder,
                    },
                    success: function(res) {
                        $('#loadingSpinner').addClass('d-none');
                        $('#cardContainer, #tableBody').css('opacity', '1');

                        const from = res.total === 0 ? 0 : (res.current_page - 1) * res.per_page + 1;
                        const to = Math.min(res.current_page * res.per_page, res.total);

                        $('#tableInfo').html(
                            `Showing <strong class="text-c-blue">${to}</strong> of
                     <strong class="text-c-blue">${res.total}</strong> subjects`
                        );
                        $('#listRecordCount').text(`${res.total} records`);

                        if (res.data.length === 0) {
                            $('#emptyState').removeClass('d-none');
                            $('#cardContainer, #tableBody').html('');
                            $('#paginationWrapper').addClass('d-none');
                            return;
                        }

                        $('#emptyState').addClass('d-none');
                        renderCards(res);
                        renderTableRows(res);
                        renderPagination(res);
                        $('#paginationWrapper').removeClass('d-none');
                    },
                    error: function() {
                        $('#loadingSpinner').addClass('d-none');
                        $('#cardContainer, #tableBody').css('opacity', '1');
                        notify('Failed to load subjects. Please try again.', "top", "right", "",
                            "danger", "animated fadeInRight", "animated fadeOutRight");
                    }
                });
            }

            /*---------------------------------------------------------------
             | Render Cards
             *--------------------------------------------------------------*/
            function renderCards(res) {
                let html = '';
                res.data.forEach(function(s, i) {
                    const blClass = blColors[i % blColors.length];

                    html += `
            <div class="col-xl-3 col-md-6">
                <div class="card ${blClass} business-info services">
                    <div class="card-block">
                        <h5 class="m-b-3">${s.name}</h5>
                        <span class="subj-code"># ${s.code}</span>
                        <p class="f-13 m-b-0">
                        ${s.level ? `<i class="feather icon-layers f-12 m-r-5"></i><span class="m-r-20">${s.level.name}</span>` : ''}
                        <i class="feather icon-user f-12 m-r-5"></i>${teacherNames(s.teachers)}</p>
                    </div>
                    <div class="card-footer">
                        ${statusBadge(s.is_active)}
                        <ul class="srv-actions">${actionButtons(s)}</ul>
                    </div>
                </div>
            </div>`;
                });
                $('#cardContainer').html(html);
            }

            /*---------------------------------------------------------------
             | Render Table Rows
             *--------------------------------------------------------------*/
            function renderTableRows(res) {
                let rows = '';
                const start = (res.current_page - 1) * res.per_page;

                res.data.forEach(function(s, i) {
                    const num = String(start + i + 1).padStart(2, '0');

                    rows += `
            <tr>
                <td class="p-l-20 text-muted f-w-600">${num}</td>
                <td><strong>${s.name}</strong></td>
                <td><span class="text-c-blue f-w-600">${s.code}</span></td>
                <td>${teacherNames(s.teachers)}</td>
                <td>${statusBadge(s.is_active)}</td>
                <td class="text-right p-r-20">
                    <ul class="srv-actions justify-end">${actionButtons(s)}</ul>
                </td>
            </tr>`;
                });
                $('#tableBody').html(rows);
            }

            /*---------------------------------------------------------------
             | Render Pagination
             *--------------------------------------------------------------*/
            function renderPagination(res) {
                let links = '';
                links += `<li class="page-item ${res.current_page === 1 ? 'disabled' : ''}">
            <a class="page-link page-btn" data-page="${res.current_page - 1}" href="javascript:void(0)">&laquo;</a>
        </li>`;
                for (let i = 1; i <= res.last_page; i++) {
                    if (i === 1 || i === res.last_page ||
                        (i >= res.current_page - 2 && i <= res.current_page + 2)) {
                        links += `<li class="page-item ${i === res.current_page ? 'active' : ''}">
                    <a class="page-link page-btn" data-page="${i}" href="javascript:void(0)">${i}</a>
                </li>`;
                    } else if (i === res.current_page - 3 || i === res.current_page + 3) {
                        links += `<li class="page-item disabled">
                    <a class="page-link" href="javascript:void(0)">...</a>
                </li>`;
                    }
                }
                links += `<li class="page-item ${res.current_page === res.last_page ? 'disabled' : ''}">
            <a class="page-link page-btn" data-page="${res.current_page + 1}" href="javascript:void(0)">&raquo;</a>
        </li>`;
                $('#paginationLinks').html(links);
            }

            /*---------------------------------------------------------------
             | View Toggle
             *--------------------------------------------------------------*/
            $('#cardViewBtn').on('click', function() {
                $('#cardView').removeClass('d-none');
                $('#listView').addClass('d-none');
                $(this).addClass('active');
                $('#listViewBtn').removeClass('active');
            });
            $('#listViewBtn').on('click', function() {
                $('#listView').removeClass('d-none');
                $('#cardView').addClass('d-none');
                $(this).addClass('active');
                $('#cardViewBtn').removeClass('active');
            });

            /*---------------------------------------------------------------
             | Filter Events
             *--------------------------------------------------------------*/
            $('#searchInput').on('input', function() {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(() => loadSubjects(1), 400);
            });
            $('#statusFilter').on('change', function() {
                loadSubjects(1);
            });
            $('#perPageSelect').on('change', function() {
                loadSubjects(1);
            });
            $('#resetFilterBtn').on('click', function() {
                $('#searchInput').val('');
                $('#statusFilter').val('');
                $('#perPageSelect').val('10');
                loadSubjects(1);
            });

            /*---------------------------------------------------------------
             | Sorting
             *--------------------------------------------------------------*/
            $(document).on('click', '.sortable', function() {
                const field = $(this).data('field');
                sortOrder = sortField === field ? (sortOrder === 'asc' ? 'desc' : 'asc') : 'asc';
                sortField = field;
                $('.sort-icon').removeClass('icon-chevron-up').addClass('icon-chevron-down');
                $(this).find('.sort-icon')
                    .removeClass('icon-chevron-up icon-chevron-down')
                    .addClass(sortOrder === 'asc' ? 'icon-chevron-up' : 'icon-chevron-down');
                loadSubjects(1, true);
            });

            /*---------------------------------------------------------------
             | Pagination
             *--------------------------------------------------------------*/
            $(document).on('click', '.page-btn', function() {
                const p = parseInt($(this).data('page'));
                if (p > 0) loadSubjects(p, true);
            });

            /*---------------------------------------------------------------
             | Show Modal
             *--------------------------------------------------------------*/
            $(document).on('click', '.btn-show', function() {
                const id = $(this).data('id');
                $.ajax({
                    url: `/subjects/${id}`,
                    method: 'GET',
                    success: function(res) {
                        const s = res.data;
                        $('#show_name').text(s.name);
                        $('#show_code').html(
                            `<span class="text-c-blue f-w-600">${s.code}</span>`);
                        $('#show_level').text(s.level ? s.level.name : '—');
                        $('#show_teachers').html(teacherNames(s.teachers));
                        $('#show_description').text(s.description || '—');

                        var notifs = [];
                        if (s.sms_enroll_student) notifs.push('SMS on enrollment');
                        if (s.notify_teacher_enroll) notifs.push('Notify teacher on enroll');
                        if (s.notify_teacher_zero_fee) notifs.push('Notify teacher on zero fee');
                        $('#show_notifications').html(notifs.length ? notifs.join('<br>') : '—');
                        $('#show_device_id').text(s.attendance_device_id || '—');

                        $('#show_status').html(statusBadge(s.is_active));
                        $('#show_created_at').text(
                            new Date(s.created_at).toLocaleDateString('en-GB', {
                                day: '2-digit',
                                month: 'short',
                                year: 'numeric'
                            })
                        );
                        $('#showSubjectModal').modal('show');
                    },
                    error: function() {
                        notify('Failed to load subject details.', "top", "right", "", "danger",
                            "animated fadeInRight", "animated fadeOutRight");
                    }
                });
            });

            // Fix aria-hidden focus warning on modal close
            $('#showSubjectModal').on('hide.bs.modal', function () {
                document.activeElement.blur();
            });

            /*---------------------------------------------------------------
             | Toggle Status (SweetAlert)
             *--------------------------------------------------------------*/
            $(document).on('click', '.btn-toggle-status', function() {
                var id = $(this).data('id');
                var current = $(this).data('status');
                var name = $(this).data('name');
                var action = (current == 1) ? 'deactivate' : 'activate';

                SIS.confirm({
                    title: action.charAt(0).toUpperCase() + action.slice(1) + " Subject?",
                    text: "Are you sure you want to " + action + " '" + name + "'?",
                    confirmText: "Yes, " + action + " it",
                    cancelText: "Cancel"
                }, function() {
                    $.ajax({
                        url: '/subjects/' + id + '/toggle',
                        method: 'POST',
                        data: {
                            _method: 'PATCH',
                            _token: '{{ csrf_token() }}',
                            is_active: (current == 1) ? 0 : 1,
                        },
                        success: function(res) {
                            swal("Updated!", res.message || "Status updated.",
                                "success");
                            loadSubjects(currentPage);
                        },
                        error: function(xhr) {
                            swal("Error!", xhr.responseJSON?.message ||
                                "Failed to update status.", "error");
                        }
                    });
                });
            });

            /*---------------------------------------------------------------
             | Delete (SweetAlert)
             *--------------------------------------------------------------*/
            $(document).on('click', '.btn-delete', function() {
                var id = $(this).data('id');
                var name = $(this).data('name');

                SIS.confirm({
                    title: "Delete Subject?",
                    text: "Are you sure you want to delete '" + name +
                        "'? This action cannot be undone.",
                    confirmText: "Yes, delete it",
                    cancelText: "Cancel"
                }, function() {
                    $.ajax({
                        url: '/subjects/' + id,
                        method: 'POST',
                        data: {
                            _method: 'DELETE',
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(res) {
                            swal("Deleted!", res.message || "Subject deleted.",
                                "success");
                            loadSubjects(currentPage);
                        },
                        error: function(xhr) {
                            swal("Error!", xhr.responseJSON?.message ||
                                "Failed to delete subject.", "error");
                        }
                    });
                });
            });

            /*---------------------------------------------------------------
             | Export
             *--------------------------------------------------------------*/
            $(document).on('click', '.export-btn', function(e) {
                e.preventDefault();
                const params = new URLSearchParams({
                    type: $(this).data('type'),
                    search: $('#searchInput').val(),
                    is_active: $('#statusFilter').val(),
                });
                window.location.href = `{{ route('subjects.export') }}?${params.toString()}`;
            });

            /*---------------------------------------------------------------
             | Init
             *--------------------------------------------------------------*/
            SIS.showFlash();
            loadSubjects();
        });
    </script>
@endpush
