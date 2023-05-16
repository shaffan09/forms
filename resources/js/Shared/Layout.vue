<script setup lang="ts">
import {Link} from "@inertiajs/vue3";

const {user} = defineProps<{
  user: {name: string}
}>()
</script>

<template>
  <nav>
    <div class="navbar bg-base-100 shadow-md">
      <div class="navbar-start">
        <div class="dropdown">
          <label tabindex="0" class="btn btn-ghost lg:hidden">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                 stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h8m-8 6h16"/>
            </svg>
          </label>
          <ul tabindex="0" class="menu menu-compact dropdown-content mt-3 p-2 shadow bg-base-100 rounded-box w-52">
            <li>
              <Link>Home</Link>
            </li>
            <li>
              <Link>Dashboard</Link>
            </li>
          </ul>
        </div>
        <a class="btn btn-ghost normal-case text-xl text-primary">Forms</a>
      </div>
      <div class="navbar-center hidden lg:flex">
        <ul class="menu menu-horizontal px-1">
          <li>
            <Link>Home</Link>
          </li>
          <li>
            <Link>Dashboard</Link>
          </li>
        </ul>
      </div>
      <div class="navbar-end">
        <Link href="/logout" method="POST" class="btn btn-primary">Logout</Link>
      </div>
    </div>
  </nav>

  <main class="p-7">
    <section>
      <span class="text-3xl text-primary font-bold">Welcome Back {{user.name}}</span>
    </section>

    <section class="mt-4">
      <slot></slot>
    </section>
  </main>
</template>

<style scoped>

</style>
