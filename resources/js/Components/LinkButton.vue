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
    <button
        :type="type"
        class="inline-flex items-right px-2 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150"
    >
        <slot />
    </button>
    </Link>
</template>
