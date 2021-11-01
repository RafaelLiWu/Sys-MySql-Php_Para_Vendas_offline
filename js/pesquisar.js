let pesquisar = () => {
    if ($('.pesquisar-mecanismo-area').css("top") == "-100px") {
        $('.pesquisar-mecanismo-area').css("top", "0px")
    } else {
        $('.pesquisar-mecanismo-area').css("top", "-100px");
    }
};

$("#pesquisar").click(() => {
    let obj = {
        pesquisar: $('#pesquisar-texto').val()
    };

    let str = '';

    $.ajax({
        url: 'pesquisar.php',
        type: 'post',
        data: obj,
        dataType: 'json',
        success: (data) => {
            data.forEach((element, index) => {
                str = str + `<p class="aside-products btn-primary"><span nome="${element['Nome']}" valor="${element['Valor']}" quantidade="${element['Quantidade']}">${element['Nome']} ${element['Quantidade']}</span><span class="aside-products-more"><span class="menos btn-danger" onclick="tirar(this)">-</span><span class="mais btn-success" onclick="adicionar(this)">+</span></span></p>`;
            });
            
        },
        error: (error) => {
            console.log(error);
        }
    }).done(()=>{
        $(".aside").html(str);
    });

});

