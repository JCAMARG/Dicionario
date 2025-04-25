<?php
 
include("../config.php");

$id = $_GET["id"]?$_GET["id"]:$_POST["id"];

if ($id>0){
	$dbObj = new mysql();
	$sql = "";
	$sql .= "SELECT * FROM prod WHERE id = ".$id.";";
	$result = $dbObj->query($sql);
	if ($dbObj->affectedRows()== 0) {
		header("Location: ".SITE_URL."/dicionario");
		exit;
	}
	$row = pg_fetch_assoc($result);
	extract($row);
} else {
		header ("Location: ".SITE_URL."/dicionario");
		exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	
	extract($_POST);
	
	$dbObj = new mysql();
	$sql = "";
	$sql .= " DELETE FROM prod ";
	$sql .= " WHERE id = '".$id."'; ";
	$result = $dbObj->query($sql);
	header("Location: ".SITE_URL."/dicionario");
	exit;
	
}

include(constant("SITE_ROOT")."/header.php");

?>
<div class="hback">
    <p class="htext">PROJETO - Apagar Palavra</p>
</div>
 
<?php include(constant("SITE_ROOT")."/menu.php"); ?>
 
<br><br>

<form method="POST" style="display:flex; object-align: auto;">
	<input type="hidden" name="id" value="<?=isset($id)?$id:"";?>">
	<table>
		<tr>
			<td colspan="2" class="htext" style="background-color:navy">Você tem certeza que quer apagar o produto "<?=isset($nome)?$nome:"";?>"?</td>
		<tr>
		<tr>
			<td>
				<input type="submit" name="submit" value="Sim" class="submit">
			</td>
			<td align="center">
				<a href="<?=SITE_URL;?>/dicionario"><input class="submit" type="button" value="Não"></a>
			</td>
		</tr>
	</table>
</form>

<?php include(constant("SITE_ROOT")."/footer.php"); ?>
