const express = require('express');
const app = express();
const mysql = require('mysql');
const port = 3000;
const path = require('path');



// connection.connect(
//     function(err){
//        if(err) throw(err);
//        console.log('connected');
//        console.log(__dirname);
//        connection.query('SELECT user_name,user_mail FROM user',
//        function(err,result){
//        if(err) throw(err);
//        console.log(result);
//        })
//     }
// );

// app.listen(port,()=> console.log(`Example app listening on port
// ${port}!`)); 

app.get('/',(request,response)=>
response.sendFile(__dirname,'php/createAccount.php'))

//(path.join

 app.get('/api/hello', (request, response) => {
    const connection = mysql.createConnection({
        host: 'localhost',
        user: 'wp459266_wp1',
        password: 'gumi7070',
        database: 'wp459266_infomation'
});
connection.connect();
 	const sql = "SELECT user_name,user_mail FROM user"
 	connection.query(sql, function (err, result, fields) {  
 	if (err) throw err;
    console.log(result);
 	response.send(result);
     connection.end();
 	});
 });


 




// app.get('/', (request,response) => response.sendFile('./php/createAccount.php'));

// app.get('/',(request,response) =>{
//     connection.query('SELECT user_name,user_mail FROM user',
//     function(err,result){
//     if(err) throw(err);
//     response.send(result);

//     connection.end();
//     })
// })

// connection.query('SELECT user_name,user_mail FROM user ',function (error, results, fields){
//     if(error) throw error;
//     console.log(results.message);
//     res.send(results.message)
//     connection.end();

// });
// });

