<template>
    <Head title="Vos documents pdf"/>
    <AuthenticatedLayout>
    <SearchBar></SearchBar>
      <div>
        <h1 class="text-2xl font-bold mb-4">Vos documents PDF</h1>
        <div v-if="pdfData.length === 0">
          <p>Aucun document PDF disponible.</p>
        </div>
        <div v-else>
          <ul>
            <li v-for="(id, index) in reportIds" :key="id">
            <a :href="route('report.show', { id: id })">PDF {{ index + 1 }}</a>
          </li>
          </ul>
        </div>
      </div>
    </AuthenticatedLayout>
  </template>
  
  <script setup>
  import { Head } from '@inertiajs/vue3';
  import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
  import SearchBar from '@/Components/SearchBar.vue';
  
  const props = defineProps({
    pdfData: Array,
    reportIds: Array,

  });
  </script>
  