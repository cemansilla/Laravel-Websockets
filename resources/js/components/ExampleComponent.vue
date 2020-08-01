<template>
	<div class="container">
		<p v-for="user in users" :key="user.id">{{ user.name }}</p>

		<div class="row justify-content-center mt-5">
			<div class="col-md-8">
				<input type="text" class="form-control" v-model="task">
				<button class="btn btn-primary mt-2" @click="addTask">Guardar</button>
			</div>
		</div>

		<div class="text-center">
			<p v-for="task in tasks" :key="task">{{ task }}</p>
		</div>
	</div>
</template>

<script>
import axiox from 'axios'

export default { 
	data(){
		return {
			task: '',
			tasks: [],
			users: []
		}
	},

	props: [
		"room"
	],

	created(){
		this.fillTask();

		// window.Echo.channel('canal')
		// 	.listen('EventSocket', (e) => {
		// 		this.tasks.push(e.task.name);
		// 	})

		window.Echo.join('room.' + this.room)
			.here(users => { // Usuarios en el canal
				this.users = users;
				console.log('here', users);
			})
			.joining(user => { // Evento cuando un usuario se une
				this.users.push(user);
				console.log('joining', user);
			})
			.leaving(user => { // Evento cuando un usuario abandona
				this.users.splice(this.users.indexOf(user), 1);
				console.log('leaving', user);
			})
	},

	methods: {
		addTask: function(){
			axios.post('/task', {name: this.task})
				.then(response => {
					this.tasks.push(response.data.name);
					this.task = '';
				});
		},

		fillTask: function(){
			this.tasks = [];

			axios.get('/tasks')
				.then(response => {
					this.tasks = response.data;
				})
				.catch(e => {
					console.log(e);
				})
		}
	}
}
</script>