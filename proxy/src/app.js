import redbird from 'redbird';

var proxy = redbird({port: 3000});

proxy.register('localhost:3000/', 'http://127.0.0.1:3001/');
proxy.register('localhost:3000/backend', 'http://127.0.0.1:3002/');
