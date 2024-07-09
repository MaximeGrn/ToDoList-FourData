<template>
    <form @submit.prevent="updateTask">
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
        <button type="submit">Mettre à jour</button>
    </form>
</template>

<script>
import api from "../services/api";

export default {
    props: {
        task: {
            type: Object,
            required: true,
        },
    },
    data() {
        return {
            nom: this.task.nom,
            description: this.task.description,
            echeance: this.task.echeance,
            status: this.task.status,
        };
    },
    methods: {
        async updateTask() {
            try {
                const response = await api.put(`/tasks/${this.task.id}`, {
                    nom: this.nom,
                    description: this.description,
                    echeance: this.echeance,
                    status: this.status,
                    todo_list_id: this.task.todo_list_id, // Important de renvoyer l'ID de la TodoList
                });
                this.$emit("taskUpdated", response.data.task);
            } catch (error) {
                console.error(
                    "Erreur lors de la mise à jour de la tâche:",
                    error
                );
                // Gérer l'erreur (afficher un message à l'utilisateur, etc.)
            }
        },
    },
};
</script>
