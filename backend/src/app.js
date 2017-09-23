var express = require('express');
var app = express();
var cookieParser = require('cookie-parser')
import path from 'path'
import bodyParser from 'body-parser';
import Bcrypt from 'bcrypt';
import Jwt from 'jsonwebtoken';

var rootDir = path.resolve('.') + '/'
var PHPFPM = require('node-phpfpm-framework');


var phpfpm = new PHPFPM({
    sockFile : '/var/run/php/php7.0-fpm.sock',
    documentRoot: rootDir
});

app.use(cookieParser())
app.use(bodyParser.raw({ type: 'application/json' }));

app.set('superSecret', 'K3J9 8LMN 02F3 B3LW');

app.get('/generatepassword/:Password', (req, res) => {
  Bcrypt.genSalt(10, (Err, Salt) => {
    Bcrypt.hash(req.params.Password, Salt, (Err, Hash) => {
      res.json({Password: Hash});
    });
  });
});


//login get
app.post('/login/', (req, res, next) => {

  phpfpm.run(
      {
          hostname: req.hostname,
          remote_addr: req.ip,
          method: req.method,
          contentType: req.headers['content-type'],
          contentLength: req.headers['content-length'],
          referer : req.get('Referer') || '',
          url: 'login.php',
          debug: true,
          queryString: req.originalUrl,
          body: req.body
      },
      function(err, output, phpErrors)
      {
          //if(err){console.log(phpErrors)}
          var Data = JSON.parse(output);
          if(Data.Result === 1){
            Bcrypt.compare(Data.PlainPassword, Data.Password, (Err, Res) => {
              if(Res) {
                var Token = Jwt.sign({ User: Data.UserName },
                              req.app.get('superSecret'),
                              {expiresIn: "365d" /*expires in 365 dias*/});

                if(Token){
                    res.send({ Result: 1, Token: Token});
                } else {
                    res.send({ Result: 0, Err: `Error generando token`});
                }

              } else {
                res.send({ Result: 0, Err: "Password Erronea" });
              }
              next();
            });
          } else {
            res.send({ Result: 0, Err: `Error consultando ususario` });
            next();
          }
  });
});


//graphql
app.use('/graphql', function(req, res, next) {

    phpfpm.run(
        {
            hostname: req.hostname,
            remote_addr: req.ip,
            method: req.method,
            contentType: req.headers['content-type'],
            contentLength: req.headers['content-length'],
            referer : req.get('Referer') || '',
            url: 'graphql.php',
            debug: true,
            queryString: req.originalUrl,
            body: req.body
        },
        function(err, output, phpErrors)
        {
            if(err){console.log(phpErrors)}
            res.send(output);

            next();
    });

});

app.listen(3002);
