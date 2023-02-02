<script setup>
import { reactive } from "vue";
import { router } from '@inertiajs/vue3'

const props = defineProps({
    errors: {
        type: Object,
        default: {}
    }
})
let cartItems = JSON.parse(localStorage.getItem('cart')) || [];
const form = reactive({
    first_name: null,
    last_name: null,
    street_address: null,
    city: null,
    zip_code: null,
    state: null,
    phone: null,
    email: null,
    items: null
})


function submit() {
    let items = JSON.parse(localStorage.getItem('cart')) || null
    if (null !== items) {
        form.items = items;
        router.post('/checkout', form);
        localStorage.removeItem('cart')
    }
}
</script>
<template>
    <div class="bg-white">
        <div class="max-w-2xl mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:max-w-7xl lg:px-8">
            <h2 class="text-xl font-bold text-gray-900">Checkout</h2>
            <form @submit.prevent="submit">
                <div class="col-md-4">
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">First Name:</span>
                        <input type="text" class="form-control" placeholder="First Name" aria-label="First Name" v-model="form.first_name" required>
                        <div v-if="errors.first_name">{{ errors.first_name }}</div>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Last Name:</span>
                        <input type="text" class="form-control" placeholder="Last Name" aria-label="Last Name" v-model="form.last_name" required>
                        <div v-if="errors.last_name">{{ errors.last_name }}</div>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Street Address:</span>
                        <input type="text" class="form-control" placeholder="Street Address" aria-label="Street Address" v-model="form.street_address" required>
                        <div v-if="errors.street_address">{{ errors.street_address }}</div>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">City:</span>
                        <input type="text" class="form-control" placeholder="City" aria-label="City" v-model="form.city" required>
                        <div v-if="errors.city">{{ errors.city }}</div>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">State:</span>
                        <input type="text" class="form-control" placeholder="State" aria-label="State" v-model="form.state">
                        <div v-if="errors.state">{{ errors.state }}</div>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">ZipCode:</span>
                        <input type="text" class="form-control" placeholder="ZipCode" aria-label="ZipCode" v-model="form.zip_code">
                        <div v-if="errors.zip_code">{{ errors.zip_code }}</div>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Email:</span>
                        <input type="text" class="form-control" placeholder="email@address.com" aria-label="Email Address" v-model="form.email" required>
                        <div v-if="errors.email">{{ errors.email }}</div>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Phone Number:</span>
                        <input type="text" class="form-control" placeholder="+1 (XXX) XXX-XXXX" aria-label="Phone Number" v-model="form.phone" required>
                        <div v-if="errors.phone">{{ errors.phone }}</div>
                    </div>
                </div>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th></th>
                        <th></th>
                        <th>#</th>
                        <th>Name</th>
                        <th>x</th>
                    </tr>
                    </thead>
                    <tbody>
                    <template v-for="(item, index) in cartItems" :key="item.id" v-if="cartItems.length > 0">
                        <tr :class="item-`${item.id}`">
                            <td>
                                <img :src="item.image_url" width="25"/>
                            </td>
                            <td>
                                {{ index + 1}}
                            </td>
                            <td>
                                {{ item.name }}
                            </td>
                            <td>
                                <button class="btn btn-danger">Remove</button>
                            </td>
                        </tr>
                    </template>
                    <template v-else>
                        <tr>
                            <td colspan="6">Empty</td>
                        </tr>
                    </template>
                    </tbody>
                </table>
                <button type="submit" class="btn btn-block btn-primary">Submit</button>
            </form>
            <p v-if="errors.length">
                <b>Please correct the following error(s):</b>
            <ul>
                <li v-for="error in errors">{{ error }}</li>
            </ul>
            </p>
        </div>
        <div class="row">
            <div class="lg:grid-cols-4">
                <div class="mt-6">
                    <a href=""
                       class="relative flex bg-gray-100 border border-transparent rounded-md py-2 px-8 items-center justify-center text-sm font-medium text-gray-900 hover:bg-gray-200"
                       @click="submit"
                    >Checkout</a
                    >
                </div>
            </div>
        </div>
    </div>
</template>
