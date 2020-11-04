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
        }
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
                this.chat.message.push(this.message);
                this.chat.color.push('success');
                this.chat.user.push('Ty');
                this.chat.time.push(this.getTime());
                axios.post('administracja/send', {
                    message: this.message,
                    user: this.user,
                    color: this.color,
                    time: this.getTime(),
                })
                    .then(response => {
                        this.message = '';
                    })
                    .catch(error => {
                        console.log(error);
                    });
            }
        }, getTime() {
            let time = new Date();
            return time.getHours() + ':' + time.getMinutes() + ":" +
                time.getSeconds();
        },
    },

    mounted() {
        Echo.private('chat')
            .listen('ChatEvent', (e) => {
                this.chat.message.push(e.message);
                this.chat.user.push(e.user);
                this.chat.color.push('warning');
                this.chat.time.push(this.getTime());
            })
            .listenForWhisper('typing', (e) => {
                if (e.name != "") {
                    this.typing = e.user + 'pisze...';
                } else {
                    this.typing = '';
                }
            });
    }
});
