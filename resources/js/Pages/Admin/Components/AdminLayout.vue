<template>
    <div class="antialiased bg-gray-50 dark:bg-gray-900 h-screen">
        <Navbar />
        <Sidebar />

        <main class="md:ml-52 pt-20 h-full flex flex-col">
            <div class="flex-1 overflow-hidden">
                <div class="h-full overflow-y-auto p-4">
                    <slot />
                </div>
            </div>
            <Footer />
        </main>

    </div>

</template>

<script setup>
    import { onMounted } from 'vue';
    import { initFlowbite } from 'flowbite';
    import Navbar from './Navbar.vue';
    import Sidebar from './Sidebar.vue';
    import Footer from './Footer.vue';

    onMounted(() => {
        initFlowbite();
    })
</script>
