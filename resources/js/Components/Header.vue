<script setup>
import { ref } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { Link, Head } from '@inertiajs/vue3';
import { Inertia } from '@inertiajs/inertia';

defineProps({
  authProps: Array
})
</script>

<template>
  <Head title="top画面" />
  <header class="bg-green-300 text-white text-lg font-bold body-font">
    <div class="container mx-auto flex flex-wrap flex-col md:flex-row items-center">
      <NavLink href="/" :active="route().current('/')">
        <ApplicationLogo class="block w-20" />
      </NavLink>
      <nav class="md:ml-auto flex flex-wrap items-center text-base justify-center">
        <Link :href="route('profile')" class="mr-5 hover:text-gray-900">Profile</Link>
        <Link class="mr-5 hover:text-gray-900">Second Link</Link>
        <Link class="mr-5 hover:text-gray-900">Third Link</Link>
        <Link class="mr-5 hover:text-gray-900">Fourth Link</Link>
      </nav>
      <div v-if="authProps.canLogin">
        <!-- ログイン -->
        <Link v-if="$page.props.auth.user" :href="route('logout')" method="post" as="button" class="mr-5 hover:text-gray-900">Log out
        </Link>
        <!-- 未ログイン -->
        <template v-else>
          <Link :href="route('login')" class="mr-5 hover:text-gray-900">Log in</Link>
          <Link v-if="authProps.canRegister" :href="route('register')" class="mr-5 hover:text-gray-900">Register</Link>
        </template>
      </div>
    </div>
  </header>
</template>
