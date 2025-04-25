<?php
 
include("../config.php");

$id = $_GET["id"]?$_GET["id"]:$_POST["id"];
$id_disciplina = $_GET["id_disciplina"]?$_GET["id_disciplina"]:$_POST["id_disciplina"];

if ($id>0){
	$dbObj = new mysql();
	$sql = "";
	$sql .= "SELECT * FROM dicionario WHERE id = ".$id.";";
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
	if (!$significado) {
		$erro .= " Significado não pode ser vazio. ";
	}
	if (!$palavra_orig) {
		$erro .= " Palavra não pode ser vazio. ";
	}
	if (!$id_disciplina) {
		$erro .= " Disciplina não pode ser vazio. ";
	}	
	if (!$erro) {
		$dbObj = new mysql();
		$sql = "";
		$sql .= " UPDATE dicionario SET ";
		$sql .= " palavra_orig = '".$palavra_orig."', ";
		$sql .= " significado = '".$significado."', ";
		$sql .= " id_disciplina = '".$id_disciplina."' ";
		$sql .= " WHERE ID = '".$id."'; ";
		$result = $dbObj->query($sql);
		header("Location: ".SITE_URL."/dicionario");
		exit;
	}
}
 
include(constant("SITE_ROOT")."/header.php");
 
?>
 
 <div class="admtitleback">
    <p class="admtitletext">EDITAR PALAVRA</p>
</div>
 
<?php include(constant("SITE_ROOT")."/menu.php"); ?>
 
<br><br>
 
<?php
if (isset($erro)) {
	echo "<span style=\"color: white; font-style: italic; padding: 5;\">";
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
	$sql .= "SELECT * FROM disciplinas ";
	$sql .= " ORDER BY nome;";
	$resultDis = $dbObj->query($sql);
?>
 
<form method="POST">
	<input type="hidden" name="id" value="<?=isset($id)?$id:"";?>">
	
	<table class="lista" style="border:1px solid slategrey; border-style:outset;">
		<tr>
			<td style="width: 1%;">Palavra:</td>
			<td><input type="text" name="palavra_orig" style="padding: 3px; border:1px solid grey; border-style:inset; width: 100%;" value="<?=isset($palavra_orig)?$palavra_orig:"";?>"></td>
		</tr>

		<tr>
			<td style="width: 1%;">Significado:</td>
			<td><input type="text" name="significado" style="padding: 3px; border:1px solid grey; border-style:inset; width: 100%;" value="<?=isset($significado)?$significado:"";?>"></td>
		</tr>
		
		<tr>
			<td style="width: 1%;">Disciplinas:</td>
			<td>
				<select style="width:179px; padding:3px; width: 100%;" name="id_disciplina">
		                    <?php
							echo "<option></option>";
		                        while ($row = pg_fetch_assoc($resultDis)) {
		                            $selected = ($row['id_disciplina'] == $id_disciplina) ? "selected" : "";
					    echo "<option value='".$row['id_disciplina']."' $selected>".$row['nome']."</option>";
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
				<input class="but-confirma" type="submit" name="submit" value="EDITAR">
			</td>
		</tr>
	</table>
</form>
 
<?php include(constant("SITE_ROOT")."/footer.php"); ?>
