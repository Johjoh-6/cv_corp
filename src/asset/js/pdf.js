import { jsPDF } from "jspdf";

const getPdf = document.querySelector('#getPdf');

getPdf.addEventListener('click', ()=>{
    const firstName = getPdf.dataset.fisrtName;
    const lastName = getPdf.dataset.lastName;
    console.log(firstName);
    console.log(lastName);
    // Default export is a4 paper, portrait, using millimeters for units
    const doc = new jsPDF();

    doc.text("Hello world!", 10, 10);
    doc.save(`CV_${lastName}_${firstName}.pdf`);


})
