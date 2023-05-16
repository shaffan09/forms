<script setup lang="ts">
import {Link} from "@inertiajs/vue3";
</script>

<template>
  <nav>
    <div class="navbar bg-base-100 shadow-md">
      <div class="flex-1">
        <Link href="/" class="btn btn-ghost normal-case text-xl text-primary">Forms</Link>
      </div>
      <div class="flex-none">
        <ul class="menu menu-horizontal px-1">
          <li>
            <Link href="/signup" class="btn btn-primary text-primary-content mr-2">Sign up</Link>
          </li>
          <li>
            <Link href="/login" class="btn btn-primary btn-outline">Login</Link>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <main class="grid place-items-center min-h-screen">
    <slot></slot>
  </main>
</template>

<style scoped>

</style>
