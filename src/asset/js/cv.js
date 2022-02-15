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
    console.log('retriveing save')
    dataCv = retrieveCVSave()
    console.log(retrieveCVSave())
}
let i = 0
dataCv.experiences.forEach(function () {
    console.log(dataCv.experiences)
    let liTxt=dataCv.experiences[i]['job'] +' chez '+ dataCv.experiences[i]['entreprise']
    const li = document.createElement("li")
    document.querySelector('.experienceList').appendChild(li)
    li.className = "singleExperience"
    document.querySelector('.experienceList .singleExperience:last-of-type').innerText = liTxt
    i++
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
    }
    let i = 1
    dataCv.experiences.push(singleExperience)
    dataCVSave()
    console.log(dataCVSave())
    document.querySelector('.experienceModale').style.display = 'none';
    let liTxt=singleExperience.job +' chez '+ singleExperience.entreprise
    const li = document.createElement("li")
    document.querySelector('.experienceList').appendChild(li)
    li.className = "singleExperience"
    document.querySelector('.experienceList .singleExperience:last-of-type').innerText = liTxt
}
dataCVSave()
Object.values(dataCv).onchange = console.log('savetest');