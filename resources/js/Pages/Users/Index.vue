<template>
    <Head title="Users" />

    <AuthenticatedLayout>
        <template #header>
            <BackButton :href="route('dashboard')" ></BackButton>
        </template>

        
        
        <div  class="mb-4 inline-flex w-full overflow-hidden rounded-lg bg-white shadow-md">
            <div class="flex w-12 items-center justify-center bg-blue-500">
                <svg class="h-6 w-6 fill-current text-white" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M20 3.33331C10.8 3.33331 3.33337 10.8 3.33337 20C3.33337 29.2 10.8 36.6666 20 36.6666C29.2 36.6666 36.6667 29.2 36.6667 20C36.6667 10.8 29.2 3.33331 20 3.33331ZM21.6667 28.3333H18.3334V25H21.6667V28.3333ZM21.6667 21.6666H18.3334V11.6666H21.6667V21.6666Z"></path>
                </svg>
            </div>
    
            <div class="-mx-3 px-4 py-2">
                <div class="mx-3">
                    <span class="font-semibold text-blue-500">Info Employers</span>
                    <p class="text-sm text-gray-600">table des employers </p>
                </div>
            </div>
        </div>

        

        <div class="flex justify-end flex">
            <LinkButton :href="route('users.create')" :active="route().current('users.create')">Create</LinkButton>
            
            
        </div>

        <div class="inline-block min-w-full overflow-hidden rounded-lg shadow">
            <table class="w-full whitespace-no-wrap">
                <thead>
                    <tr class="border-b bg-gray-50 text-left text-xs font-semibold uppercase tracking-wide text-gray-500">
                        <th class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">
                            Nom
                        </th>
                        <th class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">
                            Prenom
                        </th>
                        <th class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">
                            Matricule
                        </th>
                        <th class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">
                            CRA
                        </th>
                        <th class="border-b-2 border-gray-200 bg-gray-100 px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="user in users.data" :key="user.id" class="text-gray-700">
                        <td class="border-b border-gray-200 bg-white px-5 py-5 text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">{{ user.first_name }}</p>
                        </td>
                        <td class="border-b border-gray-200 bg-white px-5 py-5 text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">{{ user.last_name }}</p>
                        </td>
                        <td class="border-b border-gray-200 bg-white px-5 py-5 text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">{{ user.matricule }}</p>
                        </td>
                        <td class="border-b border-gray-200 bg-white px-5 py-4 text-sm">
                            <a @click="generatePdfEmploee(user.id)" class="text-blue-600 whitespace-no-wrap no-underline hover:underline " style="cursor: pointer;">Pdf</a>
                            <svg  style="cursor: pointer;" @click="generatePdfEmploee(user.id)" class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"  fill="currentColor" >
                                <path fill-rule="evenodd" d="M13 11.15V4a1 1 0 1 0-2 0v7.15L8.78 8.374a1 1 0 1 0-1.56 1.25l4 5a1 1 0 0 0 1.56 0l4-5a1 1 0 1 0-1.56-1.25L13 11.15Z" clip-rule="evenodd"/>
                                <path fill-rule="evenodd" d="M9.657 15.874 7.358 13H5a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2h-2.358l-2.3 2.874a3 3 0 0 1-4.685 0ZM17 16a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2H17Z" clip-rule="evenodd"/>
                            </svg>
                            
                        </td>
                        
                        
                        <td class="border-b border-gray-200 bg-white px-0 py-2 text-sm flex ">
                            <LinkButton :href="route('users.show', { id: user.id })" :active="route().current('users.show')">Show</LinkButton>
                            <LinkButton :href="route('users.edit', { id: user.id })" :active="route().current('users.edit')">Edit</LinkButton>
                            <LinkButton :href="route('users.destroy',user.id)"  method="DELETE">Delete</LinkButton>
                        </td>
                    </tr>
                </tbody>
            </table>

            <div class="flex flex-col items-center border-t bg-white px-5 py-5 xs:flex-row xs:justify-between">
                <pagination :links="users.links" />
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
import jsPDF from 'jspdf';
import 'jspdf-autotable';




const props = defineProps({
    users: Object
})

const printPDF = () => {
  window.print();
};

const loadImage = (src) => {
  return new Promise((resolve, reject) => {
    const img = new Image();
    img.onload = () => resolve(img);
    img.onerror = (error) => reject(error);
    img.src = src;
  });
};

const generatePdfEmploee = async (userId) => {
  try {
    const response = await axios.get(`/users/${userId}/report`);
    const userData = response.data.user;

    // Load images asynchronously first hehe boyy
    const [logo, logoText] = await Promise.all([
      loadImage('/images/logwireLogo.jpeg'),
      loadImage('/images/logwireTextLogo.jpeg')
    ]);

    const doc = new jsPDF('p', 'pt', 'A4');

    const logoWidth = 100;
    const logoHeight = (logoWidth * logo.height) / logo.width;
    doc.addImage(logo, 'JPEG', 10, 10, logoWidth, logoHeight);

    const logoTextWidth = 90;
    const logoTextHeight = (logoTextWidth * logoText.height) / logoText.width;
    doc.addImage(logoText, 'JPEG', 82, 67, logoTextWidth, logoTextHeight);
    
    const userDataContent = [
      ['Nom', 'Prenom', 'Email', 'Téléphone', 'Matricule'],
      [userData.first_name, userData.last_name, userData.email, userData.phone_number, userData.matricule]
    ];

    const styles = {
      font: 'Arial',
      fontStyle: 'normal',
      fontSize: 12,
      textColor: [0, 0, 0],
      halign: 'center',
      valign: 'middle',
    };

    await doc.autoTable({
      startY: 150,
      styles: styles,
      head: userDataContent.slice(0, 1),
      body: userDataContent.slice(1)
    });
    doc.save(`${userData.first_name}.pdf`);

  } catch (error) {
    console.error('Error generating PDF:', error);
  }
};


</script>
