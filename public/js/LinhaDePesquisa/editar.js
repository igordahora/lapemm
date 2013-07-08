$(document).ready(function(){
    
    Maiusculo('#nome');
    
    bkLib.onDomLoaded(function() {	
        new nicEditor({
            fullPanel : true
        }).panelInstance('txEditor');
    });
    
    $("#fCadastro").validate();   
    
    
});  