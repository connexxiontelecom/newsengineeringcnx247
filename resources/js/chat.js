const { default: Axios } = require('axios');
var _ = require('lodash');
import VueSlimScroll from 'vue-slimscroll';

window.Vue = require('vue');
Vue.use(VueSlimScroll);
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
		Echo.private(`messages${this.user.id}`)
		.listen('NewMessage', (e)=>{
			this.handleIncoming(e.message);
		});
	},

	filters:{
		moment:function(date){
			return moment().format('MMMM Do YYYY, h:mm:ss a');
		},
	},
	computed:{
		sortedContacts(){
			return _.sortBy(this.users, [(selected_user)=>{
				if(selected_user == this.selected){
					//return Infinity;
				}
				return selected_user.unread;
			}]).reverse();
		},

		filterContact(){
			/* this.users.filter((contact)=>{
				return boolean;
			}); */
		/* 	var self = this;
        	return this.users.filter(function (user) {
          return _.includes(user.toLowerCase(), self.searchText.toLowerCase());
			}); */
		},
	},
	methods:{
		initializeChat(){
			axios.get('/initialize-chat')
			.then(response=>{
				this.users = response.data.users;
				this.auth_user = response.data.auth_user;
			});
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
			});
			this.scrollToBottom();

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
			setTimeout(()=>{
				this.$refs.messageWrapper.scrollTo = this.$refs.messageWrapper.scrollHeight - this.$refs.messageWrapper.clientHeight;
			}, 50);
    },
	},

});

