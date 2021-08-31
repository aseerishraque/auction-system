<template>
    <router-link :to="{ name: to }" :class="utilitiClass ?? 'mt-6 inline-flex items-center justify-center flex-none bg-gray-900 hover:bg-gray-700 text-gray-100 text-sm leading-6 font-semibold py-2 px-4 border border-transparent rounded-lg focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-black focus:outline-none transition-colors duration-300'">
        <slot></slot>
    </router-link>
</template>

<script>
export default {
    props: ["to", "utilitiClass"],
}
</script>