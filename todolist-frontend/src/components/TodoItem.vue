<template>
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h4>{{ localTask.nom }}</h4>
            <p v-if="localTask.description">{{ localTask.description }}</p>
            <p v-if="localTask.echeance">
                <i class="far fa-calendar-alt mr-2"></i>
                {{ formatDate(localTask.echeance) }}
            </p>
            <p :class="statusClass">{{ statusText }}</p>
        </div>
        <div>
            <input
                type="checkbox"
                v-model="isChecked"
                @change="toggleTaskStatus"
            />
            <i
                class="fas fa-edit ml-3"
                @click="$emit('editTask', localTask)"
            ></i>
            <i
                class="fas fa-trash-alt ml-3"
                @click="$emit('deleteTask', localTask.id)"
            ></i>
        </div>
    </div>
</template>

<script>
import api from "../services/api";

export default {
    props: {
        task: {
            type: Object,
            required: true,
        },
    },
    data() {
        return {
            localTask: { ...this.task },
            isChecked: this.task.status === "completed",
        };
    },
    computed: {
        statusText() {
            switch (this.localTask.status) {
                case "not_started":
                    return "Non commencé";
                case "in_progress":
                    return "En cours";
                case "completed":
                    return "Terminé";
                default:
                    return "";
            }
        },
        statusClass() {
            switch (this.localTask.status) {
                case "not_started":
                    return "text-muted font-italic";
                case "in_progress":
                    return "text-primary";
                case "completed":
                    return "text-success";
                default:
                    return "";
            }
        },
    },
    methods: {
        formatDate(dateString) {
            const options = { year: "numeric", month: "long", day: "numeric" };
            return new Date(dateString).toLocaleDateString("fr-FR", options);
        },
        async toggleTaskStatus() {
            try {
                this.localTask.status = this.isChecked
                    ? "completed"
                    : this.localTask.previousStatus || "not_started";
                await api.put(`/tasks/${this.localTask.id}`, {
                    ...this.localTask,
                    status: this.localTask.status,
                });
                // Mettre à jour previousStatus après l'appel API
                this.localTask.previousStatus =
                    this.localTask.status === "completed"
                        ? this.localTask.previousStatus
                        : this.localTask.status;

                this.$emit("taskUpdated", this.localTask);
            } catch (error) {
                console.error(
                    "Erreur lors de la mise à jour du statut de la tâche:",
                    error
                );
            }
        },
    },
};
</script>
