<template>
    <aside class="z-20 hidden w-64 overflow-y-auto bg-white dark:bg-gray-800 md:block flex-shrink-0 bg-gradient-to-t from-green-200 to-blue-600 shadow">
        <div class="py-4 text-white dark:text-gray-400">
            <a class="ml-6 text-lg font-bold text-white dark:text-gray-200 " href="#">
                Auction
            </a>
            <ul class="mt-6 menu">
                <li v-if="role === 'admin'" class="relative px-6 py-3 font-semibold">
                    <router-link :to="{ name: 'admin.home' }" exact-active-class="font-bold text-black dark:text-gray-100" class="border-b-2 border-fuchsia-600">
                        <a class="inline-flex items-center w-full text-sm  transition-colors duration-150 hover:text-black dark:hover:text-gray-200 ">
                            <svg
                                class="w-5 h-5"
                                aria-hidden="true"
                                fill="none"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"
                                ></path>
                            </svg>
                            <span class="ml-4">Dashboard</span>
                        </a>
                    </router-link>
                </li>
                <li v-if="role === 'admin'" class="relative px-6 py-3 font-semibold ">
                    <router-link :to="{ name: 'admin.category.index'}" exact-active-class="font-bold text-black dark:text-white" class="border-b-2 border-fuchsia-600">
                        <a class="inline-flex items-center w-full text-sm  transition-colors duration-150 hover:text-black dark:hover:text-gray-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            <span class="ml-4">Categories</span>
                        </a>
                    </router-link>
                </li>
                 <li v-if="role === 'admin'" class="relative px-6 py-3 font-semibold">
                    <router-link :to="{ name: 'admin.product.index'}" exact-active-class="font-bold text-black dark:text-gray-100" class="border-b-2 border-fuchsia-600">
                        <a class="inline-flex items-center w-full text-sm  transition-colors duration-150 hover:text-black dark:hover:text-gray-200">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"
                                />
                            </svg>
                            <span class="ml-4">Products</span>
                        </a>
                    </router-link>
                </li>
                <ol class="relative px-6 py-3 font-semibold menu">
                    <router-link :to="{ name: 'admin.auction.create'}" exact-active-class="font-bold text-black dark:text-gray-100" class="border-b-2 border-fuchsia-600">
                        <a class="inline-flex items-center w-full text-sm  transition-colors duration-150 hover:text-black dark:hover:text-gray-200">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"
                                />
                            </svg>
                            <span class="ml-4">Auctions</span>
                        </a>
                    </router-link>
                    
                    <li v-if="role === 'admin'"  class="relative px-6 py-3 font-semibold">
                    <router-link :to="{ name: 'admin.auction.past'}" exact-active-class="font-bold text-black dark:text-gray-100" class="border-b-2 border-fuchsia-600">
                        <a class="inline-flex items-center w-full text-sm  transition-colors duration-150 hover:text-black dark:hover:text-gray-200">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"
                                />
                            </svg>
                            <span class="ml-4">Past Auctions</span>
                        </a>
                    </router-link>
                </li>
                <li v-if="role === 'admin'" class="relative px-6 py-3 font-semibold">
                    <router-link :to="{ name: 'admin.auction.running'}" exact-active-class="font-bold text-black dark:text-gray-100" class="border-b-2 border-fuchsia-600">
                        <a class="inline-flex items-center w-full text-sm  transition-colors duration-150 hover:text-black dark:hover:text-gray-200">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"
                                />
                            </svg>
                            <span class="ml-4">Running Auctions</span>
                        </a>
                    </router-link>
                </li>
                <li v-if="role === 'admin'" class="relative px-6 py-3 font-semibold">
                    <router-link :to="{ name: 'admin.auction.upcoming'}" exact-active-class="font-bold text-black dark:text-gray-100" class="border-b-2 border-fuchsia-600">
                        <a class="inline-flex items-center w-full text-sm  transition-colors duration-150 hover:text-black dark:hover:text-gray-200">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"
                                />
                            </svg>
                            <span class="ml-4">Upcoming Auctions</span>
                        </a>
                    </router-link>
                </li>
            </ol>
                
            </ul>
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