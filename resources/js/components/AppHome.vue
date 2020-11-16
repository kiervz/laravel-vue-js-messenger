<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <contact-list :contacts="contacts"></contact-list>
            </div>
            <div class="col-md-9">
                <conversation :contacts="selectedContact" :messages="messages"></conversation>
            </div>
        </div>
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
        }
    }
</script>
