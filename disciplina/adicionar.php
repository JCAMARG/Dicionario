<?php
 
include("../config.php");
 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	extract($_POST);
	$erro = "";
	if (!$nome) {
		$erro .= " Nome não pode ser vazio. ";
	}
	if (!$erro) {
		$dbObj = new mysql();
		$sql = "";
		$sql .= " INSERT INTO disciplinas ";
		$sql .= " (NOME) ";
		$sql .= " VALUES ";
		$sql .= " ('".$nome."')";
		$result = $dbObj->query($sql);
		header("Location: ".SITE_URL."/disciplina/index.php");
		exit;
	}
}
 
include(constant("SITE_ROOT")."/header.php");
 
?>
 
<div class="admtitleback">
    <p class="admtitletext">Adicionar Disciplina</p>
</div>
 
<?php include(constant("SITE_ROOT")."/menu.php"); ?>
 
<br><br>
 
<?php
if (isset($erro)) {
	echo "<span style=\"color: white; font-style: italic; padding:5;\">";
	echo $erro;
	echo "</span>";
	?><br><?php
}
?>
	
<form method="POST">
	<table class="lista" style="border:1px solid slategrey; border-style:outset;">
		<tr>
			<td style="width: 1%;">Nome:</td>
			<td><input type="text" name="nome" value="<?=isset($nome)?$nome:"";?>" ></td>
		</tr>
		<tr>
			<td style="width: 1%;">
				&nbsp;
			</td>
			<td style="padding:8px 0;">
				<input class="but-confirma" type="submit" name="submit" value="Adicionar">
			</td>
		</tr>
	</table>
</form>
 
<?php include(constant("SITE_ROOT")."/footer.php"); ?>
