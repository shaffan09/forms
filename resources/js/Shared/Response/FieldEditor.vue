<script setup lang="ts">
import {Field, FieldValue} from "@/types";
import {reactive} from 'vue'
import InputField from "@/Shared/InputField.vue";

const props = defineProps({
  fields: {type: Array<Field>, require: true},
})

const emits = defineEmits(['onChangeValues'])

const fieldValues: FieldValue[] = reactive([])

for (const field of props.fields!) {
  fieldValues.push({
    id: field.id,
    name: field.name,
    type: field.type,
    options: field.options,
    value: '',
    required: field.require,
    error: undefined,
  })
}

function getFieldValue(id: string): FieldValue {
  return fieldValues.find((fieldValue) => fieldValue.id === id)!
}

// text input handler
function onTextChange(event: Event, field: FieldValue) {
  field.value = (event.target as HTMLInputElement).value
  field.required && field.value === ''
    ? (field.error = true)
    : (field.error = undefined)
  emitChanges()
}

// select input handler
function onSelected(event: Event, field: FieldValue) {
  field.value = (event.target as HTMLInputElement).value
  field.required && field.value === ''
    ? (field.error = true)
    : (field.error = undefined)
  emitChanges()
}

// radio input handler
function onPicked(option: String, field: FieldValue) {
  field.value = option
  field.required && field.value === ''
    ? (field.error = true)
    : (field.error = undefined)
  emitChanges()
}

// checkbox input handler
function onChecked(option: String, field: FieldValue) {
  if (field.value && field.value.includes(option.toString())) {
    field.value = field.value.replace(option + ',', '')
  } else {
    field.value = field.value + `${option},`
  }
  field.required && field.value === ''
    ? (field.error = true)
    : (field.error = undefined)
  emitChanges()
}

function emitChanges() {
  emits('onChangeValues', fieldValues)
}

// emits the initial values
emitChanges()
</script>

<template>
  <InputField v-for="field in fields" :key="field.id.toString()">
    <template #name>
      {{ field.name }} {{ field.require ? '*' : '' }}
    </template>

    <template #description>
      <span class="font-thin text-sm italic block">
        {{ field.description }}
      </span>
    </template>

    <template #input>
      <!-- TEXT INPUT -->
      <input
        v-if="field.type === 'text'"
        @input="onTextChange($event, getFieldValue(String(field.id)))"
        type="text"
        class="input input-bordered w-full"
        :class="field.description ? 'mt-3' : ''"
        :required="field.require"/>
      <!-- TEXT INPUT -->

      <!-- SELECT INPUT -->
      <select
        v-if="field.type === 'select'"
        @change="onSelected($event, getFieldValue(String(field.id)))"
        class="select select-bordered w-full max-w-xs"
        :class="field.description ? 'mt-3' : ''">
        <option></option>
        <option
          v-for="option in field.options"
          :key="option.id.toString()"
          :value="option.option">
          {{ option.option }}
        </option>
      </select>
      <!-- SELECT INPUT -->

      <!-- RADIO INPUT -->
      <label
        v-if="field.type === 'radio'"
        v-for="option in field.options"
        :key="option.id.toString()"
        class="label justify-start"
        :class="field.description ? 'mt-3' : ''">
        <input
          @change="onPicked(option.option, getFieldValue(String(field.id)))"
          type="radio"
          class="radio mr-3"
          :name="field.id.toString()"/>
        <span class="label-text">{{ option.option }}</span>
      </label>
      <!-- RADIO INPUT -->

      <!-- CHECKBOX INPUT -->
      <label
        v-if="field.type === 'checkbox'"
        v-for="option in field.options"
        :key="option.id.toString()"
        class="label justify-start"
        :class="field.description ? 'mt-3' : ''">
        <input
          @change="onChecked(option.option, getFieldValue(String(field.id)))"
          type="checkbox"
          class="checkbox mr-3"/>
        <span class="label-text">{{ option.option }}</span>
      </label>
      <!-- CHECKBOX INPUT -->
    </template>

    <template #error>
      {{
        getFieldValue(String(field.id)).error
          ? 'This field cannot be empty'
          : ''
      }}
    </template>
  </InputField>
</template>

<style scoped>

</style>
