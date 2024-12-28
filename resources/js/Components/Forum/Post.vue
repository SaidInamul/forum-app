<script setup>
    import Svg from '../Svg.vue';
    import useCreatePost from '@/Composables/useCreatePost';
    import { useForm, router } from '@inertiajs/vue3';
    import { ref } from 'vue';
    import Textarea from '../Textarea.vue';
    import InputLabel from '../InputLabel.vue';
    import InputError from '../InputError.vue';
    import PrimaryButton from '../PrimaryButton.vue';

    const props = defineProps({
        post : {
            type : Object
        }
    })

    const editing = ref(false)
    const editForm = useForm({
        body : props.post.body
    })

    const editPost = () => {
        editForm.patch(route('post.update', props.post), {
            preserveScroll : true,
            onSuccess : () => {
                editing.value = false
            }
        })
    }

    const deletePost = () => {
        if (window.confirm('Are you sure?')) {
            router.delete(route('post.destroy', props.post), {
                preserveScroll: true
            })
        }
    }

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
                <form v-on:submit.prevent="editPost" v-if="editing == true">
                    <InputLabel for="body" value="Body" class="sr-only" />
                    <Textarea id="body" class="w-full h-48 align-top" v-model="editForm.body" required autofocus/>
                    <InputError class="mt-2" :message="editForm.errors.body" />
                    <div class="flex items-center space-x-2 mt-3">
                        <PrimaryButton>
                            Save
                        </PrimaryButton>
                        <button type="button" @click="editing = false" class="text-sm">cancel</button>
                    </div>
                </form>
                <div v-else v-html="post.body_markdown"  class="markdown"></div>
            </div>

            <ul class="flex items-center justify-end space-x-3 mt-6">
                <li v-if="post.discussion.user_can.reply">
                    <button type="button" @click="showCreatePostForm(post.discussion)" class="rounded-md p-1 bg-rose-100 hover:bg-rose-200"><Svg name="icon_reply"></Svg></button>
                    <!-- <button v-on:click="showCreatePostForm(post.discussion, post.user)" class="text-indigo-500 text-sm">Reply</button> -->
                </li>
                <li v-if="post.user_can.update">
                    <button type="button" @click="editing = true" class="rounded-md p-1 bg-rose-100 hover:bg-rose-200"><Svg name="icon_edit"></Svg></button>
                </li>
                <li v-if="post.user_can.delete">
                    <button @click="deletePost" class="rounded-md p-1 bg-rose-100 hover:bg-rose-200"><Svg name="icon_delete"></Svg></button>
                </li>
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