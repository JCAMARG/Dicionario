<?php
 
include("../config.php");

$id = $_GET["id"]?$_GET["id"]:$_POST["id"];

if ($id>0){
	$dbObj = new mysql();
	$sql = "";
	$sql .= "SELECT * FROM dicionario WHERE id = ".$id.";";
	$result = $dbObj->query($sql);
	if ($dbObj->affectedRows()== 0) {
		header("Location: ".SITE_URL."/dicionario/index.php");
		exit;
	}
	$row = pg_fetch_assoc($result);
	extract($row);
} else {
		header ("Location: ".SITE_URL."/dicionario/index.php");
		exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	
	extract($_POST);
	
	$dbObj = new mysql();
	$sql = "";
	$sql .= " DELETE FROM dicionario ";
	$sql .= " WHERE id = '".$id."'; ";
	$result = $dbObj->query($sql);
	header("Location: ".SITE_URL."/dicionario/index.php");
	exit;
	
}

include(constant("SITE_ROOT")."/header.php");

?>
<div class="admtitleback">
    <p class="admtitletext">Apagar Palavra</p>
</div>
 
<?php include(constant("SITE_ROOT")."/menu.php"); ?>
 
<br><br>

<form method="POST" style="display:flex; object-align: auto;">
	<input type="hidden" name="id" value="<?=isset($id)?$id:"";?>">
	<table>
		<tr>
			<td colspan="2" class="htext" style="background-color:navy; color:white; padding:8">Você tem certeza que quer apagar a palavra "<?=isset($palavra_orig)?$palavra_orig:"";?>"?</td>
		<tr>
		<tr>
		        <td  style="text-align: center; padding: 8px;">
		        	<input type="submit" name="submit" value="Confirmar" class="subbut but-ap">
			</td>
			<td style="text-align: center; padding: 8px;">
		        	<a class="subbut but" href="<?=SITE_URL;?>/dicionario/index.php">Cancelar</a>
		        </td>
	    	</tr>
	</table>
</form>

<?php include(constant("SITE_ROOT")."/footer.php"); ?>
