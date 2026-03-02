@extends('layouts.app')

@section('title', 'Add Subject')

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
                    <h4 class="f-w-600 m-b-5">Add Subject</h4>
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
                            <a href="{{ route('subjects.index') }}">Subject</a>
                        </li>
                        <li class="breadcrumb-item" style="float:left;">
                            <a href="#!">Add</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Page-header end -->

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5><i class="feather icon-book m-r-5 text-c-blue"></i> Subject Information</h5>
                    <div class="card-header-right">
                        <a href="{{ route('subjects.index') }}" class="btn btn-light btn-sm">
                            <i class="feather icon-arrow-left m-r-5"></i> Back to List
                        </a>
                    </div>
                </div>
                <div class="card-block">

                    {{-- Server-side validation errors --}}
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong><i class="feather icon-alert-circle m-r-5"></i> Please fix the following errors:</strong>
                            <ul class="m-b-0 m-t-5 p-l-20">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="close" data-dismiss="alert">
                                <span>&times;</span>
                            </button>
                        </div>
                    @endif

                    <form id="createSubjectForm"
                          action="{{ route('subjects.store') }}"
                          method="POST"
                          autocomplete="off">
                        @csrf

                        <div class="row">

                            {{-- Subject Name --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="f-w-600">
                                        Subject Name
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text"
                                           name="name"
                                           id="name"
                                           class="form-control @error('name') is-invalid @enderror"
                                           placeholder="e.g. Mathematics"
                                           value="{{ old('name') }}"
                                           required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="form-text text-muted">Enter the full subject name.</small>
                                </div>
                            </div>

                            {{-- Subject Code --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="f-w-600">
                                        Subject Code
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text"
                                           name="code"
                                           id="code"
                                           class="form-control @error('code') is-invalid @enderror"
                                           placeholder="e.g. MTH-101"
                                           value="{{ old('code') }}"
                                           required>
                                    @error('code')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="form-text text-muted">Must be unique. Used as subject identifier.</small>
                                </div>
                            </div>

                            {{-- Description --}}
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="f-w-600">Description</label>
                                    <textarea name="description"
                                              id="description"
                                              class="form-control @error('description') is-invalid @enderror"
                                              rows="4"
                                              placeholder="Brief description of what this subject covers...">{{ old('description') }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="form-text text-muted">
                                        Optional. <span id="charCount" class="f-w-600">0</span> / 500 characters.
                                    </small>
                                </div>
                            </div>

                            {{-- Status --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="f-w-600">Status</label>
                                    <div class="status-toggle-wrap">
                                        <div class="subj-status-option @if(old('is_active', '1') == '1') active @endif"
                                             data-value="1" id="statusActive">
                                            <i class="feather icon-check-circle m-r-5"></i> Active
                                        </div>
                                        <div class="subj-status-option @if(old('is_active', '1') == '0') active @endif"
                                             data-value="0" id="statusInactive">
                                            <i class="feather icon-x-circle m-r-5"></i> Inactive
                                        </div>
                                        <input type="hidden" name="is_active" id="isActiveInput"
                                               value="{{ old('is_active', '1') }}">
                                    </div>
                                    <small class="form-text text-muted">Active subjects are visible across the system.</small>
                                </div>
                            </div>

                        </div>{{-- end .row --}}

                        {{-- Form Actions --}}
                        <div class="form-actions-bar">
                            <button type="submit" class="btn btn-primary" id="submitBtn">
                                <i class="feather icon-save m-r-5"></i> Save Subject
                            </button>
                            <button type="button" class="btn btn-light m-l-10" id="resetBtn">
                                <i class="feather icon-rotate-ccw m-r-5"></i> Reset
                            </button>
                            <a href="{{ route('subjects.index') }}" class="btn btn-light m-l-10">
                                <i class="feather icon-x m-r-5"></i> Cancel
                            </a>
                        </div>

                    </form>
                </div>{{-- end .card-block --}}
            </div>{{-- end .card --}}
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function () {

    /*---------------------------------------------------------------
     | Character counter for description
     *--------------------------------------------------------------*/
    $('#description').on('input', function () {
        const len = $(this).val().length;
        $('#charCount').text(len);
        if (len > 450) {
            $('#charCount').addClass('text-danger').removeClass('text-c-blue');
        } else {
            $('#charCount').removeClass('text-danger').addClass('text-c-blue');
        }
    });

    // Trigger on load (for old() values)
    $('#description').trigger('input');

    /*---------------------------------------------------------------
     | Status toggle
     *--------------------------------------------------------------*/
    $('.subj-status-option').on('click', function () {
        $('.subj-status-option').removeClass('active');
        $(this).addClass('active');
        $('#isActiveInput').val($(this).data('value'));
    });

    /*---------------------------------------------------------------
     | Reset button
     *--------------------------------------------------------------*/
    $('#resetBtn').on('click', function () {
        $('#createSubjectForm')[0].reset();
        $('#charCount').text('0').removeClass('text-danger text-c-blue');
        // Reset status to Active
        $('.subj-status-option').removeClass('active');
        $('#statusActive').addClass('active');
        $('#isActiveInput').val('1');
        // Clear validation states
        $('.form-control').removeClass('is-invalid is-valid');
        $('.invalid-feedback').hide();
    });

    /*---------------------------------------------------------------
     | Client-side validation before submit
     *--------------------------------------------------------------*/
    $('#createSubjectForm').on('submit', function (e) {
        let valid = true;

        // Name
        const name = $('#name').val().trim();
        if (!name) {
            $('#name').addClass('is-invalid');
            valid = false;
        } else {
            $('#name').removeClass('is-invalid').addClass('is-valid');
        }

        // Code
        const code = $('#code').val().trim();
        if (!code) {
            $('#code').addClass('is-invalid');
            valid = false;
        } else {
            $('#code').removeClass('is-invalid').addClass('is-valid');
        }

        if (!valid) {
            e.preventDefault();
            notify('Please fill in all required fields.', "top", "right", "", "warning", "animated fadeInRight", "animated fadeOutRight");
            return false;
        }

        // Show loading state on button
        $('#submitBtn')
            .prop('disabled', true)
            .html('<i class="feather icon-loader spin m-r-5"></i> Saving...');
    });

    /*---------------------------------------------------------------
     | Auto-uppercase subject code
     *--------------------------------------------------------------*/
    $('#code').on('input', function () {
        const pos = this.selectionStart;
        $(this).val($(this).val().toUpperCase());
        this.setSelectionRange(pos, pos);
    });

});
</script>
@endpush