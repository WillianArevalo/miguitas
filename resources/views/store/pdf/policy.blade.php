<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Policy PDF</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .header-left {
            text-align: left;
            font-size: 12px;
        }

        .header-right {
            text-align: right;
            font-size: 12px;
        }

        .images img {
            width: 100%;
            margin-bottom: 10px;
        }

        footer {
            text-align: center;
            font-size: 12px;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="header">
        <div class="header-left">
            {{ $date }}
        </div>
        <div class="header-right">
            {{ $policy->name }} – Miguitas El Salvador
        </div>
    </div>
    <div class="images">
        @foreach ($policy->images as $image)
            <img src="{{ public_path('storage/' . $image->file_path) }}" alt="Policy Image">
        @endforeach
    </div>
    <footer>
        <p>
            {{ url('/') }}
        </p>
    </footer>
</body>

</html>
