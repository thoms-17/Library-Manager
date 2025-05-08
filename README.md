# 📚 Library Manager

**Library Manager** est une application web de gestion de bibliothèque développée en PHP en suivant le modèle MVC (Model-View-Controller), avec un environnement Docker complet (Apache, PHP, MySQL, phpMyAdmin).

---

## 🚀 Lancement rapide avec Docker

### ✅ Prérequis

- [Docker](https://www.docker.com/)
- [Docker Compose](https://docs.docker.com/compose/)
- Un compte Gmail avec [mot de passe d'application activé](https://support.google.com/accounts/answer/185833?hl=fr)

---

### 🧱 Étapes d’installation

#### 1. Cloner le projet

```bash
git clone https://github.com/thoms-17/Library-Manager
cd Library-Manager
```

#### 2. Créer le fichier `.env` dans le dossier `www/`

Ce fichier est requis pour configurer l'accès à la base de données ainsi que l'envoi des emails.

> 📌 **Important : adaptez les valeurs à votre propre configuration. Les informations doivent correspondre à ce que vous avez défini dans votre `docker-compose.yml`.**

Exemple de structure :

```bash
DB_HOST=mysql  
DB_NAME=nom_de_votre_base  
DB_USER=nom_utilisateur  
DB_PASS=mot_de_passe

EMAIL_SENDER=adresse_email_expediteur@gmail.com  
EMAIL_PASSWORD=mot_de_passe_application_google
```

ℹ️ Pour que la connexion fonctionne correctement avec MySQL, assurez-vous que les valeurs de `DB_NAME`, `DB_USER`, et `DB_PASS` correspondent aux variables d’environnement définies dans la section `mysql:` de votre `docker-compose.yml` :

environment:
  MYSQL_DATABASE: nom_de_votre_base
  MYSQL_USER: nom_utilisateur
  MYSQL_PASSWORD: mot_de_passe

#### 3. Lancer les conteneurs Docker

```bash
docker-compose up -d
```

Cela démarre les services suivants :

- **php-apache** → accessible sur http://localhost:8888  
- **mysql** → port 3306  
- **phpmyadmin** → accessible sur http://localhost:8080

---

## 🌐 Accès aux interfaces

- **Application** : http://localhost:8888  
- **phpMyAdmin** : http://localhost:8080  
  - **Utilisateur** : thoms  
  - **Mot de passe** : password

---

## 🛠 Structure du projet (`www/`)

www/  
├── controllers/       # Contrôleurs (RegisterController, LoginController, etc.)  
├── models/            # Modèles (User.php, etc.)  
├── views/             # Fichiers HTML/PHP pour le rendu  
├── Middlewares/       # Middleware de sécurité ou de méthode HTTP  
├── Utils/             # Fonctions utilitaires (email, validation, sécurité)  
├── .env               # Variables d’environnement (non versionné)  
├── router.php         # Définition des routes (si applicable)

---

## 🔐 Fonctionnalités principales

- Authentification sécurisée  
- Inscription avec validation de mot de passe  
- Vérification par email via token  
- Mot de passe oublié et réinitialisation sécurisée  
- Vérification de la robustesse des mots de passe  
- Session utilisateur sécurisée  
- Interface phpMyAdmin pour gestion de la BDD

---

### 👤 Donner les droits d'administrateur

Lors de la **première inscription**, l'utilisateur est enregistré avec un rôle par défaut "user". Si vous souhaitez accéder aux fonctionnalités réservées à un administrateur, vous pouvez **modifier manuellement le rôle dans la base de données** via **phpMyAdmin** :

1. Rendez-vous sur [http://localhost:8080](http://localhost:8080)
2. Connectez-vous avec les identifiants définis dans le `docker-compose.yml`
3. Accédez à la table `users`
4. Repérez la ligne correspondant à votre compte
5. Modifiez la colonne `role` et remplacez sa valeur par `admin`
6. Cliquez sur "Exécuter" pour valider la modification

> 🔐 L’utilisateur possède maintenant les privilèges d’un administrateur.

---

### 🛡️ Fonctionnalités réservées à l’administrateur

Une fois connecté en tant qu'administrateur, vous avez accès à des fonctionnalités supplémentaires :

- 🧩 Accès au dashboard Admin
- 🛠 Affichage des utilisateurs et des logs
- 📚 Ajout et suppression de livres
- 📊 Accès à un tableau kanban pour une gestion des tâches

> ✏️ Ces fonctionnalités sont protégées par vérification du rôle `admin` côté serveur.

## 📨 Configuration des emails

L’envoi d’e-mails utilise un compte Gmail configuré via le fichier `.env`.

### 📌 Prérequis Gmail :

1. Activez la validation en deux étapes sur votre compte Google.  
2. Créez un mot de passe d'application depuis https://myaccount.google.com/apppasswords  
3. Remplacez `EMAIL_SENDER` et `EMAIL_PASSWORD` dans `.env`.

---

## 📄 Licence

Ce projet est open-source, libre d'utilisation à des fins personnelles et pédagogiques.

---

## 💬 Contributions

Les contributions sont les bienvenues ! N'hésitez pas à ouvrir une issue ou une pull request.
