window.addEventListener("load", ()=>{
    function copyLinkClipboard(){
        var textArea = document.createElement("textarea");
        textArea.value = document.getElementById("copy_text_invitation").innerText;
        
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
                $('main button#copy_invitation').tooltip('show');
                setTimeout(()=>{
                    $('main button#copy_invitation').tooltip('hide');
                }, 1500);
            }
        } catch (err) {
            $('main button#copy_invitation').prop('title', '无法复制，请手动');
            $('main button#copy_invitation').tooltip('show');
            setTimeout(()=>{
                $('main button#copy_invitation').tooltip('hide');
            }, 1500);
        }

        document.body.removeChild(textArea);
    }
    $('main button#copy_invitation').tooltip({trigger: "click", delay: 300});
    $('main button#copy_invitation').click(copyLinkClipboard);
});