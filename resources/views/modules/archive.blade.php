@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Archive Module</h4>
                    <p class="card-description">Contains all archived admissions and re-evaluation records.</p>
                </div>
                <div class="card-body">
                    <!-- Search and Filter -->
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <input type="text" class="form-control" id="search" placeholder="Search by name">
                        </div>
                        <div class="col-md-3">
                            <select class="form-select" id="category">
                                <option value="">All Categories</option>
                                <option value="Pending">Pending</option>
                                <option value="Cancelled">Cancelled</option>
                                <option value="Waiting">Waiting</option>
                                <option value="Re-Evaluation">Re-Evaluation</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select class="form-select" id="sort">
                                <option value="desc">Newest First</option>
                                <option value="asc">Oldest First</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-primary" id="archive-btn">Archive All Eligible</button>
                        </div>
                    </div>

                    <!-- Table -->
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Student Name</th>
                                    <th>Category</th>
                                    <th>Date Archived</th>
                                    <th>Archived By</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="archive-table-body">
                                @foreach($archivedRecords as $record)
                                <tr>
                                    <td>{{ $record->student_name }}</td>
                                    <td>{{ $record->original_status }}</td>
                                    <td>{{ $record->created_at->format('Y-m-d H:i') }}</td>
                                    <td>{{ $record->admin_name }}</td>
                                    <td>
                                        <a href="{{ route('modules.archive.show', $record->id) }}" class="btn btn-sm btn-info">View</a>
                                        <form action="{{ route('modules.archive.restore', $record->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-success">Restore</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    {{ $archivedRecords->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Password Modal -->
<div class="modal fade" id="passwordModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirm Archive</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Enter your password to archive all eligible records.</p>
                <input type="password" class="form-control" id="password">
                <div id="error-message" class="text-danger mt-2" style="display:none;"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="confirm-archive">Archive</button>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
$(document).ready(function() {
    $('#archive-btn').click(function() {
        $('#passwordModal').modal('show');
    });

    $('#confirm-archive').click(function() {
        var password = $('#password').val();
        $.post('{{ route("modules.archive.store") }}', {
            password: password,
            _token: '{{ csrf_token() }}'
        }).done(function(response) {
            $('#passwordModal').modal('hide');
            location.reload();
        }).fail(function(xhr) {
            $('#error-message').text(xhr.responseJSON.error).show();
        });
    });

    // Search and filter
    $('#search, #category, #sort').on('change keyup', function() {
        var search = $('#search').val();
        var category = $('#category').val();
        var sort = $('#sort').val();
        var url = '{{ route("modules.archive") }}?search=' + search + '&category=' + category + '&sort=' + sort;
        window.location.href = url;
    });
});
</script>
@endsection
