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
            --primary-bg: #f1f5f9;
            --sidebar-bg: #0f172a;
            --sidebar-text: #94a3b8;
            --sidebar-hover: rgba(255, 255, 255, 0.05);
            --accent-orange: #ff7e3b;
            --card-bg: #ffffff;
            --text-main: #0f172a;
            --text-muted: #64748b;
            --border-color: #f1f5f9;
            --btn-hover: #e66a2b;
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
            padding: 24px;
            position: fixed;
            left: 0;
            top: 0;
            border-right: 1px solid rgba(255, 255, 255, 0.05);
            display: flex;
            flex-direction: column;
            z-index: 1000;
        }

        .sidebar-brand {
            font-size: 22px;
            font-weight: 700;
            color: #ffffff;
            margin-bottom: 40px;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .nav-link {
            color: var(--sidebar-text);
            padding: 12px 16px;
            border-radius: 12px;
            margin-bottom: 6px;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            text-decoration: none;
            font-weight: 500;
            font-size: 15px;
        }

        .nav-link i { 
            width: 20px; 
            font-size: 18px;
            margin-right: 12px;
            opacity: 0.7;
        }

        .nav-link:hover {
            background: var(--sidebar-hover);
            color: #ffffff;
        }

        .nav-link.active {
            background: #ffffff;
            color: var(--accent-orange);
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        .nav-link.active i {
            opacity: 1;
        }

        /* Content Area */
        .main-content {
            margin-left: 260px;
            flex: 1;
            padding: 50px;
            min-height: 100vh;
        }

        .glass-card {
            background: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.02);
        }

        .btn-premium {
            background: var(--accent-orange);
            border: none;
            color: white;
            padding: 12px 28px;
            border-radius: 12px;
            font-weight: 600;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .btn-premium:hover {
            background: var(--btn-hover);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(255, 126, 59, 0.25);
            color: white;
        }

        .form-control, .form-select {
            background: #fcfcfc;
            border: 1px solid var(--border-color);
            color: var(--text-main);
            padding: 14px;
            border-radius: 12px;
            font-size: 15px;
        }

        .form-control:focus {
            background: #ffffff;
            border-color: var(--accent-orange);
            box-shadow: 0 0 0 4px rgba(255, 126, 59, 0.08);
        }

        .section-badge {
            background: #f8fafc;
            padding: 12px 16px;
            border-radius: 12px;
            font-size: 14px;
            color: var(--text-muted);
            border: 1px solid var(--border-color);
            line-height: 1.6;
        }

        h1 { font-weight: 700; letter-spacing: -0.5px; }
    </style>
    @stack('styles')
</head>
<body>

    <aside class="sidebar">
        <a href="" class="sidebar-brand">
            <img src="{{ asset('images/loader.png') }}" height="40" width="24"> YWP Admin
        </a>

        <nav class="flex-grow-1">
            <a href="{{ route('admin.page-content.index', ['group' => 'home']) }}" class="nav-link {{ (($group ?? Request::get('group')) === 'home' || (Request::is('admin/page-content*') && !isset($group) && !Request::has('group'))) ? 'active' : '' }}">
                <i class="fa fa-home"></i> Home Content
            </a>
            <a href="{{ route('admin.page-content.index', ['group' => 'about']) }}" class="nav-link {{ ($group ?? Request::get('group')) === 'about' ? 'active' : '' }}">
                <i class="fa fa-info-circle"></i> About Pages
            </a>
            <a href="{{ route('admin.campaigns.index') }}" class="nav-link {{ Request::is('admin/campaigns*') ? 'active' : '' }}">
                <i class="fa fa-bullhorn"></i> Campaigns
            </a>
            <a href="{{ route('admin.professionals.index') }}" class="nav-link {{ Request::is('admin/professionals*') ? 'active' : '' }}">
                <i class="fa fa-user-md"></i> Professionals
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
