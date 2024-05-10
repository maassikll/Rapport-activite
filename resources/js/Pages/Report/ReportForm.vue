<template>
  <Head title="Test" />
  <AuthenticatedLayout>
    <div class=" flex  ml-20 overflow-x-auto">
      <div class="max-w-sm w-full shadow-lg flex ">
        
        <div class="md:py-2 py-1 md:px-2 px-2 dark:bg-gray-700 bg-gray-50 rounded-l-lg">
            <div class="px-4">
                <div class="border-b pb-4 border-gray-400 border-dashed">
                    <p class="text-sm pt-2 leading-4 leading-none text-gray-600 dark:text-gray-300">Séléctionner votre partener</p>
                    <select id="partnerDropdown" class="leading-3 mt-3 py-3">
                        <option v-for="name in partenerNames" :key="name" :value="name">{{ name }}</option>
                    </select>
                </div>
                <div class="border-b pb-4 border-gray-400 border-dashed pt-3">
                    <p class="text-sm  leading-4 leading-none text-gray-600 dark:text-gray-300">Séléctionner votre client</p>
                    <select id="clientDropdown" class="leading-3 mt-3 py-3">
                        <option v-for="name in clientNames" :key="name" :value="name">{{ name }}</option>
                    </select>
                </div>
                <div class="border-b pb-4 border-gray-400 border-dashed pt-3 ">
                    <p class="text-sm leading-10 leading-none text-dark-500 dark:text-gray-300">Indication des Codes couleurs</p>
                    <span class="block text-sm leading-10 leading-none text-green-500 dark:text-gray-400">couleur vert => Client </span>
                    <span class="block text-sm leading-10 leading-none text-blue-500 dark:text-gray-400">couleur bleu => Congée </span>
                    <span class="block text-sm leading-10 leading-none text-red-800 dark:text-gray-400">couleur Rouge => Absence </span>
                    <span class="block text-sm leading-10 leading-none text-indigo-600 dark:text-gray-400">couleur violet => Intercontrat </span>
                    <span class="block text-sm leading-10 leading-none text-orange-500 dark:text-gray-400">couleur orange => Maladie </span>
                    <span class="block text-sm leading-10 leading-none text-gray-500 dark:text-gray-400">couleur gris => Weekend </span>

                    
                </div>
            </div>
        </div>
        

          <div class="md:p-2 p-1 dark:bg-gray-800 bg-white rounded-r-lg">
          <div class="px-4 flex items-center justify-between">
            <span
              tabindex="0"
              class="focus:outline-none text-base font-bold dark:text-gray-100 text-gray-800"
            >
            {{ currentDay }} {{ getCurrentMonth() }} {{ currentYear }}  
            </span>
            <div class="flex items-center space-x-2">
              <div 
              v-for="color in colors"
              :key="color"
              @click="selectColor(color)"
              class="transition ease-in-out w-5 h-5 rounded cursor-pointer focus:text-gray-400 hover:text-gray-400 text-gray-800 dark:text-gray-100 hover:-translate-y-1 hover:scale-110 duration-300"
              :style="{ backgroundColor: color }"
              
            ></div>
            </div>
          </div>
          <div class="flex items-center justify-between pt-12 overflow-x-auto">
            <table class="w-full">
              <thead>
                <tr>
                  <th v-for="day in daysOfWeek" :key="day">
                    <div class="w-full flex justify-center">
                      <p class="text-base font-medium text-center text-gray-800 dark:text-gray-100">{{ day }}</p>
                    </div>
                  </th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(week, index) in weeks" :key="index">
                  <td v-for="day in week" :key="day" class="pt-6">
                    <template v-if="day !== ''">
                      <div class="transition ease-in-out px-2 py-2 cursor-pointer flex w-full justify-center hover:-translate-y-1 hover:scale-110 duration-300" >
                        <p :class="getButtonClasses(day)" role="link"  @click="toggleCheckbox(day)">{{ day }}</p>
                      </div>
                    </template>
                    
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

       
        

        <div class="m-3 justify-between ">
          <button @click="generatePdf" class="bg-blue-500 hover:bg-blue-700 text-white font-bold m-2  py-2 px-4 rounded ">Télécharger</button>
          <button @click="" class="bg-blue-500 hover:bg-blue-700 text-white font-bold  m-2  py-2 px-4  rounded">Enregistrer</button>
          <button @click="" class="bg-blue-500 hover:bg-blue-700 text-white font-bold  m-2  py-2 px-4  rounded opacity-25">Envoie pdf </button>
        </div>
      
        
      </div>
    </div>

   
  </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { ref, onMounted, watchEffect } from "vue";
import { Head } from "@inertiajs/vue3";
import jsPDF from "jspdf";
import "jspdf-autotable";

const props = defineProps({
  partenerNames:Array,
  clientNames:Array,
});

const getCurrentMonth = () => {
  const today = new Date();
  const month = today.toLocaleDateString('fr-FR', { month: 'long' });
  return month;
};




const getCurrentDate = () => {
  const today = new Date();
  return {
    year: today.getFullYear(),
    month: today.getMonth()+1, 
    day: today.getDate(),
  };
};


const currentDate = ref(getCurrentDate());
const checkedDays = ref({});
const selectedColor = ref({});

/* Color Signifation
  #38a169 => bg-green-500 => clientéle
  #4299e1 => bg-blue-500 => formation
  #e53e3e => bg-red-500 => congé
  #ED8936 => bg-orange-500 => maladie
  #9F7AEA => bg-purple-500 => intercontrat
  #6B7280 => bg-gray-500 => weekend

*/
const colors = ["#38a169", "#4299e1", "#e53e3e", "#9F7AEA", "#ED8936"];

const colorCodes = {
  "#38a169": "clientéle",
  "#4299e1": "Formation",
  "#e53e3e": "Congé",
  "#6B7280": "weekend",
  "#9F7AEA": "intercontrat",
  "#ED8936": "maladie",
};

const selectColor = (color) => {
  selectedColor.value = color;
  console.log(color);
};


const toggleCheckbox = (day) => {
  if (checkedDays.value[day] === selectedColor.value) {
    checkedDays.value[day] = null;
  } else {
    checkedDays.value[day] = selectedColor.value;
    console.log(selectedColor.value);
  }
};



const { year: currentYear, month: currentMonth, day: currentDay } = currentDate.value;


const daysOfWeek = ["lun", "mar", "mer", "jeu", "ven", "sam", "dim"];


const generateCalendar = () => {
  const firstDayOfMonth = new Date(currentYear, currentMonth -1, 0).getDay();
  const daysInMonth = new Date(currentYear, currentMonth, 0).getDate();
  const weeks = [];
  let currentWeek = [];
  let dayCounter = 1;

  for (let i = 0; i < firstDayOfMonth; i++) {
    currentWeek.push("");
  }


  for (let i = firstDayOfMonth; i < 7; i++) {
    if (dayCounter <= daysInMonth) {
      currentWeek.push(dayCounter);
      dayCounter++;
    } else {
      currentWeek.push("");
    }
  }

  weeks.push(currentWeek);


  while (dayCounter <= daysInMonth) {
    currentWeek = [];
    for (let i = 0; i < 7; i++) {
      if (dayCounter <= daysInMonth) {
        currentWeek.push(dayCounter);
        dayCounter++;
      } else {
        currentWeek.push("");
      }
    }
    weeks.push(currentWeek);
  }

  return weeks;
};


const weeks = ref(generateCalendar());




const generatePdf = async () => {
  const doc = new jsPDF();
  
  const selectedClientName = document.getElementById("clientDropdown").value;
  const selectedPartnerName = document.getElementById("partnerDropdown").value;
  if (selectedClientName && selectedPartnerName) {
    const tableData = [];

    weeks.value.forEach((week) => {
      week.forEach((day) => {
        if (day !== "") {
          const color = checkedDays.value[day]; 
          if (color) {
            const code = colorCodes[color];
            const formatedDate = `${day}/${getCurrentMonth()}/${currentYear}`;
            tableData.push({ Day: formatedDate, Code: code });
          } else {
           
            const dayOfWeek = new Date(currentYear, currentMonth - 1, day).getDay();
            if (dayOfWeek === 6 || dayOfWeek === 0) { 
              const formatedDate = `${day}/${getCurrentMonth()}/${currentYear}`;
              tableData.push({ Day: formatedDate, Code: "weekend" });
            }
          }
        }
      });
    });
    doc.text(`Nom client: ${selectedClientName}`, 10, 10);
    doc.text(`Nom partener: ${selectedPartnerName}`, 10, 20);

    if (tableData.length > 0) {
      doc.autoTable({
        head: [["Day", "Code", "comment"]],
        body: tableData.map(({ Day, Code }) => [Day, Code]),
        startY: 30, 
      });
    }
    doc.save(`Activity_Report.pdf`);
  }
};


const getButtonClasses = (day) => {
  const dayOfWeek = new Date(currentYear, currentMonth - 1, day).getDay();
  const backgroundColor = checkedDays.value[day];
  let classes = {
    'focus:outline-none': true,
    'focus:ring-2': true,
    'focus:ring-offset-2': true,
    'text-base': true,
    'w-6': true,
    'h-6': true,
    'flex': true,
    'items-center': true,
    'justify-center': true,
    'font-medium': true,
    'rounded-full': true,
  };

  if (dayOfWeek === 6 || dayOfWeek === 0) {
    classes['bg-gray-500'] = true;
  } else {
    // Apply color based on selection for other days
    switch (backgroundColor) {
      case '#38a169':
        classes['bg-green-500'] = true;
        break;
      case '#4299e1':
        classes['bg-blue-500'] = true;
        break;
      case '#e53e3e':
        classes['bg-red-500'] = true;
        break;
      case '#9F7AEA':
        classes['bg-indigo-500'] = true;
        break;
      case '#ED8936':
        classes['bg-orange-400'] = true;
        break;

    default:
      classes[''] = true;
      break;
  }

}

  return classes;
};

</script>
