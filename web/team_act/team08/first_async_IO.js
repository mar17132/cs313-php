
var fs = require('fs');

var contents = fs.readFile(process.argv[2],function(err,data){
        if(err) throw err;

        var str = data.toString();
        var numLines = str.split('\n').length -1;

        console.log(numLines);

});




