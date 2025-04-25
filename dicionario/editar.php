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
	$erro = "";
	if (!$nome) {
		$erro .= " Nome não pode ser vazio. ";
	}
	if (!$preco) {
		$erro .= " Preço não pode ser vazio. ";
	}
	if (!$cat) {
		$erro .= " Categoria não pode ser vazio. ";
	}	
	if (!$erro) {
		$dbObj = new mysql();
		$sql = "";
		$sql .= " INSERT INTO prod ";
		$sql .= " (nome, preco, cat) ";
		$sql .= " VALUES ";
		$sql .= " ('".$nome."', '".$preco."', '".$cat."')";
		$result = $dbObj->query($sql);
		header("Location: ".SITE_URL."/dicionario");
		exit;
	}
}
 
include(constant("SITE_ROOT")."/header.php");
 
?>
 
 <div class="hback">
    <p class="htext">EDITAR PALAVRA</p>
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

<?php
	$dbObj = new mysql();
	$sql = "";
	$sql .= "SELECT * FROM cat ";
	$sql .= " ORDER BY nome;";
	$result = $dbObj->query($sql);
?>
 
<form method="POST">
	<input type="hidden" name="id" value="<?=isset($id)?$id:"";?>">
	<table class="lista" style="border:1px solid slategrey; border-style:outset;">
		<tr>
			<td>Nome:</td>
			<td><input type="text" name="nome" style="padding: 3px; border:1px solid grey; border-style:inset;" value="<?=isset($nome)?$nome:"";?>"></td>
		</tr>
		<tr>
			<td>Preço:</td>
			<td><input type="text" name="preco" style="padding: 3px; border:1px solid grey; border-style:inset;" value="<?=isset($preco)?$preco:"";?>"></td>
		</tr>
		<tr>
			<td>Categoria:</td>
			<td>
				<select style="width:179px; padding:3px" name="cat">
                    <?php
					echo "<option></option>";
                        while ($row = pg_fetch_assoc($result)) {
                            echo "<option value='".$row['id']."'>".$row['nome']."</option>";
                        }
                    ?>
                </select>
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<input type="submit" name="submit" value="EDITAR">
			</td>
		</tr>
	</table>
</form>
 
<?php include(constant("SITE_ROOT")."/footer.php"); ?>
