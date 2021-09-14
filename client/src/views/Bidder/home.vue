<template>
<div>
    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
		<span class="float-left">Welcome {{ user.name }},
			<div v-if="user.is_approved === 1" class="badge badge-primary">
				<i class="fas fa-check-double mr-2"></i>
				Verified
			</div>
			<div v-else class="badge badge-error">
				<i class="fas fa-times-circle mr-2"></i>
				Not Verified
			</div>
		</span>
		<span class="float-right">Balance: {{ user.deposit }} </span>
	</h2>
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
import HomeIndex from "../../components/Bidder/Index.vue";
import HomeIndexSkeleton from "../../components/Bidder/IndexSkeleton.vue";
import { useRouter } from "vue-router";

if(Store.state.currentUser === null)
{
	useRouter().push({ name:'auth.login' });
}
const user = Store.state.currentUser;
</script>
