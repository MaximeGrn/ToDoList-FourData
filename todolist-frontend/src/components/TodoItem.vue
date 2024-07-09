<template>
    <div>
        <span>{{ task.nom }}</span>
        <!-- Afficher d'autres détails de la tâche si nécessaire (description, échéance, etc.) -->
    </div>
</template>

<script>
export default {
    props: {
        task: {
            type: Object,
            required: true,
        },
    },
};
</script>
