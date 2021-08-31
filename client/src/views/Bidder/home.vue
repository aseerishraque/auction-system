<template>
  <span>Bidder page</span>
	<button
		@click="logout()" class="block border text-lg text-white py-1 px-2 bg-red-500">
		Logout
	</button>
</template>

<script>
import { useStore } from "vuex";
import { useRouter } from "vue-router";

export default {
	setup() {
		const store = useStore();
		const router = useRouter();

		function logout() {
			store
				.dispatch("logout")
				.then(() => {
					router.push("/login");
				})
				.catch((error) => {
					alert(error);
				});
		}

		return { logout };
	},
};
</script>
