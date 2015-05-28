<div class="alert alert-success" id="alert-success" hidden>
    <i class="glyphicon glyphicon-thumbs-up"></i> De wijzigingen werden bewaard
</div>
<div class="alert alert-danger" id="alert-input-error" hidden>
    <i class="glyphicon glyphicon-thumbs-down"></i> Niet alle velden werden correct ingevuld
</div>
<div class="alert alert-danger" id="alert-saving-error" hidden>
    <i class="glyphicon glyphicon-thumbs-down"></i> De wijzigingen konden niet worden bewaard
</div>

<?php if (isset($page)) {
    if($page->getSlug() == 'news') {
?>
<div class="alert alert-warning">
    Hier kan je enkel de introtekst wijzigen die <u>boven</u> de nieuwsberichten komt te staan.<br/>
    Voor het toevoegen van nieuwsberichten klik <a href="/news/add">hier</a>.
</div>
<?php
    }
?>
    <form method="post" action="#" id="frmPage">
        <input type="hidden" id="slug" name="slug"
               value="<?php print !isNullOrEmpty($page->getSlug()) ? $page->getSlug() : ''; ?>"/>

        <div class="form-group">
            <label for="title">Titel *</label>
            <input type="text" class="input-group form-control" id="title" name="title" data-validation="length"
                   data-validation-length="min1" value="<?php print !isNullOrEmpty($page->getTitle()) ? $page->getTitle() : ''; ?>"/>
            nog <span id="maxlength">50</span> tekens
        </div>
        <div class="form-group">
            <label for="content">Inhoud *</label>
            <textarea class="input-group form-control" rows="10" id="content" data-validation="length"
                      data-validation-length="min10"
                      name="content"><?php print !isNullOrEmpty($page->getContent()) ? $page->getContent() : ''; ?></textarea>
        </div>
        <div class="checkbox">
            <label for="publish">
                <input type="checkbox" class="input-group" id="publish"
                       name="publish" <?php print ($page->getPublish() == 1) ? 'checked' : ''; ?>/> Publiceer
            </label>
        </div>
        <input type="hidden" name="hfAction" value="hfSavePage"/>
        <button type="submit" class="btn btn-info" id="btnSave">
            <i class="glyphicon glyphicon-save"></i> Opslaan
        </button>
    </form>
<?php } else { ?>
    <div class="jumbotron">
        <i class="glyphicon glyphicon-exclamation-sign"></i> Er is iets foutgelopen bij het ophalen van de data, gelieve
        opnieuw te proberen
    </div>
<?php } ?>