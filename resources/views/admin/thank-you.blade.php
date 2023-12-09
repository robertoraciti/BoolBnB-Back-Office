<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f7f7f7;
            text-align: center;
            padding: 50px;
        }

        h1 {
            color: #27ae60;
        }

        p {
            color: #333;
            font-size: 18px;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Thank You for Your Purchase!</h1>
        <p>We appreciate your business and hope you enjoy your product.</p>
    </div>

    <script>
        setTimeout(function() {
            window.location.href = "{{ route('admin.apartments.index') }}";
        }, 4000);
    </script>
</body>
</html>