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