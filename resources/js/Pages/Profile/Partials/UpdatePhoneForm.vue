<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

const phoneInput = ref(null);
const currentPhoneInput = ref(null);


const form = useForm({
    current_phonne_number: '',
    phone_number:'',
    phone_number_confirmation:'',

})


const updatePhone = () => {
    form.put(route('phone_number.update'), {
        preserveScroll: true,
        onSuccess: () => form.reset(),
        onError: () => {
            if (form.errors.phone_number) {
                form.reset('phone_number','phone_number_confirmation');
                phoneInput.value.focus();
            }
            if (form.errors.current_phone_number) {
                form.reset('current_phonne_number');
                currentPhoneInput.value.focus();
            }
        },
    });
};


</script>

<template>
        <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900">Update Phone Number</h2>

            <p class="mt-1 text-sm text-gray-600">
                Ensure your account is using a right number phone your boss may contact you.
            </p>
        </header>
        <form @submit.prevent="updatePhone" class="mt-6 space-y-6">
            <div>
                <InputLabel for="current_phone_number" value="current_phone_number" />

                <TextInput
                    id="current_phone_number"
                    ref="currentPhoneInput"
                    v-model="form.current_phone_number"
                    type="phone_number"
                    class="mt-1 block w-full"
                    autocomplete="current_phone_number"
                />

                <InputError :message="form.errors.current_phone_number" class="mt-2" />
            </div>

            <div>
                <InputLabel for="phone_number" value="New Phone number" />

                <TextInput
                    id="phone_number"
                    ref="phoneInput"
                    v-model="form.phone_number"
                    type="phone_number"
                    class="mt-1 block w-full"
                    autocomplete="phone_number"
                />

                <InputError :message="form.errors.phone_number" class="mt-2" />
            </div>

            <div>
                <InputLabel for="phone_number_confirmation" value="Confirm phone_number" />

                <TextInput
                    id="phone_number_confirmation"
                    v-model="form.phone_number_confirmation"
                    type="phone_number"
                    class="mt-1 block w-full"
                    autocomplete="new-phone_number"
                />

                <InputError :message="form.errors.phone_number_confirmation" class="mt-2" />
            </div>

            <div class="flex items-center gap-4">
                <PrimaryButton :disabled="form.processing">Save</PrimaryButton>

                <Transition
                    enter-active-class="transition ease-in-out"
                    enter-from-class="opacity-0"
                    leave-active-class="transition ease-in-out"
                    leave-to-class="opacity-0"
                >
                    <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Saved.</p>
                </Transition>
            </div>
        </form>
    </section>
</template>
