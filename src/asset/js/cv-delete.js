
let id =
$.ajax({
    url: ajaxurl,
    type: 'POST',
    data: {
        action: 'ajax_cv_delete',
        id: id,
    },
    success: function (res){
        showError(res);
        showSuccess(res);
        resetForm(form);
    }
})