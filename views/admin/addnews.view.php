<div class="alert alert-success" id="alert-success" hidden>
    <i class="glyphicon glyphicon-thumbs-up"></i> De wijzigingen werden bewaard
</div>
<div class="alert alert-danger" id="alert-input-error" hidden>
    <i class="glyphicon glyphicon-thumbs-down"></i> Niet alle velden werden correct ingevuld
</div>
<div class="alert alert-danger" id="alert-saving-error" hidden>
    <i class="glyphicon glyphicon-thumbs-down"></i> De wijzigingen konden niet worden bewaard
</div>

<form method="post" action="#" id="frmNews">
    <input type="hidden" id="id" name="id" value="<?php print (isset($news) && !isNullOrEmpty($news->getId())) ? $news->getId() : ''; ?>"/>
    <div class="form-group">
        <label for="title">Publiceer van :</label>
        <input type="text" class="input-group" id="publishFrom" name="publishFrom" readonly="readonly" value="<?php print (isset($news) && !empty($news->getPublishFrom())) ? $news->getPublishFrom()->format('d-m-Y') : ''; ?>"/>
    </div>
    <div class="form-group">
        <label for="title">Publiceer tot :</label>
        <input type="text" class="input-group" id="publishTo" name="publishTo" readonly="readonly" value="<?php print (isset($news) && !empty($news->getPublishTo())) ? $news->getPublishTo()->format('d-m-Y') : ''; ?>"/>
    </div>
    <div class="form-group">
        <label for="title">Titel *</label>
        <input type="text" class="input-group form-control" id="title" name="title" data-validation="length" data-validation-length="min5" value="<?php print (isset($news)) && !isNullOrEmpty($news->getTitle()) ? $news->getTitle() : ''; ?>"/>
        nog <span id="maxlength">250</span> tekens
    </div>
    <div class="form-group">
        <label for="content">Inhoud *</label>
        <textarea class="input-group form-control" rows="10" id="content" data-validation="length" data-validation-length="min25" name="content"><?php print (isset($news)) && !isNullOrEmpty($news->getContent()) ? $news->getContent() : ''; ?></textarea>
    </div>
    <div class="checkbox">
        <label for="publish">
            <input type="checkbox" class="input-group" id="publish" name="publish" <?php print (isset($news) && $news->getPublish() == 1) ? 'checked' : ''; ?>/> Publiceer
        </label>
    </div>
    <input type="hidden" name="hfAction" value="hfSaveNews"/>
    <button type="submit" class="btn btn-info" id="btnSave">
        <i class="glyphicon glyphicon-save"></i> Opslaan
    </button>
</form>