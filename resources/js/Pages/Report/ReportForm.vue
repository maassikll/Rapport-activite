<template>
    <Head title="Test"/>
    <AuthenticatedLayout>
      <select id="clientDropdown">
        <option v-for="name in clientNames" :key="name" :value="name">{{ name }}</option>
      </select>
      <br>
      <br>
      <select id="partnerDropdown">
        <option v-for="name in partenerNames" :key="name" :value="name">{{ name }}</option>
      </select>
      <div class="flex flex-col items-center space-y-4">
        <div class="flex space-x-4">
          <div v-for="color in colors" :key="color" @click="selectColor(color)" class="w-10 h-10 rounded-full cursor-pointer" :style="{ backgroundColor: color }"></div>
        </div>
        <div class="grid grid-cols-7 gap-4">
          <div v-for="(day, index) in days" :key="index" class="flex items-center">
            <div class="w-5 h-5 border border-black cursor-pointer" :style="{ backgroundColor: checkedDays[day] }" @click="toggleCheckbox(day)"></div>
            <label class="ml-2">{{ day }}</label>
          </div>
        </div>
        <button @click="generatePdf" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Download PDF</button>
      </div>
    </AuthenticatedLayout>
  </template>
  
  <script setup>
  import jsPDF from 'jspdf';
  import 'jspdf-autotable';
  import { ref, defineProps } from 'vue';
  import { Head } from '@inertiajs/vue3';
  import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
  
  const props = defineProps({
    partenerNames: Array,
    clientNames: Array,
  });
  
  const days = Array.from({ length: 30 }, (_, i) => i + 1);
  const checkedDays = ref({});
  const selectedColor = ref(null);
  const colors = ["green", "blue", "red"];
  
  // Define a mapping between colors and their corresponding codes
  const colorCodes = {
    green: "Vacances",
    blue: "CLI",
    red: "Visite médicale"
  };
  
  const selectColor = (color) => {
    selectedColor.value = color;
  };
  
  const toggleCheckbox = (day) => {
    if (checkedDays.value[day] === selectedColor.value) {
      checkedDays.value[day] = null;
    } else {
      checkedDays.value[day] = selectedColor.value;
    }
  };
  
  const generatePdf = async () => {
    try{
        const doc = new jsPDF;

        
        const selectedClientName = document.getElementById('clientDropdown').value;
        const selectedPartnerName = document.getElementById('partnerDropdown').value;

        if (selectedClientName && selectedPartnerName) {
        
        const tableData = [];

        
        Object.entries(checkedDays.value).forEach(([day, color]) => {
            if (color) {
            
            const code = colorCodes[color];
            
            tableData.push({ Day: day, Code: code });
            }
        });

        
        doc.text(`Nom client: ${selectedClientName}`, 10, 10);
        doc.text(`Nom partener: ${selectedPartnerName}`, 10, 20);

        
        if (tableData.length > 0) {
        
            doc.autoTable({
            //TODO Make the Comment system
            head: [['Day', 'Code','Comment']],
            body: tableData.map(({ Day, Code }) => [Day, Code]),
            startY: 30 // Start the table below the client and partner names
            });
        }

        doc.save(`Activity_Report.pdf`);
        }

    }catch{
        console.log('Undefined Error');

    }

};
  </script>
  