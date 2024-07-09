## ToDoList-FourData : Gestionnaire de tâches avec Laravel et VueJS

Ce projet est une application de gestion de tâches simple, réalisée avec le framework PHP Laravel pour le backend et VueJS pour le frontend. Elle permet aux utilisateurs de créer des ToDoLists, d'ajouter, de modifier et de supprimer des tâches, ainsi que de marquer des tâches comme terminées.

### Fonctionnalités :

- **Gestion des ToDoLists :**
    - Création de nouvelles ToDoLists
    - Suppression de ToDoLists existantes

- **Gestion des tâches :**
    - Ajout de nouvelles tâches à une ToDoList
    - Modification du nom, de la description, de l'échéance et du statut d'une tâche
    - Marquage d'une tâche comme terminée
    - Suppression de tâches

### Architecture :

Le projet est divisé en deux parties principales :

1. **Backend (Laravel) :**
    - Gère la logique métier de l'application, y compris les interactions avec la base de données.
    - Expose des API REST pour que le frontend puisse interagir avec les données.

2. **Frontend (VueJS) :**
    - Fournit l'interface utilisateur pour interagir avec l'application.
    - Consomme les API REST fournies par le backend pour afficher et gérer les données.

### Base de données :

Le projet utilise une base de données MySQL pour stocker les informations suivantes :

- **Listes de tâches :** Nom de la ToDoList
- **Tâches :** Nom, description, statut (Terminée, En cours ou Non commencée), échéance, et association à une ToDoList.

### Installation :

1. **Clonez le dépôt Git :**
   ```
   git clone https://github.com/MaximeGrn/ToDoList-FourData.git
   ```
2. **Installez les dépendances du backend (Laravel) :**
   ```
   cd ToDoList-FourData/backend
   composer install
   ```
3. **Configurez l'environnement du backend :**
    - Copiez le fichier `.env.example` en `.env`
    - Configurez les paramètres de connexion à la base de données dans le fichier `.env`
4. **Générez une clé d'application :**
   ```
   php artisan key:generate
   ```
5. **Lancez les migrations pour créer les tables de la base de données :**
   ```
   php artisan migrate
   ```
6. **Lancez le serveur de développement Laravel :**
   ```
   php artisan serve
   ```
7. **Ouvrez un nouveau terminal et accédez au dossier frontend :**
   ```
   cd ToDoList-FourData/frontend
   ```
8. **Installez les dépendances du frontend (VueJS) :**
   ```
   npm install
   ```
9. **Lancez le serveur de développement VueJS :**
   ```
   npm run serve
   ```

### Utilisation :

Une fois l'installation terminée, vous pouvez accéder à l'application en ouvrant un navigateur web et en vous rendant à l'adresse affichée dans votre terminal après avoir lancé le serveur de développement VueJS (par défaut : http://localhost:8080/). Vous pourrez alors créer des listes de tâches, ajouter des tâches, les modifier et les marquer comme terminées.

### Remarques :

- Ce projet est en cours de développement et certaines fonctionnalités pourraient ne pas être encore implémentées.
- N'hésitez pas à consulter le code source pour plus de détails sur l'implémentation.
- Pour toute question ou suggestion, veuillez ouvrir une issue sur le dépôt GitHub du projet. 
