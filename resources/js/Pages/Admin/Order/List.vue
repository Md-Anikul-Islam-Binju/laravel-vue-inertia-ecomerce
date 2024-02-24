<template>
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Order List</h1>
                </div>
            </div>
        </div>
    </section>
    <!-- Main content -->
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
                                    <th>User Name</th>
                                    <th>User Phone</th>
                                    <th>Total</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="order in orderList" :key="order.id">
                                    <td>{{ order.id }}</td>
                                    <td>{{ order.user.name }}</td>
                                    <td>{{ order.user.phone }}</td>
                                    <td>{{ order.total }}</td>
                                    <td>
                                        <Link class="btn btn-primary btn-sm mr-1" :href="`/order-manage/${order.id}`">View</Link>
                                    </td>
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
import {Link} from "@inertiajs/vue3";

export default {
    name: "List",
    layout: AdminLayout,
    props:{
        orderList:Object,
    },
    components: {
        Link
    },
}
</script>

<style scoped>

</style>
