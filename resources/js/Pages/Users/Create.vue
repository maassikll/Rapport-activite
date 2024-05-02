<template>
    <head title="Create" />
    <AuthenticatedLayout>
        <template #header>
            <BackButton :href="route('users.index')" ></BackButton>
        </template>

        <form @submit.prevent="submit">
            <div>
                <InputLabel for="first_name" value="first_name" />
                <TextInput id="first_name" type="text" class="mt-1 block w-full" v-model="form.first_name" required autofocus autocomplete="first_name" />
                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div>
                <InputLabel for="last_name" value="last_name" />
                <TextInput id="last_name" type="text" class="mt-1 block w-full" v-model="form.last_name" required autofocus autocomplete="last_name" />
                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div class="mt-3">
                <InputLabel for="email" value="Email" />
                <TextInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required autocomplete="username" />
                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-3">
                <InputLabel for="phone_number" value="phone_number" />
                <TextInput id="phone_number" type="phone_number" class="mt-1 block w-full" v-model="form.phone_number" required autocomplete="username" />
                <InputError class="mt-2" :message="form.errors.name" />
            </div>



            <div class="flex flex-row p-10">
                <div class="basis-1/2"></div>
                <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Créer
                </PrimaryButton>
            </div>
        </form>
        
        



       
    </AuthenticatedLayout>
</template>

<script setup>

import {Head, Link,useForm } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';





const props = defineProps({
    users: Object
})

const form = useForm({
    first_name: '',
    last_name: '',
    email:'',
    phone_number:'',
    terms: false,
    
    
});


const submit = () => {
    form.post(route('users.store'), {
        onFinish: () =>  
        form.reset('phone_number','email')}
    );
};

</script>