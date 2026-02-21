<template>
    <section>
        <div :class="visible ? 'translate-x-0' : '-translate-x-full'"
            class="z-50 fixed top-0 left-0 w-full h-screen max-w-md p-4 overflow-y-auto transition-transform -translate-x-full bg-white dark:bg-gray-800">
            <h5 id="drawer-label"
                class="inline-flex items-center mb-6 text-3xl font-semibold text-blue-700 uppercase dark:text-gray-400 mt-5">
                New Order
            </h5>
            <button type="button" @click="$emit('close')"
                class="text-gray-400 bg-transparent transition-all duration-200 hover:bg-red-500 hover:text-white rounded-lg text-sm p-1.5 absolute top-2.5 right-2.5 inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white">
                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                        clip-rule="evenodd"></path>
                </svg>
                <span class="sr-only">Close menu</span>
            </button>
            <form @submit.prevent="handleSubmit">
                <div class="space-y-4">
                    <p id="drawer-label"
                        class="inline-flex items-center mb-1 text-xl font-extrabold text-gray-600 uppercase dark:text-gray-400 mt-5">
                        Product Details
                    </p>
                    <div class="grid grid-cols-1 md:grid-cols-[1fr_auto] gap-4 items-end">
                        <div>
                            <label for="products"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product</label>
                            <select id="products" v-model="form.product_id"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option selected="">Select product</option>
                                <option
                                    v-for="product in products"
                                    :key="product.id"
                                    :value="product.id">
                                    {{ product.name }}
                                </option>
                            </select>
                        </div>
                        <div>
                            <label for="quantity-input" class="block mb-2 text-sm font-medium text-heading">
                                Choose quantity:
                            </label>
                            <div class="relative flex items-center max-w-[9rem] shadow-xs rounded-xl">
                                <button type="button" 
                                    @click="decrementQuantity"
                                    class="text-body bg-neutral-secondary-medium box-border border border-gray-300 hover:bg-neutral-tertiary-medium hover:text-heading focus:ring-4 focus:ring-neutral-tertiary font-medium leading-5 rounded-l-lg text-sm px-3 focus:outline-none h-11">
                                    <svg class="w-4 h-4 text-heading" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                        viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="M5 12h14" />
                                    </svg>
                                </button>
                                <input type="number" 
                                    id="quantity-input" 
                                    v-model.number="form.quantity"
                                    min="1"
                                    aria-describedby="helper-text-explanation"
                                    class="border-x-0 h-11 placeholder:text-heading text-center w-full bg-neutral-secondary-medium border-gray-300 py-2.5 placeholder:text-body"
                                    placeholder="1" 
                                    required />
                                <button type="button" 
                                    @click="incrementQuantity"
                                    class="text-body bg-neutral-secondary-medium box-border border border-gray-300 hover:bg-neutral-tertiary-medium hover:text-heading focus:ring-4 focus:ring-neutral-tertiary font-medium leading-5 rounded-r-lg text-sm px-3 focus:outline-none h-11">
                                    <svg class="w-4 h-4 text-heading" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"
                                        viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="M5 12h14m-7 7V5" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-1 gap-4">
                        <div>
                            <label for="width"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Width
                            </label>
                            <input type="number" name="width" id="width" v-model="form.width" 
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Type Product width" required="">
                        </div>
                        <div>
                            <label for="height"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Height
                            </label>
                            <input type="number" name="height" id="height" v-model="form.height"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Type Product height" required="">
                        </div>
                        <div>
                            <label for="unit"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Unit
                            </label>
                            <select id="unit" v-model="form.unit"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option :value="null">Select product</option>
                                <option value="feet">feet</option>
                                <option value="milimeters">Milimeters</option>
                                <option value="centimeters">Centimeters</option>
                                <option value="meters">Meters</option>
                            </select>
                        </div>
                        <div>
                            <label for="rate_per_unit"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Rate Per Unit
                            </label>
                            <input type="number" name="rate_per_unit" id="rate_per_unit" v-model="form.rate_per_unit" 
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Type rate per unit" required="">
                        </div>
                        <div>
                            <label for="total_price"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Total Price
                            </label>
                            <input type="number" name="total_price" id="total_price" v-model="form.total_price"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Type total price" required="">
                        </div>
                    </div>
                    <div class="bottom-0 left-0 flex justify-center w-full pb-4 space-x-4 md:px-4 md:absolute">
                        <button type="submit" @click="handleSubmit()"
                            class="text-white w-full justify-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                            Add product
                        </button>
                        <button type="button" @click="$emit('close')"
                            class="inline-flex w-full justify-center text-gray-500 items-center bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                            <svg aria-hidden="true" class="w-5 h-5 -ml-1 sm:mr-1" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                            Cancel
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </section>
</template>
<script setup>
    import { onMounted, ref, computed, watch } from 'vue';
    import { initFlowbite } from 'flowbite';
    import { router, usePage } from '@inertiajs/vue3'

    onMounted(() => {
        initFlowbite();
    });

    const props = defineProps({
        visible: {
            type: Boolean,
            required: true
        },
        products: {
            type: Array,
            required: true,
            default: () => []
        }
    }); 

    const emit = defineEmits(['close', 'order-added']);
    const page = usePage();

    const form = ref({
        product_id: null,
        quantity: 1,
        width: 0,
        height: 0,
        unit: '',
        rate_per_unit: 0,
        total_price: 0
    });

    const selectedProduct = computed(() => {
        return props.products.find(
            product => product.id == form.value.product_id
        );
    });

    const incrementQuantity = () => {
        form.value.quantity = (parseInt(form.value.quantity) || 0) + 1;
    };

    const decrementQuantity = () => {
        const currentQty = parseInt(form.value.quantity) || 0;
        if (currentQty > 1) {
            form.value.quantity = currentQty - 1;
        }
    };

    watch(() => form.value.product_id, (newProductId) => {
        const product = props.products.find(p => p.id == newProductId);
        
        if (product) {
            const hasDefaults = product.default_price !== null && 
                               product.default_width !== null && 
                               product.default_height !== null;
            
            if (hasDefaults) {
                
                form.value.width    = product.default_width;
                form.value.height   = product.default_height;
                form.value.unit     = product.default_unit;
                form.value.quantity = 1; 
                
                const defaultArea = product.default_width * product.default_height;
                if (defaultArea > 0) {
                    form.value.rate_per_unit = product.default_price / defaultArea;
                }
                
                computeTotalPrice();
            } else {
                form.value.width         = 0;
                form.value.height        = 0;
                form.value.unit          = product.default_unit || 'feet'; 
                form.value.rate_per_unit = 0;
                form.value.quantity      = 1;
                form.value.total_price   = 0;
            }
        }
    });

    const computeTotalPrice = () => {
        const product = selectedProduct.value;
        if (!product) return;
        
        const width    = parseFloat(form.value.width) || 0;
        const height   = parseFloat(form.value.height) || 0;
        const quantity = parseFloat(form.value.quantity) || 1;
        
        if (product.default_price !== null && 
            product.default_width !== null && 
            product.default_height !== null) {
            
            const defaultArea = product.default_width * product.default_height;
            if (defaultArea > 0) {
                const currentArea = width * height;
                form.value.rate_per_unit = product.default_price / defaultArea;
                form.value.total_price = currentArea * form.value.rate_per_unit * quantity;
            }
        } else {
            const rate = parseFloat(form.value.rate_per_unit) || 0;
            const area = width * height;

            form.value.total_price = area * rate * quantity;
        }
    };

    watch([() => form.value.width, () => form.value.height, () => form.value.quantity, () => form.value.rate_per_unit], () => {
        computeTotalPrice();
    }, { deep: true });


    const handleSubmit = () => {
        router.post(route('admin.orders.create-order'), form.value, {
            preserveScroll: true,
            preserveState: true,
            onSuccess: () => {
                const newOrder = page.props.sessionOrders?.slice(-1)[0];

                if (newOrder) {
                    emit('order-added', newOrder);
                }

                Swal.fire({
                    icon: 'success',
                    title: 'Product added to order successfully',
                    showConfirmButton: false,
                    timer: 1500
                });

                emit('close');
            },
            onError: () => {
                Swal.fire({
                    icon: 'error',
                    title: 'Failed to add product',
                    timer: 1500
                });
            }
        });
    };

    watch(() => props.visible, (newVal) => {
        if (!newVal) {
            form.value = {
                product_id: null,
                quantity: 1,
                width: 0,
                height: 0,
                unit: '',
                rate_per_unit: 0,
                total_price: 0
            };
        }
    });
</script>