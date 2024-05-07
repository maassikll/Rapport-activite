<template>
    <Head title="Test"/>
    <AuthenticatedLayout>
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
        <button @click="saveData" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Save</button>
      </div>
    </AuthenticatedLayout>
  </template>
  
  <script setup>
  import { ref } from 'vue';
  import { Head } from '@inertiajs/vue3';
  import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
  
  const days = Array.from({ length: 30 }, (_, i) => i + 1);
  const checkedDays = ref({});
  const selectedColor = ref(null);
  const colors = ["green", "blue", "red"];
  
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
  
  const saveData = () => {
    console.log(checkedDays.value);
  };
  </script>
  