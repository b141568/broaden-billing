# Broaden Billing


Grab Billing é um modulo que atenderá algumas necessidades especiais em que o whmcs não possui.

Com ele você poderá:

1- Cancelar fatura após o termino do serviço.
Sempre que você ou sistema cancela um serviço, a fatura não é cancelada, ela continua como aberta.

2- Cancela todas as faturas não pagas após x periodo de tempo.
Todos os dias quando o cron rodar, o hook do modulo irá cancelar todas as faturas não pagas depois de x dias após o vencimento. O "x" dias é definido no Admin >> Config Automoção >> Dias para Finalização


3- Cada afiliado poderá gerar cupons de desconto para os seus novos indicados.
A quantidade de porcentagem máxima será definida pelo admin. (Em desenvolvimento)
