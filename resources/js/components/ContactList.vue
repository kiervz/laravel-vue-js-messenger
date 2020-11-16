<template>
    <div class="contact-list">
        <ul>
            <li 
                v-for="(contact, index) in contacts" 
                :key="contact.id" 
                @click="selectContact(index, contact)" 
                :class="{ 'selected': index == selected }">
                <div class="avatar">
                    <img :src="contact.profile_img" :alt="contact.name">
                </div>
                <div class="contact">
                    <p class="name"> {{contact.name }}</p>
                    <p class="email">{{ contact.email }} </p>
                </div>
            </li>
        </ul>
    </div>
</template>

<script>
    export default {
        props: ['contacts'],
        data() {
            return {
                selected: 0,
            }
        },
        methods: {
            selectContact(index, contact) {
                this.selected = index
                
                this.$emit('selected', contact)
            }
        }
    }
</script>
<style lang="scss" scoped>
    .contact-list {
        flex:2;
        max-height: 615px;
        overflow-y: scroll;
        background: rgb(247, 246, 246);
        border-right: 1px solid lightblue;
    }
    ul {
        list-style: none;
        padding-left: 0;
    }
    li {
        display: flex;
        padding: 2px;
        border-bottom: 1px solid lightblue;
        height: 80px;
        position:relative;
        cursor:pointer;
        &.selected {
            background: #e3e6e6;
        }
    }
    .avatar {
        flex:1;
        display: flex;
        align-items: center;
    }
    .avatar img {
        width: 50px;
        border-radius: 50%;
        margin:0 auto;
    }
    .contact {
        flex: 3;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }
    .contact p {
        margin: 0;
        &.name {
            font-weight: bold;
        }
    }
</style>