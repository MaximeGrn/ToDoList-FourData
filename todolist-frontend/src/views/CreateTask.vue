<template>
    <div>
        <router-link to="/">Mes TodoLists</router-link>
        <h2>Créer une tâche</h2>
        <CreateTaskForm :todoListId="todoListId" @taskCreated="taskCreated" />
    </div>
</template>

<script>
import CreateTaskForm from "../components/CreateTaskForm.vue";
import router from "../router";

export default {
    components: {
        CreateTaskForm,
    },
    props: {
        todoListId: {
            type: Number,
            required: true,
        },
    },
    methods: {
        taskCreated() {
            // Rediriger vers la page de détails de la TodoList
            router.push({
                name: "TodoListDetails",
                params: { id: this.todoListId },
            });
        },
    },
};
</script>
