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
  <header class="text-lg font-bold body-font header_text">
    <div class="container mx-auto flex flex-wrap flex-col md:flex-row items-center">
      <NavLink href="/" :active="route().current('/')">
        <ApplicationLogo class="block w-20" />
      </NavLink>
      <nav class="md:ml-auto flex flex-wrap items-center text-base justify-center">
        <Link :href="route('posts')" class=" mr-5 hover:underline">投稿一覧</Link>
        <Link :href="route('profile')" class="mr-5 hover:underline">マイページ</Link>
        <!-- ログイン -->
        <Link v-if="$page.props.auth.user" :href="route('logout')" method="post" as="button" class="mr-5 hover:underline">ログアウト
        </Link>
        <!-- 未ログイン -->
        <div v-else>
          <Link :href="route('login')" class="mr-5 hover:underline">ログイン</Link>
          <Link :href="route('register')" class="mr-5 hover:underline">新規登録</Link>
        </div>
      </nav>
    </div>
  </header>
</template>
