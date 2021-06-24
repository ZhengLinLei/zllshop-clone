window.addEventListener("load", () => {
    //New User
    if(!localStorage.getItem('New_user_request') || localStorage.getItem('New_user_request') == "false"){
        localStorage.setItem('New_user_request', 'true');
    }
    const downloadButton = document.querySelector("button#download_app_pwa");
    const downloadStatus = document.querySelector('div#notify_pwa_version');
    let activeDownload = false;
    let deferredPrompt;

    window.addEventListener('beforeinstallprompt', (e) => {
        localStorage.setItem('PWA_installed', 'false');
        // Prevent the mini-infobar from appearing on mobile
        e.preventDefault();
        deferredPrompt = e;
        activeDownload = true;
        // Update UI notify the user they can install the PWA
        console.log("Prepared");
        $('button#download_app_pwa').removeAttr('disabled');
        downloadStatus.querySelector("small").innerHTML = `版本 v${downloadStatus.getAttribute("version")}`
        downloadButton.addEventListener("click", () => {
            // Show the install prompt
            deferredPrompt.prompt();
            // Wait for the user to respond to the prompt
            deferredPrompt.userChoice.then((choiceResult) => {
                if (choiceResult.outcome === 'accepted') {
                    console.log('User accepted the install prompt');
                } else {
                    console.log('User dismissed the install prompt');
                }
            });
        });
    });
    setTimeout(() => {
        if(!activeDownload){
            if (window.matchMedia('(display-mode: standalone)').matches || window.matchMedia('(display-mode: fullscreen)').matches || window.navigator.standalone === true || localStorage.getItem('PWA_installed') === "true") {
                localStorage.setItem("PWA_installed", 'true');
                downloadStatus.innerHTML = `<small class="text-success">已下载 版本 v${downloadStatus.getAttribute("version")}</small>`;
            } else {
                downloadStatus.innerHTML = `<diV><small class="text-danger">无法下载 </small><a class="adv small" href="#error_download" onclick="$('#collapseEight').collapse('show')">查看原因</a></div>`;
            }
        }
    }, 3000);

    window.addEventListener('appinstalled', (event) => {
        deferredPrompt = null;
        console.log('👍', 'appinstalled', event);
        localStorage.setItem("PWA_installed", 'true');
        downloadStatus.innerHTML = `<small class="text-success">已下载 版本 v${downloadStatus.getAttribute("version")}</small>`;
    });
});