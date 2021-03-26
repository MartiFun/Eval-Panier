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
# un admin n'a pas accès au panier. Il peut creer des plats, les supprimer, créer des ingredients, type et types de nouriture.

# la Modification de plat ne fonctionne pas.
# les tables pour l'historique de commandes sont crée tout comme les relation mais j'ai pas eu le temp d'en faire usage
