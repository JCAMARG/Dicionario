<?php
include("./config.php");
include(constant("SITE_ROOT")."/header.php");
?>
<div class="admtitleback">
    <p class="admtitletext">HOME - PROJETO</p>
</div>
<?php
include (constant("SITE_ROOT")."/menu.php");
?>

<div style="padding: 20px; text-align: center;">
    <h3>Recriar Tabelas</h3>
    <a href="recriar_tabelas.php?acao=disciplinas" class="button" style="padding: 10px 20px; background-color: green; color: white; text-decoration: none; border-radius: 5px;">Recriar Tabela Disciplinas</a>
    <br><br>
    <a href="recriar_tabelas.php?acao=dicionario" class="button" style="padding: 10px 20px; background-color: blue; color: white; text-decoration: none; border-radius: 5px;">Recriar Tabela Dicionário</a>
</div>

<?php
include(constant("SITE_ROOT")."/footer.php");
?>
