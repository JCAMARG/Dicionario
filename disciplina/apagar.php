<?php
include("../config.php");

$id = $_GET["id"]?$_GET["id"]:$_POST["id"];

if ($id>0){
	$dbObj = new mysql();
	$sql = "";
	$sql .= "SELECT * FROM disciplinas WHERE ID_DISCIPLINA = ".$id.";";
	$result = $dbObj->query($sql);
	if ($dbObj->affectedRows()== 0) {
		header("Location: ".SITE_URL."/disciplina");
		exit;
	}
	$row = mysqli_fetch_assoc($result);
	extract($row);
} else {
		header ("Location: ".SITE_URL."/disciplina");
		exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	
	extract($_POST);
	
	$dbObj = new mysql();
	$sql = "";
	$sql .= " DELETE FROM disciplinas ";
	$sql .= " WHERE ID_DISCIPLINA = '".$id."'; ";
	$result = $dbObj->query($sql);
	header("Location: ".SITE_URL."/disciplina");
	exit;
	
}

include(constant("SITE_ROOT")."/header.php");

?>
<div class="hback">
    <p class="htext">PROJETO - Apagar Disciplina</p>
</div>
 
<?php include(constant("SITE_ROOT")."/menu.php"); ?>
 
<br><br>

<form method="POST" style="display:flex; object-align: auto;">
	<input type="hidden" name="id" value="<?=isset($id)?$id:"";?>">
	<table>
		<tr>
			<td colspan="2" class="htext" style="background-color:navy">Você tem certeza que quer apagar a categoria "<?=isset($nome)?$nome:"";?>"?</td>
		<tr>
		<tr>
			<td>
				<input type="submit" name="submit" value="Sim" class="submit">
			</td>
			<td align="center">
				<a href="<?=SITE_URL;?>/disciplina"><input class="submit" type="button" value="Não"></a>
			</td>
		</tr>
	</table>
</form>

<?php include(constant("SITE_ROOT")."/footer.php"); ?>
