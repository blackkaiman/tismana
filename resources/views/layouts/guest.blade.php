<!DOCTYPE html>
<html lang="ro">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Login – Primăria Tismana</title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

        <style>
            body {
                background: linear-gradient(135deg, #1a5276 0%, #1a6e9e 100%);
                min-height: 100vh;
                display: flex;
                align-items: center;
                justify-content: center;
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            }
            .login-card {
                background: #fff;
                border-radius: 16px;
                box-shadow: 0 10px 40px rgba(0,0,0,.2);
                max-width: 420px;
                width: 100%;
                padding: 40px;
            }
            .login-card .brand {
                text-align: center;
                margin-bottom: 30px;
            }
            .login-card .brand i {
                font-size: 2.5rem;
                color: #1a5276;
            }
            .login-card .brand h4 {
                font-weight: 700;
                color: #1a5276;
                margin-top: 8px;
            }
            .btn-login {
                background: #1a5276;
                border-color: #1a5276;
                padding: 10px;
                font-weight: 600;
            }
            .btn-login:hover {
                background: #154360;
                border-color: #154360;
            }
        </style>
    </head>
    <body>
        <div class="login-card">
            <div class="brand">
                <i class="bi bi-building"></i>
                <h4>Primăria Tismana</h4>
                <p class="text-muted small">Panou de administrare</p>
            </div>
            {{ $slot }}
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
