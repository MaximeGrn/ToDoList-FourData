import { createRouter, createWebHistory } from "vue-router";
import TodoLists from "../views/TodoLists.vue";
import CreateTodoList from "../views/CreateTodoList.vue";
import TodoListDetails from "../views/TodoListDetails.vue";

const routes = [
    {
        path: "/",
        name: "TodoLists",
        component: TodoLists,
    },
    {
        path: "/create-todo-list",
        name: "CreateTodoList",
        component: CreateTodoList,
    },
    {
        path: "/todo-lists/:id",
        name: "TodoListDetails",
        component: TodoListDetails,
        props: true,
    },
];

const router = createRouter({
    history: createWebHistory(process.env.BASE_URL),
    routes,
});

export default router;
