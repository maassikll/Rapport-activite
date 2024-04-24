<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps(['href', 'active']);

const classes = computed(() => props.active
    ? 'flex items-center mt-4 py-2 px-1 bg-gray-700 bg-opacity-25 text-gray-100'
    : 'flex items-center mt-4 py-2 px-1 text-gray-100'
);
</script>

<template>
     <Link :href="href" :class="classes">
        <button class="flex items-center justify-center w-5 h-5 bg-gray-200 hover:bg-gray-0 rounded-full focus:outline-none">
            <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12H5"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5l-7 7 7 7"></path>
            </svg>
        </button>

    </Link>
</template>
