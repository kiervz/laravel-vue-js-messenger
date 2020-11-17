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
                })
        },
        methods: {
            startConvoWith(contact) {
                axios.get(`/conversation/${contact.id}`)
                    .then(res => {
                        this.messages = res.data.messages
                        this.selectedContact = contact
                    })
            },
            newMessage(text) {
                this.messages.push(text);
            }
        }
    }
</script>
<style lang="scss" scoped>
    .app-home {
        height: 90% !important;
        display: flex;
        background: white;
    }
</style>