<?php
include("../config.php");

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["pesquisar"])) {
    $pesq = $_GET["filtro"];
}

include(constant("SITE_ROOT")."/header.php");

?>
<div class="admtitleback flexheader">
	<p class="admtitletext">Cadastro de Palavras</p>

	<div class="admtitletext">
		<form action="index.php" method="GET" style="margin: 0; width: 100%;">
			<input style="width: auto;" type="text" name="filtro" value="<?= isset($pesq) ? htmlspecialchars($pesq) : ""; ?>">
			<input class="button but-pes" type="submit" name="pesquisar" value="Pesquisar">
		</form>
	</div>
</div>

<br>

<?php
    include (constant("SITE_ROOT")."/menu.php");
?>

<p><a class="button but-add" href="<?=constant("SITE_URL");?>/dicionario/adicionar.php">ADICIONAR</a></p>
<?php
	$dbObj = new mysql();
	
	$sql = "";
	$sql .= "SELECT * FROM dicionario ";
	$sql .= "INNER JOIN disciplinas ON dicionario.id_disciplina = disciplinas.id_disciplina ";
	if (isset($pesq) && $pesq !== "") {
	    $pesq_esc = pg_escape_string($dbObj->link_id, $pesq);
	    $sql .= "WHERE palavra_orig ILIKE '%$pesq_esc%' or significado ILIKE '%$pesq_esc%' or nome ILIKE '%$pesq_esc%' ";
	}
	$sql .= "ORDER BY palavra_orig;";

	$result = $dbObj->query($sql);

	$countSql = "SELECT COUNT(*) FROM dicionario ";
	$countSql .= "INNER JOIN disciplinas ON dicionario.id_disciplina = disciplinas.id_disciplina ";
	if (isset($pesq) && $pesq !== "") {
	    $pesq_esc = pg_escape_string($dbObj->link_id, $pesq);
	    $countSql .= "WHERE palavra_orig ILIKE '%$pesq_esc%' or significado ILIKE '%$pesq_esc%' or nome ILIKE '%$pesq_esc%' ";
	}
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
		<th style="background-color: #9ab4ff;">PALAVRA</th>
		<th style="background-color: #9ab4ff;" class="significado">SIGNIFICADO</th>
		<th style="background-color: #9ab4ff;">DISCIPLINA</th>
		<th style="background-color: #9ab4ff;">EDITAR</th>
		<th style="background-color: #f7acac;">APAGAR</th>
	</tr>
	<?php
		while ($row = pg_fetch_assoc ($result)) {
			echo "<tr class='linhalista'>";
				echo "<td class='linhalista'>";
					echo "<div class='tooltip-wrapper' data-significado='" . htmlspecialchars($row["significado"], ENT_QUOTES) . "'>";
						echo $row["palavra_orig"];
						echo "<i class='fa fa-comment' style='margin-left: 5px; color: #007bff;'></i>";
					echo "</div>";
				echo "</td>";
				echo "<td class='linhalista significado'>";
					echo $row["significado"];
				echo "</td>";
				echo "<td class='linhalista'>";
					echo $row["nome"];
				echo "</td>";
				echo "<td style='background-color: #9ab4ff;'>";
					echo "<a class='subbut but-ed' href='".constant("SITE_URL")."/dicionario/editar.php?id=".$row["id"]."&id_disciplina=" . $row["id_disciplina"] . "'>EDITAR</a>";
				echo "</td>";
				echo "<td style='background-color: #f7acac;'>";
					echo "<a class='subbut but-ap' href='".constant("SITE_URL")."/dicionario/apagar.php?id=".$row["id"]."'>APAGAR</a>";
				echo "</td>";
			echo "</tr>";
		}
	?>
</table>
<?php
include(constant("SITE_ROOT")."/footer.php");
?>
