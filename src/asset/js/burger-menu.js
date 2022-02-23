const header = document.querySelector('#header');
const btnMenu = document.querySelector('#menu-burger');

btnMenu.addEventListener('click', ()=>{
    console.log('header');
    const navPhone = header.querySelector('#box_header_nav_phone');
    btnMenu.style.display = 'none';
    btnMenu.style.visibility = 'hidden';
    navPhone.style.display = 'block';
    navPhone.style.visibility = 'visible';
    const div = document.createElement('div');
    const iClose = document.createElement('i');
    div.id = 'close';
    iClose.classList.add('fa-solid');
    iClose.classList.add('fa-xmark');
    div.appendChild(iClose);
    navPhone.appendChild(div);

    div.addEventListener('click', ()=>{
        navPhone.style.display = 'none';
        navPhone.style.visibility = 'hidden';
        showBtn();
    })
    window.addEventListener('click', (event) =>{
        if (event.target == navPhone) {
            navPhone.style.visibility = 'hidden';
            navPhone.style.display = 'none';
            showBtn();
        }
    });
})

const showBtn = () =>{
    btnMenu.style.display = 'block';
    btnMenu.style.visibility = 'visible';
}