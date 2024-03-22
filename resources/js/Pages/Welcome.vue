<template>
    <div>
        <h1>WebSocket Client</h1>
        <div v-if="connected">
            <p>Status: Connected</p>
            <input v-model="messageToSend" placeholder="Type a message..." type="text">
            <button @click="sendMessage">Send</button>
            <ul>
                <li v-for="message in receivedMessages" :key="message.id">{{ message }}</li>
            </ul>
        </div>
        <div v-else>
            <p>Status: Disconnected</p>
            <button @click="connect">Connect</button>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            ws: null,
            connected: false,
            receivedMessages: [],
            messageToSend: ''
        };
    },
    methods: {
        connect() {
            this.ws = new WebSocket('ws://localhost:6000');
            this.ws.onopen = () => {
                this.connected = true;
                this.ws.onmessage = this.handleMessage;
            };
            this.ws.onclose = () => {
                this.connected = false;
            };
        },
        handleMessage(event) {
            const message = event.data;
            this.receivedMessages.push(message);
        },
        sendMessage() {
            if (this.messageToSend.trim() !== '') {
                this.ws.send(this.messageToSend);
                this.messageToSend = '';
            }
        }
    }
};
</script>

<style scoped>
/* Add your styles here */
</style>
