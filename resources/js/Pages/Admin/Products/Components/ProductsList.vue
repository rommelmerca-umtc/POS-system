<template>
    <section class="bg-gray-50 dark:bg-gray-900 p-6 sm:p-0 h-screen">
        <div class="mx-auto max-w-screen-4xl px-4 lg:px-12">
            <div
                class="mt-4 shadow-lg shadow-blue-500/20 rounded-lg flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4 bg-white border border-gray-100">
                <h6 class="text-xl font-extrabold text-blue-900 dark:text-white">
                    Products
                </h6>
                <div
                    class="w-full md:w-1/2 flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
                    <div class="w-1/2 md:w-2/2">
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
                                    class="bg-gray-50 border border-blue-900 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Search" />
                            </div>
                        </form>
                    </div>
                    <button type="button" :disabled="isLoading" @click="refreshProductsData"
                        class="flex items-center justify-center space-x-2 text-white bg-blue-900 transition-all duration-200 hover:bg-blue-600 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-500 focus:outline-none dark:focus:ring-blue-800">
                        <span class="text-md">{{ isLoading ? 'Disabled...' : 'Refresh' }}</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" />
                        </svg>
                    </button>
                    <button type="button" :disabled="isLoading" @click="refreshProductsData"
                        class="flex items-center justify-center space-x-2 text-white bg-blue-900 transition-all duration-200 hover:bg-blue-600 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-500 focus:outline-none dark:focus:ring-blue-800">
                        <span class="text-md">{{ isLoading ? 'Disabled...' : 'Add Product' }}</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15M12 9l3 3m0 0-3 3m3-3H2.25" />
                        </svg>
                    </button>
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
