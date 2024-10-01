<script setup>
import { ref } from 'vue'
import DefaultLayout from '@/Layouts/Default.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    max: 0,
    min: 0,
});
const numbers = ref(/[^0-9]/);

const checkForm = () => {
    if (numbers.value.test(form.max) || numbers.value.test(form.min)) {
        form.setError('max', 'min must be a number.');
        form.setError('min', 'max must be a number.');
        return false
    }
    if (form.max > form.min) {
        form.setError('man', 'Max Must be greater than min.');
        return false
    }
    form.errors.title = ""
    return true;
};

const submit = () => {
    if (!checkForm()) {
        return;
    }

    form.post(route('tasksGenerate'), {
        onFinish: () => form.reset(),
    });
};
</script>

<template>
    <div>

        <Head title="Generate Batch Task" />

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

                                            <div class="col-span-3">
                                                <label for="min"
                                                    class="block text-sm font-medium leading-6 text-gray-900">Min</label>
                                                <div class="mt-2">
                                                    <input type="number" name="min" id="min" v-model="form.min" required
                                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                                    <p class="text-sm text-red-600" v-if="form.errors.min">
                                                        {{ form.errors.min }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-span-3">
                                                <label for="max"
                                                    class="block text-sm font-medium leading-6 text-gray-900">Max</label>
                                                <div class="mt-2">
                                                    <input type="number" name="max" id="max" v-model="form.max" required
                                                        class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                                                    <p class="text-sm text-red-600" v-if="form.errors.max">
                                                        {{ form.errors.max }}
                                                    </p>
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                </div>

                                <div class="mt-6 flex items-center justify-end gap-x-6">
                                    <button type="submit"
                                        class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Generate</button>
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
