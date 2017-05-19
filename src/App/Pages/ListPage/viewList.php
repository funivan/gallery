<?php

  /** @var \Funivan\Gallery\FileStorage\PathInterface $currentPath */
  /** @var View $this */
  /** @var \Funivan\Gallery\FileStorage\PathInterface[] $directories */

  use Funivan\Gallery\App\Pages\Actions\Favourite\FavouriteUrl;
  use Funivan\Gallery\App\Pages\Download\DownloadUrl;
  use Funivan\Gallery\App\Pages\ListPage\ListUrl;
  use Funivan\Gallery\App\Pages\ThumbPage\ThumbUrl;
  use Funivan\Gallery\Framework\Templating\View;


?>
<div class="row">
  <div class="col m12 l3">
    <div class="collection">
      <?php if (!$currentPath->isRoot()) { ?>
        <a href="<?= (new ListUrl($currentPath->previous()))->build() ?>" class="collection-item">
          back <i class="material-icons right">call_missed</i>
        </a>
        <a href="#" class="collection-item active">
          <?= $currentPath->name() ?>
        </a>
      <?php } ?>

      <?php foreach ($directories as $dir) { ?>
        <a href="<?= (new ListUrl($dir))->build(); ?>" class="collection-item"><?= $dir->name(); ?></a>
      <?php } ?>
    </div>
  </div>
  <div class="col m12 l9">
    <div class="row">
      <?php /** @var \Funivan\Gallery\FileStorage\PathInterface[] $files */ ?>
      <?php foreach ($files as $index => $filePath) { ?>
        <div class="col s12 m6 l4 xl3">

          <div class="card">
            <div class="card-image  waves-effect waves-block waves-light">
              <a href="<?= (new DownloadUrl($filePath))->build() ?>" target="_blank">
                <div class="valign-wrapper center-align">
                  <img src='<?= (new ThumbUrl($filePath))->build() ?>' class="img-responsive center-block">
                </div>
              </a>
            </div>
            <div class="card sticky-action">
              <div class="card-action" data-image-path="<?= $filePath->assemble() ?>">
                <!--@todo toggle visibility -->
                <a href="#" class="js-toggle" data-url="/toggle/visibility/">
                  <i class="material-icons" style="color:gray">visibility</i>
                  <i class="material-icons">visibility</i>
                </a>

                <a href="#" class="js-remove-button right" style="margin-right: 0">
                  <i class="material-icons" style="color:gray">delete</i>
                </a>

                <!--@todo toggle start action -->
                <a href="<?= (new FavouriteUrl('on', $filePath))->build() ?>" class="js-toggle" data-url="/toggle/start/">
                  <i class="material-icons">star</i>
                  <i class="material-icons" style="color:gray">star</i>
                </a>

              </div>
            </div>
          </div>
        </div>
      <?php } ?>
    </div>
  </div>
</div>