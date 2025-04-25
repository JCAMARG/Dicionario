<?php
 
include("../config.php");

$id = $_GET["id"]?$_GET["id"]:$_POST["id"];

if ($id>0){
	$dbObj = new mysql();
	$sql = "";
	$sql .= "SELECT * FROM disciplinas WHERE id = ".$id.";";
	$result = $dbObj->query($sql);
	if ($dbObj->affectedRows()== 0) {
		header("Location: ".SITE_URL."/disciplina");
		exit;
	}
	$row = pg_fetch_assoc($result);
	extract($row);
} else {
		header ("Location: ".SITE_URL."/disciplina");
		exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	extract($_POST);
	$erro = "";
	if (!$nome) {
		$erro .= " nome não pode ser vazio. ";
	}
	if (!$erro) {
		$dbObj = new mysql();
		$sql = "";
		$sql .= " UPDATE disciplinas SET ";
		$sql .= " nome = '".$nome."' ";
		$sql .= " WHERE id = '".$id."'; ";
		$result = $dbObj->query($sql);
		header("Location: ".SITE_URL."/disciplina");
		exit;
	}
}
 
include(constant("SITE_ROOT")."/header.php");
 
?>
 
 <div class="hback">
    <p class="htext">EDITAR CATEGORIA</p>
</div>
 
<?php include(constant("SITE_ROOT")."/menu.php"); ?>
 
<br><br>
 
<?php
if (isset($erro)) {
	echo "<span style=\"color: red; font-style: italic;\">";
	echo $erro;
	echo "</span>";
} 
?>
 
<form method="POST">
	<input type="hidden" name="id" value="<?=isset($id)?$id:"";?>">
	<table class="lista" style="border:1px solid slategrey; border-style:outset;">
		<tr>
			<td>nome:</td>
			<td><input type="text" name="nome" style="padding: 3px; border:1px solid grey; border-style:inset;" value="<?=isset($nome)?$nome:"";?>"></td>
		</tr>
		<tr>
			<td colspan="2">
				<input type="submit" name="submit" value="EDITAR">
			</td>
		</tr>
	</table>
</form>
 
<?php include(constant("SITE_ROOT")."/footer.php"); ?>
