<!DOCTYPE html>
<html>
<head>
    <title>DPA PDF</title>
    <style>
        /* Your custom CSS styles for the PDF content go here */
        body {
            font-family: Arial, sans-serif;
        }
        .page-header {
            text-align: center;
            margin-bottom: 20px;
        }
        .content {
            margin: 20px;
        }
        /* ... More styles ... */
    </style>
</head>
<body>
    <div class="page-header">
        <h1>DPA PDF</h1>
    </div>
    <div class="content">
        {{-- Display DPA details in the PDF content --}}
        <p><strong>Nomor DPA:</strong> {{ $dpa->kode_sub_kegiatan }}</p>
        {{-- ... Display more details ... --}}
    </div>
</body>
</html>
