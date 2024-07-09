<template>
    <div>
        <h4>{{ task.nom }}</h4>
        <p v-if="task.description">Description : {{ task.description }}</p>
        <p>État : {{ task.status }}</p>
        <p v-if="task.echeance">Échéance : {{ formatDate(task.echeance) }}</p>
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
    methods: {
        formatDate(dateString) {
            const options = { year: "numeric", month: "long", day: "numeric" };
            return new Date(dateString).toLocaleDateString("fr-FR", options);
        },
    },
};
</script>
