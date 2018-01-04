<?php

  /** @var View $this */

  use Funivan\Gallery\App\Pages\ListPage\ListUrl;
  use Funivan\Gallery\FileStorage\Fs\Local\LocalPath;
  use Funivan\Gallery\Framework\Templating\View;

  /** @var string $phrase */

?>
<div class="container">
  <div class="section">
    <div class="row center">
      <h3 class="light header">Gallery</h3>
      <p class="col s12 m8 offset-m2 caption">
        View and manager your media
      </p>
      <br>
      <a href="<?= (new ListUrl(new LocalPath('/')))->build() ?>" class="btn-large waves-effect waves-light">
        Get started
      </a>
    </div>
  </div>
</div>