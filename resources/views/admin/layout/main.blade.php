<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') - Royal Furniture</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Cinzel:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        :root {
            --bg-dark: #0D0D0D;
            --bg-sidebar: #1A1A1A;
            --bg-card: #242424;
            --primary: #C9A227;
            --secondary: #8B7355;
            --text-primary: #FFFFFF;
            --text-secondary: #A0A0A0;
            --success: #2ECC71;
            --warning: #F39C12;
            --danger: #E74C3C;
            --border: #333333;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: var(--bg-dark);
            color: var(--text-primary);
            min-height: 100vh;
        }

        .admin-wrapper {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 260px;
            background: var(--bg-sidebar);
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            border-right: 1px solid var(--border);
        }

        .sidebar-logo {
            padding: 20px;
            text-align: center;
            border-bottom: 1px solid var(--border);
            background: linear-gradient(135deg, var(--bg-sidebar) 0%, #252525 100%);
        }

        .sidebar-logo h1 {
            font-family: 'Cinzel', serif;
            color: var(--primary);
            font-size: 24px;
            letter-spacing: 2px;
        }

        .sidebar-logo span {
            color: var(--text-secondary);
            font-size: 12px;
            letter-spacing: 3px;
        }

        .sidebar-menu {
            padding: 15px 0;
        }

        .menu-item {
            display: block;
            padding: 12px 20px;
            color: var(--text-secondary);
            text-decoration: none;
            transition: all 0.3s;
            border-left: 3px solid transparent;
            font-size: 14px;
        }

        .menu-item:hover, .menu-item.active {
            background: rgba(201, 162, 39, 0.1);
            color: var(--primary);
            border-left-color: var(--primary);
        }

        .menu-item i {
            width: 25px;
        }

        .main-content {
            margin-left: 260px;
            flex: 1;
            min-height: 100vh;
        }

        .header {
            background: var(--bg-card);
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid var(--border);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .header-title {
            font-size: 20px;
            font-weight: 600;
        }

        .header-user {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .header-user span {
            color: var(--text-secondary);
        }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-block;
        }

        .btn-primary {
            background: var(--primary);
            color: #000;
        }

        .btn-primary:hover {
            background: #DDB52F;
        }

        .btn-danger {
            background: var(--danger);
            color: #fff;
        }

        .btn-success {
            background: var(--success);
            color: #fff;
        }

        .btn-warning {
            background: var(--warning);
            color: #000;
        }

        .btn-sm {
            padding: 5px 10px;
            font-size: 12px;
        }

        .card {
            background: var(--bg-card);
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            border: 1px solid var(--border);
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px solid var(--border);
        }

        .card-title {
            font-size: 18px;
            font-weight: 600;
            color: var(--primary);
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th, .table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid var(--border);
        }

        .table th {
            background: rgba(201, 162, 39, 0.1);
            color: var(--primary);
            font-weight: 600;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .table tr:hover {
            background: rgba(255, 255, 255, 0.02);
        }

        .badge {
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .badge-success {
            background: rgba(46, 204, 113, 0.2);
            color: var(--success);
        }

        .badge-warning {
            background: rgba(243, 156, 18, 0.2);
            color: var(--warning);
        }

        .badge-danger {
            background: rgba(231, 76, 60, 0.2);
            color: var(--danger);
        }

        .badge-info {
            background: rgba(52, 152, 219, 0.2);
            color: #3498DB;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            color: var(--text-secondary);
            font-size: 13px;
            font-weight: 500;
        }

        .form-control {
            width: 100%;
            padding: 12px;
            background: var(--bg-dark);
            border: 1px solid var(--border);
            border-radius: 5px;
            color: var(--text-primary);
            font-size: 14px;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary);
        }

        textarea.form-control {
            min-height: 120px;
            resize: vertical;
        }

        .alert {
            padding: 15px 20px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .alert-success {
            background: rgba(46, 204, 113, 0.1);
            border: 1px solid var(--success);
            color: var(--success);
        }

        .alert-danger {
            background: rgba(231, 76, 60, 0.1);
            border: 1px solid var(--danger);
            color: var(--danger);
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: var(--bg-card);
            border-radius: 10px;
            padding: 25px;
            border: 1px solid var(--border);
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
            background: var(--primary);
        }

        .stat-card h3 {
            color: var(--text-secondary);
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 10px;
        }

        .stat-card .value {
            font-size: 32px;
            font-weight: 700;
            color: var(--primary);
        }

        .stat-card .icon {
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 48px;
            color: rgba(201, 162, 39, 0.1);
        }

        .pagination {
            display: flex;
            gap: 5px;
            margin-top: 20px;
        }

        .pagination a {
            padding: 8px 12px;
            background: var(--bg-card);
            color: var(--text-secondary);
            border: 1px solid var(--border);
            border-radius: 5px;
            text-decoration: none;
            transition: all 0.3s;
        }

        .pagination a:hover, .pagination a.active {
            background: var(--primary);
            color: #000;
            border-color: var(--primary);
        }

        .actions {
            display: flex;
            gap: 5px;
        }

        .page-content {
            padding: 30px;
        }

        .search-form {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }

        .search-form .form-control {
            flex: 1;
        }

        .filter-form {
            display: flex;
            gap: 15px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        .filter-form select {
            padding: 8px 15px;
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 5px;
            color: var(--text-primary);
        }

        .image-preview {
            max-width: 200px;
            margin-top: 10px;
        }

        .image-preview img {
            width: 100%;
            border-radius: 5px;
        }

        .login-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, var(--bg-dark) 0%, #1a1a2e 100%);
        }

        .login-box {
            width: 400px;
            background: var(--bg-card);
            padding: 40px;
            border-radius: 10px;
            border: 1px solid var(--border);
        }

        .login-box h2 {
            text-align: center;
            color: var(--primary);
            font-family: 'Cinzel', serif;
            margin-bottom: 30px;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                position: relative;
            }
            .main-content {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>
    @yield('content')
</body>
</html>
