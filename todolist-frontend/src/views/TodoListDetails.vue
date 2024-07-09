<template>
    <div v-if="todoList">
        <h3>{{ todoList.nom }}</h3>
        <ul v-if="todoList.tasks && todoList.tasks.length > 0">
            <li v-for="task in todoList.tasks" :key="task.id">
                <TodoItem :task="task" @taskUpdated="updateTask" />
                <button @click="editTask(task)">Modifier</button>
                <button @click="deleteTask(task.id)">Supprimer</button>
            </li>
        </ul>
        <p v-else>Aucune tâche dans cette liste.</p>

        <router-link :to="`/todo-lists/${todoList.id}/create-task`"
            >Ajouter une tâche</router-link
        >
        <button @click="editTodoList">Modifier TodoList</button>
        <button @click="deleteTodoList">Supprimer TodoList</button>
    </div>
</template>

<script>
import api from "../services/api";
import TodoItem from "../components/TodoItem.vue";
import router from "../router";

export default {
    components: {
        TodoItem,
    },
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
        updateTask(updatedTask) {
            const taskIndex = this.todoList.tasks.findIndex(
                (t) => t.id === updatedTask.id
            );
            if (taskIndex !== -1) {
                this.todoList.tasks.splice(taskIndex, 1, updatedTask);
            }
        },
        editTask(task) {
            router.push({ name: "EditTask", params: { id: task.id } });
        },
        async deleteTask(taskId) {
            try {
                await api.delete(`/tasks/${taskId}`);
                // Supprimer la tâche du tableau local
                this.todoList.tasks = this.todoList.tasks.filter(
                    (task) => task.id !== taskId
                );
            } catch (error) {
                console.error(
                    "Erreur lors de la suppression de la tâche:",
                    error
                );
            }
        },
        editTodoList() {
            // Rediriger vers la page de modification de la TodoList (à implémenter)
            router.push({
                name: "EditTodoList",
                params: { id: this.todoList.id },
            });
        },
        async deleteTodoList() {
            try {
                await api.delete(`/todo-lists/${this.todoList.id}`);
                // Rediriger vers la page des TodoLists
                router.push({ name: "TodoLists" });
            } catch (error) {
                console.error(
                    "Erreur lors de la suppression de la TodoList:",
                    error
                );
            }
        },
    },
};
</script>
