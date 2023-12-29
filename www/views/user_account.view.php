<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Compte</title>
    <style>
        .edit-profile-icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background-color: #007bff;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            position: relative;
            overflow: hidden;
            /* Cacher le débordement pour éviter des problèmes de positionnement */
        }

        .edit-profile-icon:hover {
            background-color: #0056b3;
        }

        .question-mark,
        .pencil-icon {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 24px;
            display: none;
            color: #fff;
        }

        .edit-profile-icon:hover .question-mark {
            display: block;
        }

        .edit-profile-icon:hover .pencil-icon {
            display: block;
        }

        input[type="file"] {
            display: none;
        }
    </style>
</head>

<body>
    <div class="container my-5">
        <h1 class="mt-4 text-center">Mon Compte</h1>

        <?php if (isset($_SESSION['user_id'])) : ?>
            <div class="card mt-4 mx-auto" style="max-width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Informations Utilisateur</h5>

                    <!-- Gestion de la photo de profil -->
                    <div class="mt-4">
                        <form action="/account/upload-profile-image" method="POST" enctype="multipart/form-data">
                            <label for="profile-image" class="edit-profile-icon">
                                <?php if (!empty($profileImage)) : ?>
                                    <img src="data:image/jpeg;base64,<?= $profileImage ?>" alt="Profile Image" style="border-radius: 50%; width: 100%; height: 100%;">
                                <?php endif; ?>
                                <i class="fas fa-pencil-alt pencil-icon"></i>
                            </label>
                            <input type="file" name="profile_image" id="profile-image" accept="image/*" style="display: none;">
                            <button type="submit" class="btn btn-primary" style="display: none;">Enregistrer</button>
                        </form>
                    </div>


                    <p class="card-text">Nom d'utilisateur : <?= $_SESSION['username'] ?></p>
                    <p class="card-text">Adresse e-mail : <?= $_SESSION['email'] ?></p>
                    <p class="card-text">Date d'inscription : <?= date("d/m/Y", strtotime($_SESSION['creation_date'])) ?></p>
                </div>
            </div>
        <?php else : ?>
            <p class="alert alert-danger">Impossible de récupérer les informations de l'utilisateur.</p>
        <?php endif; ?>
    </div>

</body>

</html>