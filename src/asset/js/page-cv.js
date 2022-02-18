console.log('page-cv.js');

var myState = {
    pdf: null,
    /*changement de page*/
    /*currentPage: 1,*/
    zoom: 1
}

/*pdfjsLib.getDocument('../src/asset/img/New_Horizons.pdf').then((pdf) => {
    myStet.pdf = pdf;
    render();
});*/

function render() {
    myState.pdf.getPage(myState.currentPage).then((page) =>  {
        var canvas = document.getElementById("pdf_render");
        var ctx = canvas.getContext('2d');

        var Viewport = page.getViewport(myState.zoom);

        canvas.width = Viewport.width;
        canvas.height = Viewport.height;

        page.render({
            canvasContext: ctx,
            viewport: Viewport
        });
    });
}
/* changement de page*/
/*
document.getElementById('go_previous')
    .addEventListener('click', (e) => {
    if(myState.pdf == null|| myState.currentPage == 1) 
    return;
        
    myState.currentPage -= 1;
    document.getElementById("current_page").value = myState.currentPage;
    render();
});
document.getElementById('go_next')
    .addEventListener('click', (e) => {
    if(myState.pdf == null || myState.currentPage > myState.pdf._pdfInfo.numPages) 
    return;
          
    myState.currentPage += 1;
    document.getElementById("current_page").value = myState.currentPage;
    render();
});
document.getElementById('current_page')
    .addEventListener('keypress', (e) => {
    if(myState.pdf == null) return;
  
    // Get key code
    var code = (e.keyCode ? e.keyCode : e.which);
  
    // If key code matches that of the Enter key
    if(code == 13) {
        var desiredPage = document.getElementById('current_page').valueAsNumber;
                          
        if(desiredPage >= 1 && desiredPage <= myState.pdf._pdfInfo.numPages) {
            myState.currentPage = desiredPage;
            document.getElementById("current_page").value = desiredPage;
            render();
        }
    }
});
*/
/* zoom */
/*document.getElementById('zoom_in')
    .addEventListener('click', (e) => {
    if(myState.pdf == null) return;
    myState.zoom += 0.5;
 
    render();
});
document.getElementById('zoom_out')
    .addEventListener('click', (e) => {
    if(myState.pdf == null) return;
    myState.zoom -= 0.5;
     
    render();
});*/
