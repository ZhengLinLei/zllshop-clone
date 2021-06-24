function logout(){
    let body = `code=${code}`;
    fetch('./api/user?type=logout', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: body
    })
    .then(response => response.json())
    .then(data => {
        if(data.response == 200){
            location.href = location.href;
        }
    });
}