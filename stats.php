<?php

extract($_REQUEST);
date_default_timezone_set('America/Sao_Paulo');

$host = "127.0.0.1";
$user = "usuario";
$pass = "senha";
$database = "sga";

$connection = mysql_connect($host, $user, $pass);
$db = mysql_select_db($database);

function insertData($ip) {
	$aps = mysql_query("select id from aps where ip = '$ip'");
	$row = mysql_fetch_row($aps);
	$aps_id = $row[0];
	$result = mysql_query("select * from stats where aps_id = '$aps_id'");

	if (@mysql_num_rows($result) == 0) {
		$sql = "INSERT INTO stats (aps_id, created_at, updated_at) VALUES ('$aps_id', NOW(), NOW())";
	} else {
		$sql = "UPDATE stats set updated_at = NOW() where aps_id = '$aps_id'";
	}

	$sql = mysql_query($sql);
}

function showStats() {
	$result = mysql_query("select stats.*, aps.*, gex.name as gex_name from stats, aps, gex where stats.aps_id = aps.id and aps.gex_id = gex.id order by created_at");

	$output = "\n\t<h2>Estatísticas do SGA Falante</h2>\n\t<b>" . mysql_num_rows($result) . " agências usando o aplicativo desde 23/08/2011</b>\n\t<table width=\"100%\" class=\"table sort\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n";
	$output.= "\t\t<tr>\n\t\t\t<th>APS</th>\n\t\t\t<th>Gerência</th>\n\t\t\t<th width=\"77\">OL</th>\n\t\t\t<th width=\"93\">IP</th>\n\t\t\t<th width=\"95\">1ª utilização</th>\n\t\t\t<th width=\"110\">Última utilização</th>\n\t\t</tr>\n";

	while ($row = mysql_fetch_array($result)){
		$aps_name = utf8_encode($row['name']);
		$aps_ip = $row['ip'];
		$aps_ol = $row['ol'];
		$gex_name = utf8_encode($row['gex_name']);
		$created_at = date("d/m/y H:i", strtotime($row['created_at']));
		$updated_at = date("d/m/y H:i", strtotime($row['updated_at']));
		$output.= "\t\t<tr>\n\t\t\t <td>$aps_name</td>\n\t\t\t <td>$gex_name</td>\n\t\t\t <td>$aps_ol\n\t\t\t <td>$aps_ip</td>\n\t\t\t <td>$created_at</td>\n\t\t\t <td>$updated_at</td>\n\t\t</tr>\n\t";
	}

	$output.= "</table>";

	echo $output;
}

if(isset($servidor)) {
	insertData($servidor);
} else {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>SGA Falante - Estatísticas do SGA Falante</title>
	<link rel="stylesheet" href="style/sga.css" type="text/css" />
	<script type="text/javascript" src="js/jquery-1.6.1.min.js"></script>
	<script type="text/javascript" src="js/jquery.sortElements.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			if($('table.sort').length > 0) {
				var table = $('table.sort');

				$('th').wrapInner('<span title="Classificar por essa coluna"/>').each(function(){
					var th = $(this), thIndex = th.index(), inverse = false;
					th.click(function(){
						table.find('td').filter(function(){
							return $(this).index() === thIndex;
						}).sortElements(function(a, b){
							return $.text([a]) > $.text([b]) ?
								inverse ? -1 : 1
								: inverse ? 1 : -1;
						}, function(){
							return this.parentNode;
						});
						inverse = !inverse;

						table.find('tr:odd').removeClass("even").addClass("odd");
						table.find('tr:even').removeClass("odd").addClass("even");
			         });
				});
			}

			$("#content").css("min-height", ($(window).height() - $("#header").height() - $("#footer").height() - 55));
			$("table tr:odd").addClass("odd");
			$("table tr:even").addClass("even");
		});
	</script>
	<style type="text/css">
		#body { width: 100% }
		table { border-collapse:collapse; margin-top: 10px }
		table, table td { border: 1px solid #ccc; }
		table td { padding: 5px; line-height: 150% }
		table th { background: url('/assets/bg_menu.jpg') left bottom repeat-x; border: 0; color: #022d3f; cursor: pointer; font-weight: bold; padding: 5px; text-align: center; }
		table tr:hover { background: #ffc }
		.odd { background: #fff; }
		.even { background: #f6f6f6; }
	</style>
</head>
<body>
<div id="body">
	<div id="header"><h1>SGA Falante</h1></div>
	<div id="content"><?php showStats(); ?></div>
	<div id="footer">Criado na <a href="http://www-gexdiv">GEX Divinópolis</a></div>
</div>
</body>
</html>
<?php } ?>