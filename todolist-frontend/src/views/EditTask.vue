<template>
    <div v-if="task">
        <h2>Modifier la tâche</h2>
        <EditTaskForm :task="task" @taskUpdated="taskUpdated" />
    </div>
</template>

<script>
import api from "../services/api";
import EditTaskForm from "../components/EditTaskForm.vue";
import router from "../router";

export default {
    components: {
        EditTaskForm,
    },
    props: {
        id: {
            type: Number,
            required: true,
        },
    },
    data() {
        return {
            task: null,
        };
    },
    mounted() {
        this.fetchTask();
    },
    methods: {
        async fetchTask() {
            try {
                const response = await api.get(`/tasks/${this.id}`);
                this.task = response.data;
            } catch (error) {
                console.error(
                    "Erreur lors de la récupération de la tâche:",
                    error
                );
                // Gestion d'erreur
            }
        },
        taskUpdated(updatedTask) {
            // Rediriger vers la page de détails de la TodoList
            router.push({
                name: "TodoListDetails",
                params: { id: updatedTask.todo_list_id },
            });
        },
    },
};
</script>
