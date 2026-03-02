@extends('layouts.app')

@section('title', $title ?? 'Subjects')

@push('styles')
<link rel="stylesheet" href="{{ asset('adminend/css/subject.css') }}">
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
                            <button id="resetFilterBtn" class="btn btn-light"
                                title="Reset filters">
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
                        <li><a class="dropdown-item export-btn" href="#" data-type="xlsx">
                            <i class="feather icon-file m-r-5"></i> Excel (.xlsx)
                        </a></li>
                        <li><a class="dropdown-item export-btn" href="#" data-type="csv">
                            <i class="feather icon-file-text m-r-5"></i> CSV
                        </a></li>
                        <li><a class="dropdown-item export-btn" href="#" data-type="pdf">
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
                                    <th>DESCRIPTION</th>
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
        <div class="d-flex justify-content-between align-items-center m-t-20 m-b-40 d-none" id="paginationWrapper">
            <small class="text-muted" id="paginationInfo"></small>
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
                        <th class="text-muted f-w-600 p-l-20">Description</th>
                        <td id="show_description">—</td>
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

{{-- ============================================================
     DELETE CONFIRM MODAL
     ============================================================ --}}
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title f-w-600 text-danger">
                    <i class="feather icon-trash-2 m-r-5"></i> Confirm Delete
                </h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
                <p class="m-b-5">Are you sure you want to delete</p>
                <p><strong id="delete_subject_name" class="text-danger"></strong>?</p>
                <p class="text-muted f-12 m-b-0">This action cannot be undone.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">
                    Cancel
                </button>
                <button type="button" class="btn btn-danger btn-sm" id="confirmDeleteBtn">
                    <i class="feather icon-trash-2 m-r-5"></i> Delete
                </button>
            </div>
        </div>
    </div>
</div>

{{-- ============================================================
     TOGGLE STATUS CONFIRM MODAL
     ============================================================ --}}
<div class="modal fade" id="toggleStatusModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title f-w-600">
                    <i class="feather icon-archive m-r-5"></i> Change Status
                </h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
                <p class="m-b-5" id="toggleStatusMsg"></p>
                <p><strong id="toggle_subject_name" class="text-c-blue"></strong>?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">
                    Cancel
                </button>
                <button type="button" class="btn btn-warning btn-sm" id="confirmToggleBtn">
                    <i class="feather icon-archive m-r-5"></i> Confirm
                </button>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
$(document).ready(function () {

    /*---------------------------------------------------------------
     | State
     *--------------------------------------------------------------*/
    let currentPage   = 1;
    let sortField     = 'id';
    let sortOrder     = 'desc';
    let searchTimeout = null;
    let deleteId      = null;
    let toggleId      = null;
    let toggleCurrent = null;

    const blColors  = ['b-l-primary','b-l-warning','b-l-success','b-l-danger','b-l-info'];
    @can('subject.view')   const canView   = true; @else const canView   = false; @endcan
    @can('subject.edit')   const canEdit   = true; @else const canEdit   = false; @endcan
    @can('subject.toggle') const canToggle = true; @else const canToggle = false; @endcan
    @can('subject.delete') const canDelete = true; @else const canDelete = false; @endcan

    /*---------------------------------------------------------------
     | Helpers
     *--------------------------------------------------------------*/
    function statusBadge(val) {
        return (val == 1 || val === true)
            ? `<span class="badge-active"><span class="status-dot dot-active"></span>Active</span>`
            : `<span class="badge-inactive"><span class="status-dot dot-inactive"></span>Inactive</span>`;
    }

    function actionButtons(s) {
        const archiveIcon  = (s.is_active == 1) ? 'icon-toggle-right' : 'icon-toggle-left';
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
     *--------------------------------------------------------------*/
    function loadSubjects(page = 1) {
        currentPage = page;
        $('#loadingSpinner').removeClass('d-none');
        $('#cardContainer, #tableBody').html('');
        $('#emptyState').addClass('d-none');
        $('#paginationWrapper').addClass('d-none');

        $.ajax({
            url:    '{{ route("subjects.data") }}',
            method: 'GET',
            data: {
                page:       page,
                search:     $('#searchInput').val(),
                is_active:  $('#statusFilter').val(),
                per_page:   $('#perPageSelect').val(),
                sort_field: sortField,
                sort_order: sortOrder,
            },
            success: function (res) {
                $('#loadingSpinner').addClass('d-none');

                const from = res.total === 0 ? 0 : (res.current_page - 1) * res.per_page + 1;
                const to   = Math.min(res.current_page * res.per_page, res.total);

                $('#tableInfo').html(
                    `Showing <strong class="text-c-blue">${to}</strong> of
                     <strong class="text-c-blue">${res.total}</strong> subjects`
                );
                $('#listRecordCount').text(`${res.total} records`);


                if (res.data.length === 0) {
                    $('#emptyState').removeClass('d-none');
                    return;
                }

                renderCards(res);
                renderTableRows(res);
                renderPagination(res);
                $('#paginationWrapper').removeClass('d-none');
            },
            error: function () {
                $('#loadingSpinner').addClass('d-none');
                notify('Failed to load subjects. Please try again.', "top", "right", "", "danger", "animated fadeInRight", "animated fadeOutRight");
            }
        });
    }

    /*---------------------------------------------------------------
     | Render Cards
     *--------------------------------------------------------------*/
    function renderCards(res) {
        let html = '';
        res.data.forEach(function (s, i) {
            const blClass = blColors[i % blColors.length];
            const desc    = s.description
                ? (s.description.length > 100
                    ? s.description.substring(0, 100) + '...'
                    : s.description)
                : '<span class="text-muted">—</span>';

            html += `
            <div class="col-xl-3 col-md-6">
                <div class="card ${blClass} business-info services">
                    <div class="card-block">
                        <h5 class="m-b-3">${s.name}</h5>
                        <span class="subj-code"># ${s.code}</span>
                        <p class="text-muted f-13 m-b-0">${desc}</p>
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

        res.data.forEach(function (s, i) {
            const num  = String(start + i + 1).padStart(2, '0');
            const desc = s.description
                ? (s.description.length > 70
                    ? s.description.substring(0, 70) + '...'
                    : s.description)
                : '<span class="text-muted">—</span>';

            rows += `
            <tr>
                <td class="p-l-20 text-muted f-w-600">${num}</td>
                <td><strong>${s.name}</strong></td>
                <td><span class="text-c-blue f-w-600">${s.code}</span></td>
                <td class="text-muted f-13">${desc}</td>
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
            <a class="page-link page-btn" data-page="${res.current_page - 1}" href="#">&laquo;</a>
        </li>`;
        for (let i = 1; i <= res.last_page; i++) {
            if (i === 1 || i === res.last_page ||
                (i >= res.current_page - 2 && i <= res.current_page + 2)) {
                links += `<li class="page-item ${i === res.current_page ? 'active' : ''}">
                    <a class="page-link page-btn" data-page="${i}" href="#">${i}</a>
                </li>`;
            } else if (i === res.current_page - 3 || i === res.current_page + 3) {
                links += `<li class="page-item disabled">
                    <a class="page-link" href="#">...</a>
                </li>`;
            }
        }
        links += `<li class="page-item ${res.current_page === res.last_page ? 'disabled' : ''}">
            <a class="page-link page-btn" data-page="${res.current_page + 1}" href="#">&raquo;</a>
        </li>`;
        $('#paginationLinks').html(links);
    }

    /*---------------------------------------------------------------
     | View Toggle
     *--------------------------------------------------------------*/
    $('#cardViewBtn').on('click', function () {
        $('#cardView').removeClass('d-none');
        $('#listView').addClass('d-none');
        $(this).addClass('active');
        $('#listViewBtn').removeClass('active');
    });
    $('#listViewBtn').on('click', function () {
        $('#listView').removeClass('d-none');
        $('#cardView').addClass('d-none');
        $(this).addClass('active');
        $('#cardViewBtn').removeClass('active');
    });

    /*---------------------------------------------------------------
     | Filter Events
     *--------------------------------------------------------------*/
    $('#searchInput').on('input', function () {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(() => loadSubjects(1), 400);
    });
    $('#statusFilter').on('change', function () { loadSubjects(1); });
    $('#perPageSelect').on('change', function () { loadSubjects(1); });
    $('#resetFilterBtn').on('click', function () {
        $('#searchInput').val('');
        $('#statusFilter').val('');
        $('#perPageSelect').val('10');
        loadSubjects(1);
    });

    /*---------------------------------------------------------------
     | Sorting
     *--------------------------------------------------------------*/
    $(document).on('click', '.sortable', function () {
        const field = $(this).data('field');
        sortOrder   = sortField === field ? (sortOrder === 'asc' ? 'desc' : 'asc') : 'asc';
        sortField   = field;
        $('.sort-icon').removeClass('icon-chevron-up').addClass('icon-chevron-down');
        $(this).find('.sort-icon')
            .removeClass('icon-chevron-up icon-chevron-down')
            .addClass(sortOrder === 'asc' ? 'icon-chevron-up' : 'icon-chevron-down');
        loadSubjects(1);
    });

    /*---------------------------------------------------------------
     | Pagination
     *--------------------------------------------------------------*/
    $(document).on('click', '.page-btn', function (e) {
        e.preventDefault();
        const p = parseInt($(this).data('page'));
        if (p > 0) loadSubjects(p);
    });

    /*---------------------------------------------------------------
     | Show Modal
     *--------------------------------------------------------------*/
    $(document).on('click', '.btn-show', function () {
        const id = $(this).data('id');
        $.ajax({
            url: `/subjects/${id}`,
            method: 'GET',
            success: function (res) {
                const s = res.data;
                $('#show_name').text(s.name);
                $('#show_code').html(`<span class="text-c-blue f-w-600">${s.code}</span>`);
                $('#show_description').text(s.description || '—');
                $('#show_status').html(statusBadge(s.is_active));
                $('#show_created_at').text(
                    new Date(s.created_at).toLocaleDateString('en-GB', {
                        day: '2-digit', month: 'short', year: 'numeric'
                    })
                );
                $('#showSubjectModal').modal('show');
            },
            error: function () {
                notify('Failed to load subject details.', "top", "right", "", "danger", "animated fadeInRight", "animated fadeOutRight");
            }
        });
    });

    /*---------------------------------------------------------------
     | Toggle Status
     *--------------------------------------------------------------*/
    $(document).on('click', '.btn-toggle-status', function () {
        toggleId      = $(this).data('id');
        toggleCurrent = $(this).data('status');
        const name   = $(this).data('name');
        const action = (toggleCurrent == 1) ? 'set to Inactive' : 'set to Active';
        $('#toggle_subject_name').text(name);
        $('#toggleStatusMsg').text(`Are you sure you want to ${action}`);
        $('#toggleStatusModal').modal('show');
    });

    $('#confirmToggleBtn').on('click', function () {
        if (!toggleId) return;
        const $btn = $(this);
        $btn.prop('disabled', true).html('<i class="feather icon-loader spin"></i>');
        $.ajax({
            url:    `/subjects/${toggleId}`,
            method: 'POST',
            data: {
                _method:   'PUT',
                _token:    '{{ csrf_token() }}',
                is_active: (toggleCurrent == 1) ? 0 : 1,
                _toggle:   1,
            },
            success: function (res) {
                $('#toggleStatusModal').modal('hide');
                notify(res.message || 'Status updated.', "top", "right", "", "success", "animated fadeInRight", "animated fadeOutRight");
                loadSubjects(currentPage);
            },
            error: function (xhr) {
                $('#toggleStatusModal').modal('hide');
                notify(xhr.responseJSON?.message || 'Failed to update status.', "top", "right", "", "danger", "animated fadeInRight", "animated fadeOutRight");
            },
            complete: function () {
                $btn.prop('disabled', false)
                    .html('<i class="feather icon-archive m-r-5"></i> Confirm');
                toggleId = null;
                toggleCurrent = null;
            }
        });
    });

    /*---------------------------------------------------------------
     | Delete
     *--------------------------------------------------------------*/
    $(document).on('click', '.btn-delete', function () {
        deleteId = $(this).data('id');
        $('#delete_subject_name').text($(this).data('name'));
        $('#deleteModal').modal('show');
    });

    $('#confirmDeleteBtn').on('click', function () {
        if (!deleteId) return;
        const $btn = $(this);
        $btn.prop('disabled', true).html('<i class="feather icon-loader spin"></i>');
        $.ajax({
            url:    `/subjects/${deleteId}`,
            method: 'POST',
            data: { _method: 'DELETE', _token: '{{ csrf_token() }}' },
            success: function (res) {
                $('#deleteModal').modal('hide');
                notify(res.message || 'Subject deleted.', "top", "right", "", "success", "animated fadeInRight", "animated fadeOutRight");
                loadSubjects(currentPage);
            },
            error: function (xhr) {
                $('#deleteModal').modal('hide');
                notify(xhr.responseJSON?.message || 'Failed to delete subject.', "top", "right", "", "danger", "animated fadeInRight", "animated fadeOutRight");
            },
            complete: function () {
                $btn.prop('disabled', false)
                    .html('<i class="feather icon-trash-2 m-r-5"></i> Delete');
                deleteId = null;
            }
        });
    });

    /*---------------------------------------------------------------
     | Export
     *--------------------------------------------------------------*/
    $(document).on('click', '.export-btn', function (e) {
        e.preventDefault();
        const params = new URLSearchParams({
            type:      $(this).data('type'),
            search:    $('#searchInput').val(),
            is_active: $('#statusFilter').val(),
        });
        window.location.href = `/subjects/export?${params.toString()}`;
    });

    /*---------------------------------------------------------------
     | Init
     *--------------------------------------------------------------*/
    loadSubjects();
});
</script>
@endpush