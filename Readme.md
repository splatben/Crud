# SAE2-01
#### Par Raphael Gomes et Benoit Collot
  
## Important

### 1
Sur windows il faut retirer le point dans les fichier qui commence par un point comme **.php-cs-fixer.php** pour laisser
**php-cs-fixer.php**

### Serveur local

On utilisera la commande ```Composer "start:linux"``` pour lancer le serveur local 
sur linux et ```Composer:windows``` pour lancer sur windows
puis rendez vous a l'adresse : http://localhost:8000/ Pour accéder a la première page

### Style de codage

Php fixer permet de tester votre code afin de voir si il correspond a la norme indiquer ici Psr-4
Pour utiliser php cs fixer differente commande :  
```php vendor/bin/php-cs-fixer fix --dry-run``` --dry-run pour test a blanc   
```--diff``` pour voir dif entre l'original et le modifier  
retire --dry-run pour avoir les fichier qui sont fixer automatiquement  
On preferera utilise les commandes faite avec composer pour gagner du temps:  
```composer "test:cs"``` Pour voir quel fichier comporte des problèmes  
```composer "fix:cs"``` Pour fixer les problème  

### Tests

Les Tests se font avec codeception et sont dans des commande composer :
```composer test:<suited de test>``` Pour faire une suite de test en particulier
```composer test:codeception``` Pour l'ensemble des tests 
```composer test```Pour l'ensemble des tests & les test de php-fixer pour la correspondance a la norme PSR-12.
### Installation dépendance
 
Lors d'un clonage du git utiliser la commande ```composer install``` pour l'installation des paquets nécéssaire au fonctionnement du projet dans /vendor/.
Cela metre egalement a jour l'auto chargement sinon utiliser ```composer dump-autoload```.   
Pour l'Integration de php-Fixer dans phpStorm se fait dans ___Settings(CTRL+ALT+S)\Php\Quality Tools\Php cs fixer - Rulesets : custom + chemin vers .php-cs-Fixer.php + mettre sur ON___
et ne pas oublier de metre dans ___Settings\Php\Quality Tools de metre php-cs-fixer dans External formatter___.

### En cas d'erreur
#### erreur "Failed to listen on localhost:8000 (reason : address already in use)" -> linux only
Taper la commande ```ps -ef``` pour afficher les processus et cherchez le processus **php -d auto_prepend_files= __chemin d'acces de votre projet/vendor/auload.php__ -d display_errors -S localhost:8000 -t public/**
ou **bash bin/run-server.sh** regarder le pid et utiliser ```kill -9 <pid>``` (arreter l'un des deux processus arretera l'autre).