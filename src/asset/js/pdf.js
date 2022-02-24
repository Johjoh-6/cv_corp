import { jsPDF } from "jspdf";
const getPdf = document.querySelector('#getPdf');

if(getPdf){
    const cvString =  document.querySelector('#jsonarray').value;
    const cv =  JSON.parse(cvString);
    console.log(cv);
    const firstName = cv.user_firstname,
    lastName = cv.user_lastname,
    email = cv.user_email,
    phone = cv.user_phone,
    adress = cv.user_adress,
    imgExist = cv.id_picture,
    img = document.querySelector('#pdf-cv_img'),
    imgsrc = img.src,
    skills = cv.skills,
    langues = cv.langues,
    hobbie = cv.hobbie,
    experience = cv.experience,
    studies = cv.studies;
    
    console.log(imgExist);

    getPdf.addEventListener('click', ()=>{ 
        // Default export is a4 paper, portrait, using millimeters for units
        const doc = new jsPDF();

        //Style 
        doc.setLineWidth(0.2);
        doc.line(95, 90, 95, 280);
        if(imgExist != 0){
            doc.addImage(imgsrc, 7, 7, 40, 40);
        }

        font(doc, 'Roboto-Regular', 'normal', 11)
        doc.text(`
        Nom: ${lastName.capitalize()}
        Prénom : ${firstName.capitalize()}
        Email : ${email}
        Tél : ${phone}
        Adresse : ${adress}`, 9, 55);

        let yStartSkill = 100;
        let yStartLangue = 0;
        let yStartHobbie = 0;
        let x = 15;
        let y = 100;
        //Skills
        font(doc, 'Roboto-Bold', 'normal', 13);
        doc.text(`Skills`, 35, yStartSkill, 'center');
        font(doc, 'Roboto-Regular', 'normal', 11);
        for(let i = 0; i < skills.length; i++){
            let name = skills[i].skill_name;
            let level = skills[i].skill_level;
            y = (yStartSkill + 5 )+ ( i * 10);
            doc.text(`${name}`, x, y);
            addLevel(doc, level, x , (y + 4));
            yStartLangue = y + 12;
        };
        
       
       //Langues
       font(doc, 'Roboto-Bold', 'normal', 13);
       doc.text(`Langues`, 35, yStartLangue, 'center');
       font(doc, 'Roboto-Regular', 'normal', 11);
       for(let i = 0; i < langues.length; i++){
           let name = langues[i].langue_name;
           let level = langues[i].langue_level;
           y = (yStartLangue + 5) + ( i * 10);
           doc.text(`${name}`, x, y);
           addLevel(doc, level, x , (y + 4));
           yStartHobbie = y + 12;
       };
       
       //Hobbie
       font(doc, 'Roboto-Bold', 'normal', 13);
       doc.text(`Hobbie`, 35, yStartHobbie, 'center');
       y = yStartHobbie + 5;
       for(let i = 0; i < hobbie.length; i++){
           let name = hobbie[i].hobbie_name;
           let detail = hobbie[i].hobbie_details;
           font(doc, 'Roboto-Regular', 'normal', 11);
           doc.text(`${stripSlash(name)}`, x, y);
           let lines = doc.splitTextToSize(stripSlash(detail), 60, {
               'fontSize': 10,
               'fontStyle': 'Normal',
               'fontName': 'Roboto-Thin'
            });
            doc.text(x , (y + 5 ), lines);

            y += ((lines.length + 0.5 )* 5 ) + 4 ;
       };

       let yStartExperience = 100,
       yStartStudiy = 0;

       //Experience 
       font(doc, 'Roboto-Bold', 'normal', 13);
       doc.text(`Expérience Professionnel`, 135, yStartExperience, 'center');
       x = 100;
       y = yStartExperience + 5;
       for(let i = 0; i < experience.length; i++){
           let jobName = experience[i].job_name;
           let company = experience[i].company_name;
           let detail = experience[i].details;
           let start = experience[i].date_start;
           let end = experience[i].date_end;
           font(doc, 'Roboto-Regular', 'normal', 11);
           doc.text(x , y, `
           | ${stripSlash(jobName)}, ${stripSlash(company)} |
           ${start} - ${dateEnd(end)}
           `, { 'align': 'left'});
           let lines = doc.splitTextToSize(stripSlash(detail), 80, {
               'fontSize': 10,
               'fontStyle': 'normal',
               'fontName': 'Roboto-Regular'
            });
            doc.text(x , (y + 14), lines);

            y += ((lines.length + 0.5 )* 5.5 ) + 8 ;
            yStartStudiy = y + 12;
       };

       // Studies
       font(doc, 'Roboto-Bold', 'normal', 13);
       doc.text(`Formation et Diplôme`, 135, yStartStudiy, 'center');
       x = 100;
       y = yStartStudiy + 5;
       for(let i = 0; i < studies.length; i++){
           let schoolName = studies[i].school_name;
           let studyName = studies[i].study_name;
           let detail = studies[i].study_details;
           let schoolPos = studies[i].school_location;
           let start = studies[i].date_start;
           let end = studies[i].date_end;
           font(doc, 'Roboto-Regular', 'normal', 11);
           doc.text(x , y, `Formation ${stripSlash(studyName)} à ${stripSlash(schoolPos)} chez ${stripSlash(schoolName)}
           ${start} - ${dateEnd(end)}
           `, { 'align': 'left', 'maxWidth': 130});
           let lines = doc.splitTextToSize(stripSlash(detail), 80, {
               'fontSize': 10,
               'fontStyle': 'normal',
               'fontName': 'Roboto-Regular'
            });
            doc.text(x , (y + 14), lines);

            y += ((lines.length + 0.5 )* 5.5 ) + 8 ;
            
       };

        doc.save(`CV_${lastName}_${firstName}.pdf`);
    })
}

function font(doc, stringFontName, format, size){
    doc.setFont(stringFontName, format);
    doc.setFontSize(size);
}

function addLevel(doc, level, x, y){
    for(let i = 0; i < 5; i++){
        let right = x + (3 * (i + 1));
        if(i < level){
            doc.circle(right, y, 1, 'F');
        } else {
            doc.circle(right, y, 1 );
        }
    }
}
function dateEnd(date){
    if(date == 0){
        return 'Présent';
    } else {
        return date;
    }
}
function stripSlash(text)     
{     
    let t = text.replace(/\/$/, "");
    return t.replace(/\'/, "\u02BC");
} 

// For capitalize letter
Object.defineProperty(String.prototype, 'capitalize', {
    value: function() {
      return this.charAt(0).toUpperCase() + this.slice(1);
    },
    enumerable: false
  });