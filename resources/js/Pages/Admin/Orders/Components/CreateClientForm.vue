<template>
    <section v-if="visible" class="fixed inset-0 z-50 flex items-center justify-center bg-black/40">
        <div class="bg-white w-full max-w-lg rounded-xl shadow-xl p-6 space-y-6">
            <div class="flex justify-between items-center">
                <h2 class="text-xl font-bold text-blue-900">Create Client</h2>
                <button @click="$emit('close')"
                    class="text-gray-500 p-1.5 rounded transition-all duration-200 hover:bg-red-500 hover:text-white">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <span class="sr-only">Close menu</span>
                </button>
            </div>

            <form @submit.prevent="submitClient()">
                <div class="grid gap-4 mb-4 sm:grid-cols-2">
                    <div>
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            First Name <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="name" id="name" v-model="form.client_firstname"
                            @input="clearError('client_firstname')"
                            :class="['bg-gray-50 border text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5', 
                                errors.client_firstname ? 'border-red-500' : 'border-gray-300']"
                            placeholder="ex. Juan">
                        <p v-if="errors.client_firstname" class="mt-1 text-xs text-red-600">{{ errors.client_firstname }}</p>
                    </div>
                    
                    <div>
                        <label for="brand" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Last Name <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="brand" id="brand" v-model="form.client_lastname"
                            @input="clearError('client_lastname')"
                            :class="['bg-gray-50 border text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5', 
                                errors.client_lastname ? 'border-red-500' : 'border-gray-300']"
                            placeholder="ex. Dela Cruz">
                        <p v-if="errors.client_lastname" class="mt-1 text-xs text-red-600">{{ errors.client_lastname }}</p>
                    </div>
                    
                    <div>
                        <label for="mobile" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Mobile Number <span class="text-red-500">*</span>
                        </label>
                        <input type="tel" name="mobile" id="mobile" v-model="form.client_mobile_number"
                            @input="clearError('client_mobile_number')"
                            :class="['bg-gray-50 border text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5', 
                                errors.client_mobile_number ? 'border-red-500' : 'border-gray-300']"
                            placeholder="ex. 09123456789"
                            maxlength="11">
                        <p v-if="errors.client_mobile_number" class="mt-1 text-xs text-red-600">{{ errors.client_mobile_number }}</p>
                    </div>
                    
                    <div>
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Email Address <span class="text-red-500">*</span>
                        </label>
                        <input type="email" name="email" id="email" v-model="form.client_email"
                            @input="clearError('client_email')"
                            :class="['bg-gray-50 border text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5', 
                                errors.client_email ? 'border-red-500' : 'border-gray-300']"
                            placeholder="ex. johndoe@example.com">
                        <p v-if="errors.client_email" class="mt-1 text-xs text-red-600">{{ errors.client_email }}</p>
                    </div>
                    
                    <div class="sm:col-span-2">
                        <label for="address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Address <span class="text-red-500">*</span>
                        </label>
                        <textarea id="address" rows="5" v-model="form.client_address"
                            @input="clearError('client_address')"
                            :class="['block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border focus:ring-primary-500 focus:border-primary-500', 
                                errors.client_address ? 'border-red-500' : 'border-gray-300']"
                            placeholder="Write an address..."></textarea>
                        <p v-if="errors.client_address" class="mt-1 text-xs text-red-600">{{ errors.client_address }}</p>
                    </div>
                </div>

                <!-- Display general error message -->
                <div v-if="errors.general" class="mb-4 p-3 bg-red-100 border border-red-400 text-red-700 rounded-lg text-sm">
                    {{ errors.general }}
                </div>

                <div class="flex items-center space-x-4">
                    <button type="submit" :disabled="isSubmitting"
                        class="text-white transition-all duration-200 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center disabled:opacity-50 disabled:cursor-not-allowed">
                        <span v-if="isSubmitting" class="flex items-center">
                            <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            Creating...
                        </span>
                        <span v-else>Create Client</span>
                    </button>
                    
                    <button type="button" @click="cancelForm"
                        class="text-red-600 inline-flex items-center transition-all duration-200 hover:text-white border border-red-600 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="mr-1 -ml-1 w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5m6 4.125 2.25 2.25m0 0 2.25 2.25M12 13.875l2.25-2.25M12 13.875l-2.25 2.25M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
                        </svg>
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </section>
</template>

<script setup>
    import { reactive, ref } from 'vue'
    import { router, usePage } from '@inertiajs/vue3'

    const page = usePage()
    const props = defineProps({
        visible: Boolean
    })

    const emit = defineEmits(['close', 'client-created'])

    const isSubmitting = ref(false)
    const errors = reactive({
        client_firstname: '',
        client_lastname: '',
        client_mobile_number: '',
        client_email: '',
        client_address: '',
        general: ''
    })

    const form = reactive({
        client_firstname: '',
        client_lastname: '',
        client_mobile_number: '',
        client_email: '',
        client_address: ''
    })

    const clearError = (field) => {
        errors[field]  = ''
        errors.general = ''
    }

    const validateForm = () => {
        let isValid = true
        
        Object.keys(errors).forEach(key => errors[key] = '')
        
        if (!form.client_firstname?.trim()) {
            errors.client_firstname = 'First name is required'
            isValid = false
        } else if (form.client_firstname.length < 2) {
            errors.client_firstname = 'First name must be at least 2 characters'
            isValid = false
        }
        
        if (!form.client_lastname?.trim()) {
            errors.client_lastname = 'Last name is required'
            isValid = false
        } else if (form.client_lastname.length < 2) {
            errors.client_lastname = 'Last name must be at least 2 characters'
            isValid = false
        }
        
        const mobileRegex = /^(09|\+639)\d{9}$/
        if (!form.client_mobile_number?.trim()) {
            errors.client_mobile_number = 'Mobile number is required'
            isValid = false
        } else if (!mobileRegex.test(form.client_mobile_number.replace(/\s/g, ''))) {
            errors.client_mobile_number = 'Please enter a valid Philippine mobile number (e.g., 09123456789 or +639123456789)'
            isValid = false
        }
        
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/
        if (!form.client_email?.trim()) {
            errors.client_email = 'Email address is required'
            isValid = false
        } else if (!emailRegex.test(form.client_email)) {
            errors.client_email = 'Please enter a valid email address'
            isValid = false
        }
        
        if (!form.client_address?.trim()) {
            errors.client_address = 'Address is required'
            isValid = false
        } else if (form.client_address.length < 5) {
            errors.client_address = 'Address must be at least 5 characters'
            isValid = false
        }
        
        return isValid
    }

    const submitClient = () => {
        if (!validateForm()) {
            return
        }

        isSubmitting.value = true
        
        router.post(route('admin.orders.client-create'), form, {
            preserveScroll: true,
            onSuccess: () => {
                const client = usePage().props.flash?.createdClient
                emit('client-created', client)
                
                Swal.fire({
                    toast: true,
                    icon: "success",
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 3000,
                    title: "Client Created Successfully!",
                });

                form.client_firstname     = ''
                form.client_lastname      = ''
                form.client_mobile_number = ''
                form.client_email         = ''
                form.client_address       = ''
                
                Object.keys(errors).forEach(key => errors[key] = '')
                
                emit('close')
                isSubmitting.value = false
            },
            onError: (serverErrors) => {
                if (serverErrors) {
                    Object.keys(serverErrors).forEach(key => {
                        if (errors.hasOwnProperty(key)) {
                            errors[key] = serverErrors[key][0] || serverErrors[key]
                        } else {
                            errors.general = 'An error occurred. Please try again.'
                        }
                    })
                }
                isSubmitting.value = false
            },
            onFinish: () => {
                isSubmitting.value = false
            }
        })
    }

    const cancelForm = () => {
        form.client_firstname     = ''
        form.client_lastname      = ''
        form.client_mobile_number = ''
        form.client_email         = ''
        form.client_address       = ''
        
        Object.keys(errors).forEach(key => errors[key] = '')
        
        emit('close')
    }
</script>