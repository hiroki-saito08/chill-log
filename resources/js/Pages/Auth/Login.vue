<script setup>
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { usePage } from "@inertiajs/inertia-vue3";
import { Inertia } from '@inertiajs/inertia'

defineProps({
    canResetPassword: Boolean,
    status: String,
})

const page = usePage()
const urlPrev = page.props.value.urlPrev
const form = useForm({
    email: '',
    password: '',
    remember: false,
})

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    })
}

const back = () => {
    if (urlPrev !== 'empty') {
        Inertia.visit(urlPrev)
    } else {
        Inertia.visit('/')
    }
}
</script>

<template>
    <GuestLayout>
        <Head title="Log in" />

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>

        <form @submit.prevent="submit">
            <div>
                <InputLabel for="email" value="Email" />

                <TextInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required autofocus autocomplete="username" />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-4">
                <InputLabel for="password" value="Password" />

                <TextInput id="password" type="password" class="mt-1 block w-full" v-model="form.password" required autocomplete="current-password" />

                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="block mt-4">
                <label class="flex items-center">
                    <Checkbox name="remember" v-model:checked="form.remember" />
                    <span class="ml-2 text-sm text-gray-600">ログイン情報を記録</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                <div class="">
                    <Link v-if="canResetPassword" :href="route('password.request')" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    パスワードを忘れた
                    </Link>
                    <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        ログイン
                    </PrimaryButton>
                </div>
            </div>
        </form>
        <div>
            <button @click="back" class="mr-10 text-gray-600 hover:text-gray-900">戻る</button>
            <a :href="route('register')" class="mr-10 text-gray-600 hover:text-gray-900" :urlPrev=urlPrev target="_blank">新規登録はこちら</a>
        </div>
    </GuestLayout>
</template>
