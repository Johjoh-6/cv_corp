const header = document.querySelector('#header');
const btnMenu = header.querySelector('#menu-burger');

btnMenu.addEventListener('click', ()=>{
    console.log('header');
    const navPhone = header.querySelector('#box_header_nav_phone');
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