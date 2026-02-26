<template>
    <AdminLayout>
        <div class="h-full overflow-y-auto">
            <div class="mx-auto max-w-screen-2xl px-4 2xl:px-0">
                <div
                    class="mt-4 shadow-lg shadow-blue-500/20 rounded-lg flex flex-row md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4 bg-white border border-blue-200">
                    <h6 class="text-xl font-extrabold text-blue-900 dark:text-white flex items-center gap-2">
                        <span class="text-gray-400 text-sm flex items-center gap-1">
                            Orders
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="h-4 w-4">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                            </svg>
                        </span>

                        <span>Create Order</span>
                    </h6>
                    <button type="button" @click="handleCreateOrderForm()"
                        class="flex items-center justify-center space-x-2 text-white bg-blue-900 hover:shadow-xl transition duration-150 ease-in-out hover:bg-blue-600 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-500 focus:outline-none dark:focus:ring-blue-800">
                        <span>Create</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-5 h-5 font-extrabold">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M13.5 16.875h3.375m0 0h3.375m-3.375 0V13.5m0 3.375v3.375M6 10.5h2.25a2.25 2.25 0 0 0 2.25-2.25V6a2.25 2.25 0 0 0-2.25-2.25H6A2.25 2.25 0 0 0 3.75 6v2.25A2.25 2.25 0 0 0 6 10.5Zm0 9.75h2.25A2.25 2.25 0 0 0 10.5 18v-2.25a2.25 2.25 0 0 0-2.25-2.25H6a2.25 2.25 0 0 0-2.25 2.25V18A2.25 2.25 0 0 0 6 20.25Zm9.75-9.75H18a2.25 2.25 0 0 0 2.25-2.25V6A2.25 2.25 0 0 0 18 3.75h-2.25A2.25 2.25 0 0 0 13.5 6v2.25a2.25 2.25 0 0 0 2.25 2.25Z" />
                        </svg>
                    </button>
                </div>

                <div class="mt-6 sm:mt-8 md:gap-6 lg:flex lg:items-start xl:gap-8">
                    <div class="mx-auto w-full flex-none lg:max-w-2xl xl:max-w-2xl">
                        <div class="space-y-6" v-if="orders.length > 0">
                            <div v-for="(order, index) in orders" :key="index"
                                class="rounded-lg border border-blue-200 bg-white p-4 shadow-xl shadow-blue-500/20 dark:border-gray-700 dark:bg-gray-800 md:p-6">
                                <div class="space-y-4 md:flex md:items-center md:justify-between md:gap-6 md:space-y-0">
                                    <a href="#" class="shrink-0 md:order-1">
                                        <img class="h-20 w-20 dark:hidden" :src="order.product_image"
                                            alt="product image" />
                                        <img class="hidden h-20 w-20 dark:block" :src="order.product_image"
                                            alt="product image dark mode" />
                                    </a>

                                    <label for="counter-input" class="sr-only">Choose quantity:</label>
                                    <div class="flex items-center justify-between md:order-3 md:justify-end">
                                        <div class="flex items-center">
                                            <button @click="decreaseQuantity(order.id)" type="button" id="decrement-button"
                                                data-input-counter-decrement="counter-input"
                                                class="inline-flex h-5 w-5 shrink-0 items-center justify-center rounded-md border border-gray-300 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700">
                                                <svg class="h-2.5 w-2.5 text-gray-900 dark:text-white"
                                                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 18 2">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2" d="M1 1h16" />
                                                </svg>
                                            </button>
                                            <input type="text" id="counter-input" data-input-counter
                                                class="w-10 shrink-0 border-0 bg-transparent text-center text-sm font-medium text-gray-900 focus:outline-none focus:ring-0 dark:text-white"
                                                placeholder="" :value="order.quantity" required />
                                            <button @click="increaseQuantity(order.id)" type="button" id="increment-button"
                                                data-input-counter-increment="counter-input"
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
                                                ₱{{ formatCurrency(order.total_price) }}
                                            </p>
                                        </div>
                                    </div>

                                    <div class="w-full min-w-0 flex-1 space-y-4 md:order-2 md:max-w-md">
                                        <p href="#"
                                            class="text-base font-medium text-gray-900 hover:underline dark:text-white">
                                            {{ order.product_name }}
                                        </p>
                                        <p class="text-sm font-normal text-gray-500 dark:text-gray-400">
                                            {{ order.product_description }}
                                        </p>

                                        <div class="flex items-center gap-4">
                                            <button @click="removeOrder(order.id)" type="button"
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
                        </div>
                        <div v-else class="mt-6 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-11 items-center p-20">
                            <div class="grid max-w-screen-xl px-4 py-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12">
                                <div class="mr-auto place-self-center lg:col-span-7">
                                    <h1
                                        class="max-w-2xl mb-4 text-4xl font-extrabold tracking-tight leading-none md:text-5xl xl:text-6xl dark:text-white text-blue-800">
                                        No Items yet.
                                    </h1>
                                    <p class="max-w-2xl mb-6 font-light text-gray-500 lg:mb-8 md:text-lg lg:text-xl dark:text-gray-400">
                                        Please add an order item using the Create order button.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mx-auto mt-6 max-w-5xl flex-1 space-y-6 lg:mt-0 lg:w-full shadow-lg shadow-blue-500/20 rounded-lg border border-blue-200 bg-white p-4 dark:border-gray-700 dark:bg-gray-800 sm:p-6 lg:p-8">
                        <div
                            class="space-y-4 rounded-lg border border-blue-200 bg-white p-4 shadow-lg shadow-blue-500/20 dark:border-gray-700 dark:bg-gray-800 sm:p-6">
                            <p class="text-xl font-semibold text-gray-900 dark:text-white">
                                Order summary
                            </p>
                            <div class="space-y-4">
                                <div class="space-y-2">
                                    <dl class="flex items-center justify-between gap-4" v-for="orderItem in orders" :key="orderItem.id">
                                        <dt class="text-base font-normal text-gray-500 dark:text-gray-400">
                                            {{ orderItem.product_name }} (x{{ orderItem.quantity }})
                                        </dt>
                                        <dd class="text-base font-medium text-gray-900 dark:text-white">
                                            ₱{{ formatCurrency(orderItem.total_price) }}
                                        </dd>
                                    </dl>
                                </div>
                                <dl
                                    class="flex items-center justify-between gap-4 border-t border-gray-200 pt-2 dark:border-gray-700">
                                    <dt class="text-base font-bold text-gray-500 dark:text-white">Original Price</dt>
                                    <dd class="text-base font-bold text-gray-900 dark:text-white">₱{{ formatCurrency(totalAmount) }}</dd>
                                </dl>
                                <dl
                                    class="flex items-center justify-between gap-4 border-t border-gray-200 pt-2 dark:border-gray-700">
                                    <dt class="text-base font-bold text-gray-500 dark:text-white">VAT (Value Added Tax 12%)</dt>
                                    <dd class="text-base font-bold text-gray-900 dark:text-white">₱{{ formatCurrency(valueAddedTax) }}</dd>
                                </dl>
                                <dl
                                    class="flex items-center justify-between gap-4 border-t border-gray-200 pt-2 dark:border-gray-700">
                                    <dt class="text-base font-bold text-gray-900 dark:text-white">Final Amount to be Paid</dt>
                                    <dd class="text-lg font-bold text-green-700 dark:text-white">₱{{ formatCurrency(totalAmount + valueAddedTax) }}</dd>
                                </dl>
                            </div>
                            <div class="flex justify-end">
                                <label
                                    class="mt-5 hover:shadow-xl transition duration-150 ease-in-out hover:shadow-blue-200 w-60 inline-flex cursor-pointer p-4 bg-neutral-primary-soft rounded-lg border border-default rounded-base shadow-xs">
                                    <input type="checkbox" name="service_charge" class="sr-only peer" v-model="isServiceCharged">
                                    <div
                                        class="shrink-0 relative w-9 h-5 bg-gray-300 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-brand-soft dark:peer-focus:ring-brand-soft rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-buffer after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-blue-500">
                                    </div>
                                    <div class="ms-5 select-none">
                                        <p class="text-sm font-medium text-heading mb-1">Apply Service Charge?</p>
                                    </div>
                                </label>
                            </div>
                        </div>
                        <div
                            class="space-y-4 rounded-lg border border-blue-200 bg-white p-4 shadow-lg shadow-blue-500/20 dark:border-gray-700 dark:bg-gray-800 sm:p-6">
                            <div class="flex items-center justify-between">
                                <p class="text-xl font-semibold text-gray-900 dark:text-white">
                                    Client Details
                                </p>
                                <button type="button" @click="handleCreateClientForm()"
                                    class="flex items-center justify-center space-x-2 text-white bg-blue-900 hover:shadow-xl transition duration-150 ease-in-out hover:bg-blue-600 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-500 focus:outline-none dark:focus:ring-blue-800">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-5 font-extrabold">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
                                    </svg>
                                </button>
                            </div>
                            <div class="space-y-4">
                                <div class="space-y-2">
                                    <div class="w-full md:w-full">
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
                                                    class="bg-gray-100 border-none text-gray-900 text-lg rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                    placeholder="Search" />
                                            </div>
                                        </form>
                                    </div>
                                    <div v-if="selectedClient != null"
                                        class="space-y-6 rounded-lg border border-none bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                                        <ol class="relative ms-3 border-s border-gray-200 dark:border-gray-700">
                                            <li class="mb-5 ms-6">
                                                <span
                                                    class="absolute -start-3 flex h-6 w-6 items-center justify-center rounded-full bg-orange-100 ring-8 ring-white dark:bg-gray-700 dark:ring-gray-800">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="size-4 text-orange-700">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Zm6-10.125a1.875 1.875 0 1 1-3.75 0 1.875 1.875 0 0 1 3.75 0Zm1.294 6.336a6.721 6.721 0 0 1-3.17.789 6.721 6.721 0 0 1-3.168-.789 3.376 3.376 0 0 1 6.338 0Z" />
                                                    </svg>
                                                </span>
                                                <h4
                                                    class="mb-0.5 text-base font-semibold text-gray-500 dark:text-white">
                                                    Client ID
                                                </h4>
                                                <p class="text-lg font-bold text-orange-500 dark:text-gray-400">
                                                    {{ selectedClient?.client_id }}
                                                </p>
                                            </li>

                                            <li class="mb-5 ms-6">
                                                <span
                                                    class="absolute -start-3 flex h-6 w-6 items-center justify-center rounded-full bg-blue-100 ring-8 ring-white dark:bg-gray-700 dark:ring-gray-800">
                                                   <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="size-4 text-blue-700">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                                    </svg>
                                                </span>
                                                <h4
                                                    class="mb-0.5 text-base font-semibold text-gray-500 dark:text-white">
                                                    Client Name
                                                </h4>
                                                <p class="text-lg font-bold text-blue-500 dark:text-gray-400">
                                                    {{ selectedClient?.first_name }} {{ selectedClient?.last_name }}
                                                </p>
                                            </li>

                                            <li class="mb-5 ms-6">
                                                <span
                                                    class="absolute -start-3 flex h- 6 w-6 items-center justify-center rounded-full bg-green-100 ring-8 ring-white dark:bg-gray-700 dark:ring-gray-800">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="size-4 text-green-700">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M8.25 21v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21m0 0h4.5V3.545M12.75 21h7.5V10.75M2.25 21h1.5m18 0h-18M2.25 9l4.5-1.636M18.75 3l-1.5.545m0 6.205 3 1m1.5.5-1.5-.5M6.75 7.364V3h-3v18m3-13.636 10.5-3.819" />
                                                    </svg>
                                                </span>
                                                <h4
                                                    class="mb-0.5 text-base font-semibold text-gray-500 dark:text-white">
                                                    Client Address
                                                </h4>
                                                <p class="text-lg font-bold text-green-500 dark:text-gray-400">
                                                    {{ selectedClient?.address }}
                                                </p>
                                            </li>
                                            
                                            <li class="mb-5 ms-6">
                                                <span
                                                    class="absolute -start-3 flex h-6 w-6 items-center justify-center rounded-full bg-pink-100 ring-8 ring-white dark:bg-gray-700 dark:ring-gray-800">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="size-4 text-pink-700">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M10.5 1.5H8.25A2.25 2.25 0 0 0 6 3.75v16.5a2.25 2.25 0 0 0 2.25 2.25h7.5A2.25 2.25 0 0 0 18 20.25V3.75a2.25 2.25 0 0 0-2.25-2.25H13.5m-3 0V3h3V1.5m-3 0h3m-3 18.75h3" />
                                                    </svg>
                                                </span>
                                                <h4
                                                    class="mb-0.5 text-base font-semibold text-gray-500 dark:text-white">
                                                    Client Mobile Number
                                                </h4>
                                                <p class="text-lg font-boldl text-pink-500 dark:text-gray-400">
                                                    {{ selectedClient?.phone_number }}
                                                </p>
                                            </li>
                                            
                                            <li class="mb-5 ms-6">
                                                <span
                                                    class="absolute -start-3 flex h-6 w-6 items-center justify-center rounded-full bg-purple-100 ring-8 ring-white dark:bg-gray-700 dark:ring-gray-800">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="size-4 text-purple-700">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M16.5 12a4.5 4.5 0 1 1-9 0 4.5 4.5 0 0 1 9 0Zm0 0c0 1.657 1.007 3 2.25 3S21 13.657 21 12a9 9 0 1 0-2.636 6.364M16.5 12V8.25" />
                                                    </svg>
                                                </span>
                                                <h4
                                                    class="mb-0.5 text-base font-semibold text-gray-500 dark:text-white">
                                                    Client Email Address
                                                </h4>
                                                <p class="text-lg font-bold text-purple-500 dark:text-gray-400">
                                                    {{ selectedClient?.email }}
                                                </p>
                                            </li>
                                        </ol>
                                    </div>
                                    <div v-else
                                        class="space-y-6 rounded-lg border border-none bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
                                        <h4
                                            class="flex justify-center items-center gap-2 mb-0.5 font-semibold text-gray-700 bg-yellow-100 rounded p-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor"
                                                class="w-5 h-5 text-yellow-600 flex-shrink-0">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                                            </svg>
                                            <span class="text-yellow-600">
                                                Please search and select a client or create a new client
                                            </span>
                                        </h4>
                                    </div>
                                    <div class="w-full md:w-full">
                                        <h3 class="mb-4 mt-4 text-xl font-extrabold text-gray-900">
                                            Choose Payment Method:
                                        </h3>
                                        <div class="grid gap-4 mb-4 sm:grid-cols-4">
                                            <div class="flex items-center ps-4 border border-default rounded-base mb-2 rounded-xl transition-all duration-200 hover:shadow-xl hover:shadow-blue-200">
                                                <input id="cash-radio" type="radio" value="cash" name="payment-radio" v-model="selectedPayment"
                                                    class="w-4 h-4 text-neutral-primary border-default-medium bg-neutral-secondary-medium rounded-full checked:border-brand focus:ring-2 focus:outline-none focus:ring-brand-subtle border border-default appearance-none">
                                                <label for="cash-radio"
                                                    class="w-full py-4 select-none ms-2 text-md font-medium text-heading">
                                                    Cash
                                                </label>
                                            </div>
                                            <div class="flex items-center ps-4 border border-default rounded-base mb-2 rounded-xl transition-all duration-200 hover:shadow-xl hover:shadow-blue-200">
                                                <input id="gcash-radio" type="radio" value="gcash" name="payment-radio" v-model="selectedPayment"
                                                    class="w-4 h-4 text-neutral-primary border-default-medium bg-neutral-secondary-medium rounded-full checked:border-brand focus:ring-2 focus:outline-none focus:ring-brand-subtle border border-default appearance-none">
                                                <label for="gcash-radio"
                                                    class="w-full py-4 select-none ms-2 text-md font-medium text-heading">
                                                    GCash
                                                </label>
                                            </div>
                                            <div class="flex items-center ps-4 border border-default rounded-base mb-2 rounded-xl transition-all duration-200 hover:shadow-xl hover:shadow-blue-200">
                                                <input id="qrph-radio" type="radio" value="qrph" name="payment-radio" v-model="selectedPayment"
                                                    class="w-4 h-4 text-neutral-primary border-default-medium bg-neutral-secondary-medium rounded-full checked:border-brand focus:ring-1 focus:outline-none focus:ring-blue-900 border border-default appearance-none">
                                                <label for="qrph-radio"
                                                    class="w-full py-4 select-none ms-2 text-md font-medium text-heading">
                                                    QR PH
                                                </label>
                                            </div>
                                            <div class="flex items-center ps-4 border border-default rounded-base mb-2 rounded-xl transition-all duration-200 hover:shadow-xl hover:shadow-blue-200">
                                                <input id="credit-radio" type="radio" value="credit_card" name="payment-radio" v-model="selectedPayment"
                                                    class="w-4 h-4 text-neutral-primary border-default-medium bg-neutral-secondary-medium rounded-full checked:border-brand focus:ring-2 focus:outline-none focus:ring-brand-subtle border border-default appearance-none">
                                                <label for="credit-radio"
                                                    class="w-full py-4 select-none ms-2 text-md font-medium text-heading">
                                                    Credit Card
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 justify-between">
                                        <div class="flex justify-center ps-4 p-4 border border-default rounded-base mb-2 rounded-xl transition-all duration-200 hover:shadow-xl hover:shadow-blue-200">
                                            <label for="paymentDue" class="text-lg font-medium text-gray-900 dark:text-gray-100 mr-5">
                                                Due on:
                                            </label>
                                            <input
                                                type="date"
                                                id="paymentDue"
                                                v-model="paymentDue"
                                                :disabled="isLoading"
                                                class="py-2 px-4 text-lg font-medium text-gray-900 bg-white rounded-lg border border-gray-200 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600"
                                            />
                                        </div>
                                        <div class="flex justify-center ps-4 p-4 border border-default rounded-base mb-2 rounded-xl transition-all duration-200 hover:shadow-xl hover:shadow-blue-200">
                                            <label for="paymentStatus" class="text-lg font-medium text-gray-900 dark:text-gray-100 mr-5">
                                                   Status:
                                            </label>
                                            <select id="paymentStatus" v-model="paymentStatus"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 text-lg rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                <option :value="null">Select status</option>
                                                <option value="pending">Pending</option>
                                                <option value="paid">Paid</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="grid gap-4 mb-4 sm:grid-cols-2">
                                <button @click="cancelOrder()" type="submit" 
                                    class="transition-all duration-200 shadow-lg shadow-red-200 flex w-full items-center justify-center rounded-lg bg-red-900 px-5 py-2.5 text-lg font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-4 focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                                    Cancel Order
                                </button>
                                <button @click="confirmOrder()" type="submit" 
                                    class="transition-all duration-200 shadow-lg shadow-blue-200 flex w-full items-center justify-center rounded-lg bg-blue-900 px-5 py-2.5 text-lg font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    Confirm Order
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AdminLayout>
    <CreateOrderForm :visible="createOrderFormVisible" :products="products" @close="handleCloseOrderForm" @order-added="handleOrderAdded" />
    <CreateClientForm :visible="createClientFormVisible" @close="handleCloseClientForm" @client-created="handleClientCreated"/>
</template>
<script setup>
    import { onMounted, ref, computed } from 'vue';
    import { initFlowbite } from 'flowbite';
    import AdminLayout from '../../Components/AdminLayout.vue';
    import CreateOrderForm from './CreateOrderForm.vue';
    import { usePage, router } from '@inertiajs/vue3';
    import CreateClientForm from './CreateClientForm.vue'
    
    onMounted(() => {
        initFlowbite();
    });

    const isLoading               = ref(false);
    const createOrderFormVisible  = ref(false);
    const products                = computed(() => usePage().props.products);
    const searchedClient          = computed(() => usePage().props.searchedClient);
    const orders                  = ref(usePage().props.sessionOrders || []);
    const totalAmount             = computed(() => orders.value.reduce((total, order) => total + order.total_price, 0));
    const createClientFormVisible = ref(false)
    const selectedClient          = ref(null)
    const searchQuery             = ref('')
    const selectedPayment         = ref('')
    const paymentDue              = ref('')
    const paymentStatus           = ref('')
    const valueAddedTax           = computed(() => totalAmount.value * 0.12)
    const isServiceCharged        = ref(false)

    const handleCreateOrderForm = () => {
        createOrderFormVisible.value = true;
    };

    const handleCloseOrderForm = () => {
        createOrderFormVisible.value = false;
    };

    const handleOrderAdded = (order) => {
        orders.value.push(order);
    };

    const updateQuantity = (order, newQuantity) => {
        if (newQuantity < 1) return;

        router.post(route('admin.orders.update', order.id), {
            quantity: newQuantity,
        }, {
            preserveState: true,
            preserveScroll: true,
        onSuccess: () => {
            order.quantity  = newQuantity;
            const area = order.width * order.height;

            order.total_price =
                order.rate_per_unit *
                area *
                newQuantity;
            },
        });
    };

    const increaseQuantity = (order_id) => {
        const order = orders.value.find(o => o.id === order_id);
        if (order) {
            updateQuantity(order, order.quantity + 1);
        }
    };

    const decreaseQuantity = (order_id) => {
        const order = orders.value.find(o => o.id === order_id);
        if (order) {
            updateQuantity(order, order.quantity - 1);
        }
    };

    const removeOrder = (order_id) => {
        const order = orders.value.find(o => o.id === order_id);
        if (order) {
            router.delete(route('admin.orders.remove-order', order.id), {
                preserveState: true,
                preserveScroll: true,
                onSuccess: () => {
                    orders.value = orders.value.filter(o => o.id !== order_id);
                    Swal.fire({
                        toast: true,
                        icon: "success",
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 3000,
                        title: "Item removed from orders successfully!",
                    });
                },
            });
        }
    };

    const formatCurrency = (value) => {
        return value.toLocaleString('en-PH', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        });
    };

    const handleCreateClientForm = () => {
        createClientFormVisible.value = true
    }

    const handleCloseClientForm = () => {
        createClientFormVisible.value = false
    }

    const handleClientCreated = (client) => {
        selectedClient.value = client

        console.log('Client received in parent:', client)
        console.log(selectedClient.value)
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

        router.visit(route('admin.orders.search-client'), {
            method: 'get',
            data: { search: searchQuery.value },
            preserveState: true,
            replace: true,
            onSuccess: () => {
                isLoading.value = false;
                console.log
                selectedClient.value = searchedClient.value
            },
            onFinish: () => {
                isLoading.value = false;
            },
        });
    }

    function confirmOrder() {
        if (!selectedClient.value) {
            Swal.fire({
                icon: "warning",
                title: "Please select a client first."
            });
            return;
        }

        if (!selectedPayment.value) {
            Swal.fire({
                icon: "warning",
                title: "Please select a payment method."
            });
            return;
        }

        if (!paymentStatus.value) {
            Swal.fire({
                icon: "warning",
                title: "Please select payment status."
            });
            return;
        }

        isLoading.value = true;

        router.post(route('admin.orders.confirm-order'), {
            client_id: selectedClient.value.client_id,
            payment_method: selectedPayment.value,
            payment_due: paymentDue.value,
            payment_status: paymentStatus.value,
            is_service_charged: isServiceCharged.value
        }, {
            preserveScroll: true,
            onSuccess: () => {
                Swal.fire({
                    toast: true,
                    icon: "success",
                    position: "top-center",
                    showConfirmButton: false,
                    timer: 3000,
                    title: "Order created successfully!",
                });

                orders.value          = [];
                selectedClient.value  = null;
                selectedPayment.value = '';
                paymentDue.value      = '';
                paymentStatus.value   = '';

                router.visit(route('admin.orders.index'));
            },
            onError: () => {
                Swal.fire({
                    icon: "error",
                    title: "Failed to create order"
                });
            },

            onFinish: () => {
                isLoading.value = false;
            }
        });
    }
</script>