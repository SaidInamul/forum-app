<script setup>
    import Svg from '../Svg.vue';
</script>

<template>
    <markdown-toolbar class="flex items-center">
        <md-bold class="cursor-pointer py-1.5 px-1">
            <Svg name="icon_bold" class="h-5 w-5"></Svg>
        </md-bold>
        <md-italic class="cursor-pointer py-1.5 px-1">
            <Svg name="icon_italic" class="h-5 w-5"></Svg>
        </md-italic>
        <md-code class="cursor-pointer py-1.5 px-1">
            <Svg name="icon_code" class="h-5 w-5"></Svg>
        </md-code>
        <md-link class="cursor-pointer py-1.5 px-1">
            <Svg name="icon_link" class="h-5 w-5"></Svg>
        </md-link>
        <md-mention class="cursor-pointer py-1.5 px-1">
            <Svg name="icon_at" class="h-5 w-5"></Svg>
        </md-mention>
    </markdown-toolbar>
</template>