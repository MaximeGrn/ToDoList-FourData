<template>
    <div v-if="todoList">
        <h3>{{ todoList.nom }}</h3>
        <CreateTaskForm :todoListId="todoList.id" @taskCreated="addTask" />
        <ul v-if="todoList.tasks && todoList.tasks.length > 0">
            <li v-for="task in todoList.tasks" :key="task.id">
                <TodoItem :task="task" @taskUpdated="updateTask" />
            </li>
        </ul>
        <p v-else>Aucune tâche dans cette liste.</p>
    </div>
</template>

<script>
import api from "../services/api";
import CreateTaskForm from "../components/CreateTaskForm.vue";
import TodoItem from "../components/TodoItem.vue";

export default {
    components: {
        CreateTaskForm,
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
        addTask(newTask) {
            this.todoList.tasks.push(newTask);
        },
        updateTask(updatedTask) {
            const taskIndex = this.todoList.tasks.findIndex(
                (t) => t.id === updatedTask.id
            );
            if (taskIndex !== -1) {
                this.todoList.tasks.splice(taskIndex, 1, updatedTask);
            }
        },
    },
};
</script>
