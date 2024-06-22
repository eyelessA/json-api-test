<script>

export default {
	name: "IndexComponent",

	data() {
		return {
			adverts: null,
			links: null,
			sort: 'price_asc',
			page: '1',
		}
	},

	mounted() {
		this.getAdverts()
	},

	watch: {
		sort() {
			this.getAdverts()
		}
	},

	methods: {
		getAdverts() {
			axios.get('/api/adverts?order_by=' + this.sort + '&page=' + this.page)
				.then(res => {
					this.adverts = res.data.data
					this.links = res.data.meta.links
					this.links.shift()
					this.links.pop()
					console.log(res.data.data)
				})
		},
		changePage(page) {
			this.page = page
			this.getAdverts()
		}
	},

}
</script>

<template>
	<div class="container mb-3 end">
		<select class="form-select w-25" aria-label="Default select example" v-model="sort">
			<option value="price_asc">По возрастанию цены</option>
			<option value="price_desc">По убыванию цены</option>
			<option value="created_at_asc">Сначала новые</option>
			<option value="created_at_desc">Сначала старые</option>
		</select>
	</div>

    <div class="album">
        <div class="container">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4 mb-5">
                <div class="col" v-for="advert in adverts">
                    <div class="card rounded-3" v-if="advert.images.length !== 0">
                        <router-link :to="{name: 'advert.show', params: {id: advert.id}}">
                            <img :src="advert.images[0]['image_url']" width="100%" height="225" class="object-fit-cover rounded-top-3" alt="#">
                        </router-link>
                        <div class="card-body p-4">
                            <p class="card-text">
                                <router-link :to="{name: 'advert.show', params: {id: advert.id}}">
                                    <h5 class="card-title">{{ advert.name }}</h5>
                                </router-link>
                            </p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <router-link :to="{name: 'advert.show', params: {id: advert.id}}">
                                        <button class="btn btn-outline-secondary d-inline-flex align-items-center" type="button">
                                            Посмотреть
                                        </button>
                                    </router-link>
                                </div>
                                <span class="badge bg-light-subtle border border-light-subtle text-light-emphasis rounded-pill">{{ advert.price }} руб.</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex gap-2 justify-content-center">
                <nav aria-label="...">
                    <ul class="pagination">
                        <li class="page-item" v-for="link in links" :class="{ active: link.label == this.page}">
                            <a @click.prevent="changePage(link.label)" class="page-link">{{ link.label }}</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
