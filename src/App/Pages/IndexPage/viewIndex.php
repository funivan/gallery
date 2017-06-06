<?php

  /** @var View $this */

  use Funivan\Gallery\App\Pages\ListPage\ListUrl;
  use Funivan\Gallery\FileStorage\Fs\Local\LocalPath;
  use Funivan\Gallery\Framework\Templating\View;

  /** @var string $phrase */

?>
<div class="row">
  <div class="col m12 l9">
    <div class="row">
      <a href="<?= (new ListUrl(new LocalPath('/')))->build() ?>">View images</a>
    </div>
  </div>
</div>