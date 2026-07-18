<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Certificate</title>
    <style>
        body { font-family: Arial, sans-serif; color: #111827; margin: 0; padding: 0; background: #f9fafb; }
        .page { width: 100%; min-height: 1000px; padding: 28px; box-sizing: border-box; }
        .card { border: 6px solid #4f46e5; border-radius: 12px; padding: 32px; background: white; text-align: center; }
        .brand { font-size: 14px; letter-spacing: 2px; color: #4f46e5; font-weight: bold; margin-bottom: 10px; }
        .title { font-size: 30px; font-weight: bold; margin-bottom: 10px; color: #111827; }
        .subtitle { font-size: 14px; color: #6b7280; margin-bottom: 24px; }
        .name { font-size: 26px; font-weight: bold; margin: 18px 0; color: #111827; }
        .body { font-size: 16px; line-height: 1.6; margin: 6px 0; }
        .highlight { font-weight: bold; color: #111827; }
        .footer { margin-top: 24px; display: flex; justify-content: space-between; font-size: 12px; color: #6b7280; }
        .signature { margin-top: 28px; border-top: 1px solid #d1d5db; padding-top: 8px; display: inline-block; }
        .qr { margin-top: 20px; font-size: 11px; color: #6b7280; }
    </style>
</head>
<body>
    <div class="page">
        <div class="card">
            <div class="brand">IMPACTLINK MALAWI</div>
            <div class="title">Certificate of Participation</div>
            <div class="subtitle">Recognizing devoted service and meaningful contribution</div>
            <p class="body">This certifies that</p>
            <div class="name">{{ $certificate->volunteer?->first_name }} {{ $certificate->volunteer?->last_name }}</div>
            <p class="body">has actively participated in <span class="highlight">{{ $certificate->project?->title }}</span></p>
            @if($certificate->event)
                <p class="body">during the event <span class="highlight">{{ $certificate->event->title }}</span></p>
            @endif
            <p class="body">{{ $certificate->description ?? 'Recognized for meaningful participation and service.' }}</p>
            <p class="body">Volunteer Hours: <span class="highlight">{{ $certificate->hours ?? 'N/A' }}</span></p>
            <p class="body">Issue Date: <span class="highlight">{{ $certificate->issue_date }}</span></p>
            <p class="body">Certificate Number: <span class="highlight">{{ $certificate->certificate_number }}</span></p>
            <div class="signature">Authorized Signature</div>
            <div class="footer">
                <div>Organization: {{ $certificate->volunteer?->organization?->name }}</div>
                <div>Verification: {{ url('/certificates/verify/'.$certificate->verification_token) }}</div>
            </div>
            <div class="qr">Official stamp placeholder</div>
        </div>
    </div>
</body>
</html>
