<template>
    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="#">Home</a>
                    <a class="breadcrumb-item text-dark" href="#">Shop</a>
                    <span class="breadcrumb-item active">Checkout</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->


    <!-- Checkout Start -->
    <div class="container-fluid">
        <form @submit.prevent="checkoutComplete">
        <div class="row px-xl-5">
            <div class="col-lg-8">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="pr-3">Billing Address</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="row">
                        <div class="col-md-12 form-group">
                            <label>Name</label>
                            <input class="form-control" type="text" v-model="form.name"  placeholder="Your Name">
                        </div>

                        <div class="col-md-6 form-group">
                            <label>E-mail</label>
                            <input class="form-control" type="text" v-model="form.email" placeholder="example@email.com">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Mobile No</label>
                            <input class="form-control" type="text" v-model="form.mobile_no" placeholder="+123 456 789">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Address</label>
                            <input class="form-control" type="text" v-model="form.address" placeholder="123 Street">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class=" pr-3">Order Total</span></h5>
                <div class="bg-light p-30 mb-5">
                    <table class="table table-light table-borderless table-hover text-center mb-0">
                        <thead class="thead-dark">
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                        </tr>
                        </thead>
                        <tbody class="align-middle">
                        <tr v-for="cartProduct in cart" :key="cartProduct.id">
                            <td class="align-middle"><img :src="cartProduct.image" alt="" style="width: 50px;"></td>
                            <td class="align-middle"> {{cartProduct.name}}</td>
                            <td class="align-middle">{{cartProduct.price}} Tk</td>
                            <td class="align-middle">

                                {{cartProduct.quantity}}
                            </td>
                            <td class="align-middle">{{ cartProduct.price * cartProduct.quantity }} Tk</td>
                        </tr>
                        </tbody>
                    </table>




                    <div class="border-bottom pt-3 pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h6>Subtotal</h6>
                            <h6>{{ orderSubtotal }}Tk</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Shipping</h6>
                            <h6 class="font-weight-medium">100 Tk</h6>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total</h5>
                            <h5>{{ orderSubtotal+100 }}Tk</h5>
                        </div>
                    </div>
                </div>
                <div class="mb-5">
                    <h5 class="section-title position-relative text-uppercase mb-3"><span class=" pr-3">Payment</span></h5>
                    <div class="bg-light p-30">
                        <div class="form-group">
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" v-model="form.payment_method" value="cod" id="paypal">
                                <label class="custom-control-label" for="paypal">Hand Cash</label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-block btn-primary font-weight-bold py-3">Place Order</button>
                    </div>
                </div>
            </div>
        </div>
        </form>
    </div>
    <!-- Checkout End -->
</template>

<script>


import HomeLayout from "@/FrontendBase/HomeLayout.vue";
import {Link} from "@inertiajs/vue3";

export default {
    name: "Checkout",
    layout: HomeLayout,
    props:{
        cart:Object,
        orderSubtotal:Object,
    },
    data(){
        return{
            form:this.$inertia.form({
                name:null,
                email:null,
                mobile_no:null,
                address:null,
                payment_method:null,
            })
        }
    },

    methods:{
        checkoutComplete(){
            this.form.post("/order-confirm");
        }
    },
    components: {
        Link
    },
}
</script>

<style scoped>

</style>
