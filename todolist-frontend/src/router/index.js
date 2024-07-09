import { createRouter, createWebHistory } from "vue-router";
import TodoLists from "../views/TodoLists.vue";
import CreateTodoList from "../views/CreateTodoList.vue";
import TodoListDetails from "../views/TodoListDetails.vue";
import CreateTask from "../views/CreateTask.vue";
import EditTask from "../views/EditTask.vue";

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
    {
        path: "/todo-lists/:todoListId/create-task",
        name: "CreateTask",
        component: CreateTask,
        props: true,
    },
    {
        path: "/edit-task/:id", // Route pour la modification d'une tâche
        name: "EditTask",
        component: EditTask,
        props: true,
    },
];

const router = createRouter({
    history: createWebHistory(process.env.BASE_URL),
    routes,
});

export default router;
