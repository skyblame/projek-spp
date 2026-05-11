<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Aplikasi SPP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #4e73df; }
    </style>
</head>
<body class="d-flex align-items-center justify-content-center" style="height: 100vh;">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card shadow-lg border-0 rounded-lg mt-5">
                    <div class="card-header bg-white text-center pt-4 pb-2">
                        <h4 class="text-primary font-weight-bold" style="font-weight: 800;">Aplikasi SPP</h4>
                        <p class="text-muted small">Silakan login menggunakan akun Petugas/Admin</p>
                    </div>
                    <div class="card-body p-4">
                        
                        @if($errors->any())
                            <div class="alert alert-danger p-2 small text-center">
                                {{ $errors->first() }}
                            </div>
                        @endif

                        <form action="/login" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label text-secondary small fw-bold">Username</label>
                                <input type="text" name="username" class="form-control" value="{{ old('username') }}" placeholder="Masukkan username..." required autofocus>
                            </div>
                            <div class="mb-4">
                                <label class="form-label text-secondary small fw-bold">Password</label>
                                <input type="password" name="password" class="form-control" placeholder="Masukkan password..." required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100 py-2 fw-bold">
                                LOGIN
                            </button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>