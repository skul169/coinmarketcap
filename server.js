//Initialitze library requirements: express, socket.io and ioredires
var app = require('express')();
var http = require('http').Server(app);
var io = require('socket.io')(http);
var Redis = require('ioredis');

//Create new Redis instance
var redis = new Redis();

//Example howto subscribe to only one Redis channel
//redis.subscribe('test-channel', function(err, count) {
//});

//Subscribe to all Redis Channels
redis.psubscribe('*', function(err, count) {
    //Nothing to do here?
    console.log('Errors subscribing to channel');
});

//Broadcast message when recieved from Redis on all channels
redis.on('pmessage', function(subscribed,channel, message) {
    console.log('Message Recieved at channel(' + channel + '): ' + message);
    message = JSON.parse(message);
    console.log('message: ' + message.data);
   //["subscribe",[["8.84669","EURNOK","1488171808"],["118.3489","EURJPY-OTC","1488171808"]]]
   io.emit(channel, message.data.u);
   //io.emit(chan);
	
});

//Listen web socket on port 9099
http.listen(9099, function(){
    console.log('Listening on Port 9099');
});