<template>
    <div class="message-composer">
        <textarea 
            v-model="message" 
            placeholder="Message..." >
        </textarea>
        <button class="btn btn-primary btn-xs" @click="send">Send</button>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                message: null,
            }
        },
        methods: {
            send() {
                if (this.message == '') {
                    return;
                }

                this.$emit('send', this.message);
                this.message = ''
            }
        }
    }
</script>
<style scoped>
    .message-composer {
        display: flex;
    }
    .message-composer textarea {
        width: 100%;
        margin-top: 10px;
        border-radius: 3px;
        padding: 10px;
        border:1px solid lightblue;
        resize: none;
    }
    .message-composer button {
        margin-top: 25px;
        margin-left:10px;
        height: 40px;
    }
</style>