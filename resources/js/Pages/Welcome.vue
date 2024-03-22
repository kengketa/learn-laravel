<template>
    <div class="w-screen h-screen p-10 bg-yellow-600">
        <button
            class="w-32 px-4 py-2 text-white transition duration-200 ease-in-out transform bg-pink-800 rounded-sm md:w-40 lg:w-60 xl:w-96 hover:scale-105">
            เชื่อมต่อสำเร็จ
        </button>
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
