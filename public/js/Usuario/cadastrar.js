$(document).ready(function(){  
    
    // Campos maiusculos
    Maiusculo('#nome');
    
    $("#fCadastro").validate({
           
        rules: {  
            email : {
                email:true,
                emailUniqueUsuario: true
            }
        }
        
    });
    
});