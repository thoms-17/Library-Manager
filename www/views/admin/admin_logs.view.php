<head>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
</head>

<body>

    <div class="container my-5">
        <h1 class="mt-4 text-center">Logs de connexion</h1>

        <!-- Ajoutez un ID à votre table -->
        <table id="logsTable" class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Date et heure</th>
                    <th>Action</th>
                    <!-- Ajoutez d'autres colonnes selon votre structure de log -->
                </tr>
            </thead>
            <tbody>
                <?php foreach ($logsData as $log) : ?>
                    <tr>
                        <td><?= $log['id'] ?></td>
                        <td><?= $log['timestamp'] ?></td>
                        <td><?= $log['action'] ?></td>
                        <!-- Ajoutez d'autres colonnes selon votre structure de log -->
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
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