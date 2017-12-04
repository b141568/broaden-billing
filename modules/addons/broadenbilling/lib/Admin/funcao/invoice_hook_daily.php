<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use WHMCS\Database\Capsule;

function Salvar_dados($bool_invoicedaily,$invoicedaily_daystoterminate){
    
    //Atualiza dados do banco
try {
    $updatedinvoicehookdaily = Capsule::table('mod_broadenbilling')
        ->where('acao', 'ivdaily_active')
        ->update(
            [
                'valor' => $bool_invoicedaily,
            ]
        );
    $updatedinvoicehookdaily = Capsule::table('mod_broadenbilling')
        ->where('acao', 'ivdaily_daystocancel')
        ->update(
            [
                'valor' => $invoicedaily_daystoterminate,
            ]
        );
        
            echo'<script>alert("Dados salvos com sucesso!");window.location="addonmodules.php?module=broadenbilling&page=invoicehookdaily"; 
</script>';

} catch (Exception $e) {
    echo'<script>alert("Ocorreu um erro!");'
    . 'alert(.{$e->getMessage()}.);'
    . 'window.location="addonmodules.php?module=broadenbilling&page=invoicehookdaily";</script>';
    
    
    }
} // fim salvar dados






