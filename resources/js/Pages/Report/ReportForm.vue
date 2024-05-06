<template>
    <Head title="Form Activity Report" />
    <AuthenticatedLayout>

        <select>
            <option v-for="name in clientNames" :key="name" :value="name">{{ name }}</option>
        </select>

    </AuthenticatedLayout>
</template>

<script setup>
import { defineProps } from 'vue';
import { Head } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

const props = defineProps({
    clientNames: Array // Assuming clientNames is an array
})
</script>
