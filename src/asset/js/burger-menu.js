const header = document.querySelector('#header');
const btnMenu = header.querySelector('#menu-burger');
console.log(btnMenu);
document.querySelector('#menu-burger').onclick = function(){
    console.log('gg');
}
document.querySelector('.intro-btn').onclick = function(e){
    e.preventDefault();
    console.log('index.js');
}
btnMenu.onclick = ()=>{
    console.log('test vue');
}
btnMenu.addEventListener('click', ()=>{
    console.log('header');
    const navPhone = header.querySelector('#navigator-phone');
    navPhone.style.display = 'block';
    navPhone.style.visibility = 'visible';
    const iClose = document.createElement('i');
    iClose.id = 'close';
    iClose.classList.add('fa-solid');
    iClose.classList.add('fa-xmark');
    navPhone.appendChild(iClose);

    iClose.addEventListener('click', ()=>{
        navPhone.style.display = 'none';
        navPhone.style.visibility = 'hidden';
    })
})