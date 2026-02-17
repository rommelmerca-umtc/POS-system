<template>
    <section class="bg-gray-50 dark:bg-gray-900">
        <div class="flex items-center max-md:flex-col gap-6">
            <form class="max-w-lg w-full p-6 mx-auto" @submit.prevent="submit">
                <div class="mb-12">
                    <h1 class="text-blue-900 text-6xl font-bold">Sign In</h1>
                    <p class="text-slate-600 text-md mt-6 leading-relaxed">
                        Welcome back! Please log in to access
                        your account.
                    </p>
                </div>

                <div class="space-y-3">
                    <div class="relative flex items-center">
                        <label
                            class="rounded text-white text-[13px] bg-blue-900 absolute px-2 top-[-9px] left-[18px] font-medium">Email</label>
                        <input type="email" name="email" id="email" v-model="form.email" required autofocus
                            placeholder="Enter email"
                            class="px-4 py-3.5 mb-4 bg-white w-full text-blue-900 text-lg border border-blue-100 shadow-lg shadow-blue-200 focus:border-blue-600 rounded-md outline-none" />

                        <svg xmlns="http://www.w3.org/2000/svg" fill="#bbb" stroke="#bbb"
                            class="w-[18px] h-[18px] absolute right-4" viewBox="0 0 682.667 682.667">
                            <defs>
                                <clipPath id="a" clipPathUnits="userSpaceOnUse">
                                    <path d="M0 512h512V0H0Z" data-original="#000000"></path>
                                </clipPath>
                            </defs>
                            <g clip-path="url(#a)" transform="matrix(1.33 0 0 -1.33 0 682.667)">
                                <path fill="none" stroke-miterlimit="10" stroke-width="40"
                                    d="M452 444H60c-22.091 0-40-17.909-40-40v-39.446l212.127-157.782c14.17-10.54 33.576-10.54 47.746 0L492 364.554V404c0 22.091-17.909 40-40 40Z"
                                    data-original="#000000"></path>
                                <path
                                    d="M472 274.9V107.999c0-11.027-8.972-20-20-20H60c-11.028 0-20 8.973-20 20V274.9L0 304.652V107.999c0-33.084 26.916-60 60-60h392c33.084 0 60 26.916 60 60v196.653Z"
                                    data-original="#000000"></path>
                            </g>
                        </svg>
                    </div>
                    <InputError :message="form.errors.email" />

                    <div class="relative flex items-center">
                        <label
                            class="rounded text-white text-[13px] bg-blue-900 absolute px-2 top-[-9px] left-[18px] font-medium">Password</label>
                        <input :type="showPassword ? 'text' : 'password'" name="password" id="password"
                            placeholder="••••••••" v-model="form.password" required
                            class="px-4 py-3.5 bg-white w-full text-blue-900 text-lg border border-blue-200 shadow-lg shadow-blue-200 focus:border-blue-600 rounded-md outline-none" />
                        <!-- Show Password Button -->
                        <button type="button" @click="togglePassword"
                            class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm text-gray-400 dark:text-gray-300">
                            <span v-if="!showPassword">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>
                            </span>
                            <span v-else>
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                                </svg>
                            </span>
                        </button>
                    </div>
                    <InputError class="mt-2" :message="form.errors.password" />

                    <div class="flex flex-wrap items-center justify-between gap-4">
                        <div>
                            <Link v-if="props.canResetPassword" :href="route('password.request')"
                                class="text-blue-800 font-medium text-sm hover:underline">
                                Forgot Password?
                            </Link>
                        </div>
                    </div>
                </div>

                <div class="mt-5">
                    <button type="submit" :class="{ 'opacity-25': form.processing }" :disabled="form.processing"
                        class="transition-all w-full shadow-xl shadow-blue-200 py-2.5 px-4 text-[15px] tracking-wider font-medium rounded-md text-white bg-blue-800 hover:bg-blue-700 focus:outline-none cursor-pointer">
                        Sign in
                    </button>
                </div>
            </form>

            <div class="w-full md:max-w-96">
                <div class="flex flex-col justify-center space-y-16 md:h-screen min-h-full lg:px-8 px-4 py-4"
                    style="background-image: url('https://images.pexels.com/photos/5727002/pexels-photo-5727002.jpeg'); background-size: cover; background-position: center;">
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';
import { ref } from 'vue';
import { usePage } from '@inertiajs/vue3';

const page = usePage();
console.log(page.props);

const props = defineProps({
    canResetPassword: Boolean,
    status: String,
});

console.log('canResetPassword:', props.canResetPassword);

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const showPassword = ref(false);

const togglePassword = () => {
    showPassword.value = !showPassword.value;
};

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>
