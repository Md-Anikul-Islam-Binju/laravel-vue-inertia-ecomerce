<template>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Order Details Tables</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Order Details Tables</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">User Info</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>{{ order.user.name }}</td>
                                    <td>{{ order.user.email }}</td>
                                    <td>{{ order.user.phone }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Shipping Info</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>{{ order.shipping_info.name }}</td>
                                    <td>{{ order.shipping_info.email }}</td>
                                    <td>{{ order.shipping_info.mobile_no }}</td>
                                    <td>{{ order.shipping_info.address }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Order</h3>
                        </div>
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Product Name</th>
                                    <th>Qty</th>
                                    <th>Subtotal</th>
                                    <th>Shipping Cost</th>
                                    <th>Total</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="orderList in order.items" :key="orderList.id">
                                    <td>{{ orderList.id }}</td>
                                    <td>{{ orderList.product_name }}</td>
                                    <td>{{ orderList.quantity }}</td>
                                    <td>{{ orderList.quantity * orderList.price }}</td>
                                    <td>100</td>
                                    <td>{{  orderList.quantity * orderList.price + 100 }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</template>

<script>
import AdminLayout from "@/AdminBase/AdminLayout.vue";

export default {
    name: "Manage",
    layout:AdminLayout,
    props:{
        order:Object,
    },
    mounted() {
        console.log(this.order)
    }
}
</script>

<style scoped>

</style>
