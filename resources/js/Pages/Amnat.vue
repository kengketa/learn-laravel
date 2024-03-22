<template>
    <h1>Hello, world!</h1>
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
