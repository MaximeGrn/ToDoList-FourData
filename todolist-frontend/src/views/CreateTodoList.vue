<template>
    <form @submit.prevent="createTodoList">
        <div class="form-group">
            <label for="nom">Nom de la TodoList:</label>
            <input type="text" id="nom" v-model="nom" required />
        </div>
        <button type="submit">Créer</button>
    </form>
</template>

<script>
import api from "../services/api";
import router from "../router"; // Importer le router

export default {
    data() {
        return {
            nom: "",
        };
    },
    methods: {
        async createTodoList() {
            try {
                await api.post("/todo-lists", {
                    nom: this.nom,
                });
                router.push({ name: "TodoLists" });
            } catch (error) {
                console.error(
                    "Erreur lors de la création de la TodoList:",
                    error
                );
                // Gérer l'erreur (afficher un message, etc.)
            }
        },
    },
};
</script>
