<template>
    <head title="Edit" />
    <AuthenticatedLayout>
        <template #header>
            <BackButton :href="route('users.index')" ></BackButton>
        </template>

        <form @submit.prevent="updateUser">
            <div>
                <InputLabel for="first_name" value="Nom employer" />
                <TextInput id="first_name" type="text" class="mt-1 block w-full" v-model="form.first_name"  autofocus autocomplete="first_name" />
                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div>
                <InputLabel for="last_name" value="Prenom employer" />
                <TextInput id="last_name" type="text" class="mt-1 block w-full" v-model="form.last_name"  autofocus autocomplete="last_name" />
                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div class="mt-3">
                <InputLabel for="email" value="Email" />
                <TextInput id="email" type="email" class="mt-1 block w-full" v-model="form.email"  autocomplete="email" />
                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-3">
                <InputLabel for="phone_number" value="Numéro de téléphone" />
                <TextInput id="phone_number" type="phone_number" class="mt-1 block w-full" v-model="form.phone_number"  autocomplete="phone" />
                <InputError class="mt-2" :message="form.errors.phone_number" />
            </div>

            <div class="mt-3">
                <InputLabel for="matricule" value="Matricule" />
                <TextInput id="matricule" type="matricule" class="mt-1 block w-full" v-model="form.matricule"  autocomplete="numero siret" />
                <InputError class="mt-2" :message="form.errors.matricule" />
            </div>

            <div class="flex flex-row p-10">
                <div class="basis-1/2"></div>
                <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Mettre à jour
                </PrimaryButton>
            </div>
        </form>
    </AuthenticatedLayout>
</template>

<script setup>
import {Head, Link, useForm } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import BackButton from '@/Components/BackButton.vue';


/*TODO Make the system of notification slide 

Red for delete
Blue for update
Green for Adds

*/
const props = defineProps({
    user: Object
});

const form = useForm({
    first_name: props.user.first_name,
    last_name: props.user.last_name,
    email: props.user.email,
    phone_number: props.user.phone_number,
    matricule: props.user.matricule
});

const updateUser = () => {
    form.put(route('users.update', props.user.id), {
        onFinish: () => form.reset('email', 'matricule')
    });
};
</script>