<template>
    <div class="conversation">
        <h1>{{ contact ? contact.name : "Select a Contact" }}</h1>
        <message-feed :contact="contact" :messages="messages"></message-feed>
        <message-composer @send="sendMessage"></message-composer>
    </div>
</template>

<script>
    import MessageFeed from "./MessageFeed.vue"
    import MessageComposer from "./MessageComposer.vue"

    export default {
        props: ['contact', 'messages'],
        components: { MessageFeed, MessageComposer },
        data() {
            return {
                
            }
        }, 
        methods: {
            sendMessage(text) {
                axios.post('/conversation/send', {
                    contact_id: this.contact.id,
                    text: text
                }).then(res => {
                    this.$emit('newMessage', res.data.message)            
                })
            }
        }
    }
</script>

<style lang="scss" scoped>
    .conversation {
        flex:5;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        padding: 10px;
        
        h1 {
            font-size: 20px;
            padding: 10px;
            margin: 0;
            border-bottom: 1px solid lightblue;
        }
    }
</style>