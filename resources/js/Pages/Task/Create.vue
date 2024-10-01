<script setup>
import { ref } from 'vue'
import DefaultLayout from '@/Layouts/Default.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    title: '',
});
const alphaNumeric = ref(/[^A-Za-z0-9]/);

const checkForm = () => {
    if (form.title.length > 30) {
        form.setError('title', 'Title Can not be more that 30 characters.');
        return false
    }
    if (alphaNumeric.value.test(form.title)) {
        form.setError('title', 'Title Can not contain special characters.');
        return false
    }
    form.errors.title = ""
    return true;
};

const submit = () => {
    if (!checkForm()) {
        return;
    }

    form.post(route('tasks'), {
        onFinish: () => form.reset('title'),
    });
};

</script>

<template>
    <div>

        <Head title="Create Task" />

        <DefaultLayout>
            <div class="relative isolate px-6 pt-10 ">
                <div class="mx-auto max-w-2xl py-14 ">
                    <div class="sm:mb-8 sm:flex sm:justify-center">
                        <div
                            class="relative px-3 p-6 text-sm leading-6 text-gray-600 ring-1 ring-gray-900/10 hover:ring-gray-900/20 w-full">

                            <form @submit.prevent="submit">
                                <div class="space-y-12 ">
                                    <div class="border-b border-gray-900/10 pb-12">
                                        <h2 class="text-base font-semibold leading-7 text-gray-900">Create Task </h2>

                                        <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">

                                            <div class="col-span-full">
                                                <label for="title"
                                                    class="block text-sm font-medium leading-6 text-gray-900">Title</label>
                                                <div class="mt-2">
                                                    <input type="text" name="title" id="title" v-model="form.title"
                                                        required
                                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                                    <p class="text-sm text-red-600" v-if="form.errors.title">
                                                        {{ form.errors.title }}
                                                    </p>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="mt-6 flex items-center justify-end gap-x-6">
                                    <button type="submit"
                                        class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Add
                                        Task</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </DefaultLayout>

    </div>

</template>

<style></style>
