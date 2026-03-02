@extends('layouts.app')

@section('title', 'Edit Subject')

@section('content')
<div class="page-body">
    <div class="row">
        <div class="col-sm-12">

            {{-- Breadcrumb --}}
            <div class="page-header card">
                <div class="row align-items-end">
                    <div class="col-lg-8">
                        <div class="page-header-title">
                            <i class="feather icon-book bg-c-yellow"></i>
                            <div class="d-inline">
                                <h5>Edit Subject</h5>
                                <span>Update subject information</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="page-header-breadcrumb">
                            <ul class="breadcrumb-title">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('dashboard') }}"><i class="feather icon-home"></i></a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="{{ route('subjects.index') }}">Subjects</a>
                                </li>
                                <li class="breadcrumb-item active">Edit</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Loading state before AJAX fills the form --}}
            <div id="pageLoader" class="text-center p-t-30 p-b-30">
                <i class="feather icon-loader spin f-30"></i>
                <p class="text-muted m-t-10">Loading subject data...</p>
            </div>

            {{-- Form Card (hidden until data loaded) --}}
            <div class="card d-none" id="editCard">
                <div class="card-header">
                    <h5>Subject Information</h5>
                    <div class="card-header-right">
                        <a href="{{ route('subjects.index') }}" class="btn btn-secondary btn-sm">
                            <i class="feather icon-arrow-left"></i> Back to List
                        </a>
                    </div>
                </div>
                <div class="card-block">

                    <div id="formAlertError" class="alert alert-danger d-none"></div>

                    <form id="editSubjectForm">
                        @csrf
                        @method('PUT')

                        <div class="row">

                            {{-- Name --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Subject Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        placeholder="e.g. Mathematics" maxlength="255">
                                    <span class="text-danger f-12" id="error_name"></span>
                                </div>
                            </div>

                            {{-- Code --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="code">Subject Code <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="code" name="code"
                                        placeholder="e.g. MATH101" maxlength="50"
                                        style="text-transform: uppercase;">
                                    <span class="text-danger f-12" id="error_code"></span>
                                </div>
                            </div>

                            {{-- Description --}}
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="description">Description</label>
                                    <textarea class="form-control" id="description" name="description"
                                        rows="4" placeholder="Optional description..."></textarea>
                                    <span class="text-danger f-12" id="error_description"></span>
                                </div>
                            </div>

                            {{-- Status --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Status</label>
                                    <div>
                                        <div class="checkbox-fade fade-in-primary d-inline-block m-r-20">
                                            <label>
                                                <input type="radio" name="is_active" id="status_active" value="1">
                                                <span class="cr">
                                                    <i class="cr-icon feather icon-check txt-primary"></i>
                                                </span>
                                                <span class="text-success">Active</span>
                                            </label>
                                        </div>
                                        <div class="checkbox-fade fade-in-danger d-inline-block">
                                            <label>
                                                <input type="radio" name="is_active" id="status_inactive" value="0">
                                                <span class="cr">
                                                    <i class="cr-icon feather icon-check txt-danger"></i>
                                                </span>
                                                <span class="text-danger">Inactive</span>
                                            </label>
                                        </div>
                                    </div>
                                    <span class="text-danger f-12" id="error_is_active"></span>
                                </div>
                            </div>

                        </div>{{-- /row --}}

                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-warning" id="submitBtn">
                                    <i class="feather icon-save"></i> Update Subject
                                </button>
                                <a href="{{ route('subjects.index') }}" class="btn btn-secondary m-l-10">
                                    <i class="feather icon-x"></i> Cancel
                                </a>
                            </div>
                        </div>

                    </form>

                </div>{{-- /card-block --}}
            </div>{{-- /card --}}

        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function () {

    // Extract subject ID from URL: /subjects/{id}/edit
    const pathParts = window.location.pathname.split('/');
    const subjectId = pathParts[pathParts.length - 2];

    /*
    |--------------------------------------------------------------------------
    | Load existing subject data
    |--------------------------------------------------------------------------
    */
    $.ajax({
        url:     `/subjects/${subjectId}/edit`,
        method:  'GET',
        success: function (res) {
            const s = res.data;

            $('#name').val(s.name);
            $('#code').val(s.code);
            $('#description').val(s.description || '');

            if (parseInt(s.is_active) === 1) {
                $('#status_active').prop('checked', true);
            } else {
                $('#status_inactive').prop('checked', true);
            }

            $('#pageLoader').addClass('d-none');
            $('#editCard').removeClass('d-none');
        },
        error: function () {
            $('#pageLoader').html(`
                <div class="alert alert-danger">
                    Failed to load subject. <a href="{{ route('subjects.index') }}">Go back</a>
                </div>
            `);
        }
    });

    // Auto uppercase code field
    $('#code').on('input', function () {
        $(this).val($(this).val().toUpperCase());
    });

    // Clear errors on input
    $('input, textarea').on('input change', function () {
        const field = $(this).attr('name');
        if (field) {
            $(`#error_${field}`).text('');
            $(this).removeClass('is-invalid');
        }
    });

    /*
    |--------------------------------------------------------------------------
    | Submit Update
    |--------------------------------------------------------------------------
    */
    $('#editSubjectForm').on('submit', function (e) {
        e.preventDefault();

        // Clear previous errors
        $('.text-danger.f-12').text('');
        $('input, textarea').removeClass('is-invalid');
        $('#formAlertError').addClass('d-none').text('');

        const $btn = $('#submitBtn');
        $btn.prop('disabled', true).html('<i class="feather icon-loader spin"></i> Updating...');

        $.ajax({
            url:    `/subjects/${subjectId}`,
            method: 'POST',
            data:   $(this).serialize(), // includes _method=PUT
            success: function (res) {
                toastr.success(res.message || 'Subject updated successfully.');
                window.location.href = '{{ route("subjects.index") }}';
            },
            error: function (xhr) {
                $btn.prop('disabled', false).html('<i class="feather icon-save"></i> Update Subject');

                if (xhr.status === 422) {
                    const errors = xhr.responseJSON.errors;
                    $.each(errors, function (field, messages) {
                        $(`#error_${field}`).text(messages[0]);
                        $(`#${field}`).addClass('is-invalid');
                    });
                } else {
                    $('#formAlertError')
                        .removeClass('d-none')
                        .text(xhr.responseJSON?.message || 'Something went wrong. Please try again.');
                }
            }
        });
    });

});
</script>
@endpush