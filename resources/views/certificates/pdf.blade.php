<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Certificate</title>
    <style>
        body { font-family: Arial, sans-serif; color: #111827; }
        .card { border: 4px solid #4f46e5; padding: 40px; text-align: center; }
        .title { font-size: 28px; font-weight: bold; margin-bottom: 10px; }
        .name { font-size: 24px; margin: 16px 0; }
        .body { font-size: 16px; }
    </style>
</head>
<body>
    <div class="card">
        <div class="title">ImpactLink Malawi Certificate</div>
        <p>This certifies that</p>
        <div class="name">{{ $certificate->volunteer?->first_name }} {{ $certificate->volunteer?->last_name }}</div>
        <p class="body">has completed participation in {{ $certificate->project?->title }} on {{ $certificate->issue_date }}.</p>
        <p class="body">Certificate Number: {{ $certificate->certificate_number }}</p>
    </div>
</body>
</html>
