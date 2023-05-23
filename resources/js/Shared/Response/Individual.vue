<script setup lang="ts">
import {Response} from "@/types";
import {ref} from "vue";
import ChevronLeft from "@/Shared/Icons/ChevronLeft.vue";
import ChevronRight from "@/Shared/Icons/ChevronRight.vue";
import InputField from "@/Shared/InputField.vue";

const {responses} = defineProps<{ responses: Response[] }>()

let index = ref<number>(1)

function incrementIndex() {
  if (index.value !== responses.length) {
    index.value = Number(index.value) + 1
  }
}

function decrementIndex() {
  if (index.value !== 1) {
    index.value = Number(index.value) - 1
  }
}
</script>

<template>
  <!--Form Navigator-->
  <div class="flex items-center border-b pb-4">
    <button
      @click="decrementIndex"
      class="btn btn-outline btn-sm btn-circle mr-2">
      <ChevronLeft/>
    </button>

    <div class="mx-3">
      <input
        v-model="index"
        type="number"
        class="input input-bordered w-[100px]"/>
      of
      {{ responses.length }}
    </div>

    <button
      @click="incrementIndex"
      class="btn btn-outline btn-sm btn-circle mr-2">
      <ChevronRight/>
    </button>
  </div>
  <!--Form Navigator-->

  <!--Displaying response with disabled fields-->
  <InputField v-if="index > 0 && index <= responses.length" v-for="field in responses[index-1].field_values">
    <template #name>{{ field.name }}</template>
    <template #input>
      <!-- TEXT INPUT -->
      <input
        :value="field.value"
        v-if="field.type === 'text'"
        type="text"
        class="input input-bordered w-full"
        disabled/>
      <!-- TEXT INPUT -->

      <!-- SELECT INPUT -->
      <select
        v-if="field.type === 'select'"
        class="select select-bordered w-full max-w-xs"
        disabled>
        <option>
          {{ field.value }}
        </option>
      </select>
      <!-- SELECT INPUT -->

      <!-- RADIO INPUT -->
      <label
        v-if="field.type === 'radio'"
        v-for="option in field.options"
        :key="option.id.toString()"
        class="label justify-start">
        <input
          :checked="field.value === option.option"
          disabled
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
        class="label justify-start">
        <input
          type="checkbox"
          class="checkbox mr-3"
          disabled
          :checked="field.value.includes(String(option.option))"/>
        <span class="label-text">{{ option.option }}</span>
      </label>
      <!-- CHECKBOX INPUT -->
    </template>
  </InputField>
  <!--Displaying response with disabled fields-->

  <div v-else class="text-center my-7">
    <span class="text-error">
      Invalid form index!
    </span>
  </div>
</template>

<style scoped>

</style>
