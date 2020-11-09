var express = require('express');
var bodyParser = require('body-parser');

var AWS = require('aws-sdk');
const cors = require('cors');
const uuid = require('uuid');;

var app = express();
var corsOptions ={origin: true, optionsSuccessStatus: 200 };
app.use(cors(corsOptions));
app.use(bodyParser.json({limit: '10mb', extended: true}));
app.use(bodyParser.urlencoded({limit: '10mb', extended: true}))

var port = 9000;
app.listen(port);
console.log('Listening on port',port);


//Insertar un registro
var params = {
    TableName: 'finalsopes',
    Item: {
      'id_usuario': {S: req.user},
      'nombre':    {S: req.nombre},
      'password':   {S: req.password},
      'email':      {N: req.email}
    }
  };
  
  ddb.putItem(params, function(err, data) {
    if (err) {
      console.log("Error", err);
    } else {
      console.log("Sucess",data)
      callback(null,data);
    }
  });

  var params = {
    TableName: 'Prueba',
    Key: {
      'id_numero': {N: req.id_numero.toString()}
    },
    ProjectionExpression: 'nombre'   //Este es solo para obtener un dato en especifico
  };
  
  ddb.getItem(params, function(err, data) {
    if (err) {
      console.log("Error", err);
    } else {
      console.log("Success", data.Item);
      callback(null,data.Item);
    }
  });