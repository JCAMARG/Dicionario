<?php
include("./config.php");
include(constant("SITE_ROOT")."/header.php");
?>
<div class="admtitleback" style="display: flex; justify-content: space-between; align-items: center;">
    <p class="admtitletext">HOME - PROJETO DICIONARIO</p>
    <div>
        <!-- Combo Box para recriar tabelas -->
        <form action="recriar_tabelas.php" method="GET">
            <select name="acao" style="padding: 5px; font-size: 14px;">
                <option value="">Selecione uma Tabela</option>
                <option value="disciplinas">Recriar Tabela Disciplinas</option>
                <option value="dicionario">Recriar Tabela Dicionário</option>
            </select>
            <button type="submit" style="padding: 6px 10px; background-color: #007BFF; color: white; border: none; border-radius: 5px; cursor: pointer;">Recriar</button>
        </form>
    </div>
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
