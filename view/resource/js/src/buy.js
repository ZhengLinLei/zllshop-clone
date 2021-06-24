window.addEventListener("load", ()=>{
    function copyLinkClipboard(){
        var textArea = document.createElement("textarea");
        textArea.value = jsonToCopy;
        
        // Avoid scrolling to bottom
        textArea.style.top = "0";
        textArea.style.left = "0";
        textArea.style.opacity = "0";
        textArea.style.position = "fixed";

        document.body.appendChild(textArea);
        textArea.focus();
        function isOS() {
            return ['iPad Simulator','iPhone Simulator','iPod Simulator','iPad','iPhone','iPod'].includes(navigator.platform) || (navigator.userAgent.includes("Mac") && "ontouchend" in document) || navigator.userAgent.match(/ipad|iphone/i);
        }
        var range, selection;
        if (isOS()) {
            range = document.createRange();
            range.selectNodeContents(textArea);
            selection = window.getSelection();
            selection.removeAllRanges();
            selection.addRange(range);
        } else {
            textArea.select();
        }
        textArea.select();
        textArea.setSelectionRange(0, 99999);

        try {
            var successful = document.execCommand('copy');
            if(successful){
                $('section#buy div#copy_link').tooltip('show');
                setTimeout(()=>{
                    $('section#buy div#copy_link').tooltip('hide');
                }, 1500);
            }
        } catch (err) {
            $('section#buy div#copy_link').prop('title', '无法复制');
            $('section#buy div#copy_link').tooltip('show');
            setTimeout(()=>{
                $('section#buy div#copy_link').tooltip('hide');
            }, 1500);
        }

        document.body.removeChild(textArea);
    }
    $('section#buy div#copy_link').tooltip({trigger: "click", delay: 300});
    $('section#buy div#copy_link').click(copyLinkClipboard);
});
function buyEnd(){
    let body = "code="+code;
    
    fetch('../api/item?type=delete_all', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: body
    })
    .then(response => response.json())
    .then(data => {
        if(data.response == 200){
            location.href = '../cart';
        }
    });
}
