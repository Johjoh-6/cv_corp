import { jsPDF } from "jspdf";

const getPdf = document.querySelector('#getPdf');
const cv = document.querySelector('#jsonarray').value;
    console.log(JSON.parse(cv));

getPdf.addEventListener('click', ()=>{
    const firstName = getPdf.dataset.fisrtName;
    const lastName = getPdf.dataset.lastName;
    
   
    // Default export is a4 paper, portrait, using millimeters for units
    const doc = new jsPDF();
    
    doc.text("Hello world!", 10, 10);

    doc.save(`CV_${lastName}_${firstName}.pdf`);


})
