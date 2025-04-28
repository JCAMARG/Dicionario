<?php
include("./config.php");
include(constant("SITE_ROOT")."/header.php");
?>
<div class="admtitleback flexheader">
    <p class="admtitletext">HOME - PROJETO DICIONARIO</p>
    <div class="admtitletext">
        <!-- Combo Box para recriar tabelas -->
        <form action="recriar_tabelas.php" method="GET"  style="margin: 0">
            <select name="acao" style="padding: 5px; font-size: 14px;">
                <option value="">&lt;Opções para carga inicial&gt;</option>
                <option value="criar_disciplinas">Recriar Tabela Disciplinas</option>
                <option value="criar_dicionario">Recriar Tabela Dicionário</option>
                <option value="ins_disc">Carregar dados Disciplinas</option>
                <option value="ins_dici">Carregar dados Dicionário</option>
                <option value="restaurar">Restaurar banco completo</option>
            </select>
            <button class="but-confirma" type="submit" onclick="if(this.form.acao.value == '') { event.preventDefault(); }">Processar</button>
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
