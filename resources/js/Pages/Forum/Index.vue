<script setup>
import ForumLayout from '@/Layouts/ForumLayout.vue'
import Select from '@/Components/Select.vue'
import InputLabel from '@/Components/InputLabel.vue'
import TextInput from '@/Components/TextInput.vue'
import Pagination from '@/Components/Pagination.vue'
import Navigation from '@/Components/Navigation.vue'
import Discussion from '@/Components/Forum/Discussion.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import { Head, router } from '@inertiajs/vue3'
import _omitBy from 'lodash.omitby'
import _isEmpty from 'lodash.isempty'
import _debounce from 'lodash.debounce'
import useCreateDiscussion from '@/Composables/useCreateDiscussion'
import { ref, watch } from 'vue'

const props = defineProps({
    discussions : {
        type : Object
    },
    query : {
        type : Object
    }
})

const filterTopic = (e) => {
    router.visit('/', {
        data : _omitBy({
            'filter[topic]' : e.target.value
        }, _isEmpty),
        preserveScroll : true
    })
}
    const { showCreateDiscussionForm } = useCreateDiscussion()

    const searchQuery = ref(props.query.search || '')

    watch(searchQuery, (query) => {
        handleInputSearch(query)
    })

    const handleInputSearch = _debounce((query) => {
        router.reload({
            data : {
                search : query
            },
            preserveScroll : true
        })
    }, 1000)
</script>

<template>
    <Head title="Forum" />
    <ForumLayout>
        <!-- <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template> -->
        <!-- Filter side -->
        <template #left>
            <PrimaryButton
            @click="showCreateDiscussionForm"
            v-if="$page.props.auth.user"
            class="w-full flex justify-center h-10">
                Start a discussion
            </PrimaryButton>
            <Navigation :query="query"/>
        </template>
        <!-- End filter side -->
         <!-- Main -->
        <div class="space-y-6">
            <!-- Main header -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 flex items-center space-x-3">
                    <div class="flex-grow">
                        <InputLabel for="search" value="Search" class="sr-only" />
                        <TextInput type="search" id="search" class="w-full" v-model="searchQuery" placeholder="Search discussions..." />
                    </div>
                    <div>
                        <InputLabel for="topic" value="Topic" class="sr-only"/>
                        <Select id="topic" v-on:change="filterTopic">
                            <option 
                            value="">
                                All topics
                            </option>
                            <option 
                            :value="topic.slug"
                            v-for="topic in $page.props.topics"
                            :key="topic.id"
                            :selected="query.filter?.topic == topic.slug">
                                {{ topic.name }}
                            </option>
                        </Select>
                    </div>
                </div>
            </div>
            <!-- End main header -->
             <!-- List of discussion -->
            <div class="space-y-3" v-if="discussions.data.length">
                <Discussion
                v-for="discussion in discussions.data"
                :key="discussion.id"
                :discussion="discussion"/>
                <Pagination
                class="!mt-6"
                :pagination="discussions.meta"/>
            </div>
            <!-- End list of discussion -->
        </div>
        <!-- End main -->
    </ForumLayout>
</template>
