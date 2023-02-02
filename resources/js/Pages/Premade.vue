<script setup>
import {reactive, ref} from "vue";

const props = defineProps({
    donuts: {
        type: Object,
        default: {}
    },
})

let cartItems = ref(JSON.parse(localStorage.getItem('cart')) || []);

function addToCart(item) {
    let values = cartItems._value;
    values.push(item);
    cartItems._value = values;
    cartItems._rawValue = values;
    localStorage.setItem('cart', JSON.stringify(cartItems._value));
}

function buyNow(id) {

}
</script>
<template>
    <div class="bg-white">
        <div class="max-w-2xl mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:max-w-7xl lg:px-8">
            <h2 class="text-xl font-bold text-gray-900">Our Premade Donuts</h2>

            <div class="mt-8 grid grid-cols-1 gap-y-12 sm:grid-cols-2 sm:gap-x-6 lg:grid-cols-4 xl:gap-x-8">
                <div v-for="donut in donuts" :key="donut.id">
                    <div class="relative">
                        <div class="relative w-full h-72 rounded-lg overflow-hidden">
                            <img :src="donut.image_url" alt="donut" class="w-full h-full object-center object-cover" />
                        </div>
                        <div class="relative mt-4">
                            <h3 class="text-sm font-medium text-gray-900">{{ donut.name }}</h3>
                        </div>
                        <div class="absolute top-0 inset-x-0 h-72 rounded-lg p-4 flex items-end justify-end overflow-hidden">
                            <div aria-hidden="true" class="absolute inset-x-0 bottom-0 h-36 bg-gradient-to-t from-black opacity-50" />
                        </div>
                    </div>
                    <div class="mt-6">
                        <div class="relative flex btn-group" role="group" aria-label="Basic example">
                            <button type="button" class="btn btn-secondary" @click="addToCart(donut)">Add to Cart</button>
                            <button type="button" class="btn btn-primary" @click="buynow(id)">Buy Now</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="lg:grid-cols-4">
                <div class="mt-6">
                    <a href="" class="relative flex bg-gray-100 border border-transparent rounded-md py-2 px-8 items-center justify-center text-sm font-medium text-gray-900 hover:bg-gray-200"
                       @click="checkout"
                    >View Cart</a
                    >
                </div>
            </div>
        </div>
    </div>
</template>
