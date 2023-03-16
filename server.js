const express = require("express");
const app = express();
const http = require("http");
const server = http.createServer(app);
const io = require("socket.io")(server, { cors: { origin: "*" } });
const users = [];

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
