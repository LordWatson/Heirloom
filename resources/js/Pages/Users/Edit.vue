<template>
    <Head title="Users"/>
    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Edit User - {{ user.id }}
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="overflow-x-auto relative">
                        <form @submit.prevent="submit">
                            <table class="w-full text-sm text-left text-gray-500">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-600 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="py-3 px-6">
                                        Name
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        Email
                                    </th>
                                    <th scope="col" class="py-3 px-6">
                                        Actions
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                    <tr class="bg-white border-b dark:border-gray-300">
                                        <td class="py-4 px-6">
                                            <TextInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" required autofocus />
                                            <InputError class="mt-2" :message="$page.props.errors.name" />
                                        </td>
                                        <td class="py-4 px-6">
                                            <TextInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required autofocus />
                                            <InputError class="mt-2" :message="$page.props.errors.email" />
                                        </td>
                                        <td class="py-4 px-6">
                                            <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                                Update
                                            </PrimaryButton>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, useForm} from '@inertiajs/inertia-vue3';
import {Inertia} from "@inertiajs/inertia";
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

const props = defineProps({
    user: Object,
})

const form = useForm({
    name: props.user?.name,
    email: props.user?.email,
});

const submit = () => {
    Inertia.post(`/user/${props.user.id}`, {
        _method: "put",
        name: form.name,
        email: form.email,
    });
};

</script>
