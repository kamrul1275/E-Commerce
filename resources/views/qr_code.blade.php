<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Code</title>
    <style>
        .qr-container {
            max-width: 300px;
            margin: 50px auto;
            padding: 30px;
            text-align: center;
            border: 2px solid #ddd;
            border-radius: 10px;
            background-color: #f9f9f9;
            font-family: Arial, sans-serif;
        }
        
        .qr-title {
            color: #333;
            margin-bottom: 20px;
            font-size: 20px;
            font-weight: bold;
        }
        
        .qr-code {
            margin: 20px 0;
        }
        
        .scan-instruction {
            color: #666;
            font-size: 16px;
            margin-top: 15px;
        }
    </style>
</head>
<body>
    <div class="qr-container">
        <h2 class="qr-title">Profile QR Code</h2>
        
        <div class="qr-code">
            {!! $qrCode !!}
        </div>
        
        <p class="scan-instruction">Scan this QR code to view profile information</p>
    </div>
</body>
</html>