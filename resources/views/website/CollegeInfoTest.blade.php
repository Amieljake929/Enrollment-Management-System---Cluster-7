@extends('layouts.assessment') {{-- adjust if you have different layout --}}

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">📝 College Assessment Registration</h4>
                </div>
                <div class="card-body">
                    <form id="infoForm">
                        @csrf
                        <div class="mb-3">
                            <label for="full_name" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="full_name" name="full_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="age" class="form-label">Age</label>
                            <input type="number" class="form-control" id="age" name="age" min="15" max="99" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <button type="submit" class="btn btn-success w-100">Submit Information</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Success Modal -->
<div class="modal fade" id="successModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title">✅ Success!</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Your information has been successfully submitted. Redirecting you to the next step...</p>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('infoForm').addEventListener('submit', function(e) {
    e.preventDefault();

    const formData = new FormData(this);

    fetch("{{ route('college.info.submit') }}", {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            const modal = new bootstrap.Modal(document.getElementById('successModal'));
            modal.show();

            setTimeout(() => {
                window.location.href = "{{ route('college.welcome') }}";
            }, 2000);
        }
    })
    .catch(error => {
        alert('Something went wrong. Please try again.');
    });
});
</script>
@endsection