# Application de plannification

> **Note:** Il s'agit d'un projet fictif réalisé dans le cadre de ma formation


## Introduction au projet
Ce projet est une application de planification permettant de gérer des cours, des modules et des emplois du temps. Elle est conçue pour faciliter la gestion des plannings pour les équipes pédagogique.

Le framework Tailwind CSS a été choisi pour sa flexibilité et sa capacité à accélérer le développement grâce à ses classes utilitaires. Cela permet de créer rapidement des interfaces intuitives et responsives tout en maintenant un code CSS minimal et organisé.

## Installation
### Prérequis
Avant de commencer, assurez-vous d'avoir les éléments suivants installés sur votre machine :

    WAMP ou un autre serveur local (comme XAMP ou MAMP)
    PHP 7.4 ou supérieur
    MySQL

### Cloner le dépôt

Clonez ce dépôt dans le dossier de votre serveur local (par exemple, www pour WAMP ou htdocs pour XAMPP/MAMP) :

`git clone https://github.com/TaupeInHambourg/calendar-app.git`

### Configurer la base de données

- Ouvrez votre serveur local (WAMP, XAMPP, ou MAMP) et démarrez les serveurs Apache et MySQL
- Créez une base de données
- Importez le fichier SQL fourni dans le projet pour créer les tables et insérer les données nécessaires :
`mysql -u root -p NOM_DE_VOTRE_BASE < query.sql`

### Configurer le projet

**Connexion à la base de données**

- Rennomez le fichier **config.ini.example** en **config.ini** dans ce dossier : `./src/Utility`
- Remplacez les exemples par les informations de votre base

**Installer les dépendances**

- Utilisez la commande `npm install`

**Compiler les fichiers CSS**

Si vous souhaitez compiler les fichiers CSS : `npm run build:css`
Si vous souhaitez modifier les fichiers CSS et voir vos changements en temps réel : `npm run watch:css`

**Lancer le serveur PHP**

`npm start`
Vous pouvez acceder au projet dans votre navigateur par cette URL : http://localhost:5001