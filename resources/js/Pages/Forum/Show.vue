<script setup>
import ForumLayout from '@/Layouts/ForumLayout.vue'
import Pagination from '@/Components/Pagination.vue'
import Navigation from '@/Components/Navigation.vue'
import Post from '@/Components/Forum/Post.vue'
import { Head } from '@inertiajs/vue3'
import pluralize from 'pluralize';

defineProps({
    discussion : {
        type : Object
    },
    posts : {
        type : Object
    },
    query : {
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
            <Navigation :query="query"/>
        </template>
        <div class="space-y-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <span class="inline-flex rounded-lg bg-rose-100 px-2 py-0.5 text-xs text-rose-600">
                            {{ discussion.topic.name }}
                        </span>
                        <h1 class="text-lg font-medium">
                            <template v-if="discussion.is_pinned">
                                [Pinned]
                            </template>
                            {{ discussion.title }}
                        </h1>
                    </div>
                    <div class="text-sm">
                        {{ pluralize('reply', discussion.replies_count, true) }}
                    </div>
                </div>
            </div>
            <div class="space-y-3">
                <Post v-for="post in posts.data"
                :key="post.id"
                :post="post" />
                <Pagination
                class="!mt-6"
                :pagination="posts.meta"/>
            </div>
        </div>
    </ForumLayout>
</template>
