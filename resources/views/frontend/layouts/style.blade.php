      <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <style>
        :root {
            --primary-color: #2563eb;
            --secondary-color: #1e40af;
            --success-color: #10b981;
            --danger-color: #ef4444;
            --dark-bg: #1f2937;
            --light-bg: #f9fafb;
        }
        
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .content-section {
            animation: slideIn 0.3s ease;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--light-bg);
        }
        
        .sidebar {
            background: linear-gradient(180deg, var(--dark-bg) 0%, var(--secondary-color) 100%);
            min-height: 100vh;
            color: white;
            position: fixed;
            left: 0;
            top: 0;
            width: 250px;
            transition: all 0.3s;
            z-index: 1000;
        }
        
        .sidebar.mobile-hidden {
            left: -250px;
        }
        
        .sidebar .logo {
            padding: 20px;
            text-align: center;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }
        
        .sidebar .logo h4 {
            margin: 0;
            font-weight: 700;
        }
        
        .sidebar .nav-link {
            color: rgba(255,255,255,0.8);
            padding: 12px 20px;
            transition: all 0.3s;
            border-left: 3px solid transparent;
        }
        
        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background-color: rgba(255,255,255,0.1);
            color: white;
            border-left-color: var(--success-color);
        }
        
        .sidebar .nav-link i {
            width: 20px;
            margin-right: 10px;
        }
        
        .main-content {
            margin-left: 250px;
            padding: 20px;
            transition: all 0.3s;
        }
        
        .main-content.full-width {
            margin-left: 0;
        }
        
        .top-navbar {
            background: white;
            padding: 15px 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin: -20px -20px 20px -20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .menu-toggle {
            display: none;
            background: var(--primary-color);
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 5px;
            cursor: pointer;
        }
        
        .stat-card {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            transition: transform 0.3s;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
        }
        
        .stat-card .icon {
            width: 50px;
            height: 50px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
        }
        
        .stat-card.blue .icon {
            background: rgba(37, 99, 235, 0.1);
            color: var(--primary-color);
        }
        
        .stat-card.green .icon {
            background: rgba(16, 185, 129, 0.1);
            color: var(--success-color);
        }
        
        .stat-card.orange .icon {
            background: rgba(245, 158, 11, 0.1);
            color: #f59e0b;
        }
        
        .stat-card.red .icon {
            background: rgba(239, 68, 68, 0.1);
            color: var(--danger-color);
        }
        
        .card {
            border: none;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            border-radius: 10px;
        }
        
        .card-header {
            background: white;
            border-bottom: 2px solid var(--light-bg);
            font-weight: 600;
            padding: 15px 20px;
        }
        
        .table-responsive {
            border-radius: 10px;
            overflow: hidden;
        }
        
        .table {
            margin-bottom: 0;
        }
        
        .table thead {
            background: var(--primary-color);
            color: white;
        }
        
        .btn-primary {
            background: var(--primary-color);
            border: none;
        }
        
        .btn-primary:hover {
            background: var(--secondary-color);
        }
        
        .badge {
            padding: 5px 10px;
        }
        
        .search-box {
            position: relative;
        }
        
        .search-box input {
            padding-left: 35px;
        }
        
        .search-box i {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #6b7280;
        }
        
        .notification-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background: var(--danger-color);
            color: white;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            font-size: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .chart-container {
            position: relative;
            height: 300px;
        }
        
        .activity-item {
            padding: 12px;
            border-left: 3px solid var(--primary-color);
            margin-bottom: 10px;
            background: white;
            border-radius: 5px;
            transition: all 0.3s;
        }
        
        .activity-item:hover {
            background: var(--light-bg);
            transform: translateX(5px);
        }
        
        .progress-circle {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 14px;
        }
        
        .modal-backdrop.show {
            opacity: 0.5;
        }
        
        @media (max-width: 768px) {
            .sidebar {
                left: -250px;
            }
            
            .sidebar.mobile-show {
                left: 0;
            }
            
            .main-content {
                margin-left: 0;
            }
            
            .menu-toggle {
                display: block;
            }
            
            .stat-card {
                margin-bottom: 15px;
            }
        }
        
        @media print {
            .sidebar, .top-navbar, .no-print {
                display: none !important;
            }
            .main-content {
                margin: 0;
                padding: 0;
            }
        }
    </style>