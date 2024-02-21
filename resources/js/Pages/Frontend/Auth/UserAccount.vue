<template>
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="pr-3">User Account</span></h5>
                <div class="bg-light p-30 mb-5">
                    User Data
                </div>

            </div>
            <div class="col-lg-4">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="pr-3">My Profile</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom">
                        <h6 class="mb-3">Name</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import HomeLayout from "@/FrontendBase/HomeLayout.vue";

export default {
    name: "UserAccount",
    layout: HomeLayout
}
</script>

<style scoped>

</style>
