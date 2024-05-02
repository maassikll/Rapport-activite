<template>
  <Head title="Users" />

  <AuthenticatedLayout>
      <template #header>
          <BackButton :href="route('dashboard')" ></BackButton>
      </template>

      <NotificationStyle anchorText="Télecharger pdf" :handleClick="generatePdf" message="Ce pdf contient les détailes de L'employer"></NotificationStyle>




</AuthenticatedLayout>
</template>


<script setup>
import jsPDF from 'jspdf';
import 'jspdf-autotable';
import { defineProps } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import BackButton from '@/Components/BackButton.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import NotificationStyle from '@/Components/NotificationStyle.vue';

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
