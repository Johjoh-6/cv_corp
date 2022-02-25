if (document.body.contains(document.querySelector('.full_page')))  {
    let loadedCv = 0
    console.log('cvJS')
    let url_string = window.location.href; //window.location.href
    let url = new URL(url_string);
    let cvEditParam = url.searchParams.get('cvEdit');

    if (cvEditParam) {
        console.log(cvEditParam);
        console.log('LOAD')
        $.ajax({
            type: "POST",
            url: ajaxurl,
            data: {
                action: 'ajax_cv_load',
                data: cvEditParam
            },

            beforeSend: function (){
                console.log('AJAX SENT')
                document.querySelector('.loadingScreen').style.display = "flex"
            },
            success: function (response) {
                let responseData = response
                console.log(responseData)
                if (typeof responseData == 'string') {
                    history.back()
                }
                let dataCvLoaded = {
                    titleCv: responseData['cv_title'],
                    nomCv: responseData['user_lastname'],
                    prenomCv: responseData['user_firstname'],
                    emailCv: responseData['user_email'],
                    phoneCv: responseData['user_phone'],
                    adresseCv: responseData['user_adress'],
                    ID: cvEditParam,
                    image: responseData['id_picture'],
                    experiences: responseData['experience'],
                    formations: responseData['studies'],
                    langues: responseData['langues'],
                    hobbies: responseData['hobbie'],
                    skills: responseData['skills'],
                }

                if(!dataCvLoaded['titleCv']) {
                    dataCvLoaded['titleCv'] = ""
                }
                if(!dataCvLoaded['nomCv']) {
                    dataCvLoaded['nomCv'] = ""
                }
                if(!dataCvLoaded['prenomCv']) {
                    dataCvLoaded['prenomCv'] = ""
                }
                if(!dataCvLoaded['emailCv']) {
                    dataCvLoaded['emailCv'] = ""
                }
                if(!dataCvLoaded['phoneCv']) {
                    dataCvLoaded['phoneCv'] = ""
                }
                if(!dataCvLoaded['adresseCv']) {
                    dataCvLoaded['adresseCv'] = ""
                }
                if(!dataCvLoaded['image']) {
                    dataCvLoaded['image'] = ""
                }
                if (dataCvLoaded['experiences']) {
                    for (let i = 0; i < dataCvLoaded['experiences'].length; i++) {
                        dataCvLoaded['experiences'][i]['job'] = dataCvLoaded['experiences'][i]['job_name'];
                        delete dataCvLoaded['experiences'][i]['job_name'];
                        dataCvLoaded['experiences'][i]['entreprise'] = dataCvLoaded['experiences'][i]['company_name'];
                        delete dataCvLoaded['experiences'][i]['company_name'];
                        dataCvLoaded['experiences'][i]['expStart'] = dataCvLoaded['experiences'][i]['date_start'];
                        delete dataCvLoaded['experiences'][i]['date_start'];
                        dataCvLoaded['experiences'][i]['expEnd'] = dataCvLoaded['experiences'][i]['date_end'];
                        delete dataCvLoaded['experiences'][i]['date_end'];
                        dataCvLoaded['experiences'][i]['expDetails'] = dataCvLoaded['experiences'][i]['details'];
                        delete dataCvLoaded['experiences'][i]['details'];
                    }
                } else {
                    dataCvLoaded['experiences'] = []
                }

                if (dataCvLoaded['skills']) {
                    for (let i = 0; i < dataCvLoaded['skills'].length; i++) {
                        dataCvLoaded['skills'][i]['niveau'] = dataCvLoaded['skills'][i]['skill_level'];
                        delete dataCvLoaded['skills'][i]['skill_level'];
                        dataCvLoaded['skills'][i]['skill'] = dataCvLoaded['skills'][i]['skill_name'];
                        delete dataCvLoaded['skills'][i]['skill_name'];
                    }
                } else {
                    dataCvLoaded['skills'] = []
                }

                if (dataCvLoaded['formations']) {
                    for (let i = 0; i < dataCvLoaded['formations'].length; i++) {
                        dataCvLoaded['formations'][i]['formStart'] = dataCvLoaded['formations'][i]['date_start'];
                        delete dataCvLoaded['formations'][i]['date_start'];
                        dataCvLoaded['formations'][i]['formEnd'] = dataCvLoaded['formations'][i]['date_end'];
                        delete dataCvLoaded['formations'][i]['date_end'];
                        dataCvLoaded['formations'][i]['formDetails'] = dataCvLoaded['formations'][i]['study_details'];
                        delete dataCvLoaded['formations'][i]['study_details'];
                        dataCvLoaded['formations'][i]['formTitle'] = dataCvLoaded['formations'][i]['study_name'];
                        delete dataCvLoaded['formations'][i]['study_name'];
                        dataCvLoaded['formations'][i]['organisme'] = dataCvLoaded['formations'][i]['school_name'];
                        delete dataCvLoaded['formations'][i]['school_name'];
                        dataCvLoaded['formations'][i]['formLieu'] = dataCvLoaded['formations'][i]['school_location'];
                        delete dataCvLoaded['formations'][i]['school_location'];
                    }
                } else {
                    dataCvLoaded['formations'] = []
                }

                if (dataCvLoaded['langues']) {
                    for (let i = 0; i < dataCvLoaded['langues'].length; i++) {
                        dataCvLoaded['langues'][i]['langue'] = dataCvLoaded['langues'][i]['langue_name'];
                        delete dataCvLoaded['langues'][i]['langue_name'];
                        dataCvLoaded['langues'][i]['niveau'] = dataCvLoaded['langues'][i]['langue_level'];
                        delete dataCvLoaded['langues'][i]['langue_level'];
                    }
                } else {
                    dataCvLoaded['langues'] = []
                }
                if (dataCvLoaded['hobbies']) {
                    for (let i = 0; i < dataCvLoaded['hobbies'].length; i++) {
                        dataCvLoaded['hobbies'][i]['hobby_name'] = dataCvLoaded['hobbies'][i]['hobbie_name'];
                        delete dataCvLoaded['hobbies'][i]['hobbie_name'];
                        dataCvLoaded['hobbies'][i]['hobby_details'] = dataCvLoaded['hobbies'][i]['hobbie_details'];
                        delete dataCvLoaded['hobbies'][i]['hobbie_details'];
                    }

                } else {
                    dataCvLoaded['hobbies'] = []
                }
                console.log(dataCv)
                dataCv = dataCvLoaded
                console.log(dataCv)
                localStorageSave.setItem("dataCv", JSON.stringify(dataCv))
                console.log(localStorageSave)

                loadedCv = 1
            },
        }).done(function() {
            console.log('ajax DONE')
            if(window.location.hash) {
                document.querySelector('.loadingScreen').style.display = "none"
            }

            if(!window.location.hash) {
                window.location = window.location + '#loaded';
                window.location.reload();
            }
        })
    } else {
        localStorage.removeItem('dataCv')
        if(!window.location.hash) {
            window.location = window.location + '#new';
            window.location.reload();
        }
    }


    let star= '<i class="fa-solid fa-star"></i>'
    let starEmpty= '<i class="fa-regular fa-star"></i>'

    //CREATION ET CHARGEMENT DE LA DATA DU CV
    let localStorageSave = localStorage
    function dataCVSave() {
        console.log('cv autosavve')
        localStorageSave.setItem("dataCv", JSON.stringify(dataCv))
        console.log(localStorageSave)
        if(dataCv['titleCv'] && dataCv['adresseCv'] && dataCv['emailCv'] && dataCv['prenomCv'] && dataCv['nomCv'] && dataCv['experiences'].length>0 && dataCv['skills'].length>0 && dataCv['hobbies'].length>0 && dataCv['formations'].length>0) {
            document.querySelector('.saveBtn').style.pointerEvents = "auto"
            document.querySelector('.saveBtn').style.filter = "none"
        } else {
            document.querySelector('.saveBtn').style.pointerEvents = "none"
            document.querySelector('.saveBtn').style.filter = "grayscale(80%)"
        }

    }
    function retrieveCVSave() {
        if (typeof localStorageSave.dataCv != 'undefined') {
            return JSON.parse(localStorageSave.dataCv)
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

    function modaleCroix(modale) {
        document.querySelector(''+modale+' .remove').onclick = (function() {
            document.querySelectorAll(''+modale+' input').value = ""
            document.querySelectorAll(''+modale+' textarea').value = ""
            document.querySelector(''+modale+'').style.display = "none"
        })
    }



    let dataCv = {
        titleCv: '',
        nomCv: '',
        prenomCv: '',
        emailCv: '',
        phoneCv: '',
        adresseCv: '',
        ID: '',
        image: '',
        experiences: [],
        formations: [],
        langues: [],
        hobbies: [],
        skills: [],
    }

    if (typeof retrieveCVSave() != 'undefined') {
        console.log('retrieving save')
        dataCv = retrieveCVSave()
        console.log(retrieveCVSave())
    }

    let e = 0
    let f = 0
    let l = 0
    let h = 0
    let s = 0
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
        const liLangue = '<li class="singleLangue flex" data-langueId ="'+(dataCv.langues.length - 1)+'"><button class="deleteLanBtn" data-expIdDelBtn ="'+(dataCv.langues.length - 1)+'">Supprimer</button><div><h2 class="langue"></h2><ul class="niveauLangue"></ul></div></li>'
        const liLangueCv = '<li class="singleLangueCv flex" data-langueId ="'+(dataCv.langues.length - 1)+'"><div><h2 class="langue"></h2><ul class="niveauLangue"></ul></div></li>'
        let langue= dataCv.langues[l].langue
        document.querySelector('.langueList').innerHTML+=liLangue
        addTxtLineModale('langue', 'langue',langue)
        addStarsOutOfFive(niveauLangue,"langue")
        document.querySelector('.langueListCv').innerHTML+=liLangueCv
        addTxtLineModaleCv('langue', 'langue',langue)

        addStarsOutOfFiveCv(niveauLangue,"langue")

        l++
    })

    dataCv.skills.forEach(function () {

        let niveauSkill= []
        for (let nivIndex = 1; nivIndex <= dataCv.skills[s].niveau; nivIndex++) {
            niveauSkill.push(nivIndex)
        }

        const liSkill = '<li class="singleSkill flex" data-skillId ="'+(dataCv.skills.length - 1)+'"><button class="deleteSkillBtn" data-skillIdDelBtn ="'+(dataCv.skills.length - 1)+'">Supprimer</button><div><h2 class="skill"></h2><ul class="niveauSkill"></ul></div></li>'
        const liSkillCv = '<li class="singleSkillCv flex" data-skillId ="'+(dataCv.skills.length - 1)+'"><div><h2 class="skill"></h2><ul class="niveauSkill"></ul></div></li>'
        let skill= dataCv.skills[s].skill
        document.querySelector('.skillList').innerHTML+=liSkill
        addTxtLineModale('skill', 'skill',skill)
        if (niveauSkill.length != 0) {
            addStarsOutOfFive(niveauSkill,"skill")
        }

        document.querySelector('.skillListCv').innerHTML+=liSkillCv
        addTxtLineModaleCv('skill', 'skill',skill)
        if (niveauSkill.length != 0) {
            addStarsOutOfFiveCv(niveauSkill,"skill")
        }
        s++
    })

    dataCv.hobbies.forEach(function () {

        const liHobby = '<li class="singleHobby flex" data-expId ="'+(dataCv.hobbies.length - 1)+'">' +
            '<button class="deleteHobbyBtn" data-formIdDelBtn ="'+(dataCv.hobbies.length - 1)+'">Supprimer</button>' +
            '<div><h2 class="hobbyTitle"></h2><p class="hobbyDetails"></p></div>' +
            '</li>'
        const liHobbyCv = '<li class="singleHobbyCv flex" data-expId ="'+(dataCv.formations.length - 1)+'">' +
            '<div><h2 class="hobbyTitle"></h2><p class="hobbyDetails"></p></div>' +
            '</li>'
        let hobbyTitle= dataCv.hobbies[h]['hobby_name']
        let hobbyDetails= dataCv.hobbies[h]['hobby_details']
        document.querySelector('.hobbyList').innerHTML+=liHobby
        addTxtLineModale('hobby', 'hobbyTitle',hobbyTitle)
        addTxtLineModale('hobby', 'hobbyDetails',hobbyDetails)
        document.querySelector('.hobbyListCv').innerHTML+=liHobbyCv

        addTxtLineModaleCv('hobby', 'hobbyTitle',hobbyTitle)
        addTxtLineModaleCv('hobby', 'hobbyDetails',hobbyDetails)

        h++
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
            },
            setTitle() {
                if (cvEditParam) {
                    dataCv.titleCv = document.querySelector('#title').value
                }
            },
            setNom() {
                if (cvEditParam) {
                    dataCv.nomCv = document.querySelector('#nom').value
                }
            },
            setPrenom() {
                if (cvEditParam) {
                    dataCv.prenomCv = document.querySelector('#prenom').value
                }
            },
            setAdresse() {
                if (cvEditParam) {
                    dataCv.adresseCv = document.querySelector('#adresse').value
                }
            },
            setPhone() {
                if (cvEditParam) {
                    dataCv.phoneCv = document.querySelector('#phone').value
                }
            },
            setEmail() {
                if (cvEditParam) {
                    dataCv.emailCv = document.querySelector('#email').value
                }
            },
        }
    })





    document.getElementById('experienceBtn').onclick = function() {
        let allModales = document.querySelectorAll('.cvModale')
        for (let x = 0; x < allModales.length; x++) {
            allModales[x].style.display = 'none';
        }
        document.querySelector('.experienceModale').style.display = 'block';
    }


    document.getElementById('experienceAdd').onclick = function() {
        if (document.querySelector('.experienceModale input#entreprise').value && document.querySelector('.experienceModale input#job').value) {
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
        }
    }

    //LANGUE
    document.getElementById('langueBtn').onclick = function() {
        let allModales = document.querySelectorAll('.cvModale')
        for (let x = 0; x < allModales.length; x++) {
            allModales[x].style.display = 'none';
        }
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
        if (document.querySelector('.langueModale select.langue option:checked').value || document.querySelector('.langueModale input.langue').value) {
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
        }
    }


    //SKILLS
    document.getElementById('skillBtn').onclick = function() {
        let allModales = document.querySelectorAll('.cvModale')
        for (let x = 0; x < allModales.length; x++) {
            allModales[x].style.display = 'none';
        }
        document.querySelector('.skillModale').style.display = 'block';
        document.querySelector('.skillModale input.skill').onchange = (function() {
            if (document.querySelector('.skillModale input.skill').value) {
                document.querySelector('.skillModale select.skill').disabled = true
            } else {
                document.querySelector('.skillModale select.skill').disabled = false
            }
        })
        document.querySelector('.skillModale select.skill').onchange = (function() {
            if (document.querySelector('.skillModale select.skill').value) {
                document.querySelector('.skillModale input.skill').disabled = true
            } else {
                document.querySelector('.skillModale input.skill').disabled = false
            }
        })
    }

    document.getElementById('skillAdd').onclick = function() {

        if (document.querySelector('.skillModale select.skill option:checked').value || document.querySelector('.skillModale input.skill').value) {
            let singleSkill = {
                id:document.querySelector('.skillModale select.skill option:checked').value,
                skill: document.querySelector('.skillModale select.skill option:checked').textContent+document.querySelector('.skillModale input.skill').value,
                niveau: document.querySelector('.skillModale #niveauSkill').value,
            }

            let niveauSkill= []
            for (let nivIndex = 1; nivIndex <= singleSkill.niveau; nivIndex++) {
                niveauSkill.push(nivIndex)
            }
            dataCv.skills.push(singleSkill)
            dataCVSave()
            document.querySelector('.skillModale').style.display = 'none';
            const liSkill = '<li class="singleSkill flex" data-expId ="'+(dataCv.skills.length - 1)+'"><button class="deleteSkillBtn" data-skillIdDelBtn ="'+(dataCv.skills.length - 1)+'">Supprimer</button><div><h2 class="skill"></h2><ul class="niveauSkill"></ul></div></li>'
            const liSkillCv = '<li class="singleSkillCv flex" data-expId ="'+(dataCv.skills.length - 1)+'"><div><h2 class="skill"></h2><ul class="niveauSkill"></ul></div></li>'
            let skill= singleSkill.skill
            document.querySelector('.skillList').innerHTML+=liSkill
            addTxtLineModale('skill', 'skill',skill)
            if (niveauSkill.length != 0) {
                niveauSkill.forEach(function() {
                    document.querySelector('.singleSkill:last-of-type .niveauSkill').innerHTML += star
                })
                for (let nivNegative = singleSkill.niveau; nivNegative < 5; nivNegative++) {
                    document.querySelector('.singleSkill:last-of-type .niveauSkill').innerHTML += starEmpty
                }
            }

            document.querySelector('.skillListCv').innerHTML+=liSkillCv
            addTxtLineModaleCv('skill', 'skill',skill)
            if (niveauSkill.length != 0) {
                niveauSkill.forEach(function() {
                    document.querySelector('.singleSkillCv:last-of-type .niveauSkill').innerHTML += star
                })
                for (let nivNegative = singleSkill.niveau; nivNegative < 5; nivNegative++) {
                    document.querySelector('.singleSkillCv:last-of-type .niveauSkill').innerHTML += starEmpty
                }
            }
        }
    }


    document.getElementById('formationBtn').onclick = function() {
        let allModales = document.querySelectorAll('.cvModale')
        for (let x = 0; x < allModales.length; x++) {
            allModales[x].style.display = 'none';
        }
        document.querySelector('.formationModale').style.display = 'block';
    }

    document.getElementById('formationAdd').onclick = function() {
        if (document.querySelector('.formationModale input#organisme').value && document.querySelector('.formationModale input#nomFormation').value) {
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

        }

    }

    document.getElementById('hobbyBtn').onclick = function() {
        let allModales = document.querySelectorAll('.cvModale')
        for (let x = 0; x < allModales.length; x++) {
            allModales[x].style.display = 'none';
        }
        document.querySelector('.hobbyModale').style.display = 'block';
    }

    document.getElementById('hobbyAdd').onclick = function() {
        if (document.querySelector('.hobbyModale input.hobby').value) {
            let singleHobby= {
                hobby_name: document.querySelector('.hobbyModale .hobby').value,
                hobby_details: document.querySelector('.hobbyModale #hobbyDetails').value,
            }
            dataCv.hobbies.push(singleHobby)
            dataCVSave()
            console.log(dataCVSave())
            document.querySelector('.hobbyModale').style.display = 'none';

            const liHobby = '<li class="singleHobby flex" data-expId ="'+(dataCv.hobbies.length - 1)+'">' +
                '<button class="deleteHobbyBtn" data-formIdDelBtn ="'+(dataCv.hobbies.length - 1)+'">Supprimer</button>' +
                '<div><h2 class="hobbyTitle"></h2><p class="hobbyDetails"></p></div>' +
                '</li>'
            const liHobbyCv = '<li class="singleHobbyCv flex" data-expId ="'+(dataCv.formations.length - 1)+'">' +
                '<div><h2 class="hobbyTitle"></h2><p class="hobbyDetails"></p></div>' +
                '</li>'
            let hobbyTitle= singleHobby.hobby_name
            let hobbyDetails= singleHobby.hobby_details

            document.querySelector('.hobbyList').innerHTML+=liHobby
            addTxtLineModale('hobby', 'hobbyTitle',hobbyTitle)
            addTxtLineModale('hobby', 'hobbyDetails',hobbyDetails)

            document.querySelector('.hobbyListCv').innerHTML+=liHobbyCv
            addTxtLineModaleCv('hobby', 'hobbyTitle',hobbyTitle)
            addTxtLineModaleCv('hobby', 'hobbyDetails',hobbyDetails)
        }
    }
    dataCVSave()
    Object.values(dataCv).onchange = console.log('savetest');











//SUPPRESSIONS


    modaleCroix('.experienceModale')
    modaleCroix('.formationModale')
    modaleCroix('.langueModale')
    modaleCroix('.hobbyModale')
    modaleCroix('.skillModale')



if(dataCv['titleCv'] && dataCv['adresseCv'] && dataCv['emailCv'] && dataCv['prenomCv'] && dataCv['nomCv'] && dataCv['experiences'].length>0 && dataCv['skills'].length>0 && dataCv['hobbies'].length>0 && dataCv['formations'].length>0) {
    document.querySelector('.saveBtn').style.pointerEvents = "auto"
    document.querySelector('.saveBtn').style.filter = "none"
} else {
    document.querySelector('.saveBtn').style.pointerEvents = "none"
    document.querySelector('.saveBtn').style.filter = "grayscale(80%)"
}








    document.querySelector('.saveBtn').onclick = function() {

        console.log('click')
        console.log(dataCv)
        if(dataCv['titleCv'] && dataCv['adresseCv'] && dataCv['emailCv'] && dataCv['prenomCv'] && dataCv['nomCv'] && dataCv['experiences'].length>0 && dataCv['skills'].length>0 && dataCv['hobbies'].length>0 && dataCv['formations'].length>0) {
            document.querySelector('.saveBtn').style.pointerEvents = "none"
            $.ajax({
                type: "POST",
                url: ajaxurl,
                data: {
                    action: 'ajax_cv',
                    data : dataCv
                },

                beforeSend: function (){
                    console.log('AJAX SENT')
                },
                success: function (response) {
                    console.log(response)
                    let responseData = response
                    let cvId = responseData

                    dataCv.ID = cvId.id
                    console.log(cvId.id)

                    dataCVSave()
                    console.log('----')
                    window.alert('CV sauvegardé')
                },
                error: function(xhr, ajaxOptions, thrownError){
                    alert(xhr.status);
                },
            })
        } else {

            window.alert('Veuillez remplir toutes les informations demandées.')

        }

    }

    window.onbeforeunload = function(){
        if (loadedCv == 0) {
            localStorage.removeItem('dataCv')
        }
    };
}














