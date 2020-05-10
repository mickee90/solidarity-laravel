<template>
    <div class="xxl:max-w-v-3/4 lg:max-w-v-9/10 mx-auto">
        <div
                class="min-h-v-1/4 items-center flex justify-around text-2xl"
                v-if="state === 'loading'"
        >
            Laddar..
        </div>
        <div
                class="min-h-v-1/4 items-center flex justify-center grid text-2xl"
                v-else-if="state === 'empty'"
        >
            Inga inlägg hittades. Prova en annan ort
            <br />
            <ChosenCity/>
        </div>
        <div v-else class="content gap-2 grid grid-cols-2 px-8 xl:grid-cols-3">
            <Card
                v-for="post in posts"
                :key="post.id"
                :url="{
                  name: showEndpoint,
                  params: { city_id: post.city.id, postId: post.id },
                }"
                >
                <template slot="logo"></template>
                <template slot="header">{{ post.title }}</template>
                <template slot="ingress">
                    <div v-html="post.ingress"></div>
                </template>
            </Card>
        </div>
    </div>
</template>

<script>
    import Card from "../Card.vue";
    import ChosenCity from "../ChosenCity.vue";

    export default {
        props: ['fetchEndpoint', 'showEndpoint'],
        data() {
            return {
                pagination: 20,
                posts: [],
                state: "loading",
            };
        },
        async created() {
            const posts = await this.$store.dispatch(this.fetchEndpoint, null, {
                root: true,
            });

            if (posts.length === 0) {
                this.state = "empty";
                return;
            }

            this.posts = posts;
            this.state = "";
        },
        components: {
            Card,
            ChosenCity
        },
    };
</script>
