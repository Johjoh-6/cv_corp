console.log('cvJS')

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

let dataCv = {
    nomCv: 'NOM ICI',
    prenomCv: '',
    emailCv: '',
    phoneCv: '',
    adresseCv: '',
    testID: '',
    image: '',
    experiences: []
}
if (typeof retrieveCVSave() != 'undefined') {
    console.log('retrieving save')
    dataCv = retrieveCVSave()
    console.log(retrieveCVSave())
}
let i = 0
console.log(dataCv.experiences)
dataCv.experiences.forEach(function () {

    const liExp = '<li class="singleExperience flex" data-expId ="'+i+'"><button class="deleteExpBtn" data-expIdDelBtn ="'+i+'">Supprimer</button><div><h2 class="expTitle"></h2><p class="expDates"></p><p class="expDetails"></p></div></li>'
    const liExpCv = '<li class="singleExperienceCv flex" data-expId ="'+i+'"><div><h2 class="expTitle"></h2><p class="expDates"></p><p class="expDetails"></p></div></li>'
    let expTitle= dataCv.experiences[i]['job'] +' chez '+ dataCv.experiences[i]['entreprise']
    let expDates= dataCv.experiences[i]['expStart'] +' - '+ dataCv.experiences[i]['expEnd']
    let expDetails= dataCv.experiences[i]['expDetails']
    document.querySelector('.experienceList').innerHTML+=liExp
    document.querySelector('.experienceList .singleExperience:last-of-type .expTitle').innerText = expTitle
    document.querySelector('.experienceList .singleExperience:last-of-type .expDetails').innerText = expDetails
    document.querySelector('.experienceList .singleExperience:last-of-type .expDates').innerText = expDates
    document.querySelector('.experienceListCv').innerHTML+=liExpCv
    document.querySelector('.experienceListCv .singleExperienceCv:last-of-type .expTitle').innerText = expTitle
    document.querySelector('.experienceListCv .singleExperienceCv:last-of-type .expDetails').innerText = expDetails
    document.querySelector('.experienceListCv .singleExperienceCv:last-of-type .expDates').innerText = expDates

    i++
})




if (document.body.contains(document.querySelector('.full_page')))  {
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
        document.querySelector('.experienceList .singleExperience:last-of-type .expTitle').innerText = expTitle
        document.querySelector('.experienceList .singleExperience:last-of-type .expDetails').innerText = expDetails
        document.querySelector('.experienceList .singleExperience:last-of-type .expDates').innerText = expDates
        document.querySelector('.experienceListCv').innerHTML+=liExpCv
        document.querySelector('.experienceListCv .singleExperienceCv:last-of-type .expTitle').innerText = expTitle
        document.querySelector('.experienceListCv .singleExperienceCv:last-of-type .expDetails').innerText = expDetails
        document.querySelector('.experienceListCv .singleExperienceCv:last-of-type .expDates').innerText = expDates
    }
    dataCVSave()
    Object.values(dataCv).onchange = console.log('savetest');
}


//SUPPRESSION EXPERIENCE
let delBtns = document.querySelectorAll('.deleteExpBtn')
for(let i = 0; i<delBtns.length; i++) {
    delBtns[i].onclick = function() {
        console.log('click')
        let expToDelete = this.dataset.expiddelbtn
        console.log(expToDelete)
        // localStorage.removeItem(dataCv.experiences[expToDelete])
        dataCv['experiences'].splice(expToDelete,1)
        dataCVSave()
        // retrieveCVSave().experiences.splice(expToDelete,1)
        // console.log(localStorage)
        console.log(dataCv)
        let domElemToDelete = document.querySelector('.singleExperience[data-expId = "'+expToDelete+'"]')
        domElemToDelete.remove()
        domElemToDelete = document.querySelector('.singleExperienceCv[data-expId = "'+expToDelete+'"]')
        domElemToDelete.remove()
    }
}