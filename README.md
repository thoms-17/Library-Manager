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

```bash git clone https://github.com/thoms-17/Library-Manager```
```bash cd library-manager```

#### 2. Créer le fichier `.env` dans le dossier `www/`

Ce fichier est requis pour configurer l'accès à la base de données ainsi que l'envoi des emails.

> 📌 **Important : adaptez les valeurs à votre propre configuration. Les informations doivent correspondre à ce que vous avez défini dans votre `docker-compose.yml`.**

Exemple de structure :

DB_HOST=mysql  
DB_NAME=nom_de_votre_base  
DB_USER=nom_utilisateur  
DB_PASS=mot_de_passe

EMAIL_SENDER=adresse_email_expediteur@gmail.com  
EMAIL_PASSWORD=mot_de_passe_application_google

ℹ️ Pour que la connexion fonctionne correctement avec MySQL, assurez-vous que les valeurs de `DB_NAME`, `DB_USER`, et `DB_PASS` correspondent aux variables d’environnement définies dans la section `mysql:` de votre `docker-compose.yml` :

environment:
  MYSQL_DATABASE: nom_de_votre_base
  MYSQL_USER: nom_utilisateur
  MYSQL_PASSWORD: mot_de_passe

#### 3. Lancer les conteneurs Docker

docker-compose up -d

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
