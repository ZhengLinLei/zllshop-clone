window.addEventListener("load", ()=>{
    let location_form = document.getElementById("formLocation");

    location_form.addEventListener("submit", e=>{
        e.preventDefault();
        let body = new FormData(location_form);
        body.append('code', code);
        document.getElementById('check_location').disabled = true;
        fetch('../api/user?type=location', {
            method: 'POST',
            body: body
        })
        .then(response => response.json())
        .then(data => {
            if(data.response == 200){
                location.href = "../user";
            }
        });
    });
})