<!-- reproduz o painel do sga; arquivo apenas para teste -->
<embed src="sound/apert.wav" autostart="true" hidden="true"><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<title>PAINEL</title>
<meta http-equiv="Refresh" content="1000">
</head>
<body bgcolor="#000080">

<div style="margin:0; font-family: Arial, Helvetica, Sans-serif; color: white; font-size:106px; font-weight:800;letter-spacing:-8px;">
	<font color="#ffa500">SENHA</font>
</div>
<div style="margin:0; padding:0px; color: #ffff00; font-size: 280px; width:100%; margin-top:-20px; font-family: helvetica, sans-serif;font-weight:bold;letter-spacing:-0.06em;">
	<font color="#ffff00"><?php

	// gera uma senha aleatória parecida com a do SGA
	
	function random() { return rand()%9; }

	$letters = "ABCDEFGHIJKLMNOPQRSTUVXZ";

	echo $letters[random()] . 0 . random() . random() . random();

	?>
	</font>
</div>
<div style=" margin:0; color: #ffffff; font-family: Arial, helvetica, sans-serif;  position: absolute; text-align: left; font-weight:800;top: 360px; left: 0px">
	<font color="#ffffff" style=" font-size: 120px;">Mesa:</font><font color="#ffffff" style="font-size: 225px;">11</font>
</div>

</body>
</head>