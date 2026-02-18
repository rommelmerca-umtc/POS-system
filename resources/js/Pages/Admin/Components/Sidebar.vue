<template>
    <aside
        class="fixed top-0 left-0 z-40 w-52 h-screen pt-14 transition-transform -translate-x-full bg-white border-r border-gray-200 md:translate-x-0 dark:bg-gray-800 dark:border-gray-700"
        aria-label="Sidenav" id="drawer-navigation">
        <div class="overflow-y-auto py-5 px-3 h-full bg-white dark:bg-gray-800">
            <ul class="space-y-2">
                <li>
                    <Link :href="route('admin.dashboard.index')" :class="[
                        'flex items-center p-2 text-base font-medium rounded-lg transition duration-2000 group hover:text-blue-500 hover:border-blue-200 hover:shadow-sm hover:shadow-blue-500/50 transition-all dark:hover:bg-gray-700',
                        route().current('admin.dashboard.index')
                            ? 'text-blue-500 border-blue-200 shadow-sm shadow-blue-500/50'
                            : 'text-gray-900 dark:text-white'
                    ]">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="mr-2 size-4">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                    </svg>

                    <span class="ml-3">Dashboard</span>
                    </Link>
                </li>
                <li>
                    <button type="button"
                        class="flex items-center p-2 w-full text-base font-medium text-gray-900 rounded-lg transition duration-2000 group hover:text-blue-500 hover:border-blue-200 hover:shadow-sm hover:shadow-blue-500/50 transition-all dark:hover:bg-gray-700 dark:text-white "
                        aria-controls="dropdown-pages" data-collapse-toggle="dropdown-pages">
                        <svg aria-hidden="true"
                            class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-2000 group-hover:text-blue-500 dark:text-gray-400 dark:group-hover:text-white"
                            fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="flex-1 ml-3 text-left whitespace-nowrap">
                            Pages
                        </span>
                        <svg aria-hidden="true" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                    <ul id="dropdown-pages" :class="['py-2 space-y-2', isPagesActive ? '' : 'hidden']">
                        <li>
                            <Link :href="route('admin.orders.index')"
                            :class="[
                                'flex items-center p-2 pl-11 w-full text-base font-medium rounded-lg duration-2000 group hover:text-blue-500 hover:border-blue-200 hover:shadow-sm hover:shadow-blue-500/50 transition-all dark:hover:bg-gray-700',
                                route().current('admin.orders.index')
                                    ? 'text-blue-500 border-blue-200 shadow-sm shadow-blue-500/50'
                                    : 'text-gray-900 dark:text-white'
                            ]">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="mr-2 size-4">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M13.5 21v-7.5a.75.75 0 0 1 .75-.75h3a.75.75 0 0 1 .75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349M3.75 21V9.349m0 0a3.001 3.001 0 0 0 3.75-.615A2.993 2.993 0 0 0 9.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 0 0 2.25 1.016c.896 0 1.7-.393 2.25-1.015a3.001 3.001 0 0 0 3.75.614m-16.5 0a3.004 3.004 0 0 1-.621-4.72l1.189-1.19A1.5 1.5 0 0 1 5.378 3h13.243a1.5 1.5 0 0 1 1.06.44l1.19 1.189a3 3 0 0 1-.621 4.72M6.75 18h3.75a.75.75 0 0 0 .75-.75V13.5a.75.75 0 0 0-.75-.75H6.75a.75.75 0 0 0-.75.75v3.75c0 .414.336.75.75.75Z" />
                            </svg>
                            Orders
                            </Link>
                        </li>
                        <li>
                            <Link :href="route('admin.branches.index')"
                            :class="[
                                'flex items-center p-2 pl-11 w-full text-base font-medium rounded-lg duration-2000 group hover:text-blue-500 hover:border-blue-200 hover:shadow-sm hover:shadow-blue-500/50 transition-all dark:hover:bg-gray-700',
                                route().current('admin.branches.index')
                                    ? 'text-blue-500 border-blue-200 shadow-sm shadow-blue-500/50'
                                    : 'text-gray-900 dark:text-white'
                            ]">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="mr-2 size-4">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M13.5 21v-7.5a.75.75 0 0 1 .75-.75h3a.75.75 0 0 1 .75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349M3.75 21V9.349m0 0a3.001 3.001 0 0 0 3.75-.615A2.993 2.993 0 0 0 9.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 0 0 2.25 1.016c.896 0 1.7-.393 2.25-1.015a3.001 3.001 0 0 0 3.75.614m-16.5 0a3.004 3.004 0 0 1-.621-4.72l1.189-1.19A1.5 1.5 0 0 1 5.378 3h13.243a1.5 1.5 0 0 1 1.06.44l1.19 1.189a3 3 0 0 1-.621 4.72M6.75 18h3.75a.75.75 0 0 0 .75-.75V13.5a.75.75 0 0 0-.75-.75H6.75a.75.75 0 0 0-.75.75v3.75c0 .414.336.75.75.75Z" />
                            </svg>
                            Branches
                            </Link>
                        </li>
                        <li>
                            <Link :href="route('admin.sales-reports.index')"
                            :class="[
                                'flex items-center p-2 pl-11 w-full text-base font-medium rounded-lg duration-2000 group hover:text-blue-500 hover:border-blue-200 hover:shadow-sm hover:shadow-blue-500/50 transition-all dark:hover:bg-gray-700',
                                route().current('admin.sales-reports.index')
                                    ? 'text-blue-500 border-blue-200 shadow-sm shadow-blue-500/50'
                                    : 'text-gray-900 dark:text-white'
                            ]">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="mr-2 size-4">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                            Sales Reports
                            </Link>
                        </li>
                        <li>
                            <Link :href="route('admin.transactions-reports.index')" :class="[
                                'flex items-center p-2 pl-11 w-full text-base font-medium rounded-lg duration-2000 group hover:text-blue-500 hover:border-blue-200 hover:shadow-sm hover:shadow-blue-500/50 transition-all dark:hover:bg-gray-700',
                                route().current('admin.transactions-reports.index')
                                    ? 'text-blue-500 border-blue-200 shadow-sm shadow-blue-500/50'
                                    : 'text-gray-900 dark:text-white'
                            ]">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="mr-2 size-4">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                            </svg>
                            Transactions Reports
                            </Link>
                        </li>
                    </ul>
                </li>
            </ul>
            <ul class="pt-5 mt-5 space-y-2 border-t border-gray-200 dark:border-gray-700">
                <li>
                    <Link :href="route('admin.statistics.index')" :class="[
                        'flex items-center p-2 text-base font-medium rounded-lg duration-2000 group hover:text-blue-500 hover:border-blue-200 hover:shadow-sm hover:shadow-blue-500/50 transition-all dark:hover:bg-gray-700',
                        route().current('admin.statistics.index')
                            ? 'text-blue-500 border-blue-200 shadow-sm shadow-blue-500/50'
                            : 'text-gray-900 dark:text-white'
                    ]">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="mr-2 size-4">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M10.5 6a7.5 7.5 0 1 0 7.5 7.5h-7.5V6Z" />
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M13.5 10.5H21A7.5 7.5 0 0 0 13.5 3v7.5Z" />
                    </svg>
                    <span class="ml-3">My Statistics</span>
                    </Link>
                </li>
            </ul>
        </div>
    </aside>
</template>

<script setup>
    import { Link } from '@inertiajs/vue3';

    const isPagesActive =
        route().current('admin.orders.index') ||
        route().current('admin.branches.index') ||
        route().current('admin.sales-reports.index') ||
        route().current('admin.transactions-reports.index');
</script>
