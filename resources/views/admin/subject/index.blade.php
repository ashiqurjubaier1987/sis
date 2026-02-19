@extends('layouts.app')

@section('title', $title ?? 'Subjects')

@section('content')
    <div class="mb-3">
    <button class="btn btn-outline-primary" onclick="showTable()"><i class="feather icon-list"></i></button>
    <button class="btn btn-outline-secondary" onclick="showCard()"><i class="feather icon-grid"></i></button>
</div>
    <div id="table-view">
        {{-- existing table --}}
        sdafadf
    </div>

    <div id="card-view" style="display:none;">
        asdfads
        {{-- we will build card layout next --}}
    </div>

    <x-datatable id="subjectsTable" :columns="[
        ['data' => 'id', 'label' => 'ID'],
        ['data' => 'name', 'label' => 'Name'],
        ['data' => 'code', 'label' => 'Code'],
        ['data' => 'status', 'label' => 'Status'],
        ['data' => 'created_at', 'label' => 'Created'],
    ]" ajaxRoute="{{ route('subjects.index') }}"
        {{-- exportRoute="{{ route('subjects.export') }}" /> --}}
    <div class="page-header">
        <div class="d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Subjects</h4>
            <div class="btn-group" role="group">
                <button type="button" id="cardViewBtn" class="btn btn-primary btn-sm">
                    <i class="feather icon-grid"></i>
                </button>
                <button type="button" id="tableViewBtn" class="btn btn-outline-primary btn-sm">
                    <i class="feather icon-list"></i>
                </button>
            </div>
        </div>
        <input type="text" id="cardSearch" class="form-control mt-2" placeholder="Search subjects...">
    </div>

    {{-- MODERN CARD VIEW --}}
    <div id="cardView" class="row mt-3">
        asdsd
    </div>

    {{-- TABLE VIEW (hidden by default) --}}
    <div id="tableView" style="display:none;" class="mt-3">
        asdasd
    </div>

    @push('styles')
        <style>
            /* Modern card hover effect */
            .subject-card-hover {
                transition: all 0.3s ease;
                position: relative;
                border-left-width: 5px !important;
            }

            .subject-card-hover:hover {
                transform: translateY(-5px);
                box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            }

            /* Status badge on top-right */
            .status-badge {
                position: absolute;
                top: 10px;
                right: 10px;
                font-size: 0.75rem;
                padding: 0.25rem 0.5rem;
            }

            /* Colored border left */
            .border-left-success {
                border-left: 5px solid #28a745 !important;
            }

            .border-left-danger {
                border-left: 5px solid #dc3545 !important;
            }
        </style>
    @endpush

    @push('scripts')
        <script>
            $(document).ready(function() {

                // Toggle Views
                $('#cardViewBtn').click(function() {
                    $('#cardView').show();
                    $('#tableView').hide();
                    $(this).addClass('btn-primary').removeClass('btn-outline-primary');
                    $('#tableViewBtn').addClass('btn-outline-primary').removeClass('btn-primary');
                });

                $('#tableViewBtn').click(function() {
                    $('#cardView').hide();
                    $('#tableView').show();
                    $(this).addClass('btn-primary').removeClass('btn-outline-primary');
                    $('#cardViewBtn').addClass('btn-outline-primary').removeClass('btn-primary');
                    if (!$.fn.DataTable.isDataTable('#subjectTable')) {
                        $('#subjectTable').DataTable();
                    }
                });

                // Card Search Filter
                $('#cardSearch').on('keyup', function() {
                    let value = $(this).val().toLowerCase();
                    $('.subject-card').filter(function() {
                        $(this).toggle($(this).data('name').includes(value) || $(this).data('code')
                            .includes(value));
                    });
                });

            });
        </script>

        <script>
            function showTable() {
                document.getElementById('table-view').style.display = 'block';
                document.getElementById('card-view').style.display = 'none';
            }

            function showCard() {
                document.getElementById('table-view').style.display = 'none';
                document.getElementById('card-view').style.display = 'block';
            }
        </script>
    @endpush
@endsection
