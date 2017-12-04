<?php
include("header.php");



use WHMCS\Database\Capsule;


//Pegar dados
$activefunc=1;
$requestData = Capsule::table('mod_broadenbilling')->select('valor')->where('acao', "ivdaily_active")->first();
$activefunc=$requestData->valor;

$requestData = Capsule::table('mod_broadenbilling')->select('valor')->where('acao', "ivdaily_daystocancel")->first();
$datetoterminate=$requestData->valor;

?>

<h1><center>Cancelar fatura após x dias</center> </h1>
<br>
<form class="pure-form pure-form-aligned" id="forminvoicedaily" action="addonmodules.php?module=broadenbilling&page=salvarforminvoicedaily" method="POST">
    <fieldset>
        <div class="pure-control-group">
            <label for="bool_invoicedaily">Ativar Função</label>
            <?php
            if($activefunc==0){
                echo'            <input id="bool_invoicedaily" type="checkbox" name="bool_invoicedaily" value="1">';
            }else{
                echo'            <input id="bool_invoicedaily" type="checkbox" name="bool_invoicedaily" value="1" checked="checked">';
            } 
            ?>
            <span class="pure-form-message-inline">Deseja cancelar faturas não pagas após x dias?.</span>
        </div>

        <div class="pure-control-group">
            <label for="invoicedaily_daystoterminate">Dia para cancelar</label>
            <input id="invoicedaily_daystoterminate" type="number" name="invoicedaily_daystoterminate" min="0" max="9999" value="<?php echo $datetoterminate; ?>">
            <span class="pure-form-message-inline">Quantidade de dias após o vencimento para cancelar fatura.</span>

        </div>

        

        <div class="pure-controls">
           

            <button type="submit" class="pure-button pure-button-primary">Salvar</button>
        </div>
    </fieldset>
</form>