<?php
    $req = filter_input(INPUT_GET, "req", FILTER_SANITIZE_NUMBER_INT);
    require_once 'dompdf/autoload.inc.php';
    use Dompdf\Dompdf;
    if($req == 1){
        $produtos = filter_input(INPUT_GET, "produtos", FILTER_SANITIZE_STRING);
        $produtos_arr = explode(",", $produtos);
        $quantidades = filter_input(INPUT_GET, "quantidades", FILTER_SANITIZE_STRING);
        $quantidades_arr = explode(",", $quantidades);
        $valores = filter_input(INPUT_GET, "valores", FILTER_SANITIZE_STRING);
        $valores_arr = explode(",", $valores);
        $total = filter_input(INPUT_GET, "total", FILTER_SANITIZE_STRING);
        $str_produtos = '';
        $str_quantidades = '';
        $str_valores = '';

        for ($i = 0; $i < count($produtos_arr); $i++) {
            $str_produtos = "{$str_produtos}<p>{$produtos_arr[$i]}; Quantidade: {$quantidades_arr[$i]}; Valor: {$valores_arr[$i]}</p>";
        }
        

        $dompdf = new Dompdf();

        $dompdf->loadHtml(
            "
                <!DOCTYPE html>
                <html lang='pt-br'>

                <head>
                    <title>CrIFF</title>
                    <style>
                        #texto{
                            background-color: red;
                        }
                    </style>
                </head>
                <body>

                        <div>Empresa dos boms</div>
                        <br>
                        <div>{$str_produtos}</div>
                        <div>Total: R$ {$total}</div>
                    
                    
                
                </body>
                </html>"
        );
        $dompdf->render();
        $dompdf->stream(
            "login.pdf",
            array(
                "Attachment" => false
            )
        );
} else if($req == 2){
    require_once 'DataControl.php';

    $c = new Controler("loja");

    $date = date("Y_m_d");
    $comando = "SELECT * FROM dia{$date}";
    $array = array();
    $quest = $c->_Select($comando, $array);
    $dados = $quest->fetchAll(PDO::FETCH_ASSOC);
    $str = '';
    foreach ($dados as $all) {
       $str = " <p>Nome: $all[Nome]; Quantidade: $all[Quantidade]; Valor: $all[Valor]</p>{$str}";
    };

    $total = filter_input(INPUT_GET, "total", FILTER_SANITIZE_STRING);;

    $dompdf = new Dompdf();

    $dompdf->loadHtml(
        "
            <!DOCTYPE html>
            <html lang='pt-br'>

            <head>
                <title>CrIFF</title>
                <style>
                    #texto{
                        background-color: red;
                    }
                </style>
            </head>
            <body>

                    <div>Empresa dos boms</div>
                    <br>
                    <div>{$str}</div>
                    <br>
                    <br>
                    <div>Total Diario: R$ {$total}</div>
                
                
            
            </body>
            </html>"
    );
    $dompdf->render();
    $dompdf->stream(
        "login.pdf",
        array(
            "Attachment" => false
        )
    );

}

?>