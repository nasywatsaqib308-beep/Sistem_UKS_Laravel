<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login UKS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center" style="height: 100vh;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card shadow border-0">
                    <div class="card-header bg-primary text-white text-center py-3">
                        <h5 class="mb-0 fw-bold">Login Sistem UKS</h5>
                    </div>
                    <div class="card-body p-4">
                        @if($errors->any())
                            <div class="alert alert-danger">{{ $errors->first() }}</div>
                        @endif
                        <form action="{{ url('/login') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" required value="admin@uks.com">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" required value="password">
                            </div>
                            <button type="submit" class="btn btn-primary w-100 fw-bold">Login</button>
                        </form>
                        <hr>
                        <p class="text-muted small text-center mb-0">Admin: admin@uks.com / password</p>
                        <p class="text-muted small text-center mb-0">Petugas: petugas@uks.com / password</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
