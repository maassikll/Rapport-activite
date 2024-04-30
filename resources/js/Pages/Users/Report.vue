<template>
    <Head title="Users" />

<AuthenticatedLayout>
<template #header>
    <BackButton :href="route('users.index')" ></BackButton>
</template>

<div>
  <h1>Test heading</h1>
  <button class="btn btn-danger" @click="generatePdf">Generate PDF</button>
</div>
</AuthenticatedLayout>
</template>

<script setup>

import jsPDF from 'jspdf';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import BackButton from '@/Components/BackButton.vue';


const props = defineProps({
users: Object
});

console.log(props);

const generatePdf = () => {
  if (props.users && props.users.data) {
    const doc = new jsPDF('p', 'pt', 'A4');
    doc.text("User List", 10, 10);
    props.users.data.forEach((user, index) => {
      const yPos = 30 + index * 20; // Adjust Y position for each user
      doc.text(`User ${index + 1}: ${user.first_name} - ${user.last_name}- ${user.email}`, 10, yPos);
    });
    doc.save("user_list.pdf");
  } else {
    console.error('Users data is undefined or missing');
  }
};


</script>
