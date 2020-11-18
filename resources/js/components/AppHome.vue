<template>
    <div class="app-home">
        <contact-list :contacts="contacts" @selected="startConvoWith"></contact-list>
        <conversation :contact="selectedContact" :messages="messages" @newMessage="newMessage"></conversation>
    </div>
</template>

<script>
    import ContactList from './ContactList'
    import Conversation from './Conversation.vue'

    export default {
    components: { ContactList, Conversation },
        props: ['user'],
        data() {
            return {
                selectedContact: null,
                messages: [],
                contacts: [],
            }
        },
        mounted() {
            axios.get('/message')
                .then(res => {
                    this.messages = res.data.messages
                })

            axios.get('/contact') 
                .then(res => {
                    this.contacts = res.data.contacts
                    console.log(this.contacts);
                })
            
            Echo.private(`chat.${this.user.id}`)
                .listen('MessageSent', (e) => {
                    if (this.selectedContact && e.message.from == this.selectedContact.id) {
                        this.newMessage(e.message);
                    }
                });
        },
        methods: {
            startConvoWith(contact) {
                axios.get(`/conversation/${contact.id}`)
                    .then(res => {
                        this.messages = res.data.messages
                        this.selectedContact = contact
                    })
            },
            newMessage(message) {
                this.messages.push(message);
            }
        },
    }
</script>
<style lang="scss" scoped>
    .app-home {
        height: 90% !important;
        display: flex;
        background: white;
    }
</style>