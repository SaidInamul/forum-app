<script setup>
    import FixedFormWrapper from './FixedFormWrapper.vue'
    import InputLabel from '../InputLabel.vue';
    import InputError from '../InputError.vue';
    import PrimaryButton from '../PrimaryButton.vue';
    import Textarea from '../Textarea.vue'
    import useCreatePost from '@/Composables/useCreatePost';
    import Svg from '../Svg.vue';

    const { visible, form, hideCreatePostForm, discussion } = useCreatePost()
    const createPost = () => {
        form.post(route('post.store', discussion.value), {
            onSuccess : () => {
                form.reset()
                hideCreatePostForm()
            }
        })
    }
</script>

<template>
    <FixedFormWrapper v-if="visible" @submit.prevent="createPost" :form="form">
        <template #header>
            <div class="flex items-center justify-between">
                <h1 class="text-lg font-medium">Replying to {{ discussion.title }}</h1>
                <button type="button" v-on:click="hideCreatePostForm">
                    <Svg name="icon_close" class="h-5 w-5"></Svg>
                </button>
            </div>
        </template>

        <template #main="{ markdownPreviewEnabled }">
            <div>
                <InputLabel for="body" value="Body" class="sr-only" />
                <Textarea id="body" class="w-full h-48 align-top" v-model="form.body" v-if="!markdownPreviewEnabled"/>
                <!-- <Mentionable :keys="['@']" offset="6" v-on:search="mentionSearch" :items="mentionSearchResults" v-if="!markdownPreviewEnabled">
                    

                    <template #no-result>
                        <div class="mention-item">No username found</div>
                    </template>
                </Mentionable> -->
                <InputError class="mt-2" :message="form.errors.body" />
            </div>
        </template>

        <template #button>
            <PrimaryButton>
                Reply
            </PrimaryButton>
        </template>
    </FixedFormWrapper>
</template>