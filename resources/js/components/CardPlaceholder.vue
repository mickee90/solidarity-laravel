<template>
    <div
    @click="onGoTo"
    class="border border-gray-400 lg:flex lg:max-w-full max-w-sm rounded-lg overflow-hidden w-full text-left"
    :class="{ 'cursor-pointer': url !== null }" >
        <div class="flex bg-white w-full xl:h-48 items-center justify-center lg:rounded-l lg:rounded-t-none">
            <slot></slot>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            url: {
                required: false,
                type: Object,
                default: null,
            },
        },
        methods: {
            onGoTo() {
                if (this.url === null) return;

                this.$router.push(this.url);
            },
        },
    };
</script>

<style></style>
