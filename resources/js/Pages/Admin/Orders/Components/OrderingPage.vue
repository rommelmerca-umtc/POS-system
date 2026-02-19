<template>
    <section class="bg-gray-50 dark:bg-gray-900 p-6 sm:p-0 h-screen">
        <div class="mx-auto max-w-screen-4xl px-4 lg:px-12">
            <div
                class="mt-4 shadow-lg shadow-blue-500/20 rounded-lg flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4 bg-white border border-gray-100">
                <h6 class="text-xl font-extrabold text-blue-900 dark:text-white">
                    Orders
                </h6>
                <Link :href="route('admin.orders.create-order-page')" :disabled="isLoading" @click="handleFilters"
                    class="flex items-center justify-center space-x-2 text-white bg-green-900 hover:shadow-xl transition duration-150 ease-in-out hover:bg-green-600 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-green-600 dark:hover:bg-green-500 focus:outline-none dark:focus:ring-green-800">
                    <span>Add Order</span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15M12 9l3 3m0 0-3 3m3-3H2.25" />
                    </svg>

                </Link>
            </div>
            <div
                class="shadow-lg shadow-blue-500/20 mt-7 rounded bg-white border border-gray-100 dark:bg-gray-800 relative sm:rounded-lg overflow-hidden">
                <div
                    class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                    <!-- search -->
                    <div class="w-full md:w-1/2">
                        <form class="flex items-center" @submit.prevent="handleSearch" :disabled="isLoading">
                            <label for="simple-search" class="sr-only">

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
                                    class="bg-gray-100 border-none text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Search" />
                            </div>
                        </form>
                    </div>
                    <!-- filters -->
                    <div
                        class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
                        <div class="flex items-center space-x-3 w-full md:w-auto">
                            <button id="filterDropdownButton" data-dropdown-toggle="filterDropdown"
                                class="w-full md:w-auto flex items-center justify-center py-2 px-4 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700"
                                type="button">
                                <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true"
                                    class="h-4 w-4 mr-2 text-gray-400" viewbox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z"
                                        clip-rule="evenodd" />
                                </svg>
                                Filters
                                <svg class="-mr-1 ml-1.5 w-5 h-5" fill="currentColor" viewbox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <path clip-rule="evenodd" fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
                                </svg>
                            </button>
                            <div id="filterDropdown"
                                class="z-10 hidden w-48 p-3 bg-white rounded-lg shadow dark:bg-gray-700"
                                style="max-height: 200px; overflow-y: auto;">
                                <!-- filter by status -->
                                <h6 class="mb-3 text-sm font-medium text-gray-900 dark:text-white">
                                    Filter by Status
                                </h6>
                                <ul class="space-y-2 text-sm mb-2" aria-labelledby="filterDropdownButton">
                                    <li class="flex items-center">
                                        <input id="paid" type="checkbox" v-model="selectedStatuses.PAID"
                                            :disabled="isLoading"
                                            class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                        <label for="paid"
                                            class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">
                                            PAID
                                        </label>
                                    </li>
                                    <li class="flex items-center">
                                        <input id="billed" type="checkbox" v-model="selectedStatuses.BILLED"
                                            :disabled="isLoading"
                                            class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                        <label for="billed"
                                            class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">
                                            BILLED
                                        </label>
                                    </li>
                                    <li class="flex items-center">
                                        <input id="voided" type="checkbox" v-model="selectedStatuses.VOIDED"
                                            :disabled="isLoading"
                                            class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                        <label for="voided"
                                            class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">
                                            VOIDED
                                        </label>
                                    </li>
                                </ul>
                                <hr class="w-full mb-2">
                                <!-- filter by branch -->
                                <h6 class="mb-3 text-sm font-medium text-gray-900 dark:text-white">
                                    Filter by Branch
                                </h6>
                                <ul class="space-y-2 text-sm mt-5" aria-labelledby="filterDropdownButton">
                                    <li class="flex items-center" v-for="branch in branches" :key="branch.id">
                                        <input type="checkbox" :id="branch.name" :value="branch.id"
                                            v-model="selectedBranches" :disabled="isLoading"
                                            class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500" />
                                        <label :for="branch.name"
                                            class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">

                                        </label>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="flex items-center space-x-3 w-full md:w-auto">
                            <label for="startDate" class="text-sm font-medium text-gray-900 dark:text-gray-100">Start
                                Date:</label>
                            <input type="date" id="startDate" v-model="startDate" :disabled="isLoading"
                                class="py-2 px-4 text-sm font-medium text-gray-900 bg-white rounded-lg border border-gray-200 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600" />
                        </div>
                        <div class="flex items-center space-x-3 w-full md:w-auto">
                            <label for="endDate" class="text-sm font-medium text-gray-900 dark:text-gray-100">End
                                Date:</label>
                            <input type="date" id="endDate" v-model="endDate" :disabled="isLoading"
                                class="py-2 px-4 text-sm font-medium text-gray-900 bg-white rounded-lg border border-gray-200 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600" />
                        </div>
                    </div>
                    <!-- buttons -->
                    <div
                        class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
                        <button type="button" :disabled="isLoading" @click="handleFilters"
                            class="flex items-center justify-center space-x-2 text-white bg-indigo-700 hover:shadow-xl transition duration-150 ease-in-out hover:bg-indigo-600 focus:ring-4 focus:ring-indigo-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-indigo-600 dark:hover:bg-indigo-500 focus:outline-none dark:focus:ring-indigo-800">
                            <span>Generate</span>
                            <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                            </svg>
                        </button>
                        <button type="button" :disabled="isLoading" @click="refresh"
                            class="flex items-center justify-center space-x-2 text-white bg-yellow-500 hover:shadow-xl transition duration-150 ease-in-out hover:bg-yellow-600 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-yellow-600 dark:hover:bg-yellow-500 focus:outline-none dark:focus:ring-yellow-800">
                            <span>Refresh</span>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-4">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" />
                            </svg>
                        </button>
                    </div>
                </div>
                <!-- table -->
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead
                            class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 text-center">
                            <tr>
                                <th scope="col" class="px-4 py-3">Order Number</th>
                                <th scope="col" class="px-4 py-3">Client Name</th>
                                <th scope="col" class="px-4 py-3">Grand Total (Net)</th>
                                <th scope="col" class="px-4 py-3">Order Date</th>
                                <th scope="col" class="px-4 py-3"
                                    title="PAID (Finished and Paid) | BILLED (Finished not yet Paid) | VOIDED (Finished but Voided)">
                                    Sales Status
                                </th>
                                <th scope="col" class="px-4 py-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr :key="index" class="border-b dark:border-gray-700 text-center">
                                <th scope="row"
                                    class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">

                                </th>
                                <th scope="row"
                                    class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">

                                </th>
                                <th scope="row"
                                    class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">

                                </th>
                                <th scope="row"
                                    class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">

                                </th>
                                <td class="px-4 py-3">
                                    <span v-if="'PAID'"
                                        class="bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300"
                                        title="PAID (Finished and Paid)">

                                    </span>
                                    <span v-else-if="'BILLED'"
                                        class="bg-blue-100 text-blue-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300"
                                        title="BILLED (Finished not yet Paid)">

                                    </span>
                                    <span v-else-if="'VOIDED'"
                                        class="bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300"
                                        title="VOIDED (Paid but Voided)">

                                    </span>
                                </td>
                                <td class="px-4 py-3">
                                    <a href="#" @click.prevent="openDetailsModal(report)" :disabled="isLoading"
                                        class="flex items-center justify-center space-x-2 py-1 px-2 text-sm bg-blue-800 rounded-lg text-center text-white hover:shadow-xl transition duration-150 ease-in-out hover:bg-blue-600 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white focus:ring-4 focus:ring-blue-300 dark:focus:ring-gray-700 focus:outline-none dark:focus:ring-gray-800">
                                        <span>{{ isLoading ? 'Disabled...' : 'Details' }}</span>
                                    </a>
                                </td>
                            </tr>
                            <tr class="bg-gray-100 dark:bg-gray-700 font-semibold text-center">
                                <td class="px-4 py-3"></td>

                                <td colspan="2" class="px-4 py-3 text-gray-900 dark:text-white text-right">
                                    Totals
                                </td>

                                <td class="px-4 py-3 text-gray-900 dark:text-white">
                                </td>

                                <td class="px-4 py-3 text-gray-900 dark:text-white">
                                </td>

                                <td class="px-4 py-3 text-gray-900 dark:text-white">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- pagination -->
                <nav class="flex flex-col md:flex-row justify-between items-start md:items-center space-y-3 md:space-y-0 p-4"
                    aria-label="Table navigation">
                    <span class="text-sm font-normal text-gray-500 dark:text-gray-400">
                        Showing
                        <span class="font-semibold text-gray-900 dark:text-white">

                        </span>
                        of
                        <span class="font-semibold text-gray-900 dark:text-white">

                        </span>
                    </span>
                    <!-- <ul class="inline-flex items-stretch -space-x-px">
                        <li class="flex">
                            <button
                                :disabled="!link.url"
                                @click="fetchPage(link.url ? getPageFromUrl(link.url) : null)"
                                :class="[
                                    'flex items-center justify-center text-sm py-2 px-3 leading-tight',
                                    link.active ? 'z-10 text-primary-600 bg-primary-50 border-primary-300 hover:bg-primary-100 hover:text-primary-700' : 'text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700',
                                    'dark:border-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white'
                                ]">
                                <span v-html="link.label"></span>
                            </button>
                        </li>
                    </ul> -->
                </nav>
            </div>
        </div>
    </section>
</template>

<script setup>
import { router, usePage, Link } from '@inertiajs/vue3';
import { ref, onMounted, reactive, computed, watch } from 'vue';

const props = defineProps({
    salesReports: {
        type: Object,
        required: true,
    },
});

onMounted(() => {
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

const selectedBranches = ref([]);
const startDate = ref('');
const endDate = ref('');
const isLoading = ref(false);
const searchQuery = ref('');
const dialogVisible = ref(false);
const reportDetails = ref([]);
const selectedStatuses = ref({
    PAID: false,
    BILLED: false,
    VOIDED: false,
});

// const totals = computed(() => {
//     const subTotal      = props.salesReports.data.reduce((sum, report) => sum + report.sub_total, 0);
//     const discountTotal = props.salesReports.data.reduce((sum, report) => sum + report.discount_total, 0);
//     const grandTotal    = props.salesReports.data.reduce((sum, report) => sum + report.grand_total, 0);

//     return { subTotal, discountTotal, grandTotal };
// });

// const handleFilters = () => {
//     if (isLoading.value) return;

//     isLoading.value      = true;
//     const activeStatuses = Object.keys(selectedStatuses.value).filter(status => selectedStatuses.value[status]);

//     if (selectedBranches.value.length < 1 && activeStatuses.length < 1 && startDate.value == '' && endDate.value == '') {
//         isLoading.value = false;
//         Swal.fire({
//             toast: true,
//             icon: "warning",
//             position: "top-end",
//             showConfirmButton: false,
//             timer: 3000,
//             title: "Please select a filter first",
//         });
//         return;
//     }

//     if ((startDate.value && !endDate.value) || (!startDate.value && endDate.value)) {
//         isLoading.value = false;
//         Swal.fire({
//             toast: true,
//             icon: "warning",
//             position: "top-end",
//             showConfirmButton: false,
//             timer: 3000,
//             title: "Please fill both Start Date and End Date.",
//         });
//         return;
//     }

//     if (startDate.value && endDate.value) {
//         const start      = new Date(startDate.value);
//         const end        = new Date(endDate.value);
//         const diffInDays = Math.ceil((end - start) / (1000 * 60 * 60 * 24));

//         if (diffInDays > 31) {
//             isLoading.value = false;
//             Swal.fire({
//                 toast: true,
//                 icon: "warning",
//                 position: "top-end",
//                 showConfirmButton: false,
//                 timer: 3000,
//                 title: "Date range should not exceed 31 days.",
//             });
//             return;
//         }
//     }

//     router.visit(route('admin.sales-reports.index'), {
//         method: 'get',
//         data: {
//             branch_ids: selectedBranches.value.length > 0 ? selectedBranches.value : null,
//             sales_status: activeStatuses.length > 0 ? activeStatuses : null,
//             start_date: startDate.value || null,
//             end_date: endDate.value || null,
//             search: searchQuery.value || '',
//         },
//         preserveState: true,
//         replace: true,
//         onSuccess: () => {
//             isLoading.value = false;
//         },
//         onFinish: () => {
//             isLoading.value = false;
//         },
//     });
// };

// const handleSearch = () => {
//     if (isLoading.value) return;

//     isLoading.value      = true;
//     const activeStatuses = Object.keys(selectedStatuses.value).filter(status => selectedStatuses.value[status]);

//     if (searchQuery.value == '') {
//         isLoading.value = false;
//         Swal.fire({
//             toast: true,
//             icon: "warning",
//             position: "top-end",
//             showConfirmButton: false,
//             timer: 3000,
//             title: "Please input your prompt on the search box first.",
//         });
//         return;
//     }

//     router.visit(route('admin.sales-reports.index'), {
//         method: 'get',
//         data: {
//             branch_ids: selectedBranches.value.length > 0 ? selectedBranches.value : null,
//             sales_status: activeStatuses.length > 0 ? activeStatuses : null,
//             start_date: startDate.value || null,
//             end_date: endDate.value || null,
//             search: searchQuery.value,
//         },
//         preserveState: true,
//         replace: true,
//         onSuccess: () => {
//             isLoading.value = false;
//         },
//         onFinish: () => {
//             isLoading.value = false;
//         },
//     });
// };

// function refresh() {
//     if (isLoading.value) return;

//     isLoading.value        = true;
//     selectedBranches.value = [];
//     selectedStatuses.value = { PAID: false, BILLED: false, VOIDED: false };
//     startDate.value        = '';
//     endDate.value          = '';
//     searchQuery.value      = '';

//     router.visit(route('admin.sales-reports.index'), {
//         method: 'get',
//         data: {
//         },
//         preserveState: true,
//         replace: true,
//         onSuccess: () => {
//             isLoading.value = false;
//             Swal.fire({
//                 toast: true,
//                 icon: "success",
//                 position: "top-end",
//                 showConfirmButton: false,
//                 timer: 3000,
//                 title: "Data refreshed!",
//             });
//         },
//         onFinish: () => {
//             isLoading.value = false;
//         },
//     });
// }

// function formatNumber(value) {
//     if (value === null || value === undefined || isNaN(value)) {
//         return '₱0.00';
//     }
//     return new Intl.NumberFormat('en-US', {
//         style: 'currency',
//         currency: 'PHP',
//         minimumFractionDigits: 2,
//         maximumFractionDigits: 2,
//     }).format(value);
// };

// const getPageFromUrl = (url) => {
//     try {
//         const parsedUrl = new window.URL(url);
//         return parsedUrl.searchParams.get('page');
//     } catch (error) {
//         console.error('Invalid URL:', url);
//         return null;
//     }
// };

// const fetchPage = (page) => {
//     const activeStatuses = Object.keys(selectedStatuses.value).filter(status => selectedStatuses.value[status]);

//     if (!page) return;
//     router.visit(route('admin.sales-reports.index'), {
//         method: 'get',
//         data: {
//             page,
//             branch_ids: selectedBranches.value.length > 0 ? selectedBranches.value : null,
//             sales_status: activeStatuses.length > 0 ? activeStatuses : null,
//             start_date: startDate.value || null,
//             end_date: endDate.value || null,
//             search: searchQuery.value || '',
//         },
//         preserveState: true,
//         replace: true
//     });
// };

// const openDetailsModal = (report) => {
//     dialogVisible.value = true;
//     isLoading.value     = true;
//     reportDetails.value = report;
// };

// const handleClose = async () => {
//     dialogVisible.value  = false;
//     isLoading.value      = false;
//     reportDetails        = [];
// };
</script>
