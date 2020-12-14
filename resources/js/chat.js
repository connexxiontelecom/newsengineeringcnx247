const { default: Axios } = require('axios');

window.Vue = require('vue');

var vm = new Vue({
	el: "#chat",
	data(){
		return {
			message: 'CNX Chat',
			compose_message: '',
			users:'',
			messages:'',
			auth_user:'',
			selected_user:'',
		}
	},
	watch:{

	},
	created(){
		this.initializeChat();
	},
	methods:{
		initializeChat(){
			axios.get('/initialize-chat')
			.then(response=>{
				this.messages = response.data.messages;
				this.users = response.data.users;
				this.auth_user = response.data.auth_user;
			});
		},
	},

});
