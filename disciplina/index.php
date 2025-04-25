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
	$dbObj->setupDatabase();

	$sql = "";
	$sql .= "SELECT ID_DISCIPLINA, NOME FROM disciplinas ORDER BY NOME;";
	$result = $dbObj->query($sql);
?>

<table class="lista">
	<tr>
		<th>NOME</th>
		<th>APAGAR</th>
		<th>EDITAR</th>
	</tr>
	<?php
		while ($row = pg_fetch_assoc ($result)) {
			echo "<tr class='linhalista'>";
				echo "<td class='linhalista'>";
					echo $row["NOME"];
				echo "</td>";
				echo "<td>";
					echo "<a class='subbut' href='".constant("SITE_URL")."/disciplina/apagar.php?id=".$row["ID_DISCIPLINA"]."'>APAGAR</a>";
				echo "</td>";
				echo "<td>";
					echo "<a class='subbut' href='".constant("SITE_URL")."/disciplina/editar.php?id=".$row["ID_DISCIPLINA"]."'>EDITAR</a>";
				echo "</td>";
			echo "</tr>";
		}
	?>
</table>
<?php
include(constant("SITE_ROOT")."/footer.php");
?>
