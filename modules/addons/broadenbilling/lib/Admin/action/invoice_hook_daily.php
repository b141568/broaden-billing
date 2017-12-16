<?php


require_once(__DIR__ . '/../funcao/invoice_hook_daily.php');



//Checar se existe post
if($_POST){
    $bool_invoicedaily=filter_input(INPUT_POST, 'bool_invoicedaily', FILTER_SANITIZE_STRING);
    $invoicedaily_daystoterminate=filter_input(INPUT_POST, 'invoicedaily_daystoterminate', FILTER_SANITIZE_STRING);
        
    if($bool_invoicedaily!=1){
        $bool_invoicedaily=0;
    }
        Salvar_dados($bool_invoicedaily,$invoicedaily_daystoterminate);


} // fim asalvar dados



