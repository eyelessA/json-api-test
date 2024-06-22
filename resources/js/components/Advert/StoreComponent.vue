<script>

export default {
	name: "StoreComponent",

	data() {
		return {
			name: '',
			description: '',
			images: [
				{image_url: ''}
			],
			price: null,
			errors: null,
			success: false
		}
	},

	methods: {
		addImage() {
			this.images.push({image_url: ''});
		},
		removeImage(index) {
			this.images.splice(index, 1);
		},
		addAdvert() {
			axios.post('/api/adverts', {
				name: this.name,
				description: this.description,
				images: this.images,
				price: this.price
			})
				.then(res => {
					this.name = ''
					this.description = ''
					this.images = [{image_url: ''}]
					this.price = ''
					this.errors = null
					this.success = true
				})
				.catch(res => {
					this.errors = res.response.data.errors
					this.success = false
				})
		}
	}
}
</script>

<template>
	<div class="container">
		<form class="card p-4">
			<div class="mb-3">
				<label for="name" class="form-label">Name</label>
				<input type="text" class="form-control" id="name" v-model="name">
			</div>
			<div class="mb-3">
				<label for="description" class="form-label">Description</label>
				<textarea class="form-control" id="description" v-model="description"></textarea>
			</div>
			<div class="mb-3">
				<label for="price" class="form-label">Price</label>
				<input type="number" class="form-control" id="price" v-model="price">
			</div>
			<div v-for="(image, index) in images" :key="index" class="mb-3">
				<label :for="'image-url-' + index" class="form-label">Image URL {{ index + 1 }}</label>
				<input type="text" class="form-control" :id="'image-url-' + index" v-model="image.url">
			</div>
			<div>
				<button type="button" class="btn btn-secondary mb-3" @click="addImage">Add Image</button>
			</div>
			<div class="mb-3">
				<button type="button" class="btn btn-danger" @click="removeImage(index)">Remove</button>
			</div>
			<button @click.prevent="addAdvert" type="submit" class="btn btn-primary">Submit</button>
			<div v-for="fieldErrors in errors" class="mt-3">
				<div class="alert alert-danger mb-0" role="alert" v-for="errorMessage in fieldErrors">
					{{ errorMessage }}
				</div>
			</div>
			<div v-if="success" class="mt-3">
				<div class="alert alert-success" role="alert">
					Объявление успешно создано!
				</div>
			</div>
		</form>
	</div>
</template>

<style scoped>

</style>
