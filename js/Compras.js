let arr_valor = [];
let arr_quantidade = [];
let arr_nomes = [];
let produto = [];

let adicionar = (e) => {
    let nome = $(e.children[0]).attr("nome");
    let valor = $(e.children[0]).attr("valor");
    let valorTotal = 0;
    let msmProduto = produto.find(element => element.nome == nome);
    if (msmProduto) {
        msmProduto.quantidade++;
    } else {
        produto.push({
            nome: nome,
            quantidade: 1,
            valor: valor
        });
    };
    produto.forEach((element, index) => {
        arr_nomes[index] = element.nome;
        arr_valor[index] = element.valor;
        arr_quantidade[index] = element.quantidade;
        valorTotal = valorTotal + (element.quantidade * element.valor);
    });
    $("#totalapagar").val(valorTotal);
    $("#produtos").val(arr_nomes);
    $("#quantidade").val(arr_quantidade);
    $("#valor").val(arr_valor);

    $("#totalapagar").val()
};


