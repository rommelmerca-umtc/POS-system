<template>
    <section class="bg-gray-50 dark:bg-gray-900 h-full p-3 sm:p-5 overflow-y-auto">
        <div
            class="rounded-lg flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4 bg-white border border-gray-100 shadow-sm">
            <div
                class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
                <h6 class="mr-11 text-xl font-extrabold text-emerald-700 dark:text-white">
                    Products
                </h6>
            </div>
            <div
                class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
                <div class="w-full md:w-2/2">
                    <form class="flex items-center" @submit.prevent="handleSearch" :disabled="isLoading">
                        <label for="simple-search" class="sr-only">
                            {{ isLoading ? 'Disabled...' : 'Search' }}
                        </label>
                        <div class="relative w-full">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400"
                                    fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input type="text" id="simple-search" v-model="searchQuery"
                                class="bg-gray-50 border border-emerald-700 text-gray-900 text-sm rounded-lg focus:ring-emerald-500 focus:border-emerald-500 block w-full pl-10 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-emerald-500 dark:focus:border-emerald-500"
                                placeholder="Search" />
                        </div>
                    </form>
                </div>
                <button type="button" :disabled="isLoading" @click="refreshProductsData"
                    class="flex items-center justify-center space-x-2 text-white bg-emerald-700 hover:bg-emerald-600 focus:ring-4 focus:ring-emerald-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-emerald-600 dark:hover:bg-emerald-500 focus:outline-none dark:focus:ring-emerald-800">
                    <span class="text-md">{{ isLoading ? 'Disabled...' : 'Refresh' }}</span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-4">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" />
                    </svg>
                </button>
            </div>
        </div>
        <div v-if="products.length > 0"
            class="mt-6 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-11 items-center">
            <div v-for="product in products" :key="product.id"
                class=" max-w-md  group relative dark:bg-white dark:border-white rounded-md bg-white border border-gray-100 shadow-sm">
                <img :src="product.product_image"
                    alt="product_default_image"
                    style="height: 150px; width: 100%; object-fit: cover; object-position: center; margin-bottom: 1rem; border-radius: 3%;" />

               <div class="px-5 pb-5">
                    <div class="flex items-center gap-2 mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M13.5 21v-7.5a.75.75 0 0 1 .75-.75h3a.75.75 0 0 1 .75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349M3.75 21V9.349m0 0a3.001 3.001 0 0 0 3.75-.615A2.993 2.993 0 0 0 9.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 0 0 2.25 1.016c.896 0 1.7-.393 2.25-1.015a3.001 3.001 0 0 0 3.75.614m-16.5 0a3.004 3.004 0 0 1-.621-4.72l1.189-1.19A1.5 1.5 0 0 1 5.378 3h13.243a1.5 1.5 0 0 1 1.06.44l1.19 1.189a3 3 0 0 1-.621 4.72M6.75 18h3.75a.75.75 0 0 0 .75-.75V13.5a.75.75 0 0 0-.75-.75H6.75a.75.75 0 0 0-.75.75v3.75c0 .414.336.75.75.75Z" />
                        </svg>

                        <h5 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white">
                            {{ product.product_name }}
                        </h5>
                    </div>
                    <div class="flex flex-col gap-2">
                        <div class="flex items-center gap-2 mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 0 1 0 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.955.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 0 1 0-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28Z" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>

                            <span class="text-l font-bold text-gray-900 dark:text-white mb-1">
                                {{ product.product_desc }}
                            </span>
                        </div>

                        <div class="flex items-center gap-2 mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                            </svg>

                            <span class="text-xl font-bold text-gray-900 dark:text-white">
                                {{ product.product_def_price }}
                            </span>
                        </div>

                        <button :disabled="isLoading" type="button" @click="openTransactionsModal(product.product_id)"
                                class="transition text-white bg-emerald-700 hover:bg-emerald-800 focus:ring-4 focus:outline-none focus:ring-emerald-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-emerald-600 dark:hover:bg-emerald-700 dark:focus:ring-emerald-800">
                                {{ isLoading ? 'Disabled...' : 'Show Todays Transactions' }}
                        </button>
                        <button :disabled="isLoading" type="button" @click="removeBranch(product)"
                            class="transition hover:bg-red-900 text-white bg-emerald-600 focus:ring-4 focus:outline-none focus:ring-emerald-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-emerald-600 dark:hover:bg-emerald-700 dark:focus:ring-emerald-800"
                            title="Remove Branch">
                            {{ isLoading ? 'Disabled...' : 'Remove Branch' }}
                        </button>
                    </div>
                </div> 
            </div>
        </div>
        <div v-else class="mt-6 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-11 items-center p-20">
            <div class="grid max-w-screen-xl px-4 py-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12">
                <div class="mr-auto place-self-center lg:col-span-7">
                    <h1
                        class="max-w-2xl mb-4 text-4xl font-extrabold tracking-tight leading-none md:text-5xl xl:text-6xl dark:text-white text-emerald-700">
                        No Product Found
                    </h1>
                    <p class="max-w-2xl mb-6 font-light text-gray-500 lg:mb-8 md:text-lg lg:text-xl dark:text-gray-400">
                        Try refreshing the page or using our search box to explore further.
                    </p>
                </div>
                <div class="hidden lg:mt-0 lg:col-span-5 lg:flex">
                    <img src="https://images.unsplash.com/photo-1501004318641-b39e6451bec6?q=80&w=1973&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                        alt="mockup">
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
    import { router, usePage, Link } from '@inertiajs/vue3';
    import { ref, onMounted } from 'vue';
    import axios from 'axios';
    import { initFlowbite } from 'flowbite';
    import { defineEmits } from 'vue';

    defineProps({
        products: Array,
    });

    onMounted(() => {
        initFlowbite();

        const currentRoute = usePage().url;
        const hasQueryParams = currentRoute.includes('?');

        if (hasQueryParams) {
            router.visit(currentRoute.split('?')[0], {
                method: 'get',
                data: {},
                preserveState: false,
                replace: true,
            });
        }
    });

    const dialogVisible              = ref(false);
    const isLoading                  = ref(false);
    const selectedBranchId           = ref(null);
    const bookings                   = ref([]);
    const salesOrders                = ref([]);
    const searchQuery                = ref('');
    const emit                       = defineEmits(['branchRemoved']);

    const openTransactionsModal = (branchId) => {
        selectedBranchId.value = branchId;
        dialogVisible.value = true;
        isLoading.value     = true;

        axios
            .get(route('admin.branches.branchTransactions'), {
                params: { branch_id: branchId },
            })
            .then((response) => {
                bookings.value = response.data.bookings;
            });

        axios
            .get(route('admin.branches.branchSales'), {
                params: { branch_id: branchId },
            })
            .then((response) => {
                salesOrders.value = response.data.salesOrders;
            });
    };

    const handleClose = () => {
        dialogVisible.value              = false;
        isLoading.value                  = false;
        bookings.value                   = [];
        salesOrders.value                = [];
    };

    function refreshProductsData() {
        if (isLoading.value) return;

        isLoading.value = true;
        searchQuery.value = '';

        router.visit(route('admin.products.index'), {
            method: 'get',
            data: {
            },
            preserveState: true,
            replace: true,
            onSuccess: () => {
                isLoading.value = false;
                Swal.fire({
                    toast: true,
                    icon: "success",
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 3000,
                    title: "Data refreshed!",
                });
            },
            onFinish: () => {
                isLoading.value = false;
            },
        });
    }

    const handleSearch = () => {
        if (isLoading.value) return;

        isLoading.value = true;

        if (searchQuery.value == '') {
            isLoading.value = false;
            Swal.fire({
                toast: true,
                icon: "warning",
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                title: "Please input your prompt on the search box first.",
            });
            return;
        }

        router.visit(route('admin.products.index'), {
            method: 'get',
            data: {
                search: searchQuery.value
            },
            preserveState: true,
            replace: true,
            onSuccess: () => {
                isLoading.value = false;
            },
            onFinish: () => {
                isLoading.value = false;
            },
        });
    };

    const removeBranch = (branch) => {
        if (isLoading.value) return;

        isLoading.value = true;

        Swal.fire({
            title: "Are you sure?",
            text: `You want to remove branch ${branch.branch_name} from your branch list?`,
            showCancelButton: true,
            confirmButtonColor: "#18634c",
            cancelButtonColor: "#999e9c",
            confirmButtonText: "Yes, remove it!",
            cancelButtonText: "Cancel",
        }).then((result) => {
            if (result.isConfirmed) {
                axios
                    .post(route('admin.branches.remove'), { branch_id: branch.branch_id })
                    .then((response) => {
                        if (response.data.success) {
                            Swal.fire({
                                toast: true,
                                icon: "success",
                                position: "top-end",
                                showConfirmButton: false,
                                timer: 3000,
                                title: "Branch Removed!",
                            });
                            emit('branchRemoved');
                        } else {
                            Swal.fire({
                                icon: "error",
                                title: "Error",
                                text: response.data.message,
                            });
                        }
                    })
                    .catch((error) => {
                        Swal.fire({
                            title: "Error",
                            text: "Something went wrong while removing the branch.",
                        });
                        console.error(error);
                    })
                    .finally(() => {
                        isLoading.value = false;
                    });
            } else {
                isLoading.value = false;
            }
        });
    };
</script>
