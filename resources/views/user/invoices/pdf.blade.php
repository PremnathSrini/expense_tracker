<!DOCTYPE html>
<html>
<head>
    <title>Invoice PDF</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .container { width: 100%; max-width: 600px; margin: auto; text-align: center; }
        .qr-code { margin-top: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Invoice #{{ $invoice->invoice_number }}</h2>
        <p><strong>Customer Name:</strong> {{ $invoice->customer_name }}</p>
        <p><strong>Invoice Date:</strong> {{ $invoice->invoice_date }}</p>
        <p><strong>Amount:</strong> ${{ number_format($invoice->amount, 2) }}</p>

        <div class="qr-code">
            <p><strong>Scan QR for Invoice Details:</strong></p>
            <img src="data:image/png;base64,{{ $qrCode }}" alt="QR Code">
        </div>
    </div>
</body>
</html>
