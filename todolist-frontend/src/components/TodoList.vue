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
import CreateTaskForm from "./CreateTaskForm.vue";
import TodoItem from "./TodoItem.vue";

export default {
    components: {
        CreateTaskForm,
        TodoItem,
    },
    props: {
        todoList: {
            type: Object,
            required: true,
        },
    },
    data() {
        return {
            localTodoList: { ...this.todoList }, // Copie de la prop todoList
        };
    },
    methods: {
        updateTask(updatedTask) {
            const taskIndex = this.localTodoList.tasks.findIndex(
                // Modifier la copie locale
                (t) => t.id === updatedTask.id
            );
            if (taskIndex !== -1) {
                this.localTodoList.tasks.splice(taskIndex, 1, updatedTask);
            }
        },
    },
};
</script>
