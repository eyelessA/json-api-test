<script>
export default {
	name: "Index",
}

</script>

<template>

    <header class="p-3 mb-5 border-bottom">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <router-link :to="{name: 'advert.index'}">
                    <img src="../../images/logo.webp" width="45px" alt="Adverts service" class="me-4">
                </router-link>

                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                    <li><router-link :to="{name: 'advert.index'}" class="nav-link px-2 link-secondary">Все объявления</router-link></li>
                </ul>

                <div class="dropdown text-end">
                    <router-link :to="{name: 'advert.store'}">
                        <button type="button" class="btn btn-primary">Создать объявление</button>
                    </router-link>
                </div>
            </div>
        </div>
    </header>
	<router-view></router-view>
</template>

<style scoped>

</style>
