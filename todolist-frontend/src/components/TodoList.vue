<template>
    <div>
        <h3>{{ localTodoList.nom }}</h3>
        <CreateTaskForm
            :todoListId="localTodoList.id"
            @taskCreated="$emit('taskCreated', $event)"
        />
        <ul v-if="localTodoList.tasks && localTodoList.tasks.length > 0">
            <li v-for="task in localTodoList.tasks" :key="task.id">
                <TodoItem :task="task" @taskUpdated="updateTask" />
            </li>
        </ul>
        <p v-else>Aucune tâche dans cette liste.</p>
    </div>
</template>

<script>
// Importe les composants enfants
import CreateTaskForm from "./CreateTaskForm.vue";
import TodoItem from "./TodoItem.vue";

export default {
    // Enregistre les composants enfants pour les utiliser dans le template
    components: {
        CreateTaskForm,
        TodoItem,
    },
    // Définition des props attendues par le composant
    props: {
        todoList: {
            type: Object,
            required: true,
        },
    },
    data() {
        return {
            // Création d'une copie de la prop 'todoList' pour éviter de modifier la source directement
            localTodoList: { ...this.todoList },
        };
    },
    methods: {
        // Méthode pour mettre à jour une tâche dans la liste
        updateTask(updatedTask) {
            // Trouve l'index de la tâche à mettre à jour dans le tableau 'localTodoList.tasks'
            const taskIndex = this.localTodoList.tasks.findIndex(
                (t) => t.id === updatedTask.id
            );
            // Si la tâche est trouvée
            if (taskIndex !== -1) {
                // Remplace la tâche dans le tableau par la tâche mise à jour
                this.localTodoList.tasks.splice(taskIndex, 1, updatedTask);
            }
        },
    },
};
</script>
