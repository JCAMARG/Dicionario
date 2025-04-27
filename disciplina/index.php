<?php
include("../config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["confirmar_apagar"])) {
	$id_apagar = (int)$_POST["id_apagar"];
	$erro = "";
	
	// Verifica se existem palavras vinculadas
	$dbObj = new mysql();
	$checkSql = "SELECT COUNT(*) FROM dicionario WHERE id_disciplina = $id_apagar";
	$checkResult = $dbObj->query($checkSql);
	
	if ($checkResult) {
		$checkRow = pg_fetch_row($checkResult);
		if ($checkRow[0] > 0) {
			$erro = "Não é possível apagar a disciplina. Existem palavras vinculadas a ela.";
		} else {
			// Redireciona para apagar.php se não houver vínculos
			header("Location: " . constant("SITE_URL") . "/disciplina/apagar.php?id=$id_apagar");
			exit;
		}
	} else {
		$erro = "Erro ao verificar vínculos: " . pg_last_error($dbObj->link_id);
	}
}

include(constant("SITE_ROOT")."/header.php");

?>

<div class="admtitleback">
    <p class="admtitletext">Cadastro de Disciplina</p>
</div>

<?php
include (constant("SITE_ROOT")."/menu.php");

if (isset($erro)) {
	?><br><br><?php
	
	echo "<span style=\"color: white; font-style: italic; padding: 5;\">";
	echo $erro;
	echo "</span>";
	
	?><br><?php
}
?>

<p><a class="button but-add" href="<?=constant("SITE_URL");?>/disciplina/adicionar.php">ADICIONAR</a></p>
<?php
	$dbObj = new mysql();
	$sql = "";
	$sql .= "SELECT id_disciplina, nome FROM disciplinas ORDER BY nome;";
	$result = $dbObj->query($sql);

	$countSql = "SELECT COUNT(*) FROM disciplinas";
	$countResult = $dbObj->query($countSql);
	
	if ($countResult) {
	    $countRow = pg_fetch_row($countResult);
	    echo "<p>Total de registros: " . $countRow[0] . "</p>";
	} else {
	    echo "<p>Erro ao contar registros: " . pg_last_error($dbObj->link_id) . "</p>";
	}

?>

<table class="lista">
	<tr>
		<th style="background-color: #9ab4ff;">NOME</th>
		<th style="background-color: #9ab4ff;">EDITAR</th>
		<th style="background-color: #f7acac;">APAGAR</th>
	</tr>
	<?php
		while ($row = pg_fetch_assoc ($result)) {
			echo "<tr class='linhalista'>";
				echo "<td class='linhalista'>";
					echo $row["nome"];
				echo "</td>";
				echo "<td style='background-color: #9ab4ff;'>";
					echo "<a class='subbut but-ed' href='".constant("SITE_URL")."/disciplina/editar.php?id=".$row["id_disciplina"]."'>EDITAR</a>";
				echo "</td>";
				echo "<td style='background-color: #f7acac;'>";
					//echo "<a class='subbut but-ap' href='".constant("SITE_URL")."/disciplina/apagar.php?id=".$row["id_disciplina"]."'>APAGAR</a>";
					echo "<form method='post' style='display:inline'>";
						echo "<input type='hidden' name='id_apagar' value='" . $row['id_disciplina'] . "'>";
						echo "<input type='submit' name='confirmar_apagar' value='APAGAR' class='subbut but-ap'>";
					echo "</form>";
				echo "</td>";
			echo "</tr>";
		}
	?>
</table>
<?php
include(constant("SITE_ROOT")."/footer.php");
?>
