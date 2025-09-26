@extends('layouts.staff')

@section('content')
<div class="container mx-auto px-4 py-8">

    {{-- Header --}}
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Staff Dashboard</h1>
        <p class="text-gray-600">Welcome back, {{ Auth::user()->name }}! You are logged in as <strong>{{ Auth::user()->role }}</strong>.</p>
    </div>

</div>

<!-- TERMS MODAL -->
@if(Auth::user()->has_agree_term == 'pending' && session('just_logged_in'))
<div id="termsModal" class="modal-overlay">
    <div class="modal-content">
       
        <div class="text-center mb-6">
                <i class="bi bi-shield-lock me-2"></i>

            <h5 class="modal-title d-flex align-items-center justify-content-center">
                Terms and Conditions for Administrators
            </h5>
            <div class="modal-underline"></div>
        </div>

        <div class="modal-body" style="max-height: 40vh; overflow-y: auto; text-align: left; padding-right: 10px;">

            <p class="lead"><strong>1. Introduction & Acceptance</strong></p>
            <p><strong>Agreement to Terms</strong><br>
            By accessing and using the administrative functions of the Enrollment Management System (the “Platform”), you, the Admission OIC (“Administrator”), agree to be bound by these Terms and Conditions for Administrators (“Agreement”).</p>

            <p><strong>Effective Date</strong><br>
            This Agreement is effective as of September 1, 2025.</p>

            <hr class="my-4">

            <p class="lead"><strong>2. Role-Based Access & Responsibilities </strong></p>
            <p><strong>Access Granted</strong><br>
            You are granted limited, non-exclusive, and revocable access to perform administrative functions within the Platform.</p>

            <p><strong>Authorized Purposes Only</strong><br>
            You agree to use your administrative access solely for the official purposes of Bestlink College of the Philippines and not for personal benefit or unauthorized activities.</p>

            <p><strong>Administrative Duties</strong><br>
            As an Admission OIC, your functions include but are not limited to:</p>
            <ul>
                <li>Approving applications</li>
                <li>Notifying students</li>
                <li>Managing and reviewing enrollment records</li>
                <li>Generating reports</li>
                <li>Performing other administrative tasks necessary for the proper operation of the Platform</li>
            </ul>

            <p><strong>Maintain Accurate Information</strong><br>
            You agree to provide and maintain only true, accurate, current, and complete information when managing administrative settings.</p>

            <hr class="my-4">

            <p class="lead"><strong>3. Data Access & Privacy</strong></p>
            <p><strong>Access to End-User Data</strong><br>
            Administrators may access and manage student information, including personal details and enrollment-related records, as necessary to fulfill administrative duties.</p>

            <p><strong>Adherence to Privacy Policy</strong><br>
            All data access and handling by Administrators must comply with the Data Privacy Act of 2012 and the official Privacy Policy of Bestlink College of the Philippines.</p>

            <p><strong>Third-Party Disclosure</strong><br>
            No student or system data may be disclosed to third parties without explicit written authorization from Bestlink College of the Philippines, unless required by law.</p>

            <hr class="my-4">

            <p class="lead"><strong>4. Confidentiality & Security</strong></p>
            <p><strong>Confidential Information</strong><br>
            You agree to maintain the confidentiality of all Platform data, including but not limited to student records and internal system data, and to implement procedures to prevent unauthorized disclosure.</p>

            <p><strong>Password Security</strong><br>
            You are responsible for maintaining the confidentiality and security of your administrative account credentials and are prohibited from sharing them with unauthorized persons.</p>

            <p><strong>Protection of Software/Data</strong><br>
            You will use the same degree of care to protect the Platform’s data and software as you use to protect your own confidential information, but in no event less than a reasonable degree of care.</p>

            <p><strong>Security Measures</strong><br>
            Administrators must observe platform security measures, including:</p>
            <ul>
                <li>Strong password requirements</li>
                <li>Session timeouts</li>
                <li>Adherence to institutional security protocols</li>
            </ul>

            <hr class="my-4">

            <p class="lead"><strong>5. Prohibited Activities & Acceptable Use</strong></p>
            <p><strong>Prohibited Conduct</strong><br>
            You shall not use your administrative access for:</p>
            <ul>
                <li>Unauthorized modification or deletion of student records</li>
                <li>Personal gain or fraudulent activity</li>
                <li>Disrupting the operation of the Platform</li>
                <li>Accessing or sharing data without proper authorization</li>
            </ul>

            <p><strong>No Reverse Engineering</strong><br>
            You agree not to decompile, reverse engineer, or disassemble the Platform’s software or any of its components.</p>

            <hr class="my-4">

            <p class="lead"><strong>6. Consequences of Violation</strong></p>
            <p><strong>Suspension or Termination</strong><br>
            Violation of these terms may result in the immediate suspension of your administrative access and account, without prior notice.</p>

            <p><strong>Liability for Damages</strong><br>
            You may be held liable for any losses or damages incurred by Bestlink College of the Philippines as a result of your misuse of administrative access or violation of this Agreement.</p>

            <hr class="my-4">

            <p class="lead"><strong>7. Audit & Monitoring</strong></p>
            <p>Administrator activities may be logged and monitored for compliance, security, and audit purposes. Logs may be reviewed periodically or in response to suspected violations.</p>

            <hr class="my-4">

            <p class="lead"><strong>8. Training & Compliance</strong></p>
            <p>Administrators must complete any required training modules or compliance briefings related to data privacy, system usage, and institutional policies.</p>

            <hr class="my-4">

            <p class="lead"><strong>9. Dispute Resolution</strong></p>
            <p>Any disputes arising from this Agreement shall be resolved through internal administrative procedures of Bestlink College of the Philippines before resorting to external legal remedies.</p>

            <hr class="my-4">

            <p class="lead"><strong>10. Changes to Terms & Governing Law</strong></p>
            <p><strong>Right to Change Terms</strong><br>
            Bestlink College of the Philippines reserves the right to modify or update these Terms at any time, with notice provided via system announcements, official memos, or email communication.</p>

            <p><strong>Governing Law</strong><br>
            This Agreement shall be governed by and construed in accordance with the laws of the Republic of the Philippines, including the Data Privacy Act of 2012.</p>

            <hr class="my-4">

            <p class="lead"><strong>11. Acceptance Mechanism</strong></p>
            <p>By logging into the Platform or performing administrative functions, you acknowledge that you have read, understood, and accepted these Terms and Conditions for Administrators.</p>

        </div>

        <div class="modal-footer">
            <button type="button" id="cancelTerms" class="btn-custom-secondary">
                Decline
            </button>
            <button type="button" id="agreeTerms" class="btn-custom-primary" disabled>
                Confirm
            </button>
        </div>
    </div>
</div>

<style>
    .modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.6);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 9999;
        opacity: 0;
        pointer-events: none;
        transition: opacity 0.4s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .modal-content {
        background: white;
        padding: 2.5rem;
        border-radius: 1rem;
        width: 75%;
        height: 60%;
        max-width: 520px;
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.18);
        transform: scale(0.95);
        transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        animation: modalPop 0.5s forwards;
    }

    @keyframes modalPop {
        0% {
            opacity: 0;
            transform: scale(0.9);
        }
        100% {
            opacity: 1;
            transform: scale(1);
        }
    }
    .bi-shield-lock{

        font-size: 30px;

    }

    .modal-title {
        font-weight: 800;
        font-size: 1.2rem;
        color: #1e3a8a;
        letter-spacing: -0.5px;
        margin: 0;
    }

    .modal-underline {
        width: 50px;
        height: 3px;
        background: #5044e4;
        margin: 0.75rem auto;
        border-radius: 3px;
    }

    .modal-body {
        font-size: 0.75rem;
        line-height: 1.7;
        color: #4b5563;
        text-align: center;
    }

    .modal-footer {
        display: flex;
        justify-content: center;
        gap: 1rem;
        margin-top: 2rem;
        flex-wrap: wrap;
    }

    /* Custom Button Styles — Compatible with Bootstrap */
    .btn-custom-primary {
        background-color: #5044e4;
        border: none;
        color: white;
        padding: 0.75rem 1.5rem;
        border-radius: 2rem;
        transition: all 0.3s ease;
        font-weight: 700;
        cursor: pointer;
        box-shadow: 0 4px 12px rgba(80, 68, 228, 0.3);
    }

    .btn-custom-primary:hover {
        background-color: #4237c9;
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(80, 68, 228, 0.4);
    }

    .btn-custom-primary:active {
        transform: translateY(0);
    }

    .btn-custom-secondary {
        background-color: #f4f7f6;
        border: 1px solid #d1d5db;
        color: #374151;
        padding: 0.75rem 1.5rem;
        border-radius: 2rem;
        transition: all 0.3s ease;
        font-weight: 700;
        cursor: pointer;
    }

    .btn-custom-secondary:hover {
        background-color: #e5e7eb;
        transform: translateY(-2px);
        border-color: #9ca3af;
    }

    .btn-custom-secondary:active {
        transform: translateY(0);
    }

    body.modal-open {
        overflow: hidden;
    }

    /* Prevent closing by clicking backdrop */
    .modal-overlay {
        animation: fadeIn 0.4s ease forwards;
    }

    @keyframes fadeIn {
        to {
            opacity: 1;
            pointer-events: auto;
        }
    }
    .btn-custom-primary:disabled {
    background-color: #d1d5db;
    color: #6b7280;
    cursor: not-allowed;
    transform: none;
    box-shadow: none;
    opacity: 0.7;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('termsModal');
    const agreeBtn = document.getElementById('agreeTerms');
    const cancelBtn = document.getElementById('cancelTerms');

    if (modal) {
        document.body.classList.add('modal-open');
        // Prevent closing by clicking outside
        modal.addEventListener('click', function(e) {
            if (e.target === modal) {
                e.stopPropagation();
            }
        });
    }

    // >>>>>>>>>> NEW: Enable Agree button only when scrolled to bottom <<<<<<<<<<
    const modalBody = document.querySelector('.modal-body');
    if (modalBody && agreeBtn) {
        modalBody.addEventListener('scroll', function() {
            const isScrolledToBottom = modalBody.scrollHeight - modalBody.clientHeight <= modalBody.scrollTop + 1;
            if (isScrolledToBottom) {
                agreeBtn.disabled = false;
            }
        });
    }

    function closeModal() {
        if (modal) {
            modal.style.opacity = '0';
            modal.style.pointerEvents = 'none';
            setTimeout(() => {
                modal.style.display = 'none';
                document.body.classList.remove('modal-open');
            }, 400);
        }
    }

    if (agreeBtn) {
        agreeBtn.addEventListener('click', function() {
            fetch("{{ route('user.agree.terms') }}", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({})
            })
            .then(response => response.json())
            .then(data => {
                if(data.success) {
                    closeModal();
                } else {
                    alert('Failed to save agreement. Please try again.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Something went wrong.');
            });
        });
    }

    if (cancelBtn) {
        cancelBtn.addEventListener('click', function() {
            if(confirm("Are you sure you do not agree to terms and conditions? If you click OK, system will force you to logout.")) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = "{{ route('logout') }}";

                const csrf = document.createElement('input');
                csrf.type = 'hidden';
                csrf.name = '_token';
                csrf.value = '{{ csrf_token() }}';
                form.appendChild(csrf);

                document.body.appendChild(form);
                form.submit();
            }
        });
    }
});
</script>
@endif
@endsection