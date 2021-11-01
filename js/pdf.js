let imprimir = () => {
    if($('#produtos').val().length > 0 && $('#quantidade').val().length > 0 && $('#valor').val().length > 0 && $('#totalapagar').val().length > 0) {
    let obj = {
        produtos: $('#produtos').val(),
        quantidades: $('#quantidade').val(),
        valores: $('#valor').val(),
        total: $('#totalapagar').val()
    };
    let url = `dompdf.php?req=1&produtos=${obj.produtos}&quantidades=${obj.quantidades}&valores=${obj.valores}&total=${obj.total}`;
    let url_splice = url.replaceAll(" ", "+");
    window.open(url_splice, "_blank");
    }
};

$("#imprimirdia").click(() => {
    let total = $('#totaldiario').attr("total");
    let url_dia = `dompdf.php?req=2&total=${total}`;
    window.open(url_dia, "_blank");
});