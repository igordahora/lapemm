function Maiusculo(campo)
{
    $(campo).keyup(function() {
        $(this).val($(this).val().toUpperCase());
    });
}

function Minusculo(campo)
{
    $(campo).keyup(function() {
        $(this).val($(this).val().toLowerCase());
    });
}

function replaceAll(str, de, para) {
    var pos = str.indexOf(de);
    while (pos > -1) {
        str = str.replace(de, para);
        pos = str.indexOf(de);
    }
    return (str);
}

function formatMonetario(valor) {

    valor = replaceAll(valor, 'R$ ', '');
    valor = replaceAll(valor, '.', '');
    valor = replaceAll(valor, ',', '.');
    valor = parseFloat(valor);

    if (valor > 0) {
        return valor.toFixed(2);
    } else {
        return '0.00';
    }

}

function apenasNumeros(campo)
{
    $(campo).keyup(function() {
        // EXPRESSAO REGULAR PARA ACEITAR APENAS NUMEROS INTEIROS
        var reDigits = /^\d+$/;
        var valor = $(this).val();
        var numeric = reDigits.test(valor);

        if (!numeric) {
            var tValor = valor.length;
            valor = valor.substring(0, tValor - 1);
            $(this).val(valor);
        }
    });
}


function float2moeda(num) {

    x = 0;

    if (num < 0) {
        num = Math.abs(num);
        x = 1;
    }
    if (isNaN(num))
        num = "0";
    
    cents = Math.floor((num * 100 + 0.5) % 100);

    num = Math.floor((num * 100 + 0.5) / 100).toString();

    if (cents < 10)
        cents = "0" + cents;
    
    for (var i = 0; i < Math.floor((num.length - (1 + i)) / 3); i++)
        num = num.substring(0, num.length - (4 * i + 3)) + '.' + num.substring(num.length - (4 * i + 3));
    
    ret = num + ',' + cents;

    if (x == 1)
        ret = ' - ' + ret;
    
    return ret;

}