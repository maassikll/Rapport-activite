<template>
    <Head title="Parteneres" />

    <AuthenticatedLayout>
        <template #header>
            <BackButton :href="route('dashboard')" ></BackButton>
        </template>

        

        <div class="mb-4 inline-flex w-full overflow-hidden rounded-lg bg-white shadow-md">
            <div class="flex w-12 items-center justify-center bg-blue-500">
                <svg class="h-6 w-6 fill-current text-white" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M20 3.33331C10.8 3.33331 3.33337 10.8 3.33337 20C3.33337 29.2 10.8 36.6666 20 36.6666C29.2 36.6666 36.6667 29.2 36.6667 20C36.6667 10.8 29.2 3.33331 20 3.33331ZM21.6667 28.3333H18.3334V25H21.6667V28.3333ZM21.6667 21.6666H18.3334V11.6666H21.6667V21.6666Z"></path>
                </svg>
            </div>
    
            <div class="-mx-3 px-4 py-2">
                <div class="mx-3">
                    <span class="font-semibold text-blue-500">Parteneres Info</span>
                    <p class="text-sm text-gray-600">Sample table page</p>
                </div>
            </div>
        </div>
        
        <div class="flex justify-end">
            <LinkButton :href="route('parteners.create')" :active="route().current('parteners.create')">Create</LinkButton>
        </div>

        
        
  
        <div class="inline-block min-w-full overflow-hidden rounded-lg shadow">
            <table class="w-full whitespace-no-wrap">
                <thead>
                    <tr class="border-b bg-gray-50 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">
                        <th class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">
                            Nom partenere
                        </th>
                        
                        <th class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">
                            Numéro Téléphone
                        </th>
                        <th class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">
                            Numéro SIRET
                        </th>

                        <th class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">
                            
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="partener in parteners.data" :key="parteners.id" class="text-gray-700">
                        <td class="border-b border-gray-200 bg-white px-5 py-5 text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">{{ partener.name }}</p>
                        </td>
                        
                        <td class="border-b border-gray-200 bg-white px-5 py-5 text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">{{ partener.phone_number }}</p>
                        </td>
                        <td class="border-b border-gray-200 bg-white px-5 py-5 text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">{{ partener.numero_siret }}</p>
                        </td>

                        <td class="border-b border-gray-200 bg-white px-0 py-2 text-sm flex ">
                            <LinkButton :href="route('parteners.show', { id: partener.id })" :active="route().current('parteners.show')">Show</LinkButton>
                            <LinkButton :href="route('parteners.edit', { id: partener.id })" :active="route().current('parteners.edit')">Edit</LinkButton>
                            <LinkButton :href="route('parteners.destroy',partener.id)"  method="DELETE">Delete</LinkButton>
                   
                        </td>

                        
                    </tr>
                </tbody>
            </table>

            <div class="flex flex-col items-center border-t bg-white px-5 py-5 xs:flex-row xs:justify-between">
                <pagination :links="parteners.links" />
            </div>
        </div>
    </AuthenticatedLayout>
</template>


<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Pagination from '@/Components/Pagination.vue'
import { Head } from '@inertiajs/vue3';
import LinkButton from '@/Components/LinkButton.vue';
import BackButton from '@/Components/BackButton.vue';


const props = defineProps({
    parteners: Object
})




</script>

