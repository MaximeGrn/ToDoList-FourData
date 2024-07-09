<template>
    <div class="container mt-5" v-if="todoList">
        <router-link to="/" class="btn btn-secondary mb-3"
            >Mes TodoLists</router-link
        >
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ todoList.nom }}</h3>
                <div class="float-right">
                    <button
                        @click="editTodoList"
                        class="btn btn-warning btn-sm mr-2"
                    >
                        Modifier
                    </button>
                    <button
                        @click="deleteTodoList"
                        class="btn btn-danger btn-sm"
                    >
                        Supprimer
                    </button>
                </div>
            </div>
            <div class="card-body">
                <ul
                    class="list-group"
                    v-if="todoList.tasks && todoList.tasks.length > 0"
                >
                    <li
                        v-for="task in todoList.tasks"
                        :key="task.id"
                        class="list-group-item"
                    >
                        <TodoItem
                            :task="task"
                            @taskUpdated="updateTask"
                            @editTask="editTask"
                            @deleteTask="deleteTask"
                        />
                    </li>
                </ul>
                <p v-else class="text-muted">Aucune tâche dans cette liste.</p>
                <router-link
                    :to="`/todo-lists/${todoList.id}/create-task`"
                    class="btn btn-primary mt-3"
                >
                    Ajouter une tâche
                </router-link>
            </div>
        </div>
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
            // Trouver l'index de la tâche mise à jour
            const taskIndex = this.todoList.tasks.findIndex(
                (t) => t.id === updatedTask.id
            );

            if (taskIndex !== -1) {
                // Retirer la tâche de sa position actuelle
                this.todoList.tasks.splice(taskIndex, 1);

                if (updatedTask.status === "completed") {
                    // Ajouter la tâche à la fin du tableau si elle est terminée
                    this.todoList.tasks.push(updatedTask);
                } else {
                    // Ajouter la tâche au début du tableau si elle n'est pas terminée
                    this.todoList.tasks.unshift(updatedTask);
                }
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
