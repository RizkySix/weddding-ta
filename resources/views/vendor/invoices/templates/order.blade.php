<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <style>
        body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f4;
}

.invoice {
    width: 80%;
    margin: 50px auto;
    background-color: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.invoice-header h1 {
    margin: 0;
    color: #333;
}

.invoice-header p {
    margin-top: 5px;
    color: #666;
}

.invoice-body {
    margin-top: 20px;
}

.invoice-details p {
    margin: 5px 0;
}

.invoice-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

.invoice-table th, .invoice-table td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: left;
}

.invoice-table th {
    background-color: #f2f2f2;
}

.invoice-footer {
    margin-top: 20px;
    text-align: right;
}

.invoice-footer p {
    font-weight: bold;
}

    </style>
</head>
<body>
    <div class="invoice">
        <div class="invoice-header">
            <h1>{{ $invoice->name }}</h1>
            <p>Invoice #{{ $invoice->getCustomData() }}</p>
        </div>
        <div class="invoice-body">
            <div class="invoice-details">
                <p><strong>Invoice Date:</strong> {{ $invoice->getDate() }}</p>
                <p><strong>Pemesan:</strong> {{ $invoice->buyer->name }}</p>
                <p><strong>Email:</strong> {{ $invoice->buyer->custom_fields['email'] }}</p>
                <p><strong>Phone:</strong> {{ $invoice->buyer->custom_fields['phone'] }}</p>
                <p><strong>Tanggal Sewa:</strong> {{ $invoice->buyer->custom_fields['start_date'] }}</p>
                <p><strong>Tanggal Selesai:</strong> {{ $invoice->buyer->custom_fields['end_date'] }}</p>
                <p><strong>Total Hari:</strong> {{ $invoice->buyer->custom_fields['total_day'] }}</p>
                <p><strong>Lokasi Pemasangan:</strong> {{ $invoice->buyer->custom_fields['address'] }}</p>
            </div>
            <table class="invoice-table">
                <thead>
                    <tr>
                        <th>Paket</th>
                        <th>Quantity</th>
                        <th>Harga</th>
                        <th>Diskon</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $invoice->buyer->custom_fields['package'] }}</td>
                        <td>1</td>
                        <td>{{ $invoice->buyer->custom_fields['price'] }}</td>
                        <td>{{ $invoice->buyer->custom_fields['discount'] }}%</td>
                        <td>Lunas</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="invoice-footer">
            <p><strong>Total:</strong> {{ $invoice->buyer->custom_fields['total'] }}</p>
        </div>
    </div>
</body>
</html>
