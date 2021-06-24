window.addEventListener('load', ()=>{
    let time = 400;
    setTimeout(()=>{
        document.body.removeChild(document.querySelector('section#welcome'))
    }, 6 * time);
});