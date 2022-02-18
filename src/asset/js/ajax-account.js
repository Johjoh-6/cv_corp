//Update account details
$('#edit').on('click', function(e){
    const form = document.querySelector('#detail-account');
    id = e.currentTarget.dataset.id;
    e.preventDefault();
    const firstName = document.querySelector('#first_name').value;
    const lastName = document.querySelector('#last_name').value;
    const email = document.querySelector('#email').value;
    const phone = document.querySelector('#phone').value;
    const adress = document.querySelector('#adress').value;
    const img = document.querySelector('#img-profil').value;
    $.ajax({
        url: ajaxurl,
        type: 'POST',
        data: {
            action: 'ajax_account',
            id: id,
            first_name: firstName,
            last_name: lastName,
            email: email,
            phone: phone,
            adress: adress,
            img: img
        },
        success: function (res){
            console.log(res);
           showInAccount(res);
           showError(res);
           showSuccess(res);
            resetForm(form);
        }
    })

})

function showInAccount(res){
    document.querySelector('#first_name').setAttribute('placeholder', res.first_name);
    document.querySelector('#last_name').setAttribute('placeholder', res.last_name);
    document.querySelector('#email').setAttribute('placeholder', res.email);
    document.querySelector('#phone').setAttribute('placeholder', res.phone);
    document.querySelector('#adress').setAttribute('placeholder', res.adress);
    // document.querySelector('#img-profil').setAttribute('src', res.img)
}

function showError(res){
    const display = document.querySelector('#form-account');
    display.innerHTML = '';
    for(const errors in res.errors){
        const p = document.createElement('p');
        p.innerText = res.errors[errors];
        display.appendChild(p);
    }
    
}

function showSuccess(res){
    const display = document.querySelector('#form-account');
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
