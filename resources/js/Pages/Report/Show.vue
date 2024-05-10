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
  import InputLabel from '@/Components/InputLabel.vue';
  import BackButton from '@/Components/BackButton.vue';
  import LinkButton from '@/Components/LinkButton.vue';
  
// Define props
const props = defineProps({
    pdfData: String // Define pdfData prop as a string
});

// Computed property to generate the data URL for embedding the PDF
const pdfUrl = `data:application/pdf;base64,${props.pdfData}`;
  
  
  </script>