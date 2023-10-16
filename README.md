# Composer template for Drupal projects by habeuk.com

Installation de drupal 10

Creer un dossier nommé /siteweb/mydrupal, acceder à ce dossier et executer la commande ci-déssous:

```
cd /siteweb/mydrupal
composer create-project habeuk/habeuk_project_commerce:dev-10x public --no-interaction
```

Cette commande cree un dossier public et y telechage les fichiers de drupal. ( plus d'infos ).

## Requirement

composer >= 2.6.5 and PHP >= 8.1

```
composer clearcache
composer selfupdate
```

## Installation rapide

Vous pouvez tester le site en suivant les etapes ci-apres.

Acceder au dossier /siteweb/mydrupal/public/web et execute la commande :

```
cd /siteweb/mydrupal/public/web
php -d memory_limit=256M ./core/scripts/drupal quick-start habeuk_profile
```

Cette commande installe Drupal en utilisant le moteur de base de donnée SQLite.

## Installation

Vous devez avoir un serveur web et un hote virtuel configuré

Acceder au dossier public, executer les commande suivantes :

```
vendor/bin/drush site:install habeuk_profile
```

Suivez les instructions afin de terminer l'installation de drupal 10.

L'installation du site se termine par la creation d'un compte adminitrateur.

Vous pouvez utiliser ces identifiant afin d'acceder à votre nouveaau site web.

#### Commande utile

- Demarrer le serveur ( apres installation, et l'executé dans le repertoire /siteweb/mydrupal/public/web )

```
 php -S localhost:8000
```

- Generer une URL de connexion ( utile si vous avez oublié le mot de passe )

```
vendor/bin/drush uli --uid=1  --uri=http://example.hbk/ --no-browser
```

-- example.hbk => doit etre remplacer par le domaine
-- uid => l'id de l'utilisateur

- Supprimer la configuration generer par SQLITE afin de relancer l'installation

```
 sudo chmod -R 777 sites/default/ && sudo rm sites/default/settings.php && sudo rm -r sites/default/files/
```
