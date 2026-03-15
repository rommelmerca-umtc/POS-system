<template>
    <AdminLayout>
        <div class="h-full overflow-y-auto">
            <ProductsList :products="products" @productRemoved="refreshProductsData"/>
        </div>
    </AdminLayout>
</template>

<script setup>
    import AdminLayout from '../Components/AdminLayout.vue';
    import ProductsList from './Components/ProductsList.vue';
    import { onMounted } from 'vue';
    import { initFlowbite } from 'flowbite';
    import { router, usePage } from '@inertiajs/vue3';

    defineProps({
        products: Array
    });

    onMounted(() => {
        initFlowbite();
    })

    function refreshProductsData() {
        router.visit(route('admin.products.index'), {
            method: 'get',
            preserveState: true,
            replace: true,
            onSuccess: () => {
                Swal.fire({
                    toast: true,
                    icon: "success",
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 3000,
                    title: "Data refreshed!",
                });
            },
        });
    }
</script>
