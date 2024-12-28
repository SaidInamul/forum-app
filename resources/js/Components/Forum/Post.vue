<script setup>
    import Svg from '../Svg.vue';
    import useCreatePost from '@/Composables/useCreatePost';
    defineProps({
        post : {
            type : Object
        }
    })

    const { showCreatePostForm } = useCreatePost()
</script>

<template>
    <div 
    :id="`post-${post.id}`"
    class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900 flex items-start space-x-3">
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

            <ul class="flex items-center justify-end space-x-3 mt-6">
                <li v-if="post.discussion.user_can.reply">
                    <button type="button" @click="showCreatePostForm(post.discussion)" class="rounded-md p-1 bg-rose-100 hover:bg-rose-200"><Svg name="icon_reply"></Svg></button>
                    <!-- <button v-on:click="showCreatePostForm(post.discussion, post.user)" class="text-indigo-500 text-sm">Reply</button> -->
                </li>
                <!-- <li v-if="post.user_can.edit">
                    <button v-on:click="editing = true" class="text-indigo-500 text-sm">Edit</button>
                </li>
                <li v-if="post.user_can.delete">
                    <button v-on:click="deletePost" class="text-indigo-500 text-sm">Delete</button>
                </li> -->
                <!-- <li v-if="post.discussion.user_can.solve">
                    <button
                        class="text-indigo-500 text-sm"
                        v-on:click="router.patch(route('discussions.solution.patch', post.discussion), { post_id: isSolution ? null : post.id }, { preserveScroll: true })"
                    >
                        {{ isSolution ? 'Unmark' : 'Mark' }} best solution
                    </button>
                </li> -->
            </ul>
        </div>
    </div>
</template>