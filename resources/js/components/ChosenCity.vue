<template>
    <div class="relative">
        <select
                @change="onChosenCity"
                v-model="chosenCityId"
                class="appearance-none bg-white block border border-gray-200 focus:bg-white focus:border-gray-500 focus:outline-none leading-tight pr-8 px-4 py-3 rounded text-gray-700 w-full"
                id="grid-state"
        >
            <option value>Välj ort</option>
            <option :value="city.id" v-for="city in cities">{{ city.name }}</option>
        </select>
        <div
                class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700"
        >
            <svg
                    class="fill-current h-4 w-4"
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 20 20"
            >
                <path
                        d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"
                />
            </svg>
        </div>
    </div>
</template>

<script>
    import {mapState} from 'vuex';

    export default {
        data() {
            return {
                chosenCityId: "",
            };
        },
        computed: mapState({
            cities: state => state.cities
        }),
        methods: {
            onChosenCity() {
                if (this.chosenCityId === "") return;

                this.$store.dispatch("setCityId", this.chosenCityId);

                this.$router.push({
                    name: "NeedHelp",
                    params: {city_id: this.chosenCityId},
                });
            },
        },
        async created() {
            this.chosenCityId = this.$store.getters.getCityId;
        },
    };
</script>