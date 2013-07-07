$(function(){
           
    $('.password').pstrength();
    
    $("#fCadastro").validate({
        rules:{
            senha_atual:{
                required:true,
                remote:'index.php?c=Ajax&a=isPassword'
            },
            des_senha_new:{
                required:true,
                minlength: 8
            },
            des_senha_conf:{
                required:true,
                equalTo: '#des_senha_new'
            }
        },
        messages:{
            senha_atual:{remote:'A senha informada não corresponde a senha do usuário.'}
        }
    });
    
});