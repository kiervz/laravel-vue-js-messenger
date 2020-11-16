<template>
    <div class="message-feed">
        <ul v-if="contact">
            <li 
                v-for="message in messages" 
                :key="message.id" 
                :class="`message ${message.to == contact.id ? 'sent' : 'received'}`">
                <div class="text">
                    {{ message.text }}
                </div>
            </li>
        </ul>
    </div>
</template>

<script>
    export default {
        props:['contact', 'messages'],
        data() {
            return {

            }
        },
    }
</script>

<style lang="scss" scoped>
    .message-feed {
        height: 100%;
        max-height: 472px;
        overflow-y: scroll;
    }
    ul {
        list-style-type: none;
        padding: 5px;
        
        li {
            &.message {
                margin: 5px 0;
                width: 100%;

                .text {
                    max-width: 400px;
                    padding: 10px;
                    border-radius: 5px;
                    display: inline-block;
                }

                &.sent {
                    text-align: right;
                    .text {
                        background-color: lightblue;
                    }
                }
                &.received {
                    text-align: left;
                    .text {
                        background-color: rgb(233, 233, 233);
                    }
                }
            }
        }
    }
</style>