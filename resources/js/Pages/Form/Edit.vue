<script setup lang="ts">
import {Head} from "@inertiajs/vue3";
import Editor from "@/Shared/Form/FormEditor.vue";
import {Form} from "@/types";

const {form} = defineProps<{form: Form}>()

// set error to undefined
form.fields.forEach((field) => {
  field.error = false
  field.options?.forEach((option) => {
    option.error = false
  })
})
</script>

<template>
  <Head>
    <title>Edit Form</title>
  </Head>

  <h1 class="font-bold text-3xl">Edit Form</h1>

  <Editor :form="form" />
</template>

<style scoped>

</style>
