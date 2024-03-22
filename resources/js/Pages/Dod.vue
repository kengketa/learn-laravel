<template>
    <div class="p-10 bg-green-200 w-screen h-screen">
        <button
            class="w-32 md:w-40 lg:w-60 xl:w-96 px-4 py-2 rounded-sm bg-green-800 text-white transition transform duration-200 ease-in-out hover:scale-105">
            ทดสอบระบบ
        </button>

        <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">First</th>
                <th scope="col">Last</th>
                <th scope="col">Handle</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="row">1</th>
                <td>Mark</td>
                <td>Otto</td>
                <td>@mdo</td>
              </tr>
              <tr>
                <th scope="row">2</th>
                <td>Jacob</td>
                <td>Thornton</td>
                <td>@fat</td>
              </tr>
              <tr>
                <th scope="row">3</th>
                <td colspan="2">Larry the Bird</td>
                <td>@twitter</td>
              </tr>
            </tbody>
          </table>
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
