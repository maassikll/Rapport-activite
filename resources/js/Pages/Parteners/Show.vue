<template>
    <Head title="Show" />

<AuthenticatedLayout>
    <template #header>
        Detailes Partenere
    </template>
    <div>
      <h1>Partener Details</h1>
      <div>
        <p><strong>First Name:</strong> {{ partener.name }}</p>
        <p><strong>Last Name:</strong> {{ partener.email }}</p>
        <p><strong>Email:</strong> {{ partener.phone_number }}</p>
        <p><strong>Phone Number:</strong> {{ partener.numero_siret }}</p>
      </div>
    </div>
</AuthenticatedLayout>
  </template>


  
  <script setup>
  import { ref } from 'vue';
  import { Head, usePage } from '@inertiajs/vue3';
  import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'

  const { props } = usePage();
  const partener = ref(props.partener);
  </script>
  