<script setup lang="ts">
import {Form, Field} from "@/types";
import InputField from "@/Shared/InputField.vue";
import FieldEditor from "@/Shared/Form/FieldEditor.vue";
import {useForm} from "@inertiajs/vue3";

const {form} = defineProps<{ form: Form | null }>()

const formData = useForm<Form>({
  id: form?.id ?? null,
  title: form?.title ?? '',
  description: form?.description ?? undefined,
  created_at: form?.created_at ?? null,
  exp_date: form?.exp_date ?? null,
  is_active: form?.is_active ?? true,
  fields: form?.fields ?? [],
  error: undefined,
})

function onChangeFields(fields: Field[]) {
  formData.fields = fields
}

function onTitleInput() {
  formData.title === '' ? (formData.error = true) : (formData.error = false)
}

function validate(form: Form): Boolean {
  if (!form.fields.length) {
    return false
  }

  let hasFieldsError: boolean = false
  let hasOptionsError: boolean = false

  for (const field of form.fields) {
    if (field.error === undefined || field.error) {
      field.error = true
      hasFieldsError = true
    }
  }

  for (const field of form.fields) {
    if (field.options?.length === 0) hasOptionsError = true

    if (field.options !== undefined) {
      for (const option of field.options) {
        if (option.error === undefined || option.error) {
          option.error = true
          hasOptionsError = true
        }
      }
    }
  }

  return !(hasFieldsError || hasOptionsError);
}

function submit() {
  const valid = validate(formData)

  if (!valid) return

  // set error to undefined
  formData.fields.forEach((field) => {
    field.error = undefined
    field.options?.forEach((option) => {
      option.error = undefined
    })
  })

  if (form === null) formData.post('/my/forms/create')

  if (form !== null) formData.post(`/my/forms/${form.id}/edit`)
}
</script>

<template>
  <form @submit.prevent="submit" action="/" method="post">
    <section class="mt-7 p-7 rounded-md shadow-lg">
      <!--Title-->
      <InputField>
        <template #name>Title *</template>
        <template #input>
          <input
            @input="onTitleInput"
            v-model="formData.title"
            name="title" type="text"
            class="input input-bordered w-full"
            required
          />
        </template>
        <template #error>{{ formData.error ? 'Title must not be empty!' : '' }}</template>
      </InputField>
      <!--Title-->

      <!--Description-->
      <InputField>
        <template #name>Description</template>
        <template #input>
          <textarea
            v-model="formData.description"
            type="text"
            name="description"
            class="textarea textarea-bordered">
            {{formData.description}}
          </textarea>
        </template>
      </InputField>
      <!--Description-->

      <!--Exp date & is active-->
      <div class="mb-4 md:flex justify-start items-center">
        <InputField>
          <template #name>Expiry Date</template>
          <template #input>
            <input v-model="formData.exp_date" name="exp_date" type="datetime-local"
                   class="input input-bordered w-full max-w-xs"/>
          </template>
        </InputField>

        <InputField>
          <template #name>Active</template>
          <template #input>
            <input
              v-model="formData.is_active"
              name="is_active"
              type="checkbox"
              class="checkbox"
            />
          </template>
        </InputField>
      </div>
      <!--Exp date & is active-->

      <InputField>
        <template #name>Fields *</template>
        <template #input>
          <FieldEditor @on-change-fields="onChangeFields" :fields-array="formData.fields"/>
        </template>
      </InputField>

      <!-- SUBMIT BUTTON -->
      <div class="mt-5 w-full text-right">
        <button
          v-show="!formData.processing"
          @click="submit"
          class="btn btn-primary">
          {{ form ? 'Update' : 'Create' }}
        </button>
        <button
          v-show="formData.processing"
          class="btn btn-square btn-primary loading"></button>
      </div>
      <!-- SUBMIT BUTTON -->
    </section>
  </form>
</template>

<style scoped>

</style>
