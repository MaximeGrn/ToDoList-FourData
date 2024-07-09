<template>
    <form @submit.prevent="createTask">
        <div class="form-group">
            <label for="nom">Nom de la tâche :</label>
            <input type="text" id="nom" v-model="nom" required />
        </div>
        <div class="form-group">
            <label for="description">Description :</label>
            <textarea id="description" v-model="description"></textarea>
        </div>
        <div class="form-group">
            <label for="echeance">Échéance :</label>
            <input type="date" id="echeance" v-model="echeance" />
        </div>
        <div class="form-group">
            <label for="status">Statut :</label>
            <select id="status" v-model="status">
                <option value="not_started">Non commencée</option>
                <option value="in_progress">En cours</option>
                <option value="completed">Terminée</option>
            </select>
        </div>
        <button type="submit">Créer</button>
    </form>
</template>

<script>
import api from "../services/api";

export default {
    props: {
        todoListId: {
            type: Number,
            required: true,
        },
    },
    data() {
        return {
            nom: "",
            description: "",
            echeance: null, // Valeur par défaut pour la date
            status: "not_started", // Valeur par défaut pour le statut
        };
    },
    methods: {
        async createTask() {
            try {
                const response = await api.post("/tasks", {
                    nom: this.nom,
                    description: this.description,
                    echeance: this.echeance,
                    status: this.status,
                    todo_list_id: this.todoListId,
                });
                this.$emit("taskCreated", response.data.task);
                // Réinitialiser les champs du formulaire
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
