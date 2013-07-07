$(document).ready(function(){
   
    // Campos maiusculos
    Maiusculo('#nome');

    // Campos minusculos
    Minusculo('#email');
    Minusculo('#lattes');
    
    // Mascaras
    $("#cpf").mask("999.999.999-99");
    $("#dataNascimento").mask("99/99/9999");
    $("#numeroTelefone").mask("(99)9999-9999");
    $("#numeroCelular").mask("(99)9999-9999");
    
    // Validação
    $("#fCadastro").validate({
        rules: {  
            cpf : {
                cpf: 'valid'
            },
            email : {
                email:true
            },
            dataNascimento : {
                idade:true
            }
        }   
    });
    
});  