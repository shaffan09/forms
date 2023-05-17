<script setup lang="ts">
import {Option} from "@/types";
import {ref, watch} from 'vue'
import {v4 as uuidv4} from 'uuid'
import Trash from "@/Shared/Icons/Trash.vue";
import Plus from "@/Shared/Icons/Plus.vue";

const {fieldId, optionsArray} = defineProps<{
  fieldId: String
  optionsArray: Option[] | null
}>()
const emits = defineEmits(['onChangeOptions'])
const options = ref<Option[]>(optionsArray ?? [getEmptyOption()])

function getEmptyOption() {
  return {id: uuidv4(), option: '', error: undefined}
}

function addOption() {
  options.value.push(getEmptyOption())
  emitChanges()
}

function deleteOption(id: String) {
  const index: number = options.value.findIndex((option) => option.id === id)
  options.value.splice(index, 1)
}

function onOptionInput(option: Option) {
  option.option === '' ? (option.error = true) : (option.error = false)
}

function emitChanges() {
  emits('onChangeOptions', options.value, fieldId)
}

watch(options.value, emitChanges)

// to emit initial values on load
emitChanges()
</script>

<template>
  <div class="flex justify-between items-center w-full">
    <div>
      <label class="label">
        <span class="label-text font-semibold">Options *</span>
      </label>
    </div>
    <div>
      <button @click.prevent="addOption" class="btn btn-accent btn-xs gap-2">
        <Plus />
        Add Option
      </button>
    </div>
  </div>

  <div v-if="options.length">
    <div v-for="option in options" :key="option.id.toString()">
      <div class="mt-4 flex items-center justify-between">
        <input
          @input="onOptionInput(option)"
          v-model="option.option"
          placeholder="Type option here..."
          class="input input-bordered w-[95%] mr-2 lg:mr-0"
          type="text"/>
        <button
          @click.prevent="deleteOption(option.id)"
          class="btn btn-sm btn-error btn-circle">
          <Trash />
        </button>
      </div>
      <div class="text-error text-xs mt-2">
        {{ option.error ? 'Option cannot be empty' : '' }}
      </div>
    </div>
  </div>

  <div v-else>
    <p class="text-center mt-4 text-error text-sm">Options cannot be empty!</p>
  </div>
</template>

<style scoped>

</style>
