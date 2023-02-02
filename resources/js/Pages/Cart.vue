<script setup>
import {reactive} from "vue";

const props = defineProps({})
let cartItems = reactive(JSON.parse(localStorage.getItem('cart')) || []);

function removeItem(index) {
    cartItems.splice(index, 1);
    localStorage.setItem('cart', JSON.stringify(cartItems))
}


</script>
<template>
    <div class="bg-white">
        <div class="max-w-2xl mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:max-w-7xl lg:px-8">
            <h2 class="text-xl font-bold text-gray-900">Cart</h2>

            <table class="table table-striped">
                <thead>
                <tr>
                    <th></th>
                    <th>Name</th>
                    <th>x</th>
                </tr>
                </thead>
                <tbody>
                <template v-for="(item, index) in cartItems" :key="item.id" v-if="cartItems.length > 0">
                    <tr :class="item-`${item.id}`">
                        <td>
                            <img :src="item.image_url" width="50"/>
                        </td>
                        <td>
                            {{ item.name }}
                        </td>
                        <td>
                            <button class="btn btn-danger" @click="removeItem(index)">Remove</button>
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
        </div>
        <div class="row">
            <div class="lg:grid-cols-4">
                <div class="mt-6">
                    <a href="/checkout"
                       class="relative flex bg-gray-100 border border-transparent rounded-md py-2 px-8 items-center justify-center text-sm font-medium text-gray-900 hover:bg-gray-200"
                    >Checkout</a
                    >
                </div>
            </div>
        </div>
    </div>
</template>
