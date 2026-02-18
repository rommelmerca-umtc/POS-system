<template>
    <section class="bg-gray-50 dark:bg-gray-900 p-3 sm:p-0 h-screen">
        <div class="flex justify-center items-center">
            <div class="w-11/12 shadow-lg shadow-blue-500/20 rounded-lg flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4 bg-white border border-gray-100">
                <div
                    class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
                    <h6 class="mr-11 text-xl font-extrabold text-blue-900 dark:text-white">
                        Orders
                    </h6>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
    import { router, usePage } from '@inertiajs/vue3';
    import { ref, onMounted, reactive, computed, watch } from 'vue';

    const props = defineProps({
        salesReports: {
            type: Object,
            required: true,
        },
    });

    onMounted(() => {
        const currentRoute   = usePage().url;
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
    const startDate        = ref('');
    const endDate          = ref('');
    const isLoading        = ref(false);
    const searchQuery      = ref('');
    const dialogVisible    = ref(false);
    const reportDetails    = ref([]);
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
