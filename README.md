# SGA Falante

Esse projeto foi criado em 2011 para melhor o uso do [SGA](http://www.softwarepublico.gov.br/ver-comunidade?community_id=15719494) no INSS. Quando um atendente chama a senha, apenas um barulho de notificação é emitido. O que o SGA Falante faz é monitorar o painel e tocar um som que diz exatamente a senha chamada.

Já foi usado com sucesso em mais de 300 agências do INSS.

## Vantagens

* Ajuda pessoas com deficiência visual a serem chamadas
* Ajuda distraídos a serem chamados :)
* Agiliza o atendimento uma vez que o atendente não precisa chamar várias vezes a mesma senha

## Instalação

* Enviar os arquivos para um servidor web
* Acertar as conexões de banco no arquivo stats.php para monitorar estatísticas. O arquivo `stats.sql` possui o schema das tabelas necessárias para o funcionamento da aplicação
* **Opcional**: você pode testar o funcionamento da aplicação simulando seu próprio painel. Para isso, siga as instruções das linhas 9 e 10 do arquivo `cache.php`.

Nota: Esse é um código de 2011 que pode ser melhorado, principalmente porque muitos acessos concorrentes podem degradar a performance do servidor. Além disso o banco está defasado e não trás o nome de todas APS do INSS. O ideal é fazer um batimento de dados com a tabela oficial de órgãos (TB0700).

## Screenshots

![SGA Falante](https://raw.github.com/leonardofaria/sga-falante/master/screenshot1.png)

![SGA Falante - Estatísticas](https://raw.github.com/leonardofaria/sga-falante/master/screenshot2.png)