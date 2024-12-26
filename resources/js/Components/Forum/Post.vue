<script setup>
    defineProps({
        post : {
            type : Object
        }
    })
</script>

<template>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900 flex items-start space-x-3">
        <div class="w-7 flex-shrink-0">
            <img :src="post.user?.avatar_url" class="rounded-full w-7 h-7" v-if="post.user">
        </div>
        <div class="w-full">
            <div>
                <div class="font-medium text-sm">{{ post.user?.username || '[user deleted]'}}</div>
                <div
                class="text-gray-500 text-xs">
                    <time
                    :datetime="post.created_at.datetime"
                    :title="post.created_at.datetime">
                        posted {{ post.created_at.human }}
                    </time>
                </div>
            </div>
            <div class="mt-3">
                <div v-html="post.body_markdown" class="markdown"></div>
            </div>
        </div>
    </div>
</template>