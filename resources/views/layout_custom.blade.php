<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard SPP')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #f8f9fc;
            overflow-x: hidden;
        }
        
        #wrapper {
            display: flex;
            width: 100vw;
            min-height: 100vh;
        }

        #sidebar {
            width: 224px;
            background-color: #4e73df;
            background-image: linear-gradient(180deg, #4e73df 10%, #224abe 100%);
            color: white;
            transition: all 0.3s;
        }

        #sidebar .sidebar-brand {
            height: 70px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            font-weight: 700;
            text-decoration: none;
            color: white;
            letter-spacing: 0.05rem;
        }

        #sidebar .nav-link {
            color: rgba(255, 255, 255, 0.8);
            padding: 1rem 1.5rem;
            font-weight: 700;
            font-size: 0.85rem;
        }

        #sidebar .nav-link:hover, #sidebar .nav-link.active {
            color: white;
            background: rgba(255, 255, 255, 0.1);
        }

        #sidebar .nav-link i {
            margin-right: 10px;
            font-size: 0.9rem;
        }

        #content-wrapper {
            flex: 1;
            display: flex;
            flex-direction: column;
            width: 100%;
        }

        #topbar {
            height: 70px;
            background-color: white;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
        }

        .container-fluid {
            padding: 1.5rem;
        }

        .card {
            border: none;
            border-radius: 0.35rem;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
        }
        .card-header {
            background-color: #f8f9fc;
            border-bottom: 1px solid #e3e6f0;
            font-weight: bold;
            color: #4e73df;
        }
    </style>
</head>
<body>

    <div id="wrapper">
        <div id="sidebar" class="d-flex flex-column">
            <a href="/dashboard" class="sidebar-brand">
                <i class="fas fa-laugh-wink fa-lg me-2"></i>
                SB ADMIN KW
            </a>
            <hr class="border-light opacity-25 mx-3 my-0">
            
            <ul class="nav flex-column mb-auto mt-2">
                <li class="nav-item">
                    <a href="/dashboard" class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}">
                        <i class="fas fa-fw fa-tachometer-alt"></i> Dashboard
                    </a>
                </li>
                
                @if(auth()->user()->level == 'admin')
                <div class="px-3 pt-3 text-uppercase text-white-50" style="font-size: 0.65rem; font-weight: 800;">
                    Menu Master
                </div>
                
                <li class="nav-item">
                    <a href="{{ route('spp.index') }}" class="nav-link {{ Request::is('spp*') ? 'active' : '' }}">
                        <i class="fas fa-fw fa-database"></i> Data SPP
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('kelas.index') }}" class="nav-link {{ Request::is('kelas*') ? 'active' : '' }}">
                        <i class="fas fa-fw fa-chalkboard"></i> Data Kelas
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('siswa.index') }}" class="nav-link {{ Request::is('siswa*') ? 'active' : '' }}">
                        <i class="fas fa-fw fa-users"></i> Data Siswa
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('petugas.index') }}" class="nav-link {{ Request::is('petugas*') ? 'active' : '' }}">
                        <i class="fas fa-fw fa-user-tie"></i> Data Petugas
                    </a>
                </li>
                @endif
                
                <div class="px-3 pt-4 pb-2 text-uppercase text-white-50" style="font-size: 0.65rem; font-weight: 800;">
                    Transaksi
                </div>
                
                <li class="nav-item">
                    <a href="{{ route('pembayaran.index') }}" class="nav-link {{ Request::is('pembayaran*') ? 'active' : '' }}">
                        <i class="fas fa-fw fa-money-bill-wave"></i> Entri Pembayaran
                    </a>
                </li>
            </ul>
        </div>

        <div id="content-wrapper">
            <nav id="topbar" class="d-flex align-items-center justify-content-end px-4 mb-4">
                <div class="dropdown">
                    <a class="text-decoration-none text-secondary dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="me-2 d-none d-lg-inline text-gray-600 small">
                            {{ auth()->user()->nama_petugas }} ({{ strtoupper(auth()->user()->level) }})
                        </span>
                        <img class="rounded-circle" src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->nama_petugas) }}&background=4e73df&color=fff" width="32">
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow border-0">
                        <li><a class="dropdown-item" href="#"><i class="fas fa-user fa-sm fa-fw me-2 text-gray-400"></i> Profile</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i> Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </nav>

            <div class="container-fluid">
                @yield('content')
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>