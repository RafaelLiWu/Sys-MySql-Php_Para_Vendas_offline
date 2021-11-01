Sistema de estoque com vendas e pdf.

Como funciona?
É necessário que tenha um servidor sql. O banco de dados está configurado em myqsl, port=3306, user="root" sem senha , default.

Para utilizar é necessario ter um banco de dados chamado loja, e com uma tabela chamado produtos com Nome, Quantidade, Valor e um product_it. Porém você pode apenas abrir a página 'createdatabase.php' no navegador com o mysql e o apache para já criar o banco de dados e a tabela.

as funções do sistema,

é criar produtos, vender ao clicar no item criado ( que será demostrado na esquerda ), ao vender um item será criado um pdf que poderá ser baixado ou imprimido. Também ao comprar será adicionado no total diário que você poderá ver o total diário das vendas, o botão está no superior direito, e nela também tem a opção de imprimir/baixar o pdf que será lançado. e também há um mecanismo de buscas para procurar os produtos.
