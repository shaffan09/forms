<script setup lang="ts">
import {Head} from "@inertiajs/vue3";
import Editor from "@/Shared/Form/FormEditor.vue";
</script>

<template>
  <Head>
    <title>Create Form</title>
  </Head>

  <h1 class="font-bold text-3xl">Create Form</h1>

  <Editor :form="null" />
</template>

<style scoped>

</style>
