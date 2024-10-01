<script setup>
import { ref } from 'vue'
import DefaultLayout from '@/Layouts/Default.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    title: '',
    titleList: [],
});
const alphaNumeric = ref(/[^A-Za-z0-9]/);

const checkForm = () => {
    if (!form.title) {
        form.setError('title', 'Title is Required.');
        return false
    }
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
    if (form.titleList.length < 1) {
        return;
    }

    form.transform((data) => ({
        title: data.titleList,
    })).post(route('tasksBatch'), {
        // onFinish: () => form.reset('title'),
    });
};

const addTitle = () => {
    if (!checkForm()) {
        return;
    }

    form.titleList.push(form.title)
    form.reset('title')

};

const removeTitle = (title) => {

    form.titleList.splice(form.titleList.indexOf(title), 1);

};

</script>

<template>
    <div>

        <Head title="Create Batch Task" />

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

                                        <div class="mt-10 grid grid-cols-6 gap-x-6 gap-y-8 ">

                                            <div class="col-span-4">
                                                <label for="title"
                                                    class="block text-sm font-medium leading-6 text-gray-900">Title</label>
                                                <div class="mt-2">
                                                    <input type="text" name="title" id="title" v-model="form.title"
                                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                                    <p class="text-sm text-red-600" v-if="form.errors.title">
                                                        {{ form.errors.title }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-span-2">
                                                <button @click.prevent="addTitle"
                                                    class="w-full mt-8 rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Add</button>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="mt-6 flex items-center justify-center gap-x-6 w-full">

                                    <div>
                                        <div class="mt-6 border-t border-gray-100 w-full">
                                            <ul class="divide-y divide-gray-100 rounded-md border border-gray-200 w-full"
                                                v-if="form.titleList">
                                                <li class="flex items-center justify-between py-4 pl-4 pr-5 text-sm leading-6"
                                                    v-for="(title, index) in form.titleList" v-bind:key="index">
                                                    <div class="flex  flex-1 items-center w-full">
                                                        <div class="ml-4 flex min-w-0 flex-1 gap-2">
                                                            <span class="truncate font-medium">{{ title }}</span>
                                                        </div>
                                                    </div>
                                                    <div class="ml-4 flex-shrink-0">
                                                        <a href="#"
                                                            class="font-medium text-indigo-600 hover:text-indigo-500"
                                                            @click.prevent="removeTitle(title)">Remove</a>
                                                    </div>
                                                </li>

                                            </ul>
                                        </div>
                                    </div>

                                </div>

                                <div class="mt-6 flex items-center justify-end gap-x-6">
                                    <button type="submit"
                                        class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Upload</button>
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
