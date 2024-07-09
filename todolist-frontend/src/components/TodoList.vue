<template>
    <div>
        <h3>{{ todoList.nom }}</h3>
        <ul v-if="todoList.tasks">
            <li v-for="task in todoList.tasks" :key="task.id">
                <TodoItem :task="task" />
            </li>
        </ul>
    </div>
</template>

<script>
import TodoItem from "./TodoItem.vue";

export default {
    components: {
        TodoItem,
    },
    props: {
        todoList: {
            type: Object,
            required: true,
        },
    },
};
</script>
