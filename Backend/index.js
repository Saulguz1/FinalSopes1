var express = require('express');
var bodyParser = require('body-parser');
var AWS = require('aws-sdk');
const cors = require('cors');
const uuid = require('uuid');

var app = express();
var corsOptions ={origin: true, optionsSuccessStatus: 200 };
app.use(cors(corsOptions));
app.use(bodyParser.json({limit: '10mb', extended: true}));
app.use(bodyParser.urlencoded({limit: '10mb', extended: true}))

var port = 9000;
app.listen(port);
console.log('Listening on port',port);

AWS.config.update({region: 'region',
accessKeyId: 'access key',
secretAccessKey: 'secret key' });

app.post('/registrar', function (req, res){
  user = req.body.user;
  pass = req.body.password;
  name = req.body.name;
  email = req.body.email;
  //Insertar un registro
  var ddb = new AWS.DynamoDB();
  var params = {
    TableName: 'finalsopes',
    Item: {
      'usuario' : {S: ""+user},
      'nombre' : {S: "" + name},
      'email': {S: ""+email},
      'password': {S: ""+pass},
    }
  };
  
  ddb.putItem(params, function(err, data) {
    if (err) {
      res.json({ mensaje: "No se pudo insertar el usuario" })
    } else {
      res.json({ mensaje: "Se inserto el usuario" })
    }
  });
});


app.post('/login', (req, res) => {
  let usuario = req.body.usuario;
  let pass = req.body.password;
  let log = false;
  ddb.scan({
    TableName: "finalsopes"
  }, function (err, data) {
    if (err) {
      console.log('Error saving data:', err);
      res.send({ 'message': 'ddb failed' });
    } else {
      for (const item of data.Items) {
        if (item.usuario.S == usuario && item.pass.S == pass) {
          log = true; 
          break;
        }     
      }
      if(log){
        res.json({ mensaje: "Ok" , servidor: "1"})
      }else{
        res.json({ mensaje: "Error", servidor: "1"})
      }
    }
  });
})