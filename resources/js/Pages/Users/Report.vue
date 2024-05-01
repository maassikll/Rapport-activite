<template>
  <Head title="Users" />

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
                  <a @click="generatePdf" class="font-semibold text-blue-500" style="cursor: pointer;">Télecharger {{user.first_name}}.pdf</a>
                  <p class="text-sm text-gray-600">Ce pdf contient les informations d'un employer  </p>
              </div>
          </div>
      </div>




</AuthenticatedLayout>
</template>


<script setup>
import jsPDF from 'jspdf';
import 'jspdf-autotable';
import { defineProps } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import BackButton from '@/Components/BackButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';

const props = defineProps({
  user: Object
});
const loadImage = (src) => {
  return new Promise((resolve, reject) => {
    const img = new Image();
    img.onload = () => resolve(img);
    img.onerror = (error) => reject(error);
    img.src = src;
  });
};

const generatePdf = async () => {
  try {
    if (!props.user) {
      console.error('Employer not found');
      return;
    }

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
    
    const userData = [
      ['Nom', 'Prenom', 'Email', 'Téléphone', 'Matricule'],
      [props.user.first_name, props.user.last_name, props.user.email, props.user.phone_number, props.user.matricule]
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
      head: userData.slice(0, 1),
      body: userData.slice(1)
    });
    doc.save('Employer_Details.pdf');

  } catch (error) {
    console.error('Error generating PDF:', error);
  }
};
</script>
