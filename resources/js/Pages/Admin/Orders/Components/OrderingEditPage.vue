<template>
    <AdminLayout>
        <div class="h-full overflow-y-auto">
            <div class="mx-auto max-w-screen-2xl px-4 2xl:px-0">
                <div
                    class="mt-4 shadow-lg shadow-blue-500/20 rounded-lg flex flex-row md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4 bg-white border border-blue-200">
                    <h6 class="text-xl font-extrabold text-blue-900 dark:text-white flex items-center gap-2">
                        <Link :href="route('admin.orders.index')" class="text-gray-400 text-sm flex items-center gap-1 hover:text-blue-500 transition-all ease-in-out duration-200">
                            Orders
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="h-4 w-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                            </svg>
                        </Link>
                        <span>Edit Order #{{ order?.id }}</span>
                    </h6>
                    <div class="grid gap-4 mb-4 sm:grid-cols-2">
                        <Link :href="route('admin.orders.index')"
                            class="flex items-center justify-center space-x-2 text-white bg-green-500 hover:shadow-xl transition duration-150 ease-in-out hover:bg-green-600 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-green-600 dark:hover:bg-green-500 focus:outline-none dark:focus:ring-green-800">
                            <span>Back to Orders</span>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-5 h-5 font-extrabold">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" />
                            </svg>
                        </Link>
                        <button type="button" @click="updateOrder"
                            class="flex items-center justify-center space-x-2 text-white bg-blue-900 hover:shadow-xl transition duration-150 ease-in-out hover:bg-blue-600 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-500 focus:outline-none dark:focus:ring-blue-800"
                            :disabled="isLoading">
                            <span>{{ isLoading ? 'Updating...' : 'Update Order' }}</span>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-5 h-5 font-extrabold">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" />
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="mt-6 sm:mt-8 md:gap-6 lg:flex lg:items-start xl:gap-8">
                    <!-- Order Items Section -->
                    <div class="mx-auto w-full flex-none lg:max-w-2xl xl:max-w-2xl">
                        <div class="space-y-6">
                            <div v-for="(item, index) in items" :key="index"
                                class="rounded-lg border border-blue-200 bg-white p-4 shadow-xl shadow-blue-500/20 dark:border-gray-700 dark:bg-gray-800 md:p-6">
                                <div class="space-y-4 md:flex md:items-center md:justify-between md:gap-6 md:space-y-0">
                                    <div class="shrink-0 md:order-1">
                                        <div class="h-20 w-20 bg-gray-200 rounded flex items-center justify-center text-gray-500">
                                            Product Image
                                        </div>
                                    </div>

                                    <label for="counter-input" class="sr-only">Choose quantity:</label>
                                    <div class="flex items-center justify-between md:order-3 md:justify-end">
                                        <div class="flex items-center">
                                            <button @click="decreaseQuantity(item)" type="button"
                                                class="inline-flex h-5 w-5 shrink-0 items-center justify-center rounded-md border border-gray-300 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700">
                                                <svg class="h-2.5 w-2.5 text-gray-900 dark:text-white"
                                                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 18 2">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2" d="M1 1h16" />
                                                </svg>
                                            </button>
                                            <input type="text" 
                                                class="w-10 shrink-0 border-0 bg-transparent text-center text-sm font-medium text-gray-900 focus:outline-none focus:ring-0 dark:text-white"
                                                :value="item.quantity" readonly />
                                            <button @click="increaseQuantity(item)" type="button"
                                                class="inline-flex h-5 w-5 shrink-0 items-center justify-center rounded-md border border-gray-300 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700">
                                                <svg class="h-2.5 w-2.5 text-gray-900 dark:text-white"
                                                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 18 18">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16" />
                                                </svg>
                                            </button>
                                        </div>
                                        <div class="text-end md:order-4 md:w-32">
                                            <p class="text-base font-bold text-blue-800 dark:text-white">
                                                ₱{{ formatCurrency(item.total_price) }}
                                            </p>
                                        </div>
                                    </div>

                                    <div class="w-full min-w-0 flex-1 space-y-4 md:order-2 md:max-w-md">
                                        <p class="text-base font-medium text-gray-900 hover:underline dark:text-white">
                                            {{ item.name }}
                                        </p>
                                        <p class="text-sm font-normal text-gray-500 dark:text-gray-400">
                                            Size: {{ item.width }} x {{ item.height }}
                                        </p>

                                        <div class="flex items-center gap-4">
                                            <button @click="removeItem(item.id)" type="button"
                                                class="inline-flex items-center text-sm font-medium text-red-600 hover:underline dark:text-red-500">
                                                <svg class="me-1.5 h-5 w-5" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                    fill="none" viewBox="0 0 24 24">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="M6 18 17.94 6M18 18 6.06 6" />
                                                </svg>
                                                Remove
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Add Item Button -->
                            <div class="flex justify-center">
                                <button @click="showAddItemModal = true"
                                    class="flex items-center justify-center space-x-2 text-white bg-green-600 hover:shadow-xl transition duration-150 ease-in-out hover:bg-green-700 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-4 py-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                    </svg>
                                    <span>Add Item</span>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Order Summary and Details Section -->
                    <div class="mx-auto mt-6 max-w-5xl flex-1 space-y-6 lg:mt-0 lg:w-full shadow-lg shadow-blue-500/20 rounded-lg border border-blue-200 bg-white p-4 dark:border-gray-700 dark:bg-gray-800 sm:p-6 lg:p-8">
                        <!-- Order Summary -->
                        <div class="space-y-4 rounded-lg border border-blue-200 bg-white p-4 shadow-lg shadow-blue-500/20 dark:border-gray-700 dark:bg-gray-800 sm:p-6">
                            <p class="text-xl font-semibold text-gray-900 dark:text-white">
                                Order Summary
                            </p>
                            <div class="space-y-4">
                                <div class="space-y-2">
                                    <dl class="flex items-center justify-between gap-4" v-for="item in items" :key="item.id">
                                        <dt class="text-base font-normal text-gray-500 dark:text-gray-400">
                                            {{ item.name }} (x{{ item.quantity }})
                                        </dt>
                                        <dd class="text-base font-medium text-gray-900 dark:text-white">
                                            ₱{{ formatCurrency(item.total_price) }}
                                        </dd>
                                    </dl>
                                </div>
                                <dl class="flex items-center justify-between gap-4 border-t border-gray-200 pt-2 dark:border-gray-700">
                                    <dt class="text-base font-bold text-gray-500 dark:text-white">Subtotal</dt>
                                    <dd class="text-base font-bold text-gray-900 dark:text-white">₱{{ formatCurrency(subtotal) }}</dd>
                                </dl>
                                <dl class="flex items-center justify-between gap-4 border-t border-gray-200 pt-2 dark:border-gray-700">
                                    <dt class="text-base font-bold text-gray-500 dark:text-white">VAT (12%)</dt>
                                    <dd class="text-base font-bold text-gray-900 dark:text-white">₱{{ formatCurrency(vat) }}</dd>
                                </dl>
                                <dl v-if="isServiceCharged" class="flex items-center justify-between gap-4 border-t border-gray-200 pt-2 dark:border-gray-700">
                                    <dt class="text-base font-bold text-gray-500 dark:text-white">Service Charge (5%)</dt>
                                    <dd class="text-base font-bold text-gray-900 dark:text-white">₱{{ formatCurrency(serviceCharge) }}</dd>
                                </dl>
                                <dl class="flex items-center justify-between gap-4 border-t border-gray-200 pt-2 dark:border-gray-700">
                                    <dt class="text-base font-bold text-gray-900 dark:text-white">Grand Total</dt>
                                    <dd class="text-lg font-bold text-green-700 dark:text-white">₱{{ formatCurrency(grandTotal) }}</dd>
                                </dl>
                            </div>
                            <div class="flex justify-start">
                                <label class="mt-5 hover:shadow-xl transition duration-150 ease-in-out hover:shadow-blue-200 w-60 inline-flex cursor-pointer p-4 bg-neutral-primary-soft rounded-lg border border-default rounded-base shadow-xs">
                                    <input type="checkbox" name="service_charge" class="sr-only peer" v-model="isServiceCharged" @change="calculateTotals">
                                    <div class="shrink-0 relative w-9 h-5 bg-gray-300 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-brand-soft dark:peer-focus:ring-brand-soft rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-buffer after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-blue-500">
                                    </div>
                                    <div class="ms-5 select-none">
                                        <p class="text-sm font-medium text-heading mb-1">Apply Service Charge?</p>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <!-- Order Details Form -->
                        <div class="space-y-4 rounded-lg border border-blue-200 bg-white p-4 shadow-lg shadow-blue-500/20 dark:border-gray-700 dark:bg-gray-800 sm:p-6">
                            <div class="flex items-center justify-between">
                                <p class="text-xl font-semibold text-gray-900 dark:text-white">
                                    Order Details
                                </p>
                            </div>
                            
                            <div class="space-y-4">
                                <!-- Client Info (Read-only) -->
                                <div class="p-4 bg-gray-50 rounded-lg">
                                    <p class="text-sm text-gray-500">Client</p>
                                    <p class="text-lg font-semibold">{{ order?.client_name }}</p>
                                    <p class="text-sm text-gray-600">Client ID: {{ order?.client_id }}</p>
                                </div>

                                <!-- Payment Method -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Payment Method</label>
                                    <div class="grid gap-4 sm:grid-cols-4">
                                        <div class="flex items-center ps-4 border border-default rounded-base rounded-xl">
                                            <input id="edit-cash" type="radio" value="cash" v-model="form.payment_method"
                                                class="w-4 h-4 text-neutral-primary border-default-medium rounded-full">
                                            <label for="edit-cash" class="w-full py-4 ms-2 text-md font-medium">Cash</label>
                                        </div>
                                        <div class="flex items-center ps-4 border border-default rounded-base rounded-xl">
                                            <input id="edit-gcash" type="radio" value="gcash" v-model="form.payment_method"
                                                class="w-4 h-4 text-neutral-primary border-default-medium rounded-full">
                                            <label for="edit-gcash" class="w-full py-4 ms-2 text-md font-medium">GCash</label>
                                        </div>
                                        <div class="flex items-center ps-4 border border-default rounded-base rounded-xl">
                                            <input id="edit-qrph" type="radio" value="qrph" v-model="form.payment_method"
                                                class="w-4 h-4 text-neutral-primary border-default-medium rounded-full">
                                            <label for="edit-qrph" class="w-full py-4 ms-2 text-md font-medium">QR PH</label>
                                        </div>
                                        <div class="flex items-center ps-4 border border-default rounded-base rounded-xl">
                                            <input id="edit-credit" type="radio" value="credit_card" v-model="form.payment_method"
                                                class="w-4 h-4 text-neutral-primary border-default-medium rounded-full">
                                            <label for="edit-credit" class="w-full py-4 ms-2 text-md font-medium">Credit Card</label>
                                        </div>
                                    </div>
                                </div>

                                <!-- Due Date and Status -->
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div class="p-4 border border-default rounded-base rounded-xl">
                                        <label for="edit-paymentDue" class="text-lg font-medium text-gray-900 mr-5">Due on:</label>
                                        <input type="date" id="edit-paymentDue" v-model="form.payment_due"
                                            class="py-2 px-4 text-lg font-medium text-gray-900 bg-white rounded-lg border border-gray-200 focus:ring-4 focus:ring-gray-200 w-full mt-2">
                                    </div>
                                    <div class="p-4 border border-default rounded-base rounded-xl">
                                        <label for="edit-paymentStatus" class="text-lg font-medium text-gray-900 mr-5">Status:</label>
                                        <select id="edit-paymentStatus" v-model="form.payment_status"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-lg rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 mt-2">
                                            <option value="pending">Pending</option>
                                            <option value="paid">Paid</option>
                                            <option value="cancelled">Cancelled</option>
                                            <option value="overdue">Overdue</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="grid gap-4 sm:grid-cols-2 mt-6">
                                <Link :href="route('admin.orders.index')"
                                    class="transition-all duration-200 shadow-lg shadow-red-200 flex w-full items-center justify-center rounded-lg bg-gray-500 px-5 py-2.5 text-lg font-medium text-white hover:bg-gray-600">
                                    Cancel
                                </Link>
                                <button @click="updateOrder()" type="button" :disabled="isLoading"
                                    class="transition-all duration-200 shadow-lg shadow-blue-200 flex w-full items-center justify-center rounded-lg bg-blue-900 px-5 py-2.5 text-lg font-medium text-white hover:bg-blue-700 disabled:opacity-50">
                                    {{ isLoading ? 'Updating...' : 'Update Order' }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Add Item Modal -->
        <div v-if="showAddItemModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
            <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
                <div class="mt-3">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Add Item to Order</h3>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Product</label>
                            <select v-model="newItem.product_id" @change="handleProductSelect" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <option value="">Select Product</option>
                                <option v-for="product in products" :key="product.id" :value="product.id">
                                    {{ product.name }} - ₱{{ product.price }}/sqm
                                </option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Width (m)</label>
                            <input type="number" v-model="newItem.width" step="0.01" min="0" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Height (m)</label>
                            <input type="number" v-model="newItem.height" step="0.01" min="0" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Quantity</label>
                            <input type="number" v-model="newItem.quantity" min="1" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </div>
                    </div>
                    <div class="flex justify-end gap-2 mt-6">
                        <button @click="showAddItemModal = false" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400">Cancel</button>
                        <button @click="addItem" class="px-4 py-2 bg-blue-900 text-white rounded-lg hover:bg-blue-700">Add</button>
                    </div>
                </div>
            </div>
        </div>
    </AdminLayout>
</template>

<script setup>
    import { ref, computed, onMounted } from 'vue';
    import { router, Link } from '@inertiajs/vue3';
    import AdminLayout from '../../Components/AdminLayout.vue';
    import axios from 'axios';
    import Swal from 'sweetalert2';

    const props = defineProps({
        order: Object,
        items: Array,
        products: Array
    });

    const isLoading = ref(false);
    const showAddItemModal = ref(false);
    const isServiceCharged = ref(false);
    
    const form = ref({
        payment_method: props.order?.payment_method || '',
        payment_due: props.order?.payment_due || '',
        payment_status: props.order?.payment_status || ''
    });

    const newItem = ref({
        product_id: '',
        width: 0,
        height: 0,
        quantity: 1,
        rate_per_unit: 0
    });

    // Computed properties for calculations
    const subtotal = computed(() => {
        return props.items.reduce((sum, item) => sum + parseFloat(item.total_price || 0), 0);
    });

    const vat = computed(() => {
        return subtotal.value * 0.12;
    });

    const serviceCharge = computed(() => {
        if (!isServiceCharged.value) return 0;
        return (subtotal.value + vat.value) * 0.05;
    });

    const grandTotal = computed(() => {
        return subtotal.value + vat.value + serviceCharge.value;
    });

    const formatCurrency = (value) => {
        return parseFloat(value || 0).toLocaleString('en-PH', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        });
    };

    const handleProductSelect = () => {
        const selectedProduct = props.products.find(p => p.id === parseInt(newItem.value.product_id));
        if (selectedProduct) {
            newItem.value.rate_per_unit = selectedProduct.price;
        }
    };

    const increaseQuantity = (item) => {
        const newQuantity = item.quantity + 1;
        updateItemQuantity(item, newQuantity);
    };

    const decreaseQuantity = (item) => {
        if (item.quantity > 1) {
            const newQuantity = item.quantity - 1;
            updateItemQuantity(item, newQuantity);
        }
    };

    const updateItemQuantity = async (item, newQuantity) => {
        try {
            const area = item.width * item.height;
            const newTotal = item.rate_per_unit * area * newQuantity;
            
            await axios.patch(route('admin.orders.update-item', item.id), {
                quantity: newQuantity,
                total_price: newTotal
            });
            
            item.quantity = newQuantity;
            item.total_price = newTotal;
            
            // Refresh the page to get updated order totals
            router.reload({ only: ['order', 'items'] });
        } catch (error) {
            console.error('Failed to update quantity:', error);
            Swal.fire('Error', 'Failed to update quantity', 'error');
        }
    };

    const removeItem = async (itemId) => {
        const result = await Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, remove it!'
        });

        if (result.isConfirmed) {
            try {
                await axios.delete(route('admin.orders.remove-item', itemId));
                router.reload({ only: ['order', 'items'] });
                Swal.fire('Removed!', 'Item has been removed.', 'success');
            } catch (error) {
                console.error('Failed to remove item:', error);
                Swal.fire('Error', 'Failed to remove item', 'error');
            }
        }
    };

    const addItem = async () => {
        if (!newItem.value.product_id || !newItem.value.width || !newItem.value.height) {
            Swal.fire('Error', 'Please fill all fields', 'error');
            return;
        }

        try {
            const selectedProduct = props.products.find(p => p.id === parseInt(newItem.value.product_id));
            const area = newItem.value.width * newItem.value.height;
            const totalPrice = selectedProduct.price * area * newItem.value.quantity;

            await axios.post(route('admin.orders.add-item', props.order.id), {
                ...newItem.value,
                total_price: totalPrice
            });

            showAddItemModal.value = false;
            router.reload({ only: ['order', 'items'] });
            Swal.fire('Success', 'Item added successfully', 'success');
        } catch (error) {
            console.error('Failed to add item:', error);
            Swal.fire('Error', 'Failed to add item', 'error');
        }
    };

    const updateOrder = () => {
        if (!form.value.payment_method || !form.value.payment_status) {
            Swal.fire('Error', 'Please fill all required fields', 'error');
            return;
        }

        isLoading.value = true;

        router.put(
            route('admin.orders.update', { orderId: props.order.id }),
            {
                ...form.value,
                subtotal: subtotal.value,
                vat: vat.value,
                service_charge: serviceCharge.value,
                grand_total: grandTotal.value
            },
            {
                onSuccess: () => {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'Order updated successfully',
                        timer: 2000,
                        showConfirmButton: false
                    });

                    router.visit(route('admin.orders.index'));
                },
                onError: (errors) => {
                    console.error(errors);
                    Swal.fire('Error', 'Failed to update order', 'error');
                },
                onFinish: () => {
                    isLoading.value = false;
                }
            }
        );
    };

    onMounted(() => {
        if (props.order?.service_charge > 0) {
            isServiceCharged.value = true;
        }
    });
</script>