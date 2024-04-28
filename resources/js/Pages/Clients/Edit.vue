<template>
    <head title="Edit" />
    <AuthenticatedLayout>
        <template #header>
            <BackButton :href="route('clients.index')" ></BackButton>
        </template>

        <form @submit.prevent="updateClient">
            <div>
                <InputLabel for="name" value="Nom client" />
                <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.name"  autofocus autocomplete="name" />
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
                <InputLabel for="numero_siret" value="Numéro de siret" />
                <TextInput id="numero_siret" type="numero_siret" class="mt-1 block w-full" v-model="form.numero_siret"  autocomplete="numero siret" />
                <InputError class="mt-2" :message="form.errors.numero_siret" />
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

const props = defineProps({
    client: Object
});

const form = useForm({
    name: props.client.name,
    email: props.client.email,
    phone_number: props.client.phone_number,
    numero_siret: props.client.numero_siret
});

const updateClient = () => {
    form.put(route('clients.update', props.client.id), {
        onFinish: () => form.reset('email', 'numero_siret')
    });
};
</script>