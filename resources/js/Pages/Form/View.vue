<script setup lang="ts">
import {FieldValue, Form} from "@/types";
import FieldEditor from "@/Shared/Response/FieldEditor.vue";
import {useForm} from "@inertiajs/vue3";

const {form} = defineProps<{ form: Form }>()

let responseForm = useForm<{
  field_values: FieldValue[]
}>({
  field_values: []
})

function onChangeValues(values: FieldValue[]) {
  responseForm.field_values = values
}

function hasError(): boolean {
  let hasError = false

  responseForm.field_values.forEach(field => {
    if (field.error) hasError = true

    if (field.required && field.value === '') {
      hasError = true
      field.error = true
    }
  })

  return hasError
}

function submit() {
  if (hasError()) return

  // remove error attribute
  responseForm.field_values.forEach((field) => {
    field.error = undefined;
  })

  responseForm.post(`/forms/${form.id}/response`)
}
</script>

<template>
  <h1 class="font-bold text-3xl">{{ form.title }}</h1>

  <p v-if="form.description" class="font-light mt-4">{{form.description}}</p>

  <div class="mt-7">
    <form method="POST" action="/" @submit.prevent="submit">
      <FieldEditor :fields="form.fields" @on-change-values="onChangeValues"/>

      <div class="text-right">
        <button class="btn btn-accent mt-4" type="submit">Submit</button>
      </div>
    </form>
  </div>
</template>

<style scoped>

</style>
