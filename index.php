<?php
include("./config.php");
include(constant("SITE_ROOT")."/header.php");
?>
<div class="admtitleback" style="display: flex; justify-content: space-between; align-items: center;">
    <p class="admtitletext">HOME - PROJETO DICIONARIO</p>
    <div class="admtitletext">
        <!-- Combo Box para recriar tabelas -->
        <form action="recriar_tabelas.php" method="GET"  style="margin: 0">
            <select name="acao" style="padding: 5px; font-size: 14px;">
                <option value="">Selecione uma Tabela</option>
                <option value="disciplinas">Recriar Tabela Disciplinas</option>
                <option value="dicionario">Recriar Tabela Dicionário</option>
            </select>
            <button type="submit" style="padding: 6px 10px; background-color: #007BFF; color: white; border: none; border-radius: 5px; cursor: pointer;">Recriar</button>
        </form>
    </div>
</div>

<br>

<?php
include (constant("SITE_ROOT")."/menu.php");
?>

<?php
include(constant("SITE_ROOT")."/footer.php");
?>
