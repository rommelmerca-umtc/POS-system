<template>
    <AdminLayout>
        <div class="h-full overflow-y-auto">
            <OrderingPage :orders="orders" />
        </div>
    </AdminLayout>
</template>

<script setup>
    import AdminLayout from '../Components/AdminLayout.vue';
    import { onMounted } from 'vue';
    import { initFlowbite } from 'flowbite';
    import OrderingPage from './Components/OrderingPage.vue';

    defineProps({
        orders: Object
    });

    onMounted(() => {
        initFlowbite();
    })
</script>
