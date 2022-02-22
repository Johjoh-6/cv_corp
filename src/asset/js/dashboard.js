if (document.body.contains(document.querySelector('#dashboard')))  {




    function showCvSearch(array) {
        let i = 0
        if(array.length >0) {
            document.querySelector('.container_candidat').style.display = 'none'
            document.querySelector('.container_candidat_search').innerHTML = ""
            array.forEach(function () {
                console.log(array[i])
                if (array[i].imgSrc) {
                document.querySelector('.container_candidat_search').innerHTML +=
                    `<div className="box_candidat new">
                <div className="box_candidat_1">
                        
                    <div className="candidat_picture">
                        <img src="`+array[i].imgSrc+`) ?>" alt="ici photo du candidat">
                    </div>
                    <div className="box_text_profil_candidat">
                        <h1>`+array[i].title+`</h1>
                        <p>Nom : `+array[i].nom+`</p>
                        <p>Prénom : `+array[i].prenom+`</p>
                        <div className="cta_candit">
                            <a href="`+array[i].link+`">Voir ce CV</a>
                        </div>
                    </div>
                </div>
            </div>` } else {
                    document.querySelector('.container_candidat_search').innerHTML +=
                        `<div className="box_candidat new">
                <div className="box_candidat_1">
                    <div className="box_text_profil_candidat">
                        <h1>`+array[i].title+`</h1>
                        <p>Nom : `+array[i].nom+`</p>
                        <p>Prénom : `+array[i].prenom+`</p>
                        <div className="cta_candit">
                            <a href="`+array[i].link+`">Voir ce CV</a>
                        </div>
                    </div>
                </div>
            </div>`
                }
                i++

            })
        } else {
            document.querySelector('.container_candidat').style.display = 'flex'
            document.querySelector('.container_candidat_search').innerHTML = ""
        }

    }


    console.log('bite')
    document.querySelector('#searchDash').onkeyup = (function () {
        if (document.querySelector('#searchDash').value) {
            $.ajax({
                type: "POST",
                url: ajaxurl,
                data: {
                    action: 'ajax_dash_search',
                    searchData: {
                        value: document.querySelector('#searchDash').value
                    }
                },
                // contentType: "application/json",
                dataType: 'json',
                beforeSend: function () {
                    console.log('AJAX SENT')
                },
                success: function (response) {
                    // showCvSearch(response)
                    console.log(response)
                    showCvSearch(response)

                }
            })
        }
    })
}











