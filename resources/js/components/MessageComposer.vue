<template>
    <div class="message-composer">
        <textarea name="text" class="form-control" @send="sendMessage"></textarea>
    </div>
</template>

<script>
    export default {
        data() {
            return {

            }
        },
        methods: {
            sendMessage(text) {
                console.log(text);
            }
        }
    }
</script>