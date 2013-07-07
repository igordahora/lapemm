$(document).ready(function(){
   
    // Campos maiusculos
    Maiusculo('#nome');
    
    $("#fCadastro").validate();

    $("#salvar").click(function(){        
        $("#select_move").find('select:eq(1) option').each(function(){
            this.selected = true;
        });
        $("#select_move_abr").find('select:eq(1) option').each(function(){
            this.selected = true;
        });        
    });
    
    jQuery.fn.selectmove = function(){

        var $div = $(this);

        $div.find('#remove_todos').click(function(){
            $div.find('select:eq(1) option').each(function(){
                $(this).remove().appendTo($div.find('select').eq(0));
            });    
        });
        $div.find('#move_todos').click(function(){
            $div.find('select:eq(0) option').each(function(){
                $(this).remove().appendTo($div.find('select').eq(1));
            });    
        });
        $div.find('#move_sel').click(function(){
            $div.find('select').eq(0).find('option:selected').remove().appendTo($div.find('select').eq(1));
        });
        $div.find('#remove_sel').click(function(){
            $div.find('select').eq(1).find('option:selected').remove().appendTo($div.find('select').eq(0));
        });
        
    }
    
    $('#select_move').selectmove();   
    $('#select_move_abr').selectmove();

});  