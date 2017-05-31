<?php

  /** @var \Funivan\Gallery\FileStorage\PathInterface $currentPath */
  /** @var View $this */

  /** @var \Funivan\Gallery\FileStorage\PathInterface[] $directories */

  use Funivan\Gallery\App\Pages\Actions\Rotate\ImageRotateRightUrl;
  use Funivan\Gallery\App\Pages\Actions\ToggleFlag\ChangeFlagUrl;
  use Funivan\Gallery\App\Pages\Download\DownloadUrl;
  use Funivan\Gallery\App\Pages\ListPage\ListUrl;
  use Funivan\Gallery\App\Pages\ThumbPage\PreviewUrl;
  use Funivan\Gallery\App\Photo\Flag\Flags;
  use Funivan\Gallery\App\Photo\Flag\FlagsInterface;
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
      <?php /** @var \Funivan\Gallery\App\Photo\PhotosList $photos */ ?>
      <?php foreach ($photos as $index=>$photo) { ?>
        <?php $file = $photo->file();
        $filePath = $file->path() ?>
        <div class="col s12 m6 l4 xl3">

          <div class="card">
            <div class="card-image waves-effect waves-block waves-light">
              <a href="<?= (new DownloadUrl($filePath))->build() ?>" target="_blank">
                <div class="valign-wrapper center-align">
                  <img src='<?= (new PreviewUrl($filePath))->build() ?>' class="img-responsive center-block">
                </div>
              </a>
            </div>
            <div class="card sticky-action">
              <div class="card-action" data-image-path="<?= $filePath->assemble() ?>">
                <!--@todo toggle visibility -->
                <?php $flags = new Flags($file); ?>
                <a href="#" class="js-toggle" data-url="/toggle/visibility/">
                  <i class="material-icons" style="color:gray">visibility</i>
                  <i class="material-icons">visibility</i>
                </a>

                <a href="#" class="js-remove-button right" style="margin-right: 0">
                  <i class="material-icons" style="color:gray">delete</i>
                </a>

                <!--@todo toggle start action -->
                <a
                  href="<?= ChangeFlagUrl::createRemove(FlagsInterface::FAVOURITE, $file->path())->build() ?>"
                  class="js-toggle <?= $flags->has(FlagsInterface::FAVOURITE) ? 'js-flag-active' : 'js-flag-hidden' ?>"
                  data-type="toggle-favourite-<?= $index ?>"
                >
                  <i class="material-icons">star</i>
                </a>

                <a
                  href="<?= ChangeFlagUrl::createSet(FlagsInterface::FAVOURITE, $file->path())->build() ?>"
                  class="js-toggle <?= !$flags->has(FlagsInterface::FAVOURITE) ? 'js-flag-active' : 'js-flag-hidden' ?>"
                  data-type="toggle-favourite-<?= $index ?>"
                >
                  <i class="material-icons" style="color:gray">star</i>
                </a>

                <a href="<?= (new ImageRotateRightUrl($filePath))->build() ?>" class="js-toggle" data-url="/toggle/start/">
                  <i class="material-icons" style="transform: scaleX(-1);color:gray">replay</i>
                </a>

              </div>
            </div>
          </div>
        </div>
      <?php } ?>
    </div>
  </div>
</div>
<style type="text/css">
  .js-flag-hidden {
    display: none;
  }
</style>
<script type="text/javascript">
  $(document).ready(function () {
    var $toggleButtons = $('.js-toggle');
    $toggleButtons.click(function (event) {
      var $el = $(this);
      var group = $el.attr('data-type');
      $.post($el.attr('href'), {}, function (data) {
        $toggleButtons.each(function () {
          var $button = $(this);
          if ($button.attr('data-type') == group) {
            $button.toggle();
          }
        })
      }).fail(function () {
        alert("error");
      });
      event.preventDefault();
      return false;
    })
  })
</script>