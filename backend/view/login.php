<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Backend</title>
</head>
<body>
    <input type="text" id="user" placeholder="User"><br>
    <input type="password" id="password" placeholder="Password"><br><br>
    <button onclick="checkUser()">Entry</button>
    <script>
        let inputUser = document.getElementById("user");
        let inputPass = document.getElementById("password");
        function checkUser(){
            if(inputUser.value && inputPass.value){
                let body = `code=<?php echo $_SESSION["admin_security_token"]?>&user=${inputUser.value}&password=${inputPass.value}`;
                fetch("./view/api/login.php", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: body
                })
                .then(response => response.json())
                .then(data =>{
                    if(data.response == 200){
                        location.href = location.href;
                    }else{
                        alert("Try Again");
                    }
                });
            }
        }
    </script>
</body>
</html>