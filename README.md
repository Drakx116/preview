## Preview

## I - Installation

### Global

Clonez le projet et créez le fichier *.env* à la racine, suivant le *.env.example*

Depuis le terminal, installez les dépendances avec la commande ``` composer install  ```

### Base de données

Les commandes suivantes permettent la création et le remplissage des données nécessaires au fonctionnement du projet.

```
php bin/console d:d:c (doctrine:database:create)
php bin/console d:m:m (doctrine:migrations:migrate)
php bin/console d:f:l (doctrine:fixtures:load)
```

### SMTP

Par défaut, SwiftMailer était installé et configuré pour l'envoi des mails. Ayant des soucis de configuration avec mon SMTP Gmail, c'est la méthode mail() de PHP qui s'occupe d'envoyer les mails pour un POC fonctionnel.

## II - Cas utilisation

Une fois le projet installé et configuré, la page d'accueil présente un aperçu d'un produit ainsi qu'un lien redirigeant vers une page contenant le formulaire d'inscription à la Newsletter.

Une fois sur cette page, entrez votre addresse email et validez pour enregistrer votre inscription et recevoir (si la configuiration du SMTP est correct) un email de confirmation.

BONUS : Une commande a été rajoutée afin d'envoyer la Newsletter à tous les utilisateurs inscrits :

```php bin/console app:newsletter:send```
