<template>
    <div class="conversation">
        <h1>{{ contact ? contact.name : "Select a Contact" }}</h1>
        <message-feed></message-feed>
        <message-composer></message-composer>
    </div>
</template>

<script>
    import MessageFeed from "./MessageFeed.vue"
    import MessageComposer from "./MessageComposer.vue"

    export default {
        components: { MessageFeed, MessageComposer },
        data() {
            return {

            }
        }
    }
</script>