<template>
    <div class="container mt-5">
        <router-link to="/" class="btn btn-secondary mb-3"
            >Mes TodoLists</router-link
        >
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Créer une nouvelle TodoList</h3>
            </div>
            <div class="card-body">
                <form @submit.prevent="createTodoList">
                    <div class="form-group">
                        <label for="nom">Nom de la TodoList:</label>
                        <input
                            type="text"
                            id="nom"
                            v-model="nom"
                            class="form-control"
                            required
                        />
                    </div>
                    <button type="submit" class="btn btn-primary">Créer</button>
                </form>
            </div>
        </div>
    </div>
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
