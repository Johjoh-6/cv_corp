if (document.body.contains(document.querySelector('#dashboard')))  {

    const baseCv = document.querySelector('#baseCV');
    const resultDiv = document.querySelector('#result_search');

    function showCvSearch(array) {
        if(array.length > 0) {
            baseCv.style.display = 'none';
            resultDiv.innerHTML = "";
            array.map(single => {
                    resultDiv.innerHTML +=
                    `<div  class="box_candidat default">
                        <img  class="candidat_picture"src="${single.imgSrc}" alt="Photo de ${single.nom}">
                            <h4>${single.title}</h4>
                            <p>Nom : ${single.nom}</p>
                            <p>Prénom : ${single.prenom}</p>
                            <a class="cta_candit" href="${single.link}">Voir ce CV</a>
                    </div>`; 
            })
        } else {
            baseCV.style.display = 'flex';
            resultDiv.innerHTML = "";
        }
    }

    const search = document.querySelector('#searchDash');
    search.onkeyup = (function (e) {
        e.preventDefault();
            console.log(search.value);
            $.ajax({
                type: "POST",
                url: ajaxurl,
                data: {
                    action: 'ajax_dash_search',
                    search: search.value
                },
                // contentType: "application/json",
                dataType: 'json',
                success: function (response) {
                    showCvSearch(response);
                }
            })
    })
}











