<template>
<div class="bidders-crud">
    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200"> Bidders </h2>

    <!-- <div class="mb-4">
        <link-button to="admin.category.create" name="Add Category">
            <span>Add Bidder</span>
        </link-button>
    </div> -->

    <div v-if="error" class="px-3 mb-4 py-2 w-full border border-red-500 rounded text-sm text-red-500 transition delay-1000 duration-500">
        <ul class="mt-1 ml-2 list-disc list-inside">
            <li>
                <span class="-ml-2">{{ error }}</span>
            </li>
        </ul>
    </div>
  <suspense>
    <template #default>
        <BidderIndex/>
    </template>
    <template #fallback>
        <BidderIndexSkeleton/>
    </template>      
  </suspense>

</div>
</template>
<script >
import BidderIndex from '../../../components/Admin/Bidder/Index.vue';
import BidderIndexSkeleton from '../../../components/Admin/Bidder/IndexSkeleton.vue';


export default{
    name: 'BiddersIndexAll',
    data() {
        return {
            error: null
        }
    },
    components: {
      BidderIndex,
      BidderIndexSkeleton
    }
}
</script>
