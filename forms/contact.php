<form class="form-horizontal" role="form" id="frmContact" method="post">
    <!-- Formulier intro -->
    <?php if(isset($formIntro)) { ?>
        <div class="form_intro"><?php print $formIntro; ?></div>
    <?php } ?>

    <!-- Foutmeldingen -->
    <?php if(!empty($errors)) { ?>
        <ul class="errorlist">
            <?php foreach($errors as $error) { ?>
                <li><?php print $error; ?></li>
            <?php } ?>
        </ul>
    <?php } ?>

    <!-- Formulier -->
    <fieldset>
        <div class="form-group">
            <label class="control-label col-sm-2" for="theme">Betreft:</label>
            <div class="col-sm-10">
                <select class="form-control" id="theme">
                    <option>contacteer ons</option>
                    <option>vraag voor bestelling</option>
                    <option>inschrijven nieuwsbrief</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="email">Email:</label>
            <div class="col-sm-10">
                <input type="email" class="form-control" id="email" placeholder="Enter email" data-validation="required email">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="pwd">Naam:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="pwd" placeholder="Naam" data-validation="required">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="subject">Onderwerp:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="subject" placeholder="Onderwerp" data-validation="required">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="subject">Inhoud:</label>
            <div class="col-sm-10">
                <textarea class="form-control" id="message" rows="5" data-validation="required"></textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2" for="captcha">CAPTCHA</label>
            <div class="col-sm-10">
                <div class="g-recaptcha" id="recaptcha" data-sitekey="<?php echo $siteKey; ?>"></div>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <input type="hidden" name="hfAction" value="hfSendMail"/>
                <?php print $xsrf_guard->xsrf_guard_field(); ?>
                <button type="submit" class="btn btn-default">Verzenden</button>
            </div>
        </div>
    </fieldset>
</form>