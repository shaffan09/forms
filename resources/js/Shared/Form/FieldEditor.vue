<script setup lang="ts">
import {Option, Field} from "@/types";
import {ref, watch} from 'vue'
import {v4 as uuidv4} from 'uuid'
import Trash from "@/Shared/Icons/Trash.vue";
import Plus from "@/Shared/Icons/Plus.vue";
import InputField from "@/Shared/InputField.vue";
import OptionEditor from "@/Shared/Form/OptionEditor.vue";

const {fieldsArray} = defineProps<{ fieldsArray: Field[] }>()
const emits = defineEmits(['onChangeFields'])

const fields = ref<Field[]>(
  fieldsArray.length ? fieldsArray : [getEmptyField()]
)

function getEmptyField(): Field {
  return {
    id: uuidv4(),
    name: '',
    description: undefined,
    require: true,
    type: 'text',
    options: undefined,
    error: undefined,
  }
}

function addField() {
  fields.value.push(getEmptyField())
  emitChanges()
}

function deleteField(id: String) {
  const index: number = fields.value.findIndex((field) => field.id === id)
  fields.value.splice(index, 1)
}

function onChangeOptions(options: Option[], fieldId: String) {
  fields.value = fields.value.filter((field) => {
    if (field.id === fieldId) {
      field.options = options
    }
    return field
  })
}

function showOptionsEditor(type: String) {
  return type !== 'text'
}

function onInputTypeSelect(field: Field) {
  if (field.type === 'text') {
    field.options = undefined
  }
}

function onNameInput(field: Field) {
  field.name === '' ? (field.error = true) : (field.error = false)
}

function emitChanges() {
  emits('onChangeFields', fields.value)
}

// emits the fields array when fields are edited
watch(fields.value, emitChanges)

// to emit the initial values on load
emitChanges()
</script>

<template>
  <div>
    <div
      v-if="fields.length"
      v-for="field in fields"
      :key="field.id.toString()"
      class="border p-4 mb-4 rounded-md">
      <!-- FIELD NAME & DELETE BUTTON -->
      <div class="flex justify-between">
        <p class="text-xl font-semibold">{{ field.name }}</p>
        <button
          @click.prevent="deleteField(field.id)"
          class="btn btn-sm btn-error btn-circle">
          <Trash/>
        </button>
      </div>
      <!-- FIELD NAME & DELETE BUTTON -->

      <!-- FIELD EDITOR -->
      <div class="md:flex justify-between items-start">
        <!-- FIELD NAME INPUT -->
        <InputField class="md:mr-4">
          <template #name>Field Name *</template>
          <template #input>
            <input
              @input="onNameInput(field)"
              v-model="field.name"
              type="text"
              class="input input-bordered w-full"
            />
          </template>
          <template #error>
            {{ field.error ? 'Field name cannot be empty!' : '' }}
          </template>
        </InputField>
        <!-- FIELD NAME INPUT -->

        <!-- FIELD INPUT TYPE -->
        <InputField class="md:text-right">
          <template #name>Input Type *</template>
          <template #input>
            <select
              @change="onInputTypeSelect(field)"
              v-model="field.type"
              class="select select-bordered w-full max-w-xs">
              <option value="text">Text</option>
              <option value="checkbox">Checkbox</option>
              <option value="radio">Radio</option>
              <option value="select">Select</option>
            </select>
          </template>
        </InputField>
        <!-- FIELD INPUT TYPE -->
      </div>

      <div class="form-control w-full mb-4">
        <InputField>
          <template #name>Require *</template>
          <template #input>
            <input v-model="field.require" type="checkbox" class="checkbox"/>
          </template>
        </InputField>
      </div>

      <!-- FIELD DESCRIPTION INPUT -->
      <InputField>
        <template #name> Field Description</template>
        <template #input>
            <textarea
              v-model="field.description"
              type="text"
              class="textarea textarea-bordered w-full"></textarea>
        </template>
      </InputField>
      <!-- FIELD DESCRIPTION INPUT -->

      <!-- OPTIONS EDITOR -->
      <OptionEditor
        v-if="showOptionsEditor(field.type)"
        @onChangeOptions="onChangeOptions"
        :options-array="field.options ?? null"
        :fieldId="field.id.toString()"/>
      <!-- OPTIONS EDITOR -->
    </div>
    <!-- FIELD EDITOR -->

    <p v-else class="text-center mt-4 text-error text-sm">
      Fields cannot be empty!
    </p>

    <!-- ADD FIELD BUTTON -->
    <div class="w-full text-right">
      <button @click.prevent="addField" class="btn btn-accent btn-sm gap-2">
        <Plus/>
        Add Field
      </button>
    </div>
    <!-- ADD FIELD BUTTON -->
  </div>
</template>

<style scoped></style>
