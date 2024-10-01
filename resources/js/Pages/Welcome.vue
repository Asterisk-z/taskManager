<script setup>
import { Head } from '@inertiajs/vue3';
import DefaultLayout from '@/Layouts/Default.vue';
import { onMounted, ref, shallowRef } from 'vue';




const taskList = shallowRef([]);
const seconds = shallowRef(0);
const fetchTasks = async (is_completed = false) => {
    let query = is_completed ? 'is_completed=true' : ''
    await axios.get(`/api/tasks?${query}`).then((response) => {
        taskList.value = response.data
    }).catch((error) => {
        console.log(error);
    });
};
onMounted(() => {

    fetchTasks()

    // updateTimeTaken(0)

})

const updateTask = async (task, is_completed = false) => {
    let completed = is_completed ? is_completed : task.is_completed;

    await axios.put(`/api/tasks/${task.id}`, {
        'is_completed': completed, 'time_taken': task.time_taken + seconds.value
    }).then((response) => {
        taskList.value = response.data
    }).catch((error) => {
        console.log(error);
    });
};


const updateTimeTaken = (task_id) => {
    // if (task.is_completed) {
    //     return task.time_taken
    // }
    // setInterval(() => {
    //     seconds.value = time + 1
    //     updateTimeTaken(seconds.value)

    // }, 1000)
    // return seconds.value
};
const filterData = async (e) => fetchTasks(e.target.checked);

</script>

<template>
    <div>

        <Head title="Welcome" />

        <DefaultLayout>
            <div class="relative isolate px-6 pt-8 lg:px-8">
                <div class="mx-auto max-w-2xl py-7">
                    <div class="mb-8 flex flex-col justify-center" v-if="taskList">

                        <div class="flex my-4 w-full flex-col items-center justify-center  bg-white">
                            <p> Display only Completed</p>
                            <label class="relative inline-flex cursor-pointer items-center">

                                <input id="switch" type="checkbox" class="peer sr-only" @change="filterData" />
                                <label for="switch" class=""></label>
                                <div
                                    class="peer h-6 w-11 rounded-full border bg-slate-200 after:absolute after:left-[2px] after:top-0.5 after:h-5 after:w-5 after:rounded-full after:border after:border-gray-300 after:bg-white after:transition-all after:content-[''] peer-checked:bg-slate-800 peer-checked:after:translate-x-full peer-checked:after:border-white peer-focus:ring-green-300">
                                </div>
                            </label>
                        </div>


                        <div
                            class="relative isolate flex flex-col items-center gap-x-6 gap-y-10 overflow-hidden bg-gray-50 px-6 py-2.5 sm:px-3.5 w-[500px]">

                            <div class="flex flex-wrap justify-between gap-x-4 gap-y-6 w-full "
                                v-for="(task, index) in taskList" v-bind:key="index">
                                <p class="text-sm leading-6 text-gray-900">
                                    <strong class="font-semibold">{{ task.title }}</strong> - <span> Time taken {{
                                        updateTimeTaken(task.time_taken)
                                    }}</span>
                                </p>
                                <a href="#" v-if="!task.is_completed" @click.prevent="updateTask(task, true)"
                                    class="flex-none rounded-full bg-gray-900 px-3.5 py-1 text-sm font-semibold text-white shadow-sm hover:bg-gray-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-900">Completed</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </DefaultLayout>
    </div>

</template>

<style></style>
