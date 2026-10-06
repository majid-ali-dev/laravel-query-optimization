<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Indexing Demo')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        :root {
            --app-body-bg: #f5f7fa;
        }

        body {
            background-color: var(--app-body-bg);
            font-family: system-ui, -apple-system, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
        }

        .app-navbar {
            background: #ffffff;
            border-bottom: 1px solid #e5e7eb;
            box-shadow: 0 1px 2px rgba(16, 24, 40, .04);
        }

        .app-brand {
            font-weight: 700;
            letter-spacing: -.01em;
        }

        .app-page-title {
            font-size: 1.75rem;
            font-weight: 700;
            letter-spacing: -.02em;
        }

        .app-card {
            border: 1px solid #e5e7eb;
            border-radius: .75rem;
            box-shadow: 0 1px 3px rgba(16, 24, 40, .06);
        }

        .app-table > :not(caption) > * > * {
            padding: .85rem 1rem;
        }

        .app-table thead th {
            background-color: #f9fafb;
            font-size: .75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: .04em;
            color: #6b7280;
            border-bottom-width: 1px;
            white-space: nowrap;
        }

        .app-table tbody tr:last-child > * {
            border-bottom: 0;
        }

        .app-footer {
            border-top: 1px solid #e5e7eb;
            color: #6b7280;
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">

    <nav class="navbar navbar-expand-lg app-navbar sticky-top">
        <div class="container">

            <a href="{{ route('posts.index') }}" class="navbar-brand app-brand text-body">
                Indexing Demo
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#appNav" aria-controls="appNav"
                    aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="appNav">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a href="{{ route('posts.index') }}"
                           class="nav-link {{ request()->routeIs('posts.index') ? 'active fw-semibold' : '' }}">
                            Posts
                        </a>
                    </li>
                </ul>
            </div>

        </div>
    </nav>

    <main class="container py-4 py-lg-5 flex-grow-1">
        @yield('content')
    </main>

    <footer class="app-footer py-3 mt-auto">
        <div class="container d-flex flex-column flex-sm-row justify-content-between align-items-center gap-2 small">
            <span>&copy; {{ date('Y') }} Indexing Demo</span>
            <span>Built with Laravel &amp; Bootstrap</span>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
