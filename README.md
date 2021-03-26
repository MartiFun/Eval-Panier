# Eval-Panier

Lancer $composer install dans la racine du projet
puis $npm install


# dans le .Env changer ces parametres :

APP_KEY=base64:MCkoovtRpY2FK6u1HQgGzQrGlIglaDRbikFcf5I6yxc=
DB_DATABASE='nomTableExemple'
DB_USERNAME=root
DB_PASSWORD=

# puis :

$php artisan migrate
$php artisan db:seed
$php artisan serve

# 7 plats sont crée de base

# un compte admin existe avec comme email 'toto@fun.fr' et mdp 'password'
# un admin n'a pas accès au panier
