# Eval-Panier

Lancer $composer install dans la racine du projet
puis $npm install

# pour la bdd on creer un utilisateur ayant les droits de données et structure
```SQL
CREATE USER 'user'@'localhost' IDENTIFIED WITH caching_sha2_password BY '***';GRANT SELECT, INSERT, UPDATE, DELETE, CREATE, DROP, FILE, REFERENCES, INDEX, ALTER, CREATE TEMPORARY TABLES, CREATE VIEW, EVENT, TRIGGER, SHOW VIEW, CREATE ROUTINE, ALTER ROUTINE, EXECUTE ON *.* TO 'user'@'localhost';ALTER USER 'user'@'localhost' REQUIRE NONE WITH MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0;
```

#puis on creer la bdd
```SQL
CREATE DATABASE IF NOT EXISTS cuisinol
```

# dans le .Env changer ces parametres :

APP_NAME=Cuisinol
APP_KEY=base64:MCkoovtRpY2FK6u1HQgGzQrGlIglaDRbikFcf5I6yxc=

DB_HOST=localhost
DB_DATABASE=cuisinol
DB_USERNAME=user
DB_PASSWORD=root



# puis :

$php artisan migrate
$php artisan db:seed
$php artisan serve

# 7 plats sont crée de base

# un compte admin existe avec comme email 'toto@fun.fr' et mdp 'password'
# un admin n'a pas accès au panier. Il peut creer des plats, les supprimer, créer des ingredients, type et types de nouriture.

# la Modification de plat ne fonctionne pas.
# les tables pour l'historique de commandes sont crée tout comme les relation mais j'ai pas eu le temp d'en faire usage
