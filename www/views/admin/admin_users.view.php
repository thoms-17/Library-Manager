<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>

    <div class="container my-5">
        <h1 class="mt-4 text-center">Liste des utilisateurs</h1>

        <div class="table-responsive">
            <!-- Ajoutez un ID à votre table -->
            <table id="logsTable" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom d'utilisateur</th>
                        <th>Email</th>
                        <th>Date de création</th>
                        <th>Rôle</th>
                        <!-- Ajoutez d'autres colonnes selon votre structure de log -->
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($usersData as $user) : ?>
                        <tr>
                            <td><?= $user['id'] ?></td>
                            <td><?= $user['username'] ?></td>
                            <td><?= $user['email'] ?></td>
                            <td><?= $user['creation_date'] ?></td>
                            <td><?= $user['role'] ?></td>
                            <!-- Ajoutez d'autres colonnes selon votre structure de log -->
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function() {
            // Initialisez DataTables avec votre table
            $('#logsTable').DataTable({
                // Configurations supplémentaires selon vos besoins
            });
        });
    </script>

</body>

</html>
