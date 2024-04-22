<template>
    <head title="Create" />
    <AuthenticatedLayout>
        <template #header>
            Ajouter un client
        </template>

        <form @submit.prevent="submit">
            <div>
                <InputLabel for="name" value="Nom client" />
                <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" required autofocus autocomplete="name" />
                <InputError class="mt-2" :message="form.errors.name" />
            </div>


            <div class="mt-3">
                <InputLabel for="email" value="Email" />
                <TextInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required autocomplete="email" />
                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-3">
                <InputLabel for="phone_number" value="Numéro de téléphone" />
                <TextInput id="phone_number" type="phone_number" class="mt-1 block w-full" v-model="form.phone_number" required autocomplete="phone" />
                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div class="mt-3">
                <InputLabel for="description" value="Description" />
                <TextInput id="description" type="description" class="mt-1 block w-full" v-model="form.description" required autocomplete="description" />
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
    clients: Object
})

const form = useForm({
    name: '',
    email: '',
    phone_number:'',
    description:'',
    
});

const submit = () => {
    form.post(route('clients.index'), {
        onFinish: () => form.reset('name', 'email'),
    });
};


</script>