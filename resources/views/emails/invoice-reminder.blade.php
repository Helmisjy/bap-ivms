<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif; color:#333;
        }
        .box {
            padding: 20px;
            border-radius: 10px;
            background: #f6f7f9;
            border: 1px solid #ddd;
        }
        .title {
            font-size: 22px;
            font-weight: bold;
            color: #0062cc;
        }
        .category {
            padding: 8px 15px;
            background: #f0ad4e;
            color: white;
            font-weight: bold;
            border-radius: 6px;
            display: inline-block;
            margin-top: 10px;
        }
    </style>
</head>
<body>

<div class="box">
    <div class="title">Invoice Reminder</div>

    <p>Dear {{ $invoice->instruction->client->pic }},</p>

    <p>
        Ini adalah pengingat terkait invoice berikut:
    </p>

    <ul>
        <li><strong>Invoice Number :</strong> {{ $invoice->inv_number }}</li>
        <li><strong>Client :</strong> {{ $invoice->instruction->client->name }}</li>
        <li><strong>Project :</strong> {{ $invoice->instruction->project->name ?? '-' }}</li>
        <li><strong>Due Date :</strong> {{ $invoice->inv_target }}</li>
        <li><strong>Aging Days :</strong> {{ $invoice->aging_days }} hari</li>
    </ul>

    <div class="category">
        Reminder Category: {{ strtoupper($category) }}
    </div>

    <p>
        Mohon segera melakukan proses pembayaran atau menghubungi tim kami jika memerlukan informasi tambahan.
    </p>

    <p>Best regards,<br>Finance Department</p>
</div>

</body>
</html>
