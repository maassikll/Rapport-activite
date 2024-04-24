<template>
    <Head title="Show" />

<AuthenticatedLayout>
    <template #header>
        Detailes employer
    </template>
    <div>
      <h1>User Details</h1>
      <div>
        <p><strong>First Name:</strong> {{ user.first_name }}</p>
        <p><strong>Last Name:</strong> {{ user.last_name }}</p>
        <p><strong>Email:</strong> {{ user.email }}</p>
        <p><strong>Phone Number:</strong> {{ user.phone_number }}</p>
        <p><strong>Matricule:</strong> {{ user.matricule }}</p>
      </div>
    </div>
</AuthenticatedLayout>
  </template>


  
  <script setup>
  import { ref } from 'vue';
  import { Head, usePage } from '@inertiajs/vue3';
  import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'

  const { props } = usePage();
  const user = ref(props.user);
  </script>
  