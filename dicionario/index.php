<?php
include("../config.php");
include(constant("SITE_ROOT")."/header.php");

?>
<div class="admtitleback">
    <p class="admtitletext">PROJETO - Cadastro de Palavras</p>
</div>

<?php
    include (constant("SITE_ROOT")."/menu.php");
?>

<p><a class="button" href="<?=constant("SITE_URL");?>/dicionario/adicionar.php">ADICIONAR</a></p>
<?php
	$dbObj = new mysql();

	// Chamar a função para verificar e criar a tabela, se necessário
	$dbObj->setupDatabase();
	
	$sql = "";
	$sql .= "SELECT * FROM dicionario ";
	$sql .= "INNER JOIN disciplinas ON dicionario.id_disciplina = disciplinas.id_disciplina ";
	$sql .= "ORDER BY palavra_orig;";
	$result = $dbObj->query($sql);

	$countSql = "SELECT COUNT(*) FROM dicionario";
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
		<th>PALAVRA</th>
		<th>SIGNIFICADO</th>
		<th>DISCIPLINA</th>
		<th>APAGAR</th>
		<th>EDITAR</th>
	</tr>
	<?php
		while ($row = pg_fetch_assoc ($result)) {
			echo "<tr class='linhalista'>";
				echo "<td class='linhalista'>";
					echo $row["palavra_orig"];
				echo "</td>";
				echo "<td class='linhalista'>";
					echo $row["significado"];
				echo "</td>";
				echo "<td class='linhalista'>";
					echo $row["nome"];
				echo "</td>";
				echo "<td>";
					echo "<a class='subbut' href='".constant("SITE_URL")."/dicionario/apagar.php?id=".$row["id"]."'>APAGAR</a>";
				echo "</td>";
				echo "<td>";
					echo "<a class='subbut' href='".constant("SITE_URL")."/dicionario/editar.php?id=".$row["id"]."&id_disciplina=" . $row["id_disciplina"] . "'>EDITAR</a>";
				echo "</td>";
			echo "</tr>";
		}
	?>
</table>
<?php
include(constant("SITE_ROOT")."/footer.php");
?>
