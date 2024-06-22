<script>
export default {
    name: "ShowComponent",

    data() {
        return {
            advert: {},
        }
    },

    mounted() {
        this.getAdvert()
    },

    methods: {
        getAdvert() {
            axios.get('/api/adverts/' + this.$route.params.id + '?fields[]=images&fields[]=description')
                .then(res => {
                    this.advert = res.data.data
                })
        }
    }
}
</script>

<template>
    <div class="container">
        <div class="row">
            <div class="">
                <div class="row">
                    <div class="col-md-4" v-for="image in advert.images">
                        <img :src="image['image_url']" width="100%" height="225" class="rounded object-fit-cover"
                             alt="#">
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="card-body">
                        <h3 class="card-title mt-3 mb-3">{{ advert.name }}</h3>
                        <p>{{ advert.description }}</p>
                        <span class="badge bg-light-subtle border border-light-subtle text-light-emphasis rounded-pill">{{ advert.price }} руб.</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
</style>

