<template>
    <AdminLayout>
        <div class="py-4 mx-auto max-w-screen-xl lg:py-5 lg:px-6">
            <div class="mx-auto max-w-screen-sm text-center mb-2 lg:mb-2">
                <h2 class="mb-4 text-6xl text-blue-600 tracking-tight font-extrabold text-blue-800 dark:text-white">
                    Dashboard
                </h2>
                <p class="font-light text-gray-500 font-extrabold lg:mb-16 sm:text-xl dark:text-gray-400">
                    Please choose your desired transaction from the options below. You can manage orders, products,
                    reports, and clients.
                </p>
            </div>
            <div class="grid gap-8 mb-6 lg:mb-16 md:grid-cols-2">
                <a href="#"
                    class="rounded-lg flex flex-col items-center bg-neutral-primary-soft p-6 border border-gray-200 
                    shadow-lg md:flex-row md:max-w-xl md:flex-row md:max-w-xl
                    hover:shadow-2xl hover:shadow-blue-500/50 hover:border-blue-500transition-all duration-300">
                    <img class="object-cover w-full rounded-lg h-64 md:h-auto md:w-48 mb-4 md:mb-0 border border-gray-300"
                        src="../../../../public/orders_image.jpg" alt="">
                    <div class="flex flex-col justify-between md:p-4 leading-normal">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-blue-800 dark:text-white">
                            Orders Management
                        </h5>
                        <p class="mb-6 text-gray-500 dark:text-gray-400">
                            Create, update, and manage customer orders efficiently.
                        </p>
                        <div>
                            <button type="button"
                                class="inline-flex items-center w-auto text-body bg-neutral-secondary-medium box-border border 
                                border-default-medium hover:bg-neutral-tertiary-medium hover:text-heading focus:ring-4 
                                focus:ring-neutral-tertiary shadow-xs font-medium leading-5 rounded-base 
                                text-sm px-4 py-2.5 focus:outline-none rounded-lg transition-all duration-300
                                hover:shadow-lg hover:shadow-blue-500/50 hover:border-blue-500 hover:bg-blue-500 hover:text-white">
                                Go to Orders
                                <svg class="w-4 h-4 ms-1.5 rtl:rotate-180 -me-0.5" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                    viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M19 12H5m14 0-4 4m4-4-4-4" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </a>
                <a href="#"
                    class="rounded-lg flex flex-col items-center bg-neutral-primary-soft p-6 border border-gray-200 
                    shadow-lg md:flex-row md:max-w-xl md:flex-row md:max-w-xl
                    hover:shadow-2xl hover:shadow-blue-500/50 hover:border-blue-500transition-all duration-300">
                    <img class="object-cover w-full rounded-lg h-64 md:h-auto md:w-48 mb-4 md:mb-0 border border-gray-300"
                        src="../../../../public/inventory_image.jpg" alt="">
                    <div class="flex flex-col justify-between md:p-4 leading-normal">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-blue-800 dark:text-white">
                            Inventory Management
                        </h5>
                        <p class="mb-6 text-gray-500 dark:text-gray-400">
                            Track and manage your inventory levels, monitor stock movements.
                        </p>
                        <div>
                            <button type="button"
                                class="inline-flex items-center w-auto text-body bg-neutral-secondary-medium box-border border 
                                border-default-medium hover:bg-neutral-tertiary-medium hover:text-heading focus:ring-4 
                                focus:ring-neutral-tertiary shadow-xs font-medium leading-5 rounded-base 
                                text-sm px-4 py-2.5 focus:outline-none rounded-lg transition-all duration-300
                                hover:shadow-lg hover:shadow-blue-500/50 hover:border-blue-500 hover:bg-blue-500 hover:text-white">
                                Go to Orders
                                <svg class="w-4 h-4 ms-1.5 rtl:rotate-180 -me-0.5" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                    viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M19 12H5m14 0-4 4m4-4-4-4" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </a>
                <a href="#"
                    class="rounded-lg flex flex-col items-center bg-neutral-primary-soft p-6 border border-gray-200 
                    shadow-lg md:flex-row md:max-w-xl md:flex-row md:max-w-xl
                    hover:shadow-2xl hover:shadow-blue-500/50 hover:border-blue-500transition-all duration-300">
                    <img class="object-cover w-full rounded-lg h-64 md:h-auto md:w-48 mb-4 md:mb-0 border border-gray-300"
                        src="../../../../public/products_image.jpg" alt="">
                    <div class="flex flex-col justify-between md:p-4 leading-normal">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-blue-800 dark:text-white">
                            Products Management
                        </h5>
                        <p class="mb-6 text-gray-500 dark:text-gray-400">
                            Manage your product catalog, including adding new products, updating existing ones.
                        </p>
                        <div>
                            <button type="button"
                                class="inline-flex items-center w-auto text-body bg-neutral-secondary-medium box-border border 
                                border-default-medium hover:bg-neutral-tertiary-medium hover:text-heading focus:ring-4 
                                focus:ring-neutral-tertiary shadow-xs font-medium leading-5 rounded-base 
                                text-sm px-4 py-2.5 focus:outline-none rounded-lg transition-all duration-300
                                hover:shadow-lg hover:shadow-blue-500/50 hover:border-blue-500 hover:bg-blue-500 hover:text-white">
                                Go to Orders
                                <svg class="w-4 h-4 ms-1.5 rtl:rotate-180 -me-0.5" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                    viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M19 12H5m14 0-4 4m4-4-4-4" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </a>
                <a href="#"
                    class="rounded-lg flex flex-col items-center bg-neutral-primary-soft p-6 border border-gray-200 
                    shadow-lg md:flex-row md:max-w-xl md:flex-row md:max-w-xl
                    hover:shadow-2xl hover:shadow-blue-500/50 hover:border-blue-500transition-all duration-300">
                    <img class="object-cover w-full rounded-lg h-64 md:h-auto md:w-48 mb-4 md:mb-0 border border-gray-300"
                        src="../../../../public/products_image.jpg" alt="">
                    <div class="flex flex-col justify-between md:p-4 leading-normal">
                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-blue-800 dark:text-white">
                            Clients Management
                        </h5>
                        <p class="mb-6 text-gray-500 dark:text-gray-400">
                            Manage your client database, including adding new clients, updating existing ones.
                        </p>
                        <div>
                            <button type="button"
                                class="inline-flex items-center w-auto text-body bg-neutral-secondary-medium box-border border 
                                border-default-medium hover:bg-neutral-tertiary-medium hover:text-heading focus:ring-4 
                                focus:ring-neutral-tertiary shadow-xs font-medium leading-5 rounded-base 
                                text-sm px-4 py-2.5 focus:outline-none rounded-lg transition-all duration-300
                                hover:shadow-lg hover:shadow-blue-500/50 hover:border-blue-500 hover:bg-blue-500 hover:text-white">
                                Go to Orders
                                <svg class="w-4 h-4 ms-1.5 rtl:rotate-180 -me-0.5" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                    viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M19 12H5m14 0-4 4m4-4-4-4" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </AdminLayout>
</template>

<script setup>
import { router, usePage } from '@inertiajs/vue3';
import { ref, onMounted } from 'vue';
import { initFlowbite } from 'flowbite';
import AdminLayout from './Components/AdminLayout.vue';
import { Link } from '@inertiajs/vue3';

const page = usePage();
const props = defineProps({});

onMounted(() => {
    initFlowbite();
})
</script>
