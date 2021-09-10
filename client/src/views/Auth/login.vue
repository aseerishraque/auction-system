<template>
    <section class="flex flex-col items-center h-screen md:flex-row bg-gray-100">
        <div class="flex items-center justify-center w-full px-6 md:max-w-md lg:max-w-full md:mx-auto md:w-1/2 xl:w-1/3 lg:px-16 xl:px-4">
            <div class="w-full h-100 bg-white px-8 py-6 rounded-lg shadow-lg">
                <a class="flex items-center w-32 mb-4 font-medium text-gray-900 title-font md:mb-0">
                    <div class="w-2 h-2 p-2 mr-2 rounded-full bg-gradient-to-tr from-blue-300 to-blue-600">
                    </div>
                    <h2 class="text-lg font-bold tracking-tighter text-black uppercase duration-300 ease-in-out transform transition hover:text-blue-500 dark:text-gray-400"> Auction </h2>
                </a>
                <router-link :to="{name: 'visitor.home'}">
                    <button type="submit" class="btn bg-black rounded-md mr-10 mt-10">Back to Home Page</button> 
                </router-link>
                <h1 class="mt-10 text-xl font-semibold text-black tracking-ringtighter sm:text-2xl title-font">Sign in to your account</h1>
                <form class="mt-6" @submit.prevent="login(user)">
                    <div>
                        <label class="mb-1 block text-sm font-medium leading-relaxed tracking-tighter text-gray-700">Email Address</label>
                        <input type="email" v-model="user.email" required placeholder="Your Email" class="w-full px-4 py-2 text-base text-black transition duration-300 ease-in-out transform border-transparent rounded-lg bg-gray-100 focus:border-gray-500 focus:bg-white focus:outline-none focus:ring-2 ring-offset-2">
                    </div>
                    <div class="mt-4">
                        <label class="mb-1 block text-sm font-medium leading-relaxed tracking-tighter text-gray-700">Password</label>
                        <input type="password" v-model="user.password" required minlength="6" placeholder="Your Password" class="w-full px-4 py-2 text-base text-black transition duration-300 ease-in-out transform border-transparent rounded-lg bg-gray-100 focus:border-gray-500 focus:bg-white focus:outline-none focus:ring-2 ring-offset-2" >
                    </div>
                    <button type="submit" class="flex justify-center items-center w-full px-4 py-3 mt-6 font-semibold text-white transition duration-300 ease-in-out transform bg-black rounded-lg hover:bg-gray-700 active:bg-black focus:shadow-outline focus:outline-none focus:ring-2 focus:ring-black ring-offset-2">
                        <span v-if="!is_loading">Log In</span> 
                        <span v-else>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 animate-spin" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd"/>
                            </svg>
                        </span>
                    </button>
                </form>

                <hr v-if="errors" class="w-full my-6 border-gray-300">

                <div v-if="errors" class="mt-4 px-3 py-2 w-full rounded text-sm text-red-500 bg-red-100 animate-pulse">
                    <p class="font-semibold tracking-wide">
                        <strong>Error:</strong> {{ errors.message }}
                    </p>
                    <ul class="mt-1 ml-2 list-disc list-inside">
                        <li v-for="allErrors in errors.errors" :key="allErrors">
                            <span v-for="errorKeys in allErrors" :key="errorKeys">
                                <span v-for="errorMessage in errorKeys" :key="errorMessage">
                                    {{ errorMessage }}
                                </span> 
                            </span>
                        </li>
                    </ul>
                </div>

                <hr class="w-full my-6 border-gray-300">

                <p class="mt-8 text-center">
                    Need an account?
                    <router-link :to="{ name: 'auth.register'}" class="font-semibold text-blue-500  hover:text-blue-700">
                        Sign Up
                    </router-link>
                </p>
            </div>
        </div>
    </section>
</template>

<script>
import {ref} from "vue";
import {useStore} from "vuex";
import {useRouter} from "vue-router";

export default {
    setup() {
        const user = ref({
            email: "admin@admin.com",
            password: "secret",
        });
		const is_loading = ref(false);
        const errors = ref(null);

        const store = useStore();
        const router = useRouter();

        // function to handle the login
        function login(user) {
			is_loading.value = true;

			store.dispatch("login", user)
            .then(() => {
                store.dispatch("getCurrentUser")
                .then((current_user_response) => {
                   const ROLE = current_user_response.data.role;
                    is_loading.value = false;

                    if (ROLE === "admin") router.push({ name: "admin.home" });
                    else if (ROLE === "bidder") router.push({ name: "bidder.home" });
                })
                .catch((get_current_user_error) => {
                    errors.value = get_current_user_error.response.data;
                    is_loading.value = false;
                });
            })
            .catch((login_error) => {
                errors.value = login_error.response.data;
                is_loading.value = false;
            });
		}
		return {
            //data
			user,
			is_loading,
            errors,

            //methods
            login
		};
	},
}
</script>