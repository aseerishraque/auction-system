<template>
    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200"> Categories </h2>

    <div class="mb-4">
        <link-button to="admin.category.create" name="Add Category">
            <span>Add Category</span>
        </link-button>
    </div>

    <div v-if="error" class="px-3 mb-4 py-2 w-full border border-red-500 rounded text-sm text-red-500 transition delay-1000 duration-500">
        <ul class="mt-1 ml-2 list-disc list-inside">
            <li>
                <span class="-ml-2">{{ error }}</span>
            </li>
        </ul>
    </div>

    <suspense>
        <template #default>
            <CategoryIndex/>
        </template>
        <template #fallback>
            <CategoryIndexSkeleton/>
        </template>      
    </suspense>
</template>

<script setup>
import { onErrorCaptured, ref } from 'vue';
import CategoryIndex from "../../../components/Admin/Category/Index.vue";
import CategoryIndexSkeleton from "../../../components/Admin/Category/IndexSkeleton.vue";
import LinkButton from "../../../components/LinkButton.vue";

// Error handling
const error = ref(null);
onErrorCaptured(e => { error.value = e.message; })

</script>