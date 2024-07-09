<template>
    <!-- Formulaire de création d'une nouvelle tâche -->
    <form @submit.prevent="createTask">
        <!--
            @submit.prevent : Empêche le rechargement de la page par défaut lors de la soumission du formulaire.
            createTask : Méthode appelée lors de la soumission du formulaire.
        -->
        <div class="form-group">
            <label for="nom">Nom de la tâche :</label>
            <input
                type="text"
                id="nom"
                v-model="nom"
                class="form-control"
                required
            />
            <!--
                v-model="nom" : Lie la valeur de l'input à la propriété "nom" dans les données du composant.
                required : Rend le champ obligatoire.
            -->
        </div>
        <div class="form-group">
            <label for="description">Description :</label>
            <textarea
                id="description"
                v-model="description"
                class="form-control"
            ></textarea>
            <!--
                v-model="description" : Lie la valeur du textarea à la propriété "description" dans les données du composant.
            -->
        </div>
        <div class="form-group">
            <label for="echeance">Échéance :</label>
            <input
                type="date"
                id="echeance"
                v-model="echeance"
                class="form-control"
            />
            <!--
                v-model="echeance" : Lie la valeur de l'input à la propriété "echeance" dans les données du composant.
            -->
        </div>
        <div class="form-group">
            <label for="status">Statut :</label>
            <select id="status" v-model="status" class="form-control">
                <!--
                    v-model="status" : Lie la valeur sélectionnée au menu déroulant à la propriété "status" dans les données du composant.
                -->
                <option value="not_started">Non commencée</option>
                <option value="in_progress">En cours</option>
                <option value="completed">Terminée</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Créer</button>
        <!--
            Bouton de soumission du formulaire.
        -->
    </form>
</template>

<script>
import api from "../services/api"; // Importe l'instance Axios configurée pour les appels API.

export default {
    props: {
        todoListId: {
            // Reçoit l'ID de la liste de tâches parente en tant que prop.
            type: Number,
            required: true,
        },
    },
    data() {
        return {
            nom: "",
            description: "",
            echeance: null, // Valeur par défaut pour la date : null.
            status: "not_started", // Valeur par défaut pour le statut : "not_started".
        };
    },
    methods: {
        async createTask() {
            // Méthode asynchrone pour créer une nouvelle tâche.
            try {
                const response = await api.post("/tasks", {
                    // Envoie une requête POST à l'API pour créer une tâche.
                    nom: this.nom,
                    description: this.description,
                    echeance: this.echeance,
                    status: this.status,
                    todo_list_id: this.todoListId,
                });
                this.$emit("taskCreated", response.data.task);
                // Déclenche un événement "taskCreated" avec les données de la tâche créée pour informer le composant parent.

                // Réinitialiser les champs du formulaire après la création de la tâche.
                this.nom = "";
                this.description = "";
                this.echeance = null;
                this.status = "not_started";
            } catch (error) {
                console.error("Erreur lors de la création de la tâche:", error);
                // Gérer l'erreur (afficher un message à l'utilisateur, etc.)
            }
        },
    },
};
</script>
