$(function(){
           
    $('.password').pstrength();
    
    $("#fCadastro").validate({
        rules:{
            des_senha_new:{
                required:true
            },
            des_senha_conf:{
                required:true,
                equalTo: '#des_senha_new'
            }
        }
    });
    
});