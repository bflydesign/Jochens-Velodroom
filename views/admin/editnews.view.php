<div class="alert alert-success" id="alert-success" hidden>
    <i class="glyphicon glyphicon-thumbs-up"></i> Het nieuwsbericht werd succesvol verwijderd!
</div>
<div class="alert alert-danger" id="alert-deleting-error" hidden>
    <i class="glyphicon glyphicon-thumbs-down"></i> Het nieuwsbericht kon niet worden verwijderd. Gelieve opnieuw te
    proberen.
</div>

<?php if (!empty($newsList)) { ?>
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th>Titel</th>
                <th>Geplaatst op</th>
                <th>Gewijzigd op</th>
                <th>Zichtbaar</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($newsList as $newsItem) { ?>
                <tr>
                    <td><?php print $newsItem->getTitle(); ?></td>
                    <td><?php print $newsItem->getDateCreated()->format('d-m-Y'); ?></td>
                    <td><?php print $newsItem->getDateModified()->format('d-m-Y'); ?></td>
                    <td>
                        <?php if ($newsItem->getPublish() == 1) { ?>
                            <i class="glyphicon glyphicon-check"></i>
                        <?php } ?>
                    </td>
                    <td>
                        <a href="/news/add?q=<?php print $newsItem->getId(); ?>"
                           class="btn btn-info">
                            <i class="glyphicon glyphicon-edit"></i> Bewerk
                        </a>
                        <a id="<?php print $newsItem->getId(); ?>"
                           class="btn btn-danger frmDeleteNews">
                            <i class="glyphicon glyphicon-remove"></i> Verwijder
                        </a>
                    </td>
                </tr>
            <?php } //endforeach ?>
            </tbody>
        </table>
    </div>
<?php } else { ?>
    <div class="jumbotron">
        <i class="glyphicon glyphicon-exclamation-sign"></i> Er zijn momenteel geen nieuwsberichten
    </div>
<?php } //endif ?>