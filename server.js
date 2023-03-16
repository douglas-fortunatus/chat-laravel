const { channel } = require("diagnostics_channel");
const { json } = require("express");
const express = require("express");
const app = express();
const http = require("http");
const server = http.createServer(app);
const io = require("socket.io")(server, { cors: { origin: "*" } });
const Redis = require("ioredis");
const redis = new Redis();
const users = [];

redis.subscribe("private-channel", () => {
    console.log("Woooow");
});

redis.on("message", (channel, message) => {
    message = JSON.parse(message);

    if (channel == "private-channel") {
        let data = message.data.data;
        let receiver_id = data.receiver_id;
        let event = message.event;

        io.to(`${users[receiver_id]}`).emit(
            channel + ":" + message.event,
            data
        );
    }

    console.log(message);
});

io.on("connection", (socket) => {
    console.log("a user connected");

    socket.on("user_connected", (user_id) => {
        users[user_id] = socket.id;
        io.emit("updateUserStatus", users);
        console.log("user connected with id " + user_id);
    });

    socket.on("disconnect", (socket) => {
        let i = users.indexOf(socket.id);
        users.splice(i, 1, 0);
        io.emit("updateUserStatus", users);
    });
});

server.listen(3000, () => {
    console.log("listening on *:3000");
});
