const formAccountRegister = document.querySelector('#register-page');
if(formAccountRegister){
    const errors = formAccountRegister.querySelectorAll('.error-form');
    errors.forEach($error => {
        if($error.textContent != ''){
            $error.style.cssText = `
            background-color: #ffffff;
            border-radius: 5px;
           padding: .3rem .5rem;
           width: 100%;
           margin-bottom: .6rem;`
        }
    })
}
