<?php

if (!defined("WHMCS")) {
    die("This file cannot be accessed directly");
}

use WHMCS\Database\Capsule;


function broadenbilling_config() {
    return array(
    "name" => "Broaden Billing",
    "description" => "Addons adicionais para finanças | Suporte: brunowebmaster@live.com",
    "version" => "0.70",
    "author" => "Bruno Webmaster"
     );
    
}



//Função para ativar
function broadenbilling_activate() {

    # Criar Tabela
    $query = "CREATE TABLE `mod_broadenbilling` (
            `id` int(11) NOT NULL auto_increment,
            `acao` varchar(20) NOT NULL,
            `valor` varchar(20) NOT NULL,
            PRIMARY KEY(id)
          ) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
	$result= full_query($query);
        
        
        

    //Inserir Registros padrao
    $pdo = Capsule::connection()->getPdo();
    $pdo->beginTransaction();

        try {
            $statement = $pdo->prepare(
                'insert into mod_broadenbilling (acao, valor) values (:acao, :valor)'
            );
            // inserir primeiro valor
            $statement->execute(
                [
                    ':acao' => 'ivdaily_active',
                    ':valor' => '0',
                ]
            );

            //inserir segundo valor
             $statement = $pdo->prepare(
                'insert into mod_broadenbilling (acao, valor) values (:acao, :valor)'
            );
            $statement->execute(
                 [
                    ':acao' => 'ivdaily_daystocancel',
                    ':valor' => '30',
                ]
            );



            $pdo->commit();
        } catch (\Exception $e) {
            echo "Error! {$e->getMessage()}";
            $pdo->rollBack();
        }
        # Return Result
        return array('status'=>'success','description'=>'Broaden Billing foi ativado com sucesso!');

} // fim funcao ativar


                    // FUncao desativar 

function broadenbilling_deactivate()
{
    // Undo any database and schema modifications made by your module here
    $query = "DROP TABLE `mod_broadenbilling`";
    full_query($query);
    return array(
        'status' => 'success', // Supported values here include: success, error or info
        'description' => 'Broaden Billing desabilitado com sucesso',
    );
}// fim funcao desativar



//Função show admin


function broadenbilling_output($vars) {

    $page=filter_input(INPUT_GET, 'page', FILTER_SANITIZE_STRING);
    if($page=='invoicehookdaily')
    {
        include("lib/Admin/invoice_hook_daily.php");
    }
    elseif ($page=='cupomafiliados') {
         include("lib/Admin/cupomafilidos.php");
    }elseif($page=='salvarforminvoicedaily'){
        include("lib/Admin/action/invoice_hook_daily.php");
    }else {
        include("lib/Admin/index.php");
    }


} // fim funcao saida admin
