<?php

  use Funivan\Gallery\Framework\Templating\View;

  /** @var View $this */
  /** @var string $phrase */
  /** @var string $description */
?>
<div class="row">
  <div class="col m12 l9">
    <div class="row">
      <h1>Page not found</h1>
      <?= $phrase ?>
      <? if ('' !== $description) { ?>
        <p>
          <?= $description ?>
        </p>
      <? } ?>
    </div>
  </div>
</div>