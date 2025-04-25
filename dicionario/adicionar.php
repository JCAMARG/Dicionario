<?php
include("../config.php");
 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	extract($_POST);
	$erro = "";
	if (!$nome) {
		$erro .= " Nome não pode ser vazio. ";
	}
	if (!$palavra) {
		$erro .= " Palavra não pode ser vazio. ";
	}
	if (!$disciplina) {
		$erro .= " Disciplina não pode ser vazio. ";
	}
	if (!$erro) {
		$dbObj = new mysql();
		$sql = "";
		$sql .= " INSERT INTO dicionario ";
		$sql .= " (palavra_orig, id_disciplina) ";
		$sql .= " VALUES ";
		$sql .= " ('".$palavra."', '".$disciplina."')";
		$result = $dbObj->query($sql);
		header("Location: ".SITE_URL."/dicionario");
		exit;
	}
}
 
include(constant("SITE_ROOT")."/header.php");
 
?>
 
<h1>PROJETO - Adicionar Palavra</h1>
 
<?php include(constant("SITE_ROOT")."/menu.php"); ?>
 
<br><br>
 
<?php
if (isset($erro)) {
	echo "<span style=\"color: red; font-style: italic;\">";
	echo $erro;
	echo "</span>";
}
?>
 
<?php
	$dbObj = new mysql();
	$sql = "";
	$sql .= "SELECT * FROM disciplinas ";
	$sql .= " ORDER BY NOME;";
	$result = $dbObj->query($sql);
?> 
 
<form method="POST">
	<table>
		<tr>
			<td>Palavra:</td>
			<td><input type="text" name="palavra" value="<?=isset($palavra)?$palavra:"";?>"></td>
		</tr>
		<tr>
			<td>Disciplina:</td>
			<td>
				<select style="width:179px" name="disciplina">
                    <?php
					echo "<option></option>";
                        while ($row = pg_fetch_assoc($result)) {
                            echo "<option value='".$row['ID_DISCIPLINA']."'>".$row['NOME']."</option>";
                        }
                    ?>
                </select>
			</td>
		</tr>
		<tr>
			<td>
				&nbsp;
			</td>
			<td>
				<input type="submit" name="submit" value="Adicionar">
			</td>
		</tr>
	</table>
</form>
 
<?php include(constant("SITE_ROOT")."/footer.php"); ?>
