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
        <h1 class="mb-4">Espace Admin</h1>

        <div class="row">
            <div class="col-md-4 mb-4">
                <!-- Widget pour les logs (avec lien sur l'ensemble de la carte) -->
                <a href="/admin/logs" style="text-decoration: none; color: inherit;">
                    <div class="card">
                        <div class="card-body text-center">
                            <i class="fas fa-file-alt fa-3x mb-3 custom-color"></i>
                            <h5 class="card-title">Logs</h5>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Ajoutez d'autres widgets selon vos besoins -->
        </div>
    </div>
</body>

</html>
