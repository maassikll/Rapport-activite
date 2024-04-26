<template>
    <Head title="About us" />

    <AuthenticatedLayout>
        <template #header>
            <BackButton :href="route('dashboard')" ></BackButton>
        </template>

        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 border-b border-gray-200">
                About us page
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import BackButton from '@/Components/BackButton.vue';
</script>
