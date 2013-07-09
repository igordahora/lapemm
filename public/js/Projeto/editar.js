$(document).ready(function(){
    
    bkLib.onDomLoaded(function() {	
        new nicEditor({
            fullPanel : true
        }).panelInstance('txEditor');
    });
    
    $("#fCadastro").validate();   
    
    
});  