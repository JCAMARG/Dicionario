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
	$sql .= "SELECT * FROM dicionario ORDER BY palavra_orig;";
	$result = $dbObj->query($sql);
?>

<table class="lista">
	<tr>
		<th>PALAVRA</th>
		<th>APAGAR</th>
		<th>EDITAR</th>
	</tr>
	<?php
		while ($row = pg_fetch_assoc ($result)) {
			echo "<tr class='linhalista'>";
				echo "<td class='linhalista'>";
					echo $row["palavra_orig"];
				echo "</td>";
				echo "<td>";
					echo "<a class='subbut' href='".constant("SITE_URL")."/dicionario/apagar.php?id=".$row["id"]."'>APAGAR</a>";
				echo "</td>";
				echo "<td>";
					echo "<a class='subbut' href='".constant("SITE_URL")."/dicionario/editar.php?id=".$row["id"]."'>EDITAR</a>";
				echo "</td>";
			echo "</tr>";
		}
	?>
</table>
<?php
include(constant("SITE_ROOT")."/footer.php");
?>
