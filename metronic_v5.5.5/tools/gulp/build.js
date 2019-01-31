var yargs = require('yargs');
var fs = require('fs');

var release = true;

// merge with default parameters
var args = Object.assign({
  'prod': false,
  'metronic': false,
  'keen': false,
  'default': false,
  'angular': false,
}, yargs.argv);

var theme = 'metronic';
var package = 'default';
var confPath = '';

if (release) {
  ['default', 'angular'].forEach(function(p) {
    if (args[p]) {
      package = p;
    }
  });
  confPath = './../themes/' + package + '.conf.json';

} else {
  ['metronic', 'keen'].forEach(function(t) {
    if (args[t]) {
      theme = t;
    }
    ['default', 'angular'].forEach(function(p) {
      if (args[p]) {
        package = p;
      }
    });
  });
  confPath = './../themes/' + theme + '/' + package + '.conf.json';
}

console.log('Using config ' + confPath);
module.exports = require(confPath);
