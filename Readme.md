# SAE2-01
#### Par Raphael Gomes et Benoit Collot
  
## Important

### 1
Sur Windows il faut retirer le point dans les fichiers qui commence par un point comme **.php-cs-fixer.php** pour laisser
**php-cs-fixer.php**

### Serveur local

On utilisera la commande ```Composer "start:linux"``` pour lancer le serveur local 
sur Linux et ```Composer:windows``` pour lancer sur Windows
puis rendez vous a l'adresse : http://localhost:8000/ Pour accéder à la première page

### Style de codage

Php fixer permet de tester votre code afin de voir s'il correspond à la norme indiquée ici Psr-4.
Pour utiliser php cs fixer différente commande :  
```php vendor/bin/php-cs-fixer fix --dry-run``` --dry-run pour test a blanc   
```--diff``` pour voir la différence entre l'original et celui modifier  
Retire --dry-run pour avoir les fichiers qui sont fixés automatiquement.  
On préférera utilise les commandes faite avec composer pour gagner du temps :  
```composer "test:cs"``` pour voir quel fichier comporte des problèmes  
```composer "fix:cs"``` pour fixer les problèmes  

### Tests

Les Tests se font avec codeception et sont dans des commandes composer :
```composer test:``` Pour faire une suite de tests en particulier
```composer test:codeception``` pour l'ensemble des tests 
```composer test```Pour l'ensemble des tests & les tests de php-fixer pour la correspondance a la norme PSR-12.

### Installation dépendance
 
Lors d'un clonage du git utiliser la commande ```composer install``` pour l'installation des paquets nécessaire au fonctionnement du projet dans /vendor/.
Cela mettre également à jour l'auto chargement sinon utilisé ```composer dump-autoload```.   
Pour l'Intégration de php-Fixer dans phpStorm se fait dans ___Settings (CTRL+ALT+S)\Php\Quality_Tools\Php cs fixer - Rulesets : custom + chemin vers.php-cs-Fixer.php + mettre sur ON___
Et ne pas oublier de mettre dans ___Settings\Php\Quality_Tools de mettre php-cs-fixer dans External formatter___.

### Classe et Fonctionnement

Le Projet Comporte 5 classe **Tvshow, Season, Poster, Genre, Episode** correspondent aux 5 tables de la base de Donnée ces 5 classes comporte des getters sur l'ensemble de leur attribut.  
Les classes Tvshow, Season, Poster, Genre, Episode ont une méthode nommée ```findById``` qui sert de constructeur et qui vas chercher dans la base de données l'ensemble des champs en utilisant l'id qui est passée en paramètre. 
De plus, il y a les classes EpisodeCollection, SeasonCollection et TvshowCollection ses classes sont utilisée pour récupérer de nombreuses donnée de même type que le nom de la collection sous Forme d'array. Ils comportent deux méthodes :
```findAll()``` qui renvoie l'ensemble des données de la table 
````findBy_Autre_Class_Id````qui renvoie l'ensemble des donnée des saisons/épisodes pour le tvshow/la saison avec l'id passé en paramètre

### En cas d'erreur
#### erreur "Failed to listen on localhost:8000 (reason : address already in use)" -> linux only
Taper la commande ```ps -ef``` pour afficher les processus et cherchez le processus **php -d auto_prepend_files= __ chemin d'accès de votre projet/vendor/auload.php__ -d display_errors -S localhost:8000 -t public/**
ou **bash bin/run-server.sh** regardé le pid et utiliser ```kill -9 ``` (arrêter l'un des deux processus arrêtera l'autre.).