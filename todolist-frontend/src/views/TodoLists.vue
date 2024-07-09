<template>
    <div class="container">
        <h1 class="text-center mt-5">Mes TodoLists</h1>
        <div class="row mt-4">
            <div class="col-md-8 offset-md-2">
                <router-link to="/create-todo-list" class="btn btn-success mb-3"
                    >Créer une nouvelle TodoList</router-link
                >
                <ul class="list-group">
                    <li
                        v-for="todoList in todoLists"
                        :key="todoList.id"
                        class="list-group-item"
                    >
                        <router-link
                            :to="`/todo-lists/${todoList.id}`"
                            class="h5"
                            >{{ todoList.nom }}</router-link
                        >
                        <ul class="list-unstyled ml-3">
                            <li v-for="task in todoList.tasks" :key="task.id">
                                - {{ task.nom }}
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
import api from "../services/api";

export default {
    data() {
        return {
            todoLists: [],
        };
    },
    mounted() {
        this.fetchTodoLists();
    },
    methods: {
        async fetchTodoLists() {
            try {
                const response = await api.get("/todo-lists");
                this.todoLists = response.data;
            } catch (error) {
                console.error(
                    "Erreur lors de la récupération des TodoLists :",
                    error
                );
                // Gestion d'erreur (afficher un message à l'utilisateur, etc.)
            }
        },
    },
};
</script>
