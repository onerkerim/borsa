
var app = require('express')();
var http = require('http').Server(app);
var io = require('socket.io')(http);

//app.get('/', function(req, res){
//  res.sendFile(__dirname + '/index.html');
//});



io.on('connection', function(socket){
  socket.on('islem_eklendi', function(data){
    io.emit('islem_eklendi', data);
     console.log(data);
  });

    socket.on('islem_guncelle', function(data){
    io.emit('islem_guncelle', data);
     console.log(data);
  });
});


http.listen(3000, function(){
  console.log('listening on *:3000');
});

