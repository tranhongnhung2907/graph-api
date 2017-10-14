var http = require('http');
var fs = require('fs');
http.createServer(function (req, res) {
  fs.writeFile('demofile2.php', 'text text TEXT', function(err) {
  	if (err) throw err;
  	console.log('Replaced');
  });
  // res.writeHead(200, {'Content-Type': 'text/html'});
  // res.write('nuhula lalala');
  // res.end();
  fs.unlink('demofile2.php', function(err) {
	if (err) throw err;
	console.log('file deleted');
  });
}).listen(8080);