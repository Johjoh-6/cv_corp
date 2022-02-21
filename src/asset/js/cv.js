if (document.body.contains(document.querySelector('.full_page')))  {
    console.log('cvJS')
    let star= '<i class="fa-solid fa-star"></i>'
    let starEmpty= '<i class="fa-regular fa-star"></i>'

    //CREATION ET CHARGEMENT DE LA DATA DU CV
    let localStorageSave = localStorage
    function dataCVSave() {
        if (typeof dataCv != 'undefined') {
            console.log('cv autosavve')
            localStorageSave.setItem("dataCv", JSON.stringify(dataCv))
            console.log(localStorageSave)
        }
    }
    function retrieveCVSave() {
        if (typeof localStorageSave.dataCv != 'undefined') {
            return JSON.parse(localStorageSave.dataCv)
        }
    }

    function addExpDelBtn() {
        let delBtns = document.querySelectorAll('.deleteExpBtn')
        for(let i = 0; i<delBtns.length; i++) {
            delBtns[i].onclick = function() {
                console.log('click')
                let expToDelete = this.dataset.expiddelbtn
                console.log(expToDelete)
                dataCv['experiences'].splice(expToDelete,1)
                dataCVSave()
                console.log(dataCv)
                let domExpToDelete = document.querySelector('.singleExperience[data-expId = "'+expToDelete+'"]')
                domExpToDelete.remove()
                domExpToDelete = document.querySelector('.singleExperienceCv[data-expId = "'+expToDelete+'"]')
                domExpToDelete.remove()
            }
        }
    }
    function addFormDelBtn() {
        let delBtns = document.querySelectorAll('.deleteFormBtn')
        for(let i = 0; i<delBtns.length; i++) {
            delBtns[i].onclick = function() {
                console.log('click')
                let formToDelete = this.dataset.formiddelbtn
                console.log(formToDelete)
                dataCv['formations'].splice(formToDelete,1)
                dataCVSave()
                console.log(dataCv)
                let domFormToDelete = document.querySelector('.singleFormation[data-expId = "'+formToDelete+'"]')
                domFormToDelete.remove()
                domFormToDelete = document.querySelector('.singleFormationCv[data-expId = "'+formToDelete+'"]')
                domFormToDelete.remove()
            }
        }
    }
    function capitalizeFirstLetter(string) {
        return string.charAt(0).toUpperCase() + string.slice(1)
    }
    function addTxtLineModale(category, elemName, dataName) {
        document.querySelector('.'+ category +'List .single'+ capitalizeFirstLetter(category) +':last-of-type .'+ elemName).innerText = dataName
    }
    function addTxtLineModaleCv(category, elemName, dataName) {
        document.querySelector('.'+ category +'ListCv .single'+ capitalizeFirstLetter(category) +'Cv:last-of-type .'+ elemName).innerText = dataName
    }

    function addStarsOutOfFive(level, target) {
        level.forEach(function() {
            document.querySelector('.single'+capitalizeFirstLetter(target)+':last-of-type .niveau'+capitalizeFirstLetter(target)).innerHTML += star
            console.log('ok')
        })
        for (let nivNegative = level.length; nivNegative < 5; nivNegative++) {
            document.querySelector('.single'+capitalizeFirstLetter(target)+':last-of-type .niveau'+capitalizeFirstLetter(target)).innerHTML += starEmpty
        }
    }

    function addStarsOutOfFiveCv(level, target) {
        level.forEach(function() {
            document.querySelector('.single'+capitalizeFirstLetter(target)+'Cv:last-of-type .niveau'+capitalizeFirstLetter(target)).innerHTML += star
            console.log('ok')
        })
        for (let nivNegative = level.length; nivNegative < 5; nivNegative++) {
            document.querySelector('.single'+capitalizeFirstLetter(target)+'Cv:last-of-type .niveau'+capitalizeFirstLetter(target)).innerHTML += starEmpty
        }
    }



    let dataCv = {
        nomCv: 'NOM ICI',
        prenomCv: '',
        emailCv: '',
        phoneCv: '',
        adresseCv: '',
        ID: '',
        image: '',
        experiences: [],
        formations: [],
        langues: [],
    }

    if (typeof retrieveCVSave() != 'undefined') {
        console.log('retrieving save')
        dataCv = retrieveCVSave()
        console.log(retrieveCVSave())
    }
    let e = 0
    let f = 0
    let l = 0
    console.log(dataCv.experiences)
    dataCv.experiences.forEach(function () {

        const liExp = '<li class="singleExperience flex" data-expId ="'+e+'"><button class="deleteExpBtn" data-expIdDelBtn ="'+e+'">Supprimer</button><div><h2 class="expTitle"></h2><p class="expDates"></p><p class="expDetails"></p></div></li>'
        const liExpCv = '<li class="singleExperienceCv flex" data-expId ="'+e+'"><div><h2 class="expTitle"></h2><p class="expDates"></p><p class="expDetails"></p></div></li>'
        let expTitle= dataCv.experiences[e]['job'] +' chez '+ dataCv.experiences[e]['entreprise']
        let expDates= dataCv.experiences[e]['expStart'] +' - '+ dataCv.experiences[e]['expEnd']
        let expDetails= dataCv.experiences[e]['expDetails']
        document.querySelector('.experienceList').innerHTML+=liExp
        addTxtLineModale('experience', 'expTitle',expTitle)
        if (expDetails) {
            addTxtLineModale('experience', 'expDetails',expDetails)
        }
        addTxtLineModale('experience', 'expDates',expDates)
        document.querySelector('.experienceListCv').innerHTML+=liExpCv
        addTxtLineModaleCv('experience', 'expTitle',expTitle)
        if (expDetails) {
            addTxtLineModaleCv('experience', 'expDetails',expDetails)
        }
        addTxtLineModaleCv('experience', 'expDates',expDates)

        e++
    })
    dataCv.formations.forEach(function () {

        const liForm = '<li class="singleFormation flex" data-expId ="'+(dataCv.formations.length - 1)+'">' +
            '<button class="deleteFormBtn" data-formIdDelBtn ="'+(dataCv.formations.length - 1)+'">Supprimer</button>' +
            '<div><h2 class="formTitle"></h2><p class="formLieu"></p><p class="formDates"></p><p class="formDetails"></p></div>' +
            '</li>'
        const liFormCv = '<li class="singleFormationCv flex" data-expId ="'+(dataCv.formations.length - 1)+'">' +
            '<div><h2 class="formTitle"></h2><p class="formLieu"><p class="formDates"></p><p class="formDetails"></p></div>' +
            '</li>'
        let formTitle= dataCv.formations[f]['nomFormation'] +' chez '+ dataCv.formations[f]['organisme']
        let formDates= dataCv.formations[f]['formStart'] +' - '+ dataCv.formations[f]['formEnd']
        let formDetails= dataCv.formations[f]['formDetails']
        let formLieu= dataCv.formations[f]['formLieu']
        document.querySelector('.formationList').innerHTML+=liForm
        addTxtLineModale('formation', 'formTitle',formTitle)
        addTxtLineModale('formation', 'formDates',formDates)
        addTxtLineModale('formation', 'formDetails',formDetails)
        addTxtLineModale('formation', 'formLieu',formLieu)
        document.querySelector('.formationListCv').innerHTML+=liFormCv

        addTxtLineModaleCv('formation', 'formTitle',formTitle)
        addTxtLineModaleCv('formation', 'formDates',formDates)
        addTxtLineModaleCv('formation', 'formDetails',formDetails)
        addTxtLineModaleCv('formation', 'formLieu',formLieu)

        f++
    })
    dataCv.langues.forEach(function () {

        let niveauLangue= []
        for (let nivIndex = 1; nivIndex <= dataCv.langues[l].niveau; nivIndex++) {
            niveauLangue.push(nivIndex)
        }
        dataCVSave()
        console.log(dataCVSave())
        document.querySelector('.langueModale').style.display = 'none';
        const liLangue = '<li class="singleLangue flex" data-expId ="'+(dataCv.langues.length - 1)+'"><button class="deleteLanBtn" data-expIdDelBtn ="'+(dataCv.langues.length - 1)+'">Supprimer</button><div><h2 class="langue"></h2><ul class="niveauLangue"></ul></div></li>'
        const liLangueCv = '<li class="singleLangueCv flex" data-expId ="'+(dataCv.langues.length - 1)+'"><div><h2 class="langue"></h2><ul class="niveauLangue"></ul></div></li>'
        let langue= dataCv.langues[l].langue
        document.querySelector('.langueList').innerHTML+=liLangue
        addTxtLineModale('langue', 'langue',langue)
        addStarsOutOfFive(niveauLangue,"langue")
        document.querySelector('.langueListCv').innerHTML+=liLangueCv
        addTxtLineModaleCv('langue', 'langue',langue)

        addStarsOutOfFiveCv(niveauLangue,"langue")

        l++
    })













    //gestion des des inputs en VUE
    var cvInputs = new Vue({
        el: '.full_page',
        data: dataCv,
        methods: {
            onChangePfp() {
                console.log('lol')
                let imgInp = document.querySelector('input#photo')
                const [file] = imgInp.files
                if (file) {
                    dataCv.image = URL.createObjectURL(file)
                }
            },
            autosave() {
                dataCVSave()
            }
        }
    })





    document.getElementById('experienceBtn').onclick = function() {
        document.querySelector('.experienceModale').style.display = 'block';
    }


    document.getElementById('experienceAdd').onclick = function() {
        let singleExperience = {
            entreprise: document.querySelector('.experienceModale #entreprise').value,
            job: document.querySelector('.experienceModale #job').value,
            expStart: document.querySelector('.experienceModale #expStart').value,
            expEnd: document.querySelector('.experienceModale #expEnd').value,
            expDetails: document.querySelector('.experienceModale #expDetails').value,
        }
        dataCv.experiences.push(singleExperience)
        dataCVSave()
        console.log(dataCVSave())
        document.querySelector('.experienceModale').style.display = 'none';
        const liExp = '<li class="singleExperience flex" data-expId ="'+(dataCv.experiences.length - 1)+'"><button class="deleteExpBtn" data-expIdDelBtn ="'+(dataCv.experiences.length - 1)+'">Supprimer</button><div><h2 class="expTitle"></h2><p class="expDates"></p><p class="expDetails"></p></div></li>'
        const liExpCv = '<li class="singleExperienceCv flex" data-expId ="'+(dataCv.experiences.length - 1)+'"><div><h2 class="expTitle"></h2><p class="expDates"></p><p class="expDetails"></p></div></li>'
        let expTitle= singleExperience.job +' chez '+ singleExperience.entreprise
        let expDates= singleExperience.expStart +' - '+ singleExperience.expEnd
        let expDetails= singleExperience.expDetails
        document.querySelector('.experienceList').innerHTML+=liExp
        addTxtLineModale('experience', 'expTitle',expTitle)
        addTxtLineModale('experience', 'expDetails',expDetails)
        addTxtLineModale('experience', 'expDates',expDates)
        document.querySelector('.experienceListCv').innerHTML+=liExpCv
        addTxtLineModaleCv('experience', 'expTitle',expTitle)
        addTxtLineModaleCv('experience', 'expDetails',expDetails)
        addTxtLineModaleCv('experience', 'expDates',expDates)

        //SUPPRESSION EXPERIENCE
        addExpDelBtn()
    }

    //LANGUE
    document.getElementById('langueBtn').onclick = function() {
        document.querySelector('.langueModale').style.display = 'block';
        document.querySelector('.langueModale input.langue').onchange = (function() {
            if (document.querySelector('.langueModale input.langue').value) {
                document.querySelector('.langueModale select.langue').disabled = true
            } else {
                document.querySelector('.langueModale select.langue').disabled = false
            }
        })
        document.querySelector('.langueModale select.langue').onchange = (function() {
            if (document.querySelector('.langueModale select.langue').value) {
                document.querySelector('.langueModale input.langue').disabled = true
            } else {
                document.querySelector('.langueModale input.langue').disabled = false
            }
        })
    }


    document.getElementById('langueAdd').onclick = function() {
            let singleLangue = {
                id:document.querySelector('.langueModale select.langue option:checked').value,
                langue: document.querySelector('.langueModale select.langue option:checked').textContent+document.querySelector('.langueModale input.langue').value,
                niveau: document.querySelector('.langueModale #niveauLangue').value,
            }

        let niveauLangue= []
        for (let nivIndex = 1; nivIndex <= singleLangue.niveau; nivIndex++) {
            niveauLangue.push(nivIndex)
        }
        dataCv.langues.push(singleLangue)
        dataCVSave()
        document.querySelector('.langueModale').style.display = 'none';
        const liLangue = '<li class="singleLangue flex" data-expId ="'+(dataCv.langues.length - 1)+'"><button class="deleteLanBtn" data-expIdDelBtn ="'+(dataCv.langues.length - 1)+'">Supprimer</button><div><h2 class="langue"></h2><ul class="niveauLangue"></ul></div></li>'
        const liLangueCv = '<li class="singleLangueCv flex" data-expId ="'+(dataCv.langues.length - 1)+'"><div><h2 class="langue"></h2><ul class="niveauLangue"></ul></div></li>'
        let langue= singleLangue.langue
        document.querySelector('.langueList').innerHTML+=liLangue
        addTxtLineModale('langue', 'langue',langue)
        niveauLangue.forEach(function() {
            document.querySelector('.singleLangue:last-of-type .niveauLangue').innerHTML += star
            console.log('ok')
        })
        for (let nivNegative = singleLangue.niveau; nivNegative < 5; nivNegative++) {
            document.querySelector('.singleLangue:last-of-type .niveauLangue').innerHTML += starEmpty
        }
        document.querySelector('.langueListCv').innerHTML+=liLangueCv
        addTxtLineModaleCv('langue', 'langue',langue)
        niveauLangue.forEach(function() {
            document.querySelector('.singleLangueCv:last-of-type .niveauLangue').innerHTML += star
            console.log('ok')
        })
        for (let nivNegative = singleLangue.niveau; nivNegative < 5; nivNegative++) {
            document.querySelector('.singleLangueCv:last-of-type .niveauLangue').innerHTML += starEmpty
        }
        //SUPPRESSION LANGUE
    }

    document.getElementById('formationBtn').onclick = function() {
        document.querySelector('.formationModale').style.display = 'block';
    }

    document.getElementById('formationAdd').onclick = function() {
        let singleFormation = {
            organisme: document.querySelector('.formationModale #organisme').value,
            nomFormation: document.querySelector('.formationModale #nomFormation').value,
            formStart: document.querySelector('.formationModale #formStart').value,
            formEnd: document.querySelector('.formationModale #formEnd').value,
            formDetails: document.querySelector('.formationModale #formDetails').value,
            formLieu: document.querySelector('.formationModale #formLieu').value,
        }
        dataCv.formations.push(singleFormation)
        dataCVSave()
        console.log(dataCVSave())
        document.querySelector('.formationModale').style.display = 'none';

        const liForm = '<li class="singleFormation flex" data-expId ="'+(dataCv.formations.length - 1)+'">' +
            '<but' +
            'ton class="deleteFormBtn" data-formIdDelBtn ="'+(dataCv.formations.length - 1)+'">Supprimer</button>' +
            '<div><h2 class="formTitle"></h2><p class="formLieu"><p class="formDates"></p><p class="formDetails"></p></div>' +
            '</li>'
        const liFormCv = '<li class="singleFormationCv flex" data-expId ="'+(dataCv.formations.length - 1)+'">' +
            '<div><h2 class="formTitle"></h2><p class="formLieu"></p><p class="formDates"></p><p class="formDetails"></p></div>' +
            '</li>'
        let formTitle= singleFormation.nomFormation +' chez '+ singleFormation.organisme
        let formDates= singleFormation.formStart +' - '+ singleFormation.formEnd
        let formDetails= singleFormation.formDetails
        let formLieu= singleFormation.formLieu

        document.querySelector('.formationList').innerHTML+=liForm
        addTxtLineModale('formation', 'formTitle',formTitle)
        addTxtLineModale('formation', 'formDates',formDates)
        addTxtLineModale('formation', 'formDetails',formDetails)
        addTxtLineModale('formation', 'formLieu',formLieu)



        document.querySelector('.formationListCv').innerHTML+=liFormCv

        addTxtLineModaleCv('formation', 'formTitle',formTitle)
        addTxtLineModaleCv('formation', 'formDates',formDates)
        addTxtLineModaleCv('formation', 'formDetails',formDetails)
        addTxtLineModaleCv('formation', 'formLieu',formLieu)

        addFormDelBtn()
    }
    dataCVSave()
    Object.values(dataCv).onchange = console.log('savetest');











//SUPPRESSION EXPERIENCE

    addExpDelBtn()
    addFormDelBtn()














document.querySelector('.saveBtn').onclick = function() {
    console.log('click')
    console.log(dataCv)
    $.ajax({
        type: "POST",
        url: ajaxurl,
        data: {
            action: 'ajax_cv',
            data : dataCv
        },
        // contentType: "application/json",
        // dataType: 'json',
        beforeSend: function (){
            console.log('AJAX SENT')
        },
        success: function (response) {
            let responseData = response
            let cvId = responseData.trim().charAt(0)
            dataCv.ID = cvId
            console.log(cvId)
            dataCVSave()
            console.log('----')
        },
    })

}
}
















