@extends('layouts.app')

@section('title', $title ?? 'Add Subject')

@push('styles')
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

                        {{-- SweetAlert flash (picked up by SIS.showFlash) --}}
                        @if (session('success'))
                            <div id="sis-flash-success" data-message="{{ session('success') }}"></div>
                        @endif

                        {{-- Server-side validation errors --}}
                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong><i class="feather icon-alert-circle m-r-5"></i> Please fix the following
                                    errors:</strong>
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

                        <form id="createSubjectForm" action="{{ route('subjects.store') }}" method="POST"
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
                                        <input type="text" name="name" id="name"
                                            class="form-control @error('name') is-invalid @enderror"
                                            placeholder="e.g. Mathematics" value="{{ old('name') }}" required>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="form-text text-muted">Enter the full subject name.</small>
                                    </div>
                                </div>

                                {{-- Subject Code --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="f-w-600">Subject Code</label>
                                        <input type="text" name="code" id="code"
                                            class="form-control @error('code') is-invalid @enderror"
                                            placeholder="e.g. MTH-101" value="{{ old('code') }}">
                                        @error('code')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="form-text text-muted">Optional. Must be unique if provided.</small>
                                    </div>
                                </div>

                                {{-- Assign Teachers --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="f-w-600">
                                            Assign Teacher(s)
                                            <span class="text-danger">*</span>
                                        </label>
                                        <select name="teacher_ids[]" id="teacher_ids"
                                            class="form-control @error('teacher_ids') is-invalid @enderror" multiple required>
                                            @foreach ($teachers as $teacher)
                                                <option value="{{ $teacher->id }}"
                                                    {{ in_array($teacher->id, old('teacher_ids', [])) ? 'selected' : '' }}>
                                                    {{ $teacher->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('teacher_ids')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="form-text text-muted">Search and assign one or more teachers.</small>
                                    </div>
                                </div>

                                {{-- Status --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="f-w-600">Status</label>
                                        <div class="status-toggle-wrap d-flex align-items-center">
                                            <input type="checkbox" id="statusSwitch" class="js-switch"
                                                @if(old('is_active', '1') == '1') checked @endif>
                                            <span class="m-l-10 status-label f-w-600">
                                                {{ old('is_active', '1') == '1' ? 'Active' : 'Inactive' }}
                                            </span>
                                            <input type="hidden" name="is_active" id="isActiveInput"
                                                value="{{ old('is_active', '1') }}">
                                        </div>
                                        <small class="form-text text-muted">Active subjects are visible across the
                                            system.</small>
                                    </div>
                                </div>

                                {{-- Description --}}
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="f-w-600">Description</label>
                                        <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror"
                                            rows="4" placeholder="Brief description of what this subject covers...">{{ old('description') }}</textarea>
                                        @error('description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="form-text text-muted">Optional.</small>
                                    </div>
                                </div>

                            </div>{{-- end .row --}}

                            {{-- Form Actions --}}
                            <input type="hidden" name="save_action" id="saveAction" value="save">
                            <div class="form-actions-bar">
                                <button type="submit" class="btn btn-primary" id="submitBtn">
                                    <i class="feather icon-save m-r-5"></i> Save Subject
                                </button>
                                <button type="submit" class="btn btn-success" id="submitAddAnotherBtn"
                                    onclick="document.getElementById('saveAction').value='save_add_another'">
                                    <i class="feather icon-plus m-r-5"></i> Save & Add Another
                                </button>
                                <button type="reset" class="btn btn-light">
                                    <i class="feather icon-rotate-ccw m-r-5"></i> Reset
                                </button>
                                <a href="{{ route('subjects.index') }}" class="btn btn-light">
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
        $(document).ready(function() {

            // Select2 — Teacher dropdown (multiple)
            $('#teacher_ids').select2({
                placeholder: '— Select Teacher(s) —',
                allowClear: true,
                width: '100%'
            });

            // Switchery — Status toggle
            var statusEl = document.getElementById('statusSwitch');
            var switchery = new Switchery(statusEl, { size: 'small', color: '#4680ff' });
            statusEl.addEventListener('change', function () {
                var isActive = this.checked ? '1' : '0';
                $('#isActiveInput').val(isActive);
                $('.status-label').text(this.checked ? 'Active' : 'Inactive');
            });

            // Auto-uppercase subject code
            $('#code').on('input', function() {
                var pos = this.selectionStart;
                $(this).val($(this).val().toUpperCase());
                this.setSelectionRange(pos, pos);
            });

            // SIS global helpers (multi-submit guard + success flash)
            if (typeof SIS !== 'undefined') {
                SIS.formGuard('#createSubjectForm');
                SIS.showFlash();
            }

        });
    </script>
@endpush
