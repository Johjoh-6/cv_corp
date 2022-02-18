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
    const img = document.querySelector('#img').files[0];
    const form_data = new FormData();
    form_data.append('id', id);
    form_data.append('action', 'ajax_account');
    form_data.append('first_name', firstName);
    form_data.append('last_name', lastName);
    form_data.append('email', email);
    form_data.append('phone', phone);
    form_data.append('adress', adress);
    form_data.append('img', img);
    console.log(img);
    $.ajax({
        url: ajaxurl,
        type: 'POST',
        processData: false,
        contentType: false,
        data: form_data,
        beforeSend: function () {
            console.log('send');
        },
        success: function (res){
            console.log('response');
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
    if(res.img_url){
        document.querySelector('#img-profil').setAttribute('src', res.img_url);
    }
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
