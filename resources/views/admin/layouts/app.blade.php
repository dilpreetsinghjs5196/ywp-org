<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YWP Admin Panel</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-bg: #0f172a;
            --sidebar-bg: #1e293b;
            --accent-orange: #ff7e3b;
            --card-glass: rgba(255, 255, 255, 0.05);
            --text-main: #f8fafc;
            --text-muted: #94a3b8;
        }

        body {
            font-family: 'Outfit', sans-serif;
            background-color: var(--primary-bg);
            color: var(--text-main);
            margin: 0;
            display: flex;
        }

        /* Sidebar */
        .sidebar {
            width: 260px;
            height: 100vh;
            background: var(--sidebar-bg);
            padding: 20px;
            position: fixed;
            left: 0;
            top: 0;
            border-right: 1px solid rgba(255,255,255,0.05);
            display: flex;
            flex-direction: column;
        }

        .sidebar-brand {
            font-size: 24px;
            font-weight: 700;
            color: var(--accent-orange);
            margin-bottom: 40px;
            text-decoration: none;
            display: flex;
            align-items: center;
        }

        .sidebar-brand img { margin-right: 10px; }

        .nav-link {
            color: var(--text-muted);
            padding: 12px 15px;
            border-radius: 10px;
            margin-bottom: 5px;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            text-decoration: none;
        }

        .nav-link i { width: 25px; }

        .nav-link:hover, .nav-link.active {
            background: rgba(255,255,255,0.05);
            color: var(--accent-orange);
        }

        /* Content Area */
        .main-content {
            margin-left: 260px;
            flex: 1;
            padding: 40px;
            min-height: 100vh;
        }

        .glass-card {
            background: var(--card-glass);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }

        .btn-premium {
            background: linear-gradient(135deg, #ff7e3b, #ff4d00);
            border: none;
            color: white;
            padding: 10px 25px;
            border-radius: 12px;
            font-weight: 600;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .btn-premium:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 126, 59, 0.4);
            color: white;
        }

        .form-control, .form-select {
            background: rgba(255,255,255,0.03);
            border: 1px solid rgba(255,255,255,0.1);
            color: var(--text-main);
            padding: 12px;
            border-radius: 10px;
        }

        .form-control:focus {
            background: rgba(255,255,255,0.05);
            border-color: var(--accent-orange);
            color: var(--text-main);
            box-shadow: none;
        }

        .alert-success {
            background: rgba(16, 185, 129, 0.1);
            border: 1px solid rgba(16, 185, 129, 0.2);
            color: #10b981;
            border-radius: 12px;
        }

        .section-badge {
            background: rgba(255,255,255,0.05);
            padding: 5px 15px;
            border-radius: 8px;
            font-size: 14px;
            color: var(--text-muted);
            border: 1px solid rgba(255,255,255,0.05);
        }
    </style>
    @stack('styles')
</head>
<body>

    <aside class="sidebar">
        <a href="" class="sidebar-brand">
            <img src="{{ asset('images/loader.png') }}" height="40" width="24"> YWP Admin
        </a>

        <nav class="flex-grow-1">
            <a href="{{ route('admin.page-content.index') }}" class="nav-link active">
                <i class="fa fa-home"></i> Home Content
            </a>
            <a href="#" class="nav-link">
                <i class="fa fa-bullhorn"></i> Campaigns
            </a>
            <a href="#" class="nav-link">
                <i class="fa fa-question-circle"></i> FAQs
            </a>
             <a href="#" class="nav-link">
                <i class="fa fa-file-contract"></i> Policies
            </a>
        </nav>

        <div class="mt-auto">
            <a href="{{ url('/') }}" target="_blank" class="nav-link">
                <i class="fa fa-external-link-alt"></i> Visit Website
            </a>
        </div>
    </aside>

    <main class="main-content">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
