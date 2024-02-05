<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="../styles/admin_dashboard.css">
</head>

<body>
    <div class="container mt-5">
        <h1 class="mb-4 text-center">Espace Admin</h1>

        <!-- Widgets -->
        <div class="row">
            <div class="col-md-4 mb-4 col-6">
                <a href="/admin/logs" style="text-decoration: none; color: inherit;">
                    <div class="card">
                        <div class="card-body text-center">
                            <i class="fas fa-file-alt fa-3x mb-3 text-primary"></i>
                            <h5 class="card-title">Logs</h5>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-4 mb-4 col-6">
                <a href="/admin/users" style="text-decoration: none; color: inherit;">
                    <div class="card">
                        <div class="card-body text-center">
                            <i class="fa-solid fa-user fa-3x mb-3 text-primary"></i>
                            <h5 class="card-title">Utilisateurs</h5>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Ajoutez d'autres widgets selon vos besoins -->
        </div>
    </div>
</body>

</html>
