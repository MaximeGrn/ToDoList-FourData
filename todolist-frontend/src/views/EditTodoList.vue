<template>
    <div class="container mt-5" v-if="todoList">
        <router-link to="/" class="btn btn-secondary mb-3"
            >Mes TodoLists</router-link
        >
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Modifier la TodoList</h3>
            </div>
            <div class="card-body">
                <form @submit.prevent="updateTodoList">
                    <div class="form-group">
                        <label for="nom">Nom de la TodoList:</label>
                        <input
                            type="text"
                            id="nom"
                            v-model="todoList.nom"
                            class="form-control"
                            required
                        />
                    </div>
                    <button type="submit" class="btn btn-primary">
                        Mettre à jour
                    </button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import api from "../services/api";
import router from "../router";

export default {
    props: {
        id: {
            type: Number,
            required: true,
        },
    },
    data() {
        return {
            todoList: null,
        };
    },
    mounted() {
        this.fetchTodoList();
    },
    methods: {
        async fetchTodoList() {
            try {
                const response = await api.get(`/todo-lists/${this.id}`);
                this.todoList = response.data;
            } catch (error) {
                console.error(
                    "Erreur lors de la récupération de la TodoList :",
                    error
                );
                // Gestion d'erreur
            }
        },
        async updateTodoList() {
            try {
                await api.put(`/todo-lists/${this.todoList.id}`, this.todoList);
                router.push({ name: "TodoLists" });
            } catch (error) {
                console.error(
                    "Erreur lors de la mise à jour de la TodoList :",
                    error
                );
                // Gestion d'erreur
            }
        },
    },
};
</script>
