<?php
include("../config.php");
include(constant("SITE_ROOT")."/header.php");
?>
<div class="hback">
    <p class="htext">PROJETO - Cadastro de Disciplina</p>
</div>

<?php
    include (constant("SITE_ROOT")."/menu.php");
?>

<p><a class="button" href="<?=constant("SITE_URL");?>/disciplina/adicionar.php">ADICIONAR</a></p>
<?php
	$dbObj = new mysql();
	//$dbObj->setupDatabase();
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
		<th>nome</th>
		<th>APAGAR</th>
		<th>EDITAR</th>
	</tr>
	<?php
		while ($row = pg_fetch_assoc ($result)) {
			echo "<tr class='linhalista'>";
				echo "<td class='linhalista'>";
					echo $row["nome"];
				echo "</td>";
				echo "<td>";
					echo "<a class='subbut' href='".constant("SITE_URL")."/disciplina/apagar.php?id=".$row["id_disciplina"]."'>APAGAR</a>";
				echo "</td>";
				echo "<td>";
					echo "<a class='subbut' href='".constant("SITE_URL")."/disciplina/editar.php?id=".$row["id_disciplina"]."'>EDITAR</a>";
				echo "</td>";
			echo "</tr>";
		}
	?>
</table>
<?php
include(constant("SITE_ROOT")."/footer.php");
?>
