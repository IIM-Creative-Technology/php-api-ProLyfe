# php-api-ProLyfe
php-api-ProLyfe created by GitHub Classroom

# IIM API DOCUMENTATION

### Installation :

```
composer install
```

### Créer la base de donnée :

```
php bin/console doctrine:database:create
```

### Migrer la base de donnée ;

```
php bin/console doctrine:migrations:migrate
```

### Peupler notre nos tables :

Ajouter nos fixtures :

```
php bin/console doctrine:fixtures:load 
```

### Générer un token JWT :

POST : /api/login


### Les différents endpoints :

* Notes : /api/notes
* Matières : /api/matieres
* Intervenants : /api/intervenants
* Elèves : /api/eleves
* Classes : /api/classes

### Mails des personnes pouvant s'authentifier :

* Karine : Karine4admin.devinci.fr	
* Nicolas : Nicolas4admin.devinci.fr	
* Alexis : Alexis4admin.devinci.fr
