const { default: Axios } = require('axios');
var _ = require('lodash');
//import VueSlimScroll from 'vue-slimscroll';
//import Vue from 'vue';
import Echo from 'laravel-echo';

window.Vue = require('vue');
//Vue.use(VueSlimScroll);

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
			selected_user_details: '',
			searchText:'',
			noRecord:false,
			file: '',
			options:{
				height:'500px'
			},
			selected: 0,
		}
	},
	watch:{

	},
	created(){
		this.initializeChat();
	},
	mounted(){
		/* Echo.private(`messages${this.user.id}`)
		.listen('NewMessage', (e)=>{
			this.handleIncoming(e.message);
		}); */
	},

	filters:{
		moment:function(date){
			return moment().format('MMMM Do YYYY, h:mm:ss a');
		},
	},
	computed:{
		sortedContacts(){
			return _.sortBy(this.users, [(selected_user)=>{
			}]).reverse();
		},

	},
	methods:{
		initializeChat(){
			axios.get('/initialize-chat')
			.then(response=>{
				this.users = response.data.users;
				this.auth_user = response.data.auth_user;
				this.searchText = '';
			});
		},

		searchContact(){

				axios.get('/filter-contact/'+this.searchText)
				.then(response=>{
					this.users = response.data.users;
					if(this.users.length <= 0){
						this.noRecord = true;
					}else{
						this.noRecord = false;
					}
					this.auth_user = response.data.auth_user;
				});


		},
		triggerFileUpload(){
			this.handleFileUpload();
		},
		handleFileUpload(){
			this.$refs.attachment.click();
			this.file = this.$refs.attachment.files[0];
		//	if(this.file != null){
				let formData = new FormData();
				formData.append('attachment', this.file);
				formData.append('to',this.selected_user);
				axios.post('/conversation/attachment',formData)
				.then(response=>{
					this.file = '';
					this.getSelectedUser(this.selected_user);
					this.scrollToBottom();

				});
			//}
		},
		handleIncoming(message){
			if(this.selected_user && message.from_id == $this.selected_user){
				this.saveNewMessage(message);
				//this.messages.push(message);
				return;
			}
			//alert(message.message);
		},
		getSelectedUser(id){
			this.selected_user = id;
			axios.get('/chat-with/'+id)
			.then(response=>{
				this.messages = '';
				this.messages = response.data.messages;
				this.selected_user_details = response.data.selected_user;
				this.initializeChat();
				this.searchText = '';
				this.scrollToBottom();
			});

		},

		clearMessages(id){
			axios.get('/clear-messages/'+id)
			.then(response=>{
				this.getSelectedUser(id);
			});
		},

		sendMessage(){
			if(!this.selected_user){
				return;
			}
			axios.post('/conversation/send',{
				message:this.compose_message,
				receiver:this.selected_user
			})
			.then(response=>{
				this.compose_message = '';
				this.getSelectedUser(this.selected_user);
				this.scrollToBottom();
			});
		},
		saveNewMessage(obj){
			this.messages.push(obj);
		},
		moment(){
			return moment();
		},
		date: function (date) {
      return moment(date).format('MMMM Do YYYY, h:mm:ss a');
		},
		scrollToBottom() {
			setTimeout(() => {
					document.getElementById('messageWrapper').scrollTop = document.getElementById('messageWrapper').scrollHeight - document.getElementById('messageWrapper').clientHeight;
			}, 50);
		},
		setupClient() {
			axios.post("/conversation/compatibility-token", {
					forPage: window.location.pathname,
					_token: $('meta[name="csrf-token"]').attr('content')
			}).then(response=> {
					//console.log(re);
					//device = new Device();
					//device.setup(data.token);
					//setupHandlers(device);
			}).catch(error=> {
					updateCallStatus("Could not get a token from server!");
			});

	}

	},

});


