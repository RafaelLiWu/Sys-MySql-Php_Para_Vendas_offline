let produto = [];

let adicionar = (element) => {
    let e = element.parentNode.parentNode;
    let nome = $(e.children[0]).attr("nome");
    let quantidade = $(e.children[0]).attr("quantidade");
    let valor = $(e.children[0]).attr("valor");
    let msmProduto = produto.find(element => element.nome == nome);
    if (msmProduto) {
        if ((msmProduto.quantidade + 1) <= quantidade) {
            msmProduto.quantidade++;
        };
    } else {
        produto.push({
            nome: nome,
            quantidade: 1,
            valor: valor
        });
    };
    atualizar();
};
let atualizar = () => {

    let arr_valor = [];
    let arr_quantidade = [];
    let arr_nomes = [];
    let valorTotal = 0;
    let valorVazio;
    
    $("#totalapagar").val("");
    $("#produtos").val("");
    $("#quantidade").val("");
    $("#valor").val("");

    if (produto.length > 0) {
        produto.forEach((element, index) => {
            arr_nomes[index] = element.nome;
            arr_valor[index] = element.valor;
            arr_quantidade[index] = element.quantidade;
            valorTotal = valorTotal + (element.quantidade * element.valor);
        });

        
        
        $("#totalapagar").val(valorTotal.toFixed(2));
        $("#produtos").val(arr_nomes);
        $("#quantidade").val(arr_quantidade);
        $("#valor").val(arr_valor);
    }
};

let tirar = (e) => {
    let atributos = e.parentNode.parentNode.children[0];
    let nome = $(atributos).attr('nome');
    let item = produto.find(element => element.nome == nome);
    if (item) {
        if(item.quantidade == 1){

            let indice = produto.indexOf(item);
            produto.splice(indice, 1);
            atualizar();

        } else {

            item.quantidade = item.quantidade - 1;
            atualizar();

        }
    }
};
