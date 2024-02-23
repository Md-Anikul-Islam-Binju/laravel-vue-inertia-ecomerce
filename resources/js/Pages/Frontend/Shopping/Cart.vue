<template>
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0">
                    <thead class="thead-dark">
                    <tr>
                        <th>Products</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Remove</th>
                    </tr>
                    </thead>
                    <tbody class="align-middle">
                        <tr v-for="cartProduct in cart" :key="cartProduct.id">
                            <td class="align-middle"><img :src="cartProduct.image" alt="" style="width: 50px;"> {{cartProduct.name}}</td>
                            <td class="align-middle">{{cartProduct.price}} Tk</td>

                            <td class="align-middle">
                                <a @click="decrement(cartProduct)" class="btn btn-sm btn-secondary">-</a>
                                {{cartProduct.quantity}}
                                <a @click="increment(cartProduct)" class="btn btn-sm btn-primary">+</a>
                            </td>

                            <td class="align-middle">{{ cartProduct.price * cartProduct.quantity }} Tk</td>
                            <td class="align-middle">
                                <Link :href="`/remove-to-cart/${cartProduct.id}`" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></Link>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                <form class="mb-30" action="">
                    <div class="input-group">
                        <input type="text" class="form-control border-0 p-4" placeholder="Coupon Code">
                        <div class="input-group-append">
                            <button class="btn btn-primary">Apply Coupon</button>
                        </div>
                    </div>
                </form>
                <h5 class="section-title position-relative text-uppercase mb-3"><span class=" pr-3">Cart Summary</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h6>Subtotal</h6>
                            <h6>{{ subtotal }}</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Shipping</h6>
                            <h6 class="font-weight-medium">100 Tk</h6>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total</h5>
                            <h5>{{ total }}</h5>
                        </div>
                        <div v-if="!user">
                            <Link href="/user-login" class="btn btn-block btn-primary font-weight-bold my-3 py-3">Proceed To Checkout</Link>
                        </div>
                        <div v-else>
                            <Link href="/checkout" class="btn btn-block btn-primary font-weight-bold my-3 py-3">Proceed To Checkout</Link>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import HomeLayout from "@/FrontendBase/HomeLayout.vue";
import {Link} from "@inertiajs/vue3";

export default {
    name: "Cart",
    layout: HomeLayout,
    props: {
        cart: Object,
        user:Object
    },
    components: {
        Link
    },
    computed: {
        subtotal() {
            console.log('Cart:', this.cart);
            if (!this.cart || typeof this.cart !== 'object') {
                console.log('Cart:', this.cart);
                return 0;
            }
            const cartArray = Object.values(this.cart);
            return cartArray.reduce((total, cartProduct) => {
                return total + (cartProduct.price * cartProduct.quantity);
            }, 0).toFixed(2);
        },
        total() {
            return (parseFloat(this.subtotal) + 100).toFixed(2); // Assuming fixed shipping for now
        }
    },
    methods: {
        increment(cartProduct) {
            cartProduct.quantity++;
            this.updateQuantity(cartProduct);
        },
        decrement(cartProduct) {
            if (cartProduct.quantity > 1) {
                cartProduct.quantity--;
                this.updateQuantity(cartProduct);
            }
        },
        updateQuantity(cartProduct) {
            // Make a GET request to update the cart quantity
            fetch(`/update-cart-quantity/${cartProduct.id}?quantity=${cartProduct.quantity}`, { method: 'GET' })
                .then(response => {
                    // Handle success if needed
                })
                .catch(error => {
                    console.error('Error updating quantity:', error);
                    // Handle error if needed
                });
        },
    }
}
</script>

<style scoped>

</style>
