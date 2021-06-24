window.addEventListener("load", ()=>{
    //Clipboard code
    if(navigator.clipboard){
        navigator.clipboard.readText()
        .then(text => {
            if(text.match(/^\d+\s\·\s📋复制此口令前往APP打开.+https:\/\/zllshop.es\s\·\s自动识别商品\s𝐈𝐓𝐄𝐌\s\·\s.+/g)){
                let textArr = text.split(" · ");
                fetch('./api/item?type=search', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: `id=${textArr[0]}&code=${code}`
                })
                .then(response => response.json())
                .then(data => {
                    if(data.response == 200){
                        $('#check_import_item').attr('href', $('#check_import_item').attr('href')+textArr[0]);
                        $('#image_import_item').attr('src', $('#image_import_item').attr('level')+data.data.img);
                        $('#title_import_item').html(data.data.title);
                        $('#Modal_item').modal('show');
                    }
                    navigator.clipboard.writeText("已查看物品🛒 [口令失效]❌ · " + text);
                });
            }
        })
        .catch(error => {
            console.log("Error Clipboard: ", error);
        });
    }else{
        console.log("Can not access clipboard");
    }
    //Show ad
    if(document.querySelector("#ad_main")){
        $('#Modal').modal('show');
    }
    //Download PWA
    if((!localStorage.getItem('PWA_installed') || localStorage.getItem('PWA_installed') === "false") && (localStorage.getItem('Request_install') < 3)){
        $('#download').addClass('d-flex');

        $('#installclose').click(function (e) { 
            e.preventDefault();
            $('#download').removeClass('d-flex');

            if(localStorage.getItem('Request_install')){
                localStorage.setItem('Request_install', parseInt(localStorage.getItem('Request_install')) +1);
            }else{
                localStorage.setItem('Request_install', 1);
            }
        });
    }
    //New User
    if(!localStorage.getItem('New_user_request') || localStorage.getItem('New_user_request') == "false"){
        $('.new_user').addClass('d-inline');
    }
    //Menu
    function openMenu(){
        categorySection.classList.add('openMenu');
    }
    function closeMenu(){
        categorySection.classList.remove('openMenu');
    }
    let categorySection = document.querySelector("section#category");
    let menuToggle = document.querySelectorAll(".menu-button"); //First close because the item it's before
    if(menuToggle[1]){
        menuToggle[1].addEventListener("click", openMenu); //Open
        menuToggle[0].addEventListener("click", closeMenu); //Close
    }
    let inputSearch = document.querySelector("section#category input#search-input");
    let clearInput = document.querySelector("section#category div#clear-search-text");
    //Function of search
    function searchButtonFunction(e){
        if(e.keyCode == 13){
            let url;
            if(!isNaN(inputSearch.value)){
                url = (searchSomething)?"../item?item=" + parseInt(inputSearch.value):"./item?item=" +parseInt(inputSearch.value);
            }else{
                url = (searchSomething)?"../category/all?search=" + inputSearch.value:"./category/all?search=" + inputSearch.value;
            }
            location.href = url;
        }
    }

    inputSearch.addEventListener("focusin", ()=>{
        inputSearch.parentElement.classList.add("active");
        clearInput.classList.add("active")
    });
    inputSearch.addEventListener("focusout", ()=>{
        inputSearch.parentElement.classList.remove("active");
        if(inputSearch.value == ""){
            clearInput.classList.remove("active");
        }
    });
    inputSearch.addEventListener('keypress', searchButtonFunction);

    //------------
    clearInput.addEventListener("click", ()=>{
        inputSearch.value = "";
        clearInput.classList.remove("active");
    });


});
//Function redirect item link
function href_item(dom){
    document.location = (searchSomething)?"../item?item=" + dom.getAttribute("href_item"):"./item?item=" + dom.getAttribute("href_item");
}