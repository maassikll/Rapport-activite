<template>
    <div class="mb-4 inline-flex w-full overflow-hidden rounded-lg bg-white shadow-md ">
        <div class="flex w-12 items-center justify-center bg-blue-500">
            <svg  style="cursor: pointer;" @click="handleClick" class="w-6 h-6 text-gray-800 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
            <path fill-rule="evenodd" d="M13 11.15V4a1 1 0 1 0-2 0v7.15L8.78 8.374a1 1 0 1 0-1.56 1.25l4 5a1 1 0 0 0 1.56 0l4-5a1 1 0 1 0-1.56-1.25L13 11.15Z" clip-rule="evenodd"/>
            <path fill-rule="evenodd" d="M9.657 15.874 7.358 13H5a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2h-2.358l-2.3 2.874a3 3 0 0 1-4.685 0ZM17 16a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2H17Z" clip-rule="evenodd"/>
            </svg>


        </div>
  
        <div class="-mx-3 px-4 py-2">
            <div class="mx-3">
                <a @click="handleClick" class="font-semibold text-blue-500" style="cursor: pointer;">{{ anchorText }}</a>
                <p class="text-sm text-gray-600">{{ message }}</p>
            </div>
        </div>
    </div>
</template>

<script setup>
const props = defineProps({
    anchorText: String,
    handleClick: Function,
    message: String
});
</script>
