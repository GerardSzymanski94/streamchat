require('./bootstrap.js');

window.Vue = require('vue');

import Vue from 'vue'
import VueChatScroll from "vue-chat-scroll/dist/vue-chat-scroll";

Vue.use(VueChatScroll)

Vue.component('message-component', require('./components/MessageComponent.vue').default);

const app = new Vue({
    el: '#app',
    data: {
        message: "",
        chat: {
            message: [],
            user: [],
            color: [],
            time: [],
        },
        typing: '',
        typinguser: {
            user: []
        },
        numberOfUsers: 0,
    },
    watch: {
        message() {
            this.typinguser.user = 'Ktoś ';
            Echo.private('chat')
                .whisper('typing', {
                    name: this.message,
                    user: this.typinguser.user
                });
        }
    },

    methods: {
        send() {
            if (this.message.length > 0) {
                let time = this.getTime();
                this.chat.message.push(this.message);
                this.chat.color.push('success');
                this.chat.user.push('Ty');
                this.chat.time.push(time);
                axios.post('administracja/send', {
                    message: this.message,
                    color: 'success',
                    time: time,
                    chat: this.chat,
                })
                    .then(response => {
                        this.message = '';
                    })
                    .catch(error => {
                        console.log(error);
                    });
            }
        },
        getTime() {
            let time = new Date();
            return time.getHours() + ':' + time.getMinutes() + ":" +
                time.getSeconds();
        },
        getOldMessages() {
            axios.post('administracja/getOldMessages')
                .then(response => {
                    console.log(response);
                    if (response.data != '') {
                        this.chat = response.data;
                    }
                })
                .catch(error => {
                    console.log(error);
                });
        }
    },

    mounted() {
        this.getOldMessages();
        Echo.private('chat')
            .listen('ChatEvent', (e) => {
                let time = this.getTime();
                this.chat.message.push(e.message);
                this.chat.user.push(e.user);
                this.chat.color.push('warning');
                this.chat.time.push(time);

               /* axios.post('administracja/saveToSession', {
                    chat: this.chat,
                    message: e.message,
                    color: 'warning',
                    time: time,
                })
                    .then(response => {
                    })
                    .catch(error => {
                        console.log(error);
                    });*/
            })


            .listenForWhisper('typing', (e) => {
                if (e.name != "") {
                    this.typing = e.user + 'pisze...';
                } else {
                    this.typing = '';
                }
            });
        Echo.join(`chat`)
            .here((users) => {
                this.numberOfUsers = users.length;
            })
            .joining((user) => {
                this.numberOfUsers += 1;
                console.log('in: ' + user.name);
            })
            .leaving((user) => {
                this.numberOfUsers -= 1;
                console.log('out: ' + user.name);
            })
            .listen('NewMessage', (e) => {
                //
            });
    }
});
