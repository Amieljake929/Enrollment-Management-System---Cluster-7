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
                            <input type="text" class="form-control" id="search" placeholder="Search by name" value="{{ request('search') }}">
                        </div>
                        <div class="col-md-3">
                            <select class="form-select" id="category">
                                <option value="" {{ request('category') == '' ? 'selected' : '' }}>All Categories</option>
                                <option value="Pending" {{ request('category') == 'Pending' ? 'selected' : '' }}>Pending</option>
                                <option value="Cancelled" {{ request('category') == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                                <option value="Validated" {{ request('category') == 'Validated' ? 'selected' : '' }}>Waiting</option>
                                <option value="Re-Evaluate" {{ request('category') == 'Re-Evaluate' ? 'selected' : '' }}>Re-Evaluation</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select class="form-select" id="sort">
                                <option value="desc" {{ request('sort', 'desc') == 'desc' ? 'selected' : '' }}>Newest First</option>
                                <option value="asc" {{ request('sort', 'desc') == 'asc' ? 'selected' : '' }}>Oldest First</option>
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
                                @if($archivedRecords->isEmpty())
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-4">
                                        No archived records yet. Use the "Archive All Eligible" button to archive pending, cancelled, waiting, or re-evaluation records.
                                    </td>
                                </tr>
                                @endif
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
                <div id="success-message" class="text-success mt-2" style="display:none;"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="confirm-archive">Archive</button>
            </div>
        </div>
    </div>
</div>

<script>
(function() {
    function initArchiveModule() {
        function waitForBootstrap(callback, maxRetries = 20) {
            if (window.bootstrap && typeof window.bootstrap.Modal === 'function') {
                callback();
            } else if (maxRetries > 0) {
                console.log('Waiting for Bootstrap...');
                setTimeout(function() {
                    waitForBootstrap(callback, maxRetries - 1);
                }, 100);
            } else {
                console.error('Bootstrap not loaded after timeout.');
            }
        }

        waitForBootstrap(function() {
            var archiveBtn = document.getElementById('archive-btn');
            var confirmBtn = document.getElementById('confirm-archive');
            var passwordInput = document.getElementById('password');
            var errorMsg = document.getElementById('error-message');
            var successMsg = document.getElementById('success-message');
            var searchInput = document.getElementById('search');
            var categorySelect = document.getElementById('category');
            var sortSelect = document.getElementById('sort');
            var passwordModal = document.getElementById('passwordModal');

            if (!archiveBtn || !confirmBtn || !passwordInput || !passwordModal) {
                console.error('Archive elements not found. Retrying in 100ms...');
                setTimeout(initArchiveModule, 100);
                return;
            }

            // Open modal
            archiveBtn.addEventListener('click', function() {
                var modal = new window.bootstrap.Modal(passwordModal);
                modal.show();
            });

            // Confirm archive with fetch (no jQuery needed)
            confirmBtn.addEventListener('click', function() {
                var password = passwordInput.value;
                if (!password) {
                    errorMsg.textContent = 'Password is required.';
                    errorMsg.style.display = 'block';
                    return;
                }

                var formData = new FormData();
                formData.append('password', password);
                formData.append('_token', '{{ csrf_token() }}');

                fetch('{{ route("modules.archive.store") }}', {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                    },
                    body: formData
                })
                .then(function(response) {
                    return response.text().then(function(text) {
                        // Check if response is HTML (error page, redirect, etc.)
                        if (text.trim().startsWith('<!DOCTYPE') || text.includes('<html')) {
                            if (text.toLowerCase().includes('login') || text.includes('Log In')) {
                                throw new Error('Session expired. Please refresh the page and log in again.');
                            } else {
                                throw new Error('Server error. Please refresh the page and try again.');
                            }
                        }
                        if (response.status === 419) {
                            throw new Error('CSRF token mismatch. Please refresh the page and try again.');
                        }
                        var json;
                        try {
                            json = JSON.parse(text);
                        } catch (e) {
                            throw new Error('Invalid response format: ' + text.substring(0, 100));
                        }
                        if (!response.ok) {
                            throw new Error(json.error || json.message || `HTTP ${response.status}`);
                        }
                        return json;
                    });
                })
                .then(function(data) {
                    var modalInstance = window.bootstrap.Modal.getInstance(passwordModal);
                    if (modalInstance) {
                        modalInstance.hide();
                    }
                    errorMsg.style.display = 'none';
                    successMsg.style.display = 'none';
                    if (data.success) {
                        successMsg.textContent = data.success;
                        successMsg.style.display = 'block';
                        setTimeout(function() {
                            // Fetch updated archive content
                            fetch('/modules/archive?content=1', {
                                headers: {
                                    'X-Requested-With': 'XMLHttpRequest',
                                },
                            })
                            .then(response => response.text())
                            .then(html => {
                                const parser = new DOMParser();
                                const doc = parser.parseFromString(html, 'text/html');
                                const newContent = doc.querySelector('#page-content')?.innerHTML;
                                if (newContent) {
                                    document.getElementById('page-content').innerHTML = newContent;
                                    // Execute scripts
                                    const scripts = document.querySelectorAll('#page-content script');
                                    scripts.forEach(oldScript => {
                                        const newScript = document.createElement('script');
                                        if (oldScript.src) {
                                            newScript.src = oldScript.src;
                                            newScript.async = true;
                                        } else {
                                            newScript.textContent = oldScript.textContent;
                                        }
                                        oldScript.parentNode.replaceChild(newScript, oldScript);
                                    });
                                }
                            })
                            .catch(err => {
                                console.error('Error reloading archive:', err);
                                location.reload(); // fallback
                            });
                        }, 1500);
                    } else {
                        errorMsg.textContent = 'Unexpected response.';
                        errorMsg.style.display = 'block';
                    }
                })
                .catch(function(error) {
                    console.error('Error:', error);
                    var modalInstance = window.bootstrap.Modal.getInstance(passwordModal);
                    if (modalInstance) {
                        modalInstance.hide();
                    }
                    errorMsg.style.display = 'none';
                    if (error.message.includes('Failed to fetch')) {
                        errorMsg.textContent = 'Network error. Please try again.';
                    } else if (error.message.includes('Session expired') || error.message.includes('CSRF mismatch')) {
                        errorMsg.textContent = error.message;
                    } else if (error.message.includes('403') || error.message.includes('Unauthenticated') || error.message.includes('Incorrect password')) {
                        errorMsg.textContent = 'Access denied or incorrect password.';
                    } else {
                        errorMsg.textContent = error.message || 'An error occurred. Please try again.';
                    }
                    errorMsg.style.display = 'block';
                });
            });

            // Search and filter (vanilla)
            function updateUrl() {
                var search = searchInput ? encodeURIComponent(searchInput.value) : '';
                var category = categorySelect ? encodeURIComponent(categorySelect.value) : '';
                var sort = sortSelect ? sortSelect.value : 'desc';
                var url = '{{ route("modules.archive") }}?search=' + search + '&category=' + category + '&sort=' + sort;
                window.location.href = url;
            }

            if (searchInput) searchInput.addEventListener('keyup', updateUrl);
            if (categorySelect) categorySelect.addEventListener('change', updateUrl);
            if (sortSelect) sortSelect.addEventListener('change', updateUrl);
        });
    }

    // Initialize
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initArchiveModule);
    } else {
        initArchiveModule();
    }
})();
</script>
@endsection
