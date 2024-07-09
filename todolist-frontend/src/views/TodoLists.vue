<template>
    <div>
        <h2>Mes TodoLists</h2>
        <router-link to="/create-todo-list"
            >Créer une nouvelle TodoList</router-link
        >
        <ul>
            <li v-for="todoList in todoLists" :key="todoList.id">
                <router-link :to="`/todo-lists/${todoList.id}`">{{
                    todoList.nom
                }}</router-link>
                <ul v-if="todoList.tasks && todoList.tasks.length > 0">
                    <li v-for="task in todoList.tasks" :key="task.id">
                        - {{ task.nom }}
                    </li>
                </ul>
            </li>
        </ul>
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
