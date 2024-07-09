<template>
    <div>
        <h2>Mes TodoLists</h2>
        <ul>
            <li v-for="todoList in todoLists" :key="todoList.id">
                <TodoList :todoList="todoList" />
            </li>
        </ul>
    </div>
</template>

<script>
import api from "../services/api";
import TodoList from "./TodoList.vue";

export default {
    components: {
        TodoList,
    },
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
