<script setup>
    import ForumLayout from '@/Layouts/ForumLayout.vue'
    import Pagination from '@/Components/Pagination.vue'
    import Navigation from '@/Components/Navigation.vue'
    import PrimaryButton from '@/Components/PrimaryButton.vue'
    import Post from '@/Components/Forum/Post.vue'
    import { Head, router } from '@inertiajs/vue3'
    import pluralize from 'pluralize';
    import useCreatePost from '@/Composables/useCreatePost'
    import { nextTick, onMounted, onUpdated } from 'vue'
    import VueScrollTo from 'vue-scrollto'

    const props = defineProps({
        discussion : {
            type : Object
        },
        posts : {
            type : Object
        },
        query : {
            type : Object
        },
        postId : {
            type : Number
        }
    })

    const scrollToPost = (postId) => {
        if (!postId) {
            return
        }
        nextTick (() => {
            VueScrollTo.scrollTo(`#post-${postId}`, 500, {offset : -50})
        })
    }

    onMounted(() => {
        scrollToPost(props.postId)
    })

    onUpdated(() => {
        scrollToPost(props.postId)
    })

    const deleteDiscussion = () => {
        if (window.confirm('Are you sure?')) {
            router.delete(route('discussion.destroy', props.discussion))
        }
    }

    const { showCreatePostForm } = useCreatePost()
</script>

<template>
    <Head :title="discussion.title" />
    <ForumLayout>
        <!-- <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template> -->
        <template #left>
            <PrimaryButton
            @click="showCreatePostForm(discussion)"
            v-if="discussion.user_can.reply"
            class="w-full flex justify-center h-10">
                start to reply
            </PrimaryButton>
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
                        <ul>
                            <li v-if="discussion.user_can.delete">
                                <button class="text-rose-500 text-sm" @click="deleteDiscussion">Delete</button>
                            </li>
                        </ul>
                    </div>
                    <div class="text-sm">
                        {{ pluralize('reply', discussion.replies_count, true) }}
                    </div>
                </div>
            </div>
            <div class="space-y-3" v-if="posts.data.length">
                <Post v-for="post in posts.data"
                :key="post.id"
                :post="post"
                :isSolution="discussion.solution?.id === post.id" />
                <Pagination
                class="!mt-6"
                :pagination="posts.meta"/>
            </div>
        </div>
    </ForumLayout>
</template>
