<?php

  declare(strict_types = 1);

  /** @var View $this */
  /** @var PathInterface $currentPath */
  /** @var PathInterface[] $directories */

  /** @var \Funivan\CabbageFramework\Auth\UserInterface $user */


  use Funivan\CabbageFramework\Auth\UserInterface;
  use Funivan\Gallery\App\Pages\Download\DownloadUrl;
  use Funivan\Gallery\App\Pages\ThumbPage\PreviewUrl;
  use Funivan\Gallery\FileStorage\PathInterface;
  use Funivan\CabbageFramework\Templating\View;

  /** @var \Funivan\Gallery\FileStorage\File\FileInterface[] $photos */
?>
<div class="row">
  <div class="col m12 l12">
    <div class="row">
      <?php foreach ($photos as $file) { ?>
        <?php $filePath = $file->path(); ?>
        <div class="col s12 m6 l4 xl3">
          <div class="card js-image-card">
            <div class="card-image waves-effect waves-block waves-light">
              <a href="<?= (new DownloadUrl($filePath))->build() ?>" target="_blank">
                <div class="valign-wrapper center-align">
                  <img src='<?= (new PreviewUrl($filePath))->build() ?>' class="img-responsive center-block js-image-preview">
                </div>
              </a>
            </div>
          </div>
        </div>
      <?php } ?>
    </div>
  </div>
</div>