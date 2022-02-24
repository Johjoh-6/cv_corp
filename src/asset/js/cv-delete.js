allMyCv = document.querySelectorAll('.cta_candit .deleteCvBtn')
for (let i = 0; i < allMyCv.length; i++) {
    allMyCv[i].onclick = function(e) {
        e.preventDefault()
        // console.log(allMyCv)
        let id = allMyCv[i].dataset.cvid
        console.log(id)
            $.ajax({
                url: ajaxurl,
                type: 'POST',
                data: {
                    action: 'ajax_cv_delete',
                    id: id,
                },
                success: function (res){
                    console.log(res)
                    window.location.reload();
                }
            })
    }
}
