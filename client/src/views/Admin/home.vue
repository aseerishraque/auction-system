<template>
<div>
    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200"> Dashboard </h2>
    <suspense>
        <template #default>
            <HomeIndex/>
        </template>
        <template #fallback>
            <HomeIndexSkeleton/>
        </template>
    </suspense>
</div>
</template>

<script setup>
import HomeIndex from "../../../src/components/Admin/Auction/Home/Index.vue";
import HomeIndexSkeleton from "../../../src/components/Admin/Auction/Home/IndexSkeleton.vue";
import { useStore } from "vuex";
import { useRouter } from "vue-router";

const store = useStore();
const router = useRouter();

function logout() {
    store.dispatch("logout")
    .then(() => {
        router.push("/login");
    })
    .catch((error) => {
        alert(error);
    });
}
		
</script>
