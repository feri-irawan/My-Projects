var http = require('http');
http.createServer(function (req, res) {
    res.writeHead(200, {'Content-Type': 'text/html'});
    res.write('Hello <b>World</b>!');
    res.end();
}).listen(8000);

console.log("server running on http://localhost:8000");
