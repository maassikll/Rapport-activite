<template>
    <head title="Show" />
    <AuthenticatedLayout>
        <template #header>
            <BackButton :href="route('report.index')" ></BackButton>
        </template>

        <div>
            <embed :src="pdfUrl" type="application/pdf" width="100%" height="600px">
        </div>
      
    </AuthenticatedLayout>
  </template>
  
  <script setup>
  
  import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
  import BackButton from '@/Components/BackButton.vue';

  
const props = defineProps({
    pdfData: String
});

const pdfUrl = `data:application/pdf;base64,${props.pdfData}`;
  
  
  </script>