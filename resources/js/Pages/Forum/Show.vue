<script setup>
import ForumLayout from '@/Layouts/ForumLayout.vue'
import Pagination from '@/Components/Pagination.vue'
import { Head } from '@inertiajs/vue3'

defineProps({
    discussion : {
        type : Object
    }
})
</script>

<template>
    <Head :title="discussion.title" />
    <ForumLayout>
        <!-- <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template> -->
        <template #left>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">Left</div>
            </div>
        </template>
        <div class="space-y-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex items-center space-x-3">
                        <span class="inline-flex rounded-lg bg-indigo-100 px-2 py-0.5 text-xs text-indigo-600">
                            {{ discussion.topic.name }}
                        </span>
                        <h1 class="text-lg font-medium">
                            <template v-if="discussion.is_pinned">
                                [Pinned]
                            </template>
                            {{ discussion.title }}
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </ForumLayout>
</template>
