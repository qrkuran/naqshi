<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Naqshi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding-top: 60px; /* Navbar fixed-top kullanıldığında içeriğin üst boşluğu için */
        }

        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            background-color: #f8f9fa;
            padding: 15px 0;
        }
    </style>
</head>

<body>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">naqshi.uz</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
        </div>
    </div>
</nav>

<!-- Ana İçerik -->
<div class="container">
    <main role="main" class="pb-5">
        <div class="table-responsive">
            <table class="table table-striped mt-4">
                <tbody>
                @foreach ($content as $item)
                    <tr>
                        <td class="col-9">{{ $item['title'] }}</td>
                        <td class="col-3">
                            <audio controls controlslist="nodownload" class="w-100">
                                <source src="{{ $item['sound'] }}" type="audio/mpeg">
                            </audio>
                        </td>
                    </tr>
                    <tr>
                        <td class="col-9"></td>
                        <td class="col-3"></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </main>
</div>

<!-- Footer -->
<footer class="footer border-top text-muted">
    <div class="container">
        &copy; {{ date('Y') }} All rights reserved.
    </div>
</footer>

<!-- JavaScript Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
