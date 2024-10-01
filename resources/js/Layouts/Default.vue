<script setup>
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div>

        <div class="bg-white">
            <header class="absolute inset-x-0 top-0 z-50">
                <nav class="flex items-center justify-center p-6 lg:px-8" aria-label="Global">
                    <div class="flex gap-x-12 ">

                        <Link href="/"><a href="#" class="text-sm font-semibold leading-6 text-gray-900">Home</a>
                        </Link>
                        <Link href="/create"><a href="#" class="text-sm font-semibold leading-6 text-gray-900">Create
                            Task</a>
                        </Link>
                        <Link href="/batch"><a href="#" class="text-sm font-semibold leading-6 text-gray-900">Create
                            Batch
                            Task
                        </a></Link>
                        <Link href="/generate"><a href="#"
                            class="text-sm font-semibold leading-6 text-gray-900">Generate
                            Batch
                            Task
                        </a></Link>
                    </div>
                </nav>

            </header>
            <slot />
        </div>
    </div>

</template>
