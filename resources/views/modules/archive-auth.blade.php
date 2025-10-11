@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Archive Module Access</h4>
                    <p class="card-description">Enter your password to access the Archive Module.</p>
                </div>
                <div class="card-body">
                    <div class="text-center">
                        <button class="btn btn-primary" id="access-archive-btn">Access Archive Module</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Password Modal -->
<div class="modal fade" id="passwordModal" tabindex="-1" aria-labelledby="passwordModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="passwordModalLabel">Enter Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Please enter your password to access the Archive Module.</p>
                <input type="password" class="form-control" id="password" placeholder="Password">
                <div id="error-message" class="text-danger mt-2" style="display:none;"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="confirm-password">Confirm</button>
            </div>
        </div>
    </div>
</div>

<!-- Warning Modal -->
<div class="modal fade" id="warningModal" tabindex="-1" aria-labelledby="warningModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="warningModalLabel">Confidential Data Access Warning</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>You are accessing sensitive and confidential student data.</p>
                <p>In accordance with ISO/IEC 27001 and ISO 15489 standards, all users must handle archived records with strict confidentiality.</p>
                <p>Unauthorized viewing, copying, modification, or distribution of this data is strictly prohibited.</p>
                <p>Please ensure that all information retrieved will be kept secure and used only for authorized institutional purposes.</p>
                <p>If you understand, then proceed.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="proceed-access">Proceed</button>
            </div>
        </div>
    </div>
</div>

<script>
(function() {
    function initArchiveAuth() {
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
            var accessBtn = document.getElementById('access-archive-btn');
            var passwordModalEl = document.getElementById('passwordModal');
            var warningModalEl = document.getElementById('warningModal');
            var confirmBtn = document.getElementById('confirm-password');
            var proceedBtn = document.getElementById('proceed-access');
            var passwordInput = document.getElementById('password');
            var errorMsg = document.getElementById('error-message');

            if (!accessBtn || !passwordModalEl || !warningModalEl || !confirmBtn || !proceedBtn || !passwordInput) {
                console.error('Auth elements not found. Retrying in 100ms...');
                setTimeout(initArchiveAuth, 100);
                return;
            }

            var passwordModal = new window.bootstrap.Modal(passwordModalEl);
            var warningModal = new window.bootstrap.Modal(warningModalEl);

            // Open password modal
            accessBtn.addEventListener('click', function() {
                passwordModal.show();
            });

            // Confirm password
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

                fetch('{{ route("modules.archive.authenticate") }}', {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                    },
                    body: formData
                })
                .then(function(response) {
                    return response.json();
                })
                .then(function(data) {
                    if (data.success) {
                        passwordModal.hide();
                        errorMsg.style.display = 'none';
                        passwordInput.value = '';
                        warningModal.show();
                    } else {
                        errorMsg.textContent = data.error || 'Incorrect password.';
                        errorMsg.style.display = 'block';
                    }
                })
                .catch(function(error) {
                    console.error('Error:', error);
                    errorMsg.textContent = 'An error occurred. Please try again.';
                    errorMsg.style.display = 'block';
                });
            });

            // Proceed to archive
            proceedBtn.addEventListener('click', function() {
                warningModal.hide();
                // Fetch the archive content
                fetch('/modules/archive?content=1', {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                    },
                })
                .then(response => response.text())
                .then(html => {
                    // Extract the body content
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
                        // Update URL
                        window.history.pushState({}, '', '/modules/archive');
                    } else {
                        alert('Error loading archive content.');
                    }
                })
                .catch(err => {
                    console.error('Error loading archive:', err);
                    alert('Failed to load archive content.');
                });
            });
        });
    }

    // Initialize
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initArchiveAuth);
    } else {
        initArchiveAuth();
    }
})();
</script>
@endsection
