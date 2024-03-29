window.addEventListener('load', ()=>{
    const ControlNumberItem = {
        number_item: 1,
        minus: function(){
            if(ControlNumberItem.number_item >= 2){
                ControlNumberItem.number_item--;
                ControlNumberItem.write();
            }
        },
        plus: function(){
            ControlNumberItem.number_item++;
            ControlNumberItem.write();
        },
        write: function(){
            document.querySelector("div.number_item span#number_of_item").innerHTML = ControlNumberItem.number_item;
        }
    }

    let number_control = document.querySelectorAll("div#number_minus, div#number_plus");
    number_control[0].addEventListener("click", ControlNumberItem.minus);
    number_control[1].addEventListener("click", ControlNumberItem.plus);

    let button_add_cart = document.querySelector("section#item button#button_add");
    //TOOLTIPS
    $('section#item button#button_add').tooltip({trigger: "click", delay: 300});
    $('section#item div#copy_link').tooltip({trigger: "click", delay: 100});

    button_add_cart.addEventListener("click", ()=>{
        $("section#item button#button_add").tooltip('hide');

        data_item.text = document.querySelector("input#item_description_option").value;
        data_item.number_item = parseInt(ControlNumberItem.number_item);
        var body = "data="+JSON.stringify(data_item)+"&code="+button_add_cart.getAttribute("key-code");

        fetch('./api/item?type=add', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: body
        })
        .then(response => response.json())
        .then(data => {
            if(data.response == 200){
                $("section#item button#button_add").tooltip('show');
                let footer_cart = document.querySelector("footer#footer div#footer-cart");
                if(footer_cart.querySelector("span#notification")){
                    let notification = footer_cart.querySelector("span#notification");

                    notification.innerHTML = parseInt(notification.innerHTML) + 1;
                }else{
                    let notification = document.createElement("span")
                    notification.innerHTML = 1;
                    notification.classList.add("badge", "badge-pill", "badge-danger", "small");
                    notification.id = "notification";

                    footer_cart.querySelector("a").appendChild(notification);
                }
            }
        });
    });
});
function copyLinkClipboard(el){
    var textArea = document.createElement("textarea");
    textArea.value = ((el.getAttribute('copy-text') != 'url')?el.getAttribute('copy-text'):location.href);
    
    // Avoid scrolling to bottom
    textArea.style.top = "0";
    textArea.style.left = "0";
    textArea.style.position = "fixed";

    document.body.appendChild(textArea);
    textArea.focus();
    textArea.select();

    try {
        var successful = document.execCommand('copy');
        if(successful){
            $(el).tooltip('show');
            setTimeout(()=>{
                $(el).tooltip('hide');
            }, 1500);
        }
    } catch (err) {
        $(el).prop('title', '无法复制');
        $(el).tooltip('show');
        setTimeout(()=>{
            $(el).tooltip('hide');
        }, 1500);
    }

    document.body.removeChild(textArea);
}