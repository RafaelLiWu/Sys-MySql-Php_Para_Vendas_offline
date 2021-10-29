let createProducts = () => {
    $('.header-formulario').addClass("formCriar");
};
let createProductsClose = () => {
    $('.header-formulario').removeClass("formCriar");
};
let TotalDiario = () => {
    if ($('.header-resultados-result').hasClass("resultadosDiario")){
        $('.header-resultados-result').removeClass("resultadosDiario");
    } else {
        $('.header-resultados-result').addClass("resultadosDiario");
    }
}