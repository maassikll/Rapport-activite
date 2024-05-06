<template>
    <Head title="Form Activity Report" />
    <AuthenticatedLayout>


        <select id="clientDropdown">
            <option v-for="name in clientNames" :key="name" :value="name">{{ name }}</option>
        </select>
        <br>
        <br>
        <select id="partnerDropdown">
            <option v-for="name in partenerNames" :key="name" :value="name">{{ name }}</option>
        </select>

        <br>
        <br>


        <div>
            <input type="checkbox" id="workday" value="workday" v-model="selectedTypes">
            <label for="workday" class="checkbox-label workday">Jour de travail</label>
            
            <input type="checkbox" id="weekend" value="weekend" v-model="selectedTypes">
            <label for="weekend" class="checkbox-label weekend">Weekend</label>
            
            <input type="checkbox" id="holiday" value="holiday" v-model="selectedTypes">
            <label for="holiday" class="checkbox-label holiday">Vacances</label>
        </div>

        <br>
        <br>

        <button @click="generatePDF">Télécharger le PDF</button>

    </AuthenticatedLayout>
</template>

<style scoped>
.checkbox-label {
    margin-right: 10px;
    cursor: pointer;
}

.workday {
    color: green;
}

.weekend {
    color: red;
}

.holiday {
    color: yellow;
}
</style>

<script setup>
import jsPDF from 'jspdf';
import 'jspdf-autotable';
import { defineProps, ref } from 'vue';
import { Head } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

const props = defineProps({
    clientNames: Array,
    partenerNames: Array,
    

})

const selectedTypes = ref([]); // Reactive reference to store selected types of days

const generatePDF = async () => {
    const doc = new jsPDF;


        // Get the selected client and partner names
        const selectedClientName = document.getElementById('clientDropdown').value;
        const selectedPartnerName = document.getElementById('partnerDropdown').value;

            // Get the selected types of days
    const selectedTypesOfDays = [];
    if (document.getElementById('workday').checked) {
        selectedTypesOfDays.push('Jour de travail');
    }
    if (document.getElementById('weekend').checked) {
        selectedTypesOfDays.push('Weekend');
    }
    if (document.getElementById('holiday').checked) {
        selectedTypesOfDays.push('Vacances');
    }

    // Check if both client and partner names are selected
    if (selectedClientName && selectedPartnerName) {
        // Add selected names to the PDF
        doc.text(`Nom client: ${selectedClientName}`, 10, 10);
        doc.text(`Nom partener: ${selectedPartnerName}`, 10, 20);
        doc.text(`Selected Types of Days: ${selectedTypesOfDays.join(', ')}`, 10, 30);
        doc.save(`Activity_Report.pdf`);
    } else {
        console.error('Please select both client and partner names.');
    }

    doc.save(`Activity_Report.pdf`);
};

</script>
