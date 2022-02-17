const btnMenu = document.querySelector('#menu-burger');
const navPhone = document.querySelector('#navigator-phone');

btnMenu.addEventListener('click', ()=>{
    console.log('header');
    const navPhone = document.querySelector('#navigator-phone');
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