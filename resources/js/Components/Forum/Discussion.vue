<script setup>
    import { Link } from '@inertiajs/vue3'
    import { computed } from 'vue'
    import pluralize from 'pluralize';
    const props = defineProps({
        discussion : {
            type : Object
        }
    })

    const participants = computed(() => props.discussion.participants.slice(0, 3))
</script>

<template>
    <Link :href="route('discussion.show', discussion)" class="block bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900 flex items-center space-x-6">
            <div class="flex-grow">
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
                <div class="mt-5 text-gray-500 text-sm line-clamp-1" v-if="discussion.post">
                    {{ discussion.post.body_preview }}
                </div>
                <Link :href="`${route('discussion.show', discussion)}?post=${discussion.latest_post.id}`" class="inline-block text-xs mt-3" v-if="discussion.post">
                    last post by {{ discussion.latest_post.user?.username || '[user deleted]' }} <time
                    :datetime="discussion.latest_post.created_at.datetime"
                    :title="discussion.latest_post.created_at.datetime">
                        {{ discussion.latest_post.created_at.human }}
                    </time>
                </Link>
            </div>
            <div class="flex-shrink-0 flex flex-col items-end">
                <div class="flex items-center justify-start -space-x-2">
                    <img 
                    :src="participant.avatar_url"
                    v-for="participant in participants"
                    :key="participant.id"
                    class="h-6 w-6 rounded-full ring-2 ring-white first-of-type:w-7 first-of-type:h-7" :title="participant.username">
                    <span class="!ml-2 text-sm text-gray-500" v-if="discussion.participants.length > 3">+ {{ discussion.participants.length - 3 }} more</span>
                </div>
                <div class="text-xs mt-3">
                    {{ pluralize('reply', discussion.replies_count, true) }} 
                </div>
            </div>
        </div>
    </Link>
</template>