<?php
include("../config.php");
 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	//extract($_POST);

	$significado = $_POST['significado'] ?? '';
	$palavra = $_POST['palavra'] ?? '';
	$disciplina = $_POST['disciplina'] ?? '';
	$erro = "";
	
	$erro = "";
	if (!$significado) {
		$erro .= " Significado não pode ser vazio. ";
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
		$sql .= " (palavra_orig, significado, id_disciplina) ";
		$sql .= " VALUES ";
		$sql .= " ('".$palavra."', '".$significado."', '".$disciplina."')";
		$result = $dbObj->query($sql);
		header("Location: ".SITE_URL."/dicionario");
		exit;
	}
}
 
include(constant("SITE_ROOT")."/header.php");
 
?>
<div class="admtitleback">
    <p class="admtitletext">Adicionar Palavra</p>
</div>
 
<?php include(constant("SITE_ROOT")."/menu.php"); ?>
 
<br><br>
 
<?php
if (isset($erro)) {
	echo "<span style=\"color: white; font-style: italic; padding: 5\">";
	echo $erro;
	echo "</span>";
	?>
		<br><br>
	<?php
}
?>
	
<?php
	$dbObj = new mysql();
	$sql = "";
	$sql .= "SELECT id_disciplina, nome FROM disciplinas ";
	$sql .= " ORDER BY nome;";
	$result = $dbObj->query($sql);

	if (!$result) {
		die("<p style='color: red;'>Erro na consulta: " . pg_last_error($dbObj->link_id) . "</p>");
	}
?> 
 
<form method="POST">
	<table class="lista" style="border:1px solid slategrey; border-style:outset;">
		<tr>
			<td style="width: 1%;">Palavra:</td>
			<td><input type="text" name="palavra" value="<?=isset($palavra)?$palavra:"";?>" style="width: 100%;"></td>
		</tr>
		<tr>
			<td style="width: 1%;">Significado:</td>
			<td><input type="text" name="significado" value="<?=isset($significado)?$significado:"";?>"  style="width: 100%;"></td>
		</tr>
		<tr>
			<td style="width: 1%;">Disciplina:</td>
			<td>
				<select style="width:179px; width: 100%;" name="disciplina">
		                    <?php
		                        while ($row = pg_fetch_assoc($result)) {
		                            echo "<option value='".$row['id_disciplina']."'>".$row['nome']."</option>";
		                        }
		                    ?>
               			</select>
			</td>
		</tr>
		<tr>
			<td style="width: 1%;">
				&nbsp;
			</td>
			<td>
				<input class="but-confirma" type="submit" name="submit" value="Adicionar">
			</td>
		</tr>
	</table>
</form>
 
<?php include(constant("SITE_ROOT")."/footer.php"); ?>
