var express = require('express');
var bodyParser = require('body-parser');
var AWS = require('aws-sdk');
const cors = require('cors');
const uuid = require('uuid');
var md5 = require('md5');
var app = express();
var corsOptions ={origin: true, optionsSuccessStatus: 200 };
app.use(cors(corsOptions));
app.use(bodyParser.json({limit: '10mb', extended: true}));
app.use(bodyParser.urlencoded({limit: '10mb', extended: true}))

var port = 9000;
app.listen(port);
console.log('Listening on port',port);

AWS.config.update({region: 'region',
accessKeyId: 'access',
secretAccessKey: 'secret' });
var ddb = new AWS.DynamoDB();

app.post('/registrar', function (req, res){
  user = req.body.user;
  pass = req.body.password;
  name = req.body.name;
  email = req.body.email;
  //Insertar un registro
 pass= md5(pass);
  var params = {
    TableName: 'finalsopes',
    Item: {
      'id_usuario' : {S: ""+user},
      'nombre' : {S: "" + name},
      'email': {S: ""+email},
      'password': {S: ""+pass},
    }
  };
  
  ddb.putItem(params, function(err, data) {
    if (err) {
      console.log(err)
      res.json({ mensaje: 0 })
    } else {
      res.json({ mensaje: 1 })
    }
  });
});


app.post('/login', (req, res) => {
  let usuario = req.body.user;
  var pass = req.body.password;
  let email =req.body.email;
  let log = false;
  pass= md5(pass);
  ddb.scan({
    TableName: "finalsopes"
  }, function (err, data) {
    if (err) {
      console.log('Error saving data:', err);
      res.json([]);
    } else {
      for (const item of data.Items) {
        if ((item.id_usuario.S == usuario && item.password.S == pass) || item.email.S == email && item.password.S == pass) {
          log = true; 
          res.json(item);
          break;
        }     
      }
      if(log){

      }else{
      res.json([]);
      }
    }
  });
})

app.get('/PruebaBalance', (req, res) => {
  res.json({servidor: "Hola se hizo peticion en el Servidor 1"})
})