<script setup>
    import FixedFormWrapper from './FixedFormWrapper.vue'
    import TextInput from '../TextInput.vue';
    import InputLabel from '../InputLabel.vue';
    import InputError from '../InputError.vue';
    import PrimaryButton from '../PrimaryButton.vue';
    import Select from '../Select.vue';
    import Textarea from '../Textarea.vue'
</script>

<template>
    <FixedFormWrapper>
        <template #header>
            <div class="fflex items-center justify-between">
                <h1 class="text-lg font-medium">New discussion</h1>
                <!-- <button v-on:click="hideCreateDiscussionForm">
                    <Svg name="icon-close" class="h-5 w-5"></Svg>
                </button> -->
            </div>
        </template>

        <template #main>
            <div class="flex items-start space-x-3">
                <div class="flex-grow">
                    <div>
                        <InputLabel for="title" value="Title" class="sr-only" />
                        <TextInput id="title" type="text" class="w-full" placeholder="Discussion title" />
                        <!-- <InputError class="mt-2" :message="form.errors.title" /> -->
                    </div>
                </div>
                <div>
                    <InputLabel for="topic" value="Topic" class="sr-only" />
                    <Select id="topic">
                            <option 
                            value="">
                                Choose a topic
                            </option>
                            <option 
                            :value="topic.slug"
                            v-for="topic in $page.props.topics"
                            :key="topic.id"
                            >
                                {{ topic.name }}
                            </option>
                        </Select>
                    <!-- <InputError class="mt-2" :message="form.errors.topic_id" /> -->
                </div>
            </div>
            <div class="mt-4">
                <InputLabel for="body" value="Body" class="sr-only" />
                <Textarea id="body" class="w-full h-48 align-top" />
                <!-- <Mentionable :keys="['@']" offset="6" v-on:search="mentionSearch" :items="mentionSearchResults" v-if="!markdownPreviewEnabled">
                    

                    <template #no-result>
                        <div class="mention-item">No username found</div>
                    </template>
                </Mentionable> -->
                <!-- <InputError class="mt-2" :message="form.errors.body" /> -->
            </div>
        </template>

        <template #button>
            <PrimaryButton>
                Start discussion
            </PrimaryButton>
        </template>
    </FixedFormWrapper>
</template>