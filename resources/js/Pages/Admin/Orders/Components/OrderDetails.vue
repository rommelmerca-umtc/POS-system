<template>
    <el-dialog
        :model-value="detailsDialogVisible"
        @update:model-value="(value) => emit('update:detailsDialogVisible', value)"
        title="Order Details"
        :before-close="() => emit('update:detailsDialogVisible', false)"
        center
        :style="{ width: '90%', maxWidth: '400px', minWidth: '300px' }"
        class="responsive-dialog">
        <div
            :class="[
                'w-full max-w-md p-4 border rounded-lg sm:p-8',
                'dark:bg-gray-800 dark:border-gray-700',
                orderDetails?.payment_status === 'pending' ? 'shadow-md shadow-blue-500 bg-white dark:bg-blue-900' : '',
                orderDetails?.payment_status === 'paid' ? 'shadow-md shadow-green-500 bg-white dark:bg-green-900' : '',
                orderDetails?.payment_status === 'cancelled' ? 'shadow-md shadow-orange-500 bg-white dark:bg-orange-900' : '',
                orderDetails?.payment_status === 'overdue' ? 'shadow-md shadow-red-500 bg-white dark:bg-red-900' : '',
                orderDetails?.payment_status === 'blacklisted' ? 'shadow-md shadow-gray-500 bg-white dark:bg-gray-900' : ''
            ]">
            <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white text-center">
                Order Details
            </h5>
            <div class="flow-root">
                <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-500">
                    <li class="py-2 sm:py-2">
                        <p class="text-sm font-medium text-gray-900 truncate dark:text-white mt-2 text-center">
                            Client Details
                        </p>
                        <div class="flex items-center py-1">
                            <div class="flex-1 min-w-0 ms-4">
                                <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                    Customer ID :
                                </p>
                            </div>
                            <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                {{ orderDetails?.client_id }}
                            </div>
                        </div>
                        <div class="flex items-center py-1">
                            <div class="flex-1 min-w-0 ms-4">
                                <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                    Client Name :
                                </p>
                            </div>
                            <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                {{ orderDetails?.client_name }}
                            </div>
                        </div>
                    </li>

                    <li class="py-2 sm:py-2">
                        <p class="text-sm font-medium text-gray-900 truncate dark:text-white mt-2 text-center">
                            Order
                        </p>
                        <div class="flex items-center py-1">
                            <div class="flex-1 min-w-0 ms-4">
                                <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                    Order ID :
                                </p>
                            </div>
                            <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                {{ orderDetails.id }}
                            </div>
                        </div>
                        <div class="flex items-center py-1">
                            <div class="flex-1 min-w-0 ms-4">
                                <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                    Date Created :
                                </p>
                            </div>
                            <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                {{ orderDetails.created_at }}
                            </div>
                        </div>
                        <div class="flex items-center py-1">
                            <div class="flex-1 min-w-0 ms-4">
                                <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                    Grand Total :
                                </p>
                            </div>
                            <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                {{ orderDetails?.grand_total }}
                            </div>
                        </div>
                        <div class="flex items-center py-1">
                            <div class="flex-1 min-w-0 ms-4">
                                <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                    Payment Method :
                                </p>
                            </div>
                            <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                {{ orderDetails?.payment_method }}
                            </div>
                        </div>
                        <div class="flex items-center py-1">
                            <div class="flex-1 min-w-0 ms-4">
                                <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                    Payment Status :
                                </p>
                            </div>
                            <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                <span v-if="orderDetails?.payment_status === 'pending'"
                                    class="bg-blue-100 text-blue-800 text-sm font-extrabold px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300"
                                    title="PENDING (Pending not Paid)">
                                    {{ orderDetails?.payment_status.toUpperCase()  }}
                                </span>
                                <span v-else-if="orderDetails?.payment_status === 'paid'"
                                    class="bg-green-100 text-green-800 text-sm font-extrabold px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300"
                                    title="PAID (Finished Paid)">
                                    {{ orderDetails?.payment_status.toUpperCase() }}
                                </span>
                                <span v-else-if="orderDetails?.payment_status === 'cancelled'"
                                    class="bg-orange-100 text-orange-800 text-sm font-extrabold px-2.5 py-0.5 rounded dark:bg-orange-900 dark:text-orange-300"
                                    title="CANCELLED (Pending but Cancelled)">
                                    {{ orderDetails?.payment_status.toUpperCase()  }}
                                </span>
                                <span v-else-if="orderDetails?.payment_status === 'overdue'"
                                    class="bg-red-100 text-red-800 text-sm font-extrabold px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300"
                                    title="OVERDUE">
                                    {{ orderDetails?.payment_status.toUpperCase()  }}
                                </span>
                                <span v-else-if="orderDetails?.payment_status === 'blacklisted'"
                                    class="bg-gray-100 text-gray-800 text-sm font-extrabold px-2.5 py-0.5 rounded dark:bg-gray-900 dark:text-gray-300"
                                    title="BLACKLISTED">
                                    {{ orderDetails?.payment_status.toUpperCase()  }}
                                </span>
                            </div>
                        </div>
                        <div class="flex items-center py-1">
                            <div class="flex-1 min-w-0 ms-4">
                                <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                    Payment Due :
                                </p>
                            </div>
                            <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                {{ orderDetails?.payment_due }}
                            </div>
                        </div>
                    </li>

                    <li class="py-2 sm:py-2">
                        <p class="text-sm font-medium text-gray-900 dark:text-white mt-2 text-center">
                            Order Items
                        </p>

                        <div v-for="item in orderItems" :key="item.id" class="py-2 border-b">
                            <div class="flex justify-between">
                                <span>{{ item.name }}</span>
                                <span>x{{ item.quantity }}</span>
                            </div>

                            <div class="flex justify-between">
                                <span>Size</span>
                                <span>{{ item.width }} x {{ item.height }}</span>
                            </div>

                            <div class="flex justify-between text-sm text-gray-500">
                                <span>{{ formatNumber(item.rate_per_unit) }}</span>
                                <span>{{ formatNumber(item.total_price) }}</span>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </el-dialog>
</template>

<script setup>
    import { defineProps, defineEmits } from 'vue';

    defineProps({
        detailsDialogVisible: {
            type: Boolean,
            required: true,
        },
        orderDetails: {
            type: Object,
            required: true,
        },
        orderItems: {
            type: Array,
            required: true,
        }
    });

    const emit = defineEmits(['update:detailsDialogVisible']);

    function formatNumber(value) {
        if (value === null || value === undefined || isNaN(value)) {
            return '₱0.00';
        }
        return new Intl.NumberFormat('en-US', {
            style: 'currency',
            currency: 'PHP',
            minimumFractionDigits: 2,
            maximumFractionDigits: 2,
        }).format(value);
    };
</script>

<style scoped>
    .responsive-dialog {
        width: 80%;
        max-width: 600px; /* Max width for large screens */
    }

    @media (max-width: 768px) {
        .responsive-dialog {
            width: 95%; /* Adjust for smaller screens */
        }
    }

    @media (max-width: 480px) {
        .responsive-dialog {
            width: 100%; /* Full width on very small screens */
        }
    }
</style>
