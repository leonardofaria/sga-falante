<?php
	extract($_REQUEST);

	// se não tiver IP, usa o da APS Divinópolis
	if($ip == "") { $ip = "10.34.54.205"; }

	// uso o curl para copiar a página do servidor do SGA
	$url = "http://$ip/sga/painel/p_principal_cross.php";
	// descomente a linha a seguir para simular o funcionamento do script
	// $url = "http://localhost/sga/painel.php";
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$curl_scraped_page = curl_exec($ch);
	curl_close($ch);


	// substituo o intervalo do Meta Refresh
	// sem essa substituição, o frontend faz o servidor cair com tantos refreshs
	$output = str_replace("content=\"1\">", "content=\"1000\">", $curl_scraped_page);

	// removo o som default do painel
	$output = str_replace("<embed src=\"sound/apert.wav\" autostart=\"true\" hidden=\"true\">", "", $output);

	// removo a formatação do painel e atribui um ID a <div> que armazena a senha
	$output = str_replace(" style=\" margin:0; color: #ffffff; font-family: Arial, helvetica, sans-serif;  position: absolute; text-align: left; font-weight:800;top: 360px; left: 0px\"", "", $output);
	$output = str_replace(" style=\"margin:0; font-family: Arial, Helvetica, Sans-serif; color: white; font-size:106px; font-weight:800;letter-spacing:-8px;\"", "", $output);
	$output = str_replace("margin-top:-20px; ", "", $output);
	$output = str_replace("font-size: 120px;", "", $output);
	$output = str_replace("font-size: 225px;", "", $output);
	$output = str_replace("font-size: 280px;", "", $output);
	$output = str_replace("#ffa500", "#000", $output);
	$output = str_replace("#ffff00", "#000", $output);
	$output = str_replace("letter-spacing:-0.06em;\">", " letter-spacing:-0.06em;\" id=\"senha_atual\">", $output);
	$output = str_replace("#ffffff", "#000", $output);
	$output = str_replace("font-weight:800", "font-weight:100", $output);

	echo $output;
?>