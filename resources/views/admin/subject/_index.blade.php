@extends('layouts.app') {{-- or your Adminty layout --}}

@section('content')
<div class="pcoded-inner-content">
    <div class="main-body">
        <div class="page-wrapper">
            <div class="page-body container mt-4">

                <!-- Filter Segment -->
                <div class="card p-3 mb-4">
                    <div class="row g-3 align-items-end">
                        <div class="col-md-4">
                            <label class="form-label">Search Subject</label>
                            <input type="text" class="form-control" id="searchInput" placeholder="Enter subject name">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Status</label>
                            <select class="form-select" id="statusSelect">
                                <option value="all">All</option>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                        <div class="col-md-5 d-flex gap-2">
                            <button class="btn btn-primary mt-3" id="submitFilter">Submit</button>
                            <button class="btn btn-secondary mt-3" id="resetFilter">Reset</button>
                        </div>
                    </div>
                </div>

                <!-- View Toggle -->
                <div class="d-flex justify-content-end toggle-view mb-3">
                    <button class="btn btn-outline-primary me-2" id="cardViewBtn">Card View</button>
                    <button class="btn btn-outline-secondary" id="tableViewBtn">Table View</button>
                </div>

                <!-- Card View -->
                <div id="cardView" class="card-grid">
                    @foreach($subjects as $subject)
                        <div class="card p-3">
                            <h5 class="card-title">{{ $subject->name }}</h5>
                            <p class="card-text">Code: {{ $subject->code }}</p>
                            <p class="card-text">Status: {{ ucfirst($subject->status) }}</p>
                            <div>
                                <a href="{{ route('subjects.show', $subject->id) }}" class="btn btn-sm btn-info">View</a>
                                <a href="{{ route('subjects.edit', $subject->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Table View -->
                <div id="tableView" style="display:none;">
                    <table id="subjectTable" class="display table table-striped">
                        <thead>
                            <tr>
                                <th>Subject Name</th>
                                <th>Code</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($subjects as $subject)
                                <tr>
                                    <td>{{ $subject->name }}</td>
                                    <td>{{ $subject->code }}</td>
                                    <td>{{ ucfirst($subject->status) }}</td>
                                    <td>
                                        <a href="{{ route('subjects.show', $subject->id) }}" class="btn btn-sm btn-info">View</a>
                                        <a href="{{ route('subjects.edit', $subject->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function(){
        var table = $('#subjectTable').DataTable();

        $('#cardViewBtn').click(function(){
            $('#cardView').show();
            $('#tableView').hide();
        });
        $('#tableViewBtn').click(function(){
            $('#cardView').hide();
            $('#tableView').show();
        });

        $('#submitFilter').click(function(){
            var searchVal = $('#searchInput').val().toLowerCase();
            var statusVal = $('#statusSelect').val();

            // Filter Cards
            $('#cardView .card').each(function(){
                var name = $(this).find('.card-title').text().toLowerCase();
                var status = $(this).find('.card-text').eq(1).text().toLowerCase();
                var show = true;
                if(searchVal && !name.includes(searchVal)) show = false;
                if(statusVal != 'all' && !status.includes(statusVal)) show = false;
                $(this).toggle(show);
            });

            // Filter Table
            table.rows().every(function(){
                var rowData = this.data();
                var rowName = rowData[0].toLowerCase();
                var rowStatus = rowData[2].toLowerCase();
                var showRow = true;
                if(searchVal && !rowName.includes(searchVal)) showRow = false;
                if(statusVal != 'all' && !rowStatus.includes(statusVal)) showRow = false;
                $(this.node()).toggle(showRow);
            });
        });

        $('#resetFilter').click(function(){
            $('#searchInput').val('');
            $('#statusSelect').val('all');
            $('#cardView .card').show();
            table.rows().every(function(){ $(this.node()).show(); });
        });
    });
</script>
@endpush