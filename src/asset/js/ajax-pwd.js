
//Update PWD account
$('#update_password').on('click', function(e){
    const form = document.querySelector('#pwd-account');
    id = e.currentTarget.dataset.id;
    e.preventDefault();
   const pwd = 
    $.ajax({
        url: ajaxurl,
        type: 'POST',
        data: {
            action: 'ajax_account_pwd',
            id: id,
            
        },
        success: function (res){
            console.log(res);
          
           showError(res);
           showSuccess(res);
            resetForm(form);
        }
    })

})


function showError(res){
    const display = document.querySelector('#form-pwd');
    display.innerHTML = '';
    for(const errors in res.errors){
        const p = document.createElement('p');
        p.innerText = res.errors[errors];
        display.appendChild(p);
    }
    
}

function showSuccess(res){
    const display = document.querySelector('#form-pwd');
    if(res.succes){
        const p = document.createElement('p');
        p.style.color = 'green';
        p.innerText = "Modification enregistré";
        display.appendChild(p);
    }
}
function resetForm(form){
    form.reset();
}