<template>
    <aside class="z-20 hidden w-64 overflow-y-auto bg-white dark:bg-gray-800 md:block flex-shrink-0 bg-gradient-to-t from-green-200 to-blue-600 shadow-lg">
        <div class="py-4 text-white dark:text-gray-400">
            <a class="ml-6 text-lg font-bold text-white dark:text-gray-200 " href="#">
                Auction
            </a>
            <!-- New Menu Start -->
            <ul class="menu py-3">
                <li v-if="role === 'admin'">
                    <router-link :to="{ name: 'admin.home' }" exact-active-class="font-bold text-black dark:text-gray-100" class="border-b-2 border-fuchsia-600">
                        <i class="fa fa-home"></i>
                        <span class="ml-4">Dashboard</span>
                    </router-link>
                </li>
                <li v-if="role === 'admin'">
                    <router-link :to="{ name: 'admin.category.index'}" exact-active-class="font-bold text-black dark:text-white" class="border-b-2 border-fuchsia-600">
                            <i class="fa fa-file-alt"></i>
                            <span class="ml-4">Categories</span>
                    </router-link>
                </li>
                <li v-if="role === 'admin'">
                    <router-link :to="{ name: 'admin.product.index'}" exact-active-class="font-bold text-black dark:text-gray-100" class="border-b-2 border-fuchsia-600">
                        <i class="fa fa-address-book"></i>
                        <span class="ml-4">Products</span>
                    </router-link>
                </li>
                <li v-if="role === 'admin'">
                    <router-link :to="{ name: 'admin.bidders.index'}" exact-active-class="font-bold text-black dark:text-gray-100" class="border-b-2 border-fuchsia-600">
                        <i class="fa fa-users"></i>
                        <span class="ml-4">Bidders</span>
                    </router-link>
                </li>
                <li v-if="role === 'admin'">
                    <router-link :to="{ name: 'admin.auction.create'}" exact-active-class="font-bold text-black dark:text-gray-100" class="border-b-2 border-fuchsia-600">
                        <i class="fa fa-balance-scale"></i>
                        <span class="ml-4">Auctions</span>
                    </router-link>
                    <ul class="menu">
                        <li v-if="role === 'admin'">
                            <router-link :to="{ name: 'admin.auction.past'}" exact-active-class="font-bold text-black dark:text-gray-100" >
                                <i class="fa fa-history"></i>
                                <span class="ml-4">Past Auctions</span>
                            </router-link>
                        </li>
                        <li v-if="role === 'admin'" >
                            <router-link :to="{ name: 'admin.auction.running'}" exact-active-class="font-bold text-black dark:text-gray-100" >
                                <i class="fa fa-hourglass-half"></i>
                                <span class="ml-4">Running Auctions</span>
                            </router-link>
                        </li>
                        <li v-if="role === 'admin'" >
                            <router-link :to="{ name: 'admin.auction.upcoming'}" exact-active-class="font-bold text-black dark:text-gray-100" >
                                <i class="fas fa-external-link-alt"></i>
                                <span class="ml-4">Upcoming Auctions</span>
                            </router-link>
                        </li>
                    </ul>
                </li>
                <li v-if="role === 'bidder'">
                    <router-link :to="{ name: 'bidder.profile.edit'}" exact-active-class="font-bold text-black dark:text-gray-100" class="border-b-2 border-fuchsia-600">
                        <i class="fa fa-cogs"></i>
                        <span class="ml-4">Edit Profile</span>
                    </router-link>
                </li>
                <li v-if="role === 'bidder'">
                    <router-link :to="{ name: 'bidder.bids'}" exact-active-class="font-bold text-black dark:text-gray-100" class="border-b-2 border-fuchsia-600">
                        <i class="fa fa-history"></i>
                        <span class="ml-4">History</span>
                    </router-link>
                </li>
                <li v-if="role === 'bidder'">
                    <router-link :to="{ name: 'bidder.products'}" exact-active-class="font-bold text-black dark:text-gray-100" class="border-b-2 border-fuchsia-600">
                        <i class="fa fa-sitemap"></i>
                        <span class="ml-4">Products</span>
                    </router-link>
                </li>
            </ul>
            <!-- New Menu END -->

        </div>
    </aside>
</template>
<script setup> 
import { ref, computed } from "vue";
import { useStore } from "vuex";
import { onClickOutside } from "@vueuse/core";

const isvisible=ref(false)
const store = useStore();
const role = computed(() => store.state.currentUser ? store.state.currentUser.role : "");

const sidebar = ref(null);
const isSidebarOpen = computed(() => store.getters.getSidebarState);

onClickOutside(sidebar, (event) => {
	store.dispatch("closeSidebar");
});
function closeSidebar() {
    store.dispatch("closeSidebar");
}
// function visible()
// {
//     isvisible.value = !isvalue.value;
    
// }
</script>