'use strict';

var _redbird = require('redbird');

var _redbird2 = _interopRequireDefault(_redbird);

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

var proxy = (0, _redbird2.default)({ port: 3000 });

proxy.register('localhost:3000/', 'http://127.0.0.1:3001/');
proxy.register('localhost:3000/backend', 'http://127.0.0.1:3002/');