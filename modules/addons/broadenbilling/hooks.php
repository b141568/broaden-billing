<?php
use WHMCS\Database\Capsule;

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//Invoice Daily
add_hook('DailyCronJob', 1, function($vars) {
    // Perform potentially risky queries in a transaction for easy rollback.
$pdo = Capsule::connection()->getPdo();


    //Check status invoice
    $requestData = Capsule::table('mod_broadenbilling')->select('valor')->where('acao', "ivdaily_active")->first();
    $status_func_invoice=$requestData->valor;
    
    $requestData = Capsule::table('mod_broadenbilling')->select('valor')->where('acao', "ivdaily_daystocancel")->first();
    $daystocancel=$requestData->valor;
    
 if($status_func_invoice==1 and $daystocancel>0){

    $requestData = Capsule::table('mod_broadenbilling')->select('valor')->where('acao', "ivdaily_daystocancel")->first();
    
    $datetoterminate=$requestData->valor;
    $data_atual=date("Y-m-d");
    $data_limite=date("Y-m-d", strtotime('-'.$datetoterminate.' days', strtotime($data_atual)));
   

    
    foreach (Capsule::table('tblinvoices')
            ->where('duedate', '<', $data_limite)->where('status', '=', 'Unpaid')
            ->get() as $listinvoice) {

        // Lista todas os itens da fatura no loop
        foreach (Capsule::table('tblinvoiceitems')
            ->where('invoiceid', '=', $listinvoice->id)
            ->get() as $listinvoiceitem) {
//       
            // pega o status do produto
         $requestDataprod = Capsule::table('tblhosting')->select('domainstatus')->where('id', $listinvoiceitem->relid)->first();
                if($requestDataprod->domainstatus=='Cancelled'){ // se o status for cancelado, ele cancela a fatura.
                   //Funcao cancela fatura
                        try {
                        $updateinvoice = Capsule::table('tblinvoices')
                            ->where('id', '<',$listinvoice->id)
                            ->update(
                                [
                                    'status' => 'Cancelled',
                                ]
                            );
                                



                    } catch (\Exception $e) {
                        echo "Erro ao atualizar faturas. {$e->getMessage()}";

                                    mail("contato@maximalhost.com", "Oi5 tudo bem?", "Mensagem de teste");

                        }
                }
        
        } // Listar itens da fatura
   
        
    } // Listar faturas 
   


    





 }
});

//Fim invoice Daily


