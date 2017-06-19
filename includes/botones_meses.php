<?php
$uno = '1';
$unomas = $_GET[act] + $uno;
$unomenos = $_GET[act] - $uno;
$mesanterior = mes_anterior($_GET[mes]);
$messiguiente = mes_siguiente($_GET[mes]);
?>
<?php
$disabled_anterior = 'href="pagos_mes_alum.php?act='.$_GET[act].'&mes='.$mesanterior.'"';
$disabled_siguiente = 'href="pagos_mes_alum.php?act='.$_GET[act].'&mes='.$messiguiente.'"';
if ($_GET[mes]=='Sep'){
	$disabled_anterior = 'disabled';
}
if ($_GET[mes]=='Jun'){
	$disabled_siguiente = 'disabled';
}
echo '<div id="menu"><a class="btn btn-success btn-sm btn" style="width:32%" '.$disabled_anterior.'>Mes anterior</a>';
echo '<a class="btn btn-danger btn-sm" style="width:32%;margin-left:4px;margin-right:4px;" href="pagos_mes_alum.php">Atrás</a>';
echo '<a class="btn btn-success btn-sm btn" style="width:32%" '.$disabled_siguiente.'>Mes siguiente</a></div>';
?>