@php
    use Carbon\Carbon;

    // Safe helpers
    $get = fn($obj, $key, $default = 'N/A') => data_get($obj, $key, $default);

    // Build full name: first, middle, last, extension (if any)
    $fullName = collect([
        $get($student, 'first_name', ''),
        $get($student, 'middle_name', ''),
        $get($student, 'last_name', ''),
        $get($student, 'extension_name', ''),
    ])->filter(fn($v) => filled($v))->implode(' ');

    // DOB formatting (Month DD, YYYY)
    $dobRaw = $get($student, 'dob', null);
    $dobFmt = $dobRaw ? Carbon::parse($dobRaw)->translatedFormat('F d, Y') : 'N/A';

    // Docs arrays (from controller). Provide defaults to avoid errors.
    $uploadedDocs = $uploadedDocs ?? [];
    $pendingDocs  = $pendingDocs ?? [];

    // From email for warning
    $officialEmail = config('mail.from.address') ?: $get($student, 'official_email', 'your-official@email.com');
@endphp

@component('mail::message')
Hi {{ $get($student, 'first_name') }},

Thank you for successfully submitting your online enrollment form for **School Year 2025-2026**.

Please keep note of your temporary details:

**PERSONAL INFORMATION:**
- **Full Name:** {{ $fullName ?: 'N/A' }}
- **Gender:** {{ strtoupper($get($student, 'gender')) }}
- **Date of Birth:** {{ $dobFmt }}
- **Place of Birth:** {{ $get($student, 'place_of_birth') }}

**CONTACT ADDRESS:**
- **Contact Number:** {{ $get($student, 'contact_number') }}
- **Email:** {{ $get($student, 'email') }}
- **Social Media:** {{ $get($student, 'social_media') }}
- **Current Address:** {{ $get($student, 'current_address') }}
- **City/Municipality:** {{ $get($student, 'city_municipality') }}

**ENROLLMENT PREFERENCES:**
- **Course:** {{ $get($student, 'course_id') }}
- **Year Level:** {{ $get($student, 'level_id') }}
- **Branch:** Main {{ $get($student, 'branch_id') }}

**Uploaded Documents ✅**
@forelse ($uploadedDocs as $doc)
- {{ $doc }}
@empty
- None
@endforelse

**To Follow:**
@forelse ($pendingDocs as $doc)
- {{ $doc }}
@empty
- None
@endforelse

**Enrollment Status:** {{ strtoupper($get($student, 'info_status')) }}

---

**Important Notice:**  
Your enrollment form is currently **under review** for verification and validation.

**What Happens Next?**  
Please do not worry; we will send you another email to officially confirm when your enrollment form has been validated.

**After Your Enrollment Form is Validated:**  
Once you receive our **official Confirmation Email** stating your enrollment is validated, you may proceed to the next step: paying the **Down Payment of Php 1,000.00**.  
You **must use your Enrollee Number as the reference number** for your payment.

**PAYMENT PLATFORMS:**  
You can make the Php 1,000.00 down payment through the following platforms:  
- **HelloMoneyApp (HMA)**  
- **AUB Bank (Asia United Bank)**

Thank you for your cooperation. Please wait for our next email notification.

Sincerely,  
**Bestlink College Of The Philippines**  
bestlink092@gmail.com

---

**Email Warning**  
🔒 **Reminder:** We will never ask for your password, documents, or personal info. Official emails only come from **{{ $officialEmail }}**. Always verify before responding and report any suspicious messages to the **Admission Office** or **IT Support**.
@endcomponent
