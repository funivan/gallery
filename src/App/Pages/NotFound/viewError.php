<?php

  use Funivan\CabbageFramework\Templating\View;

  /** @var View $this */
  /** @var string $phrase */
  /** @var string $description */
?>
<div class="row">
  <div class="col m12 l9">
    <div class="row">
      <h1>Page not found</h1>
      <?= $phrase ?>
      <?php if ('' !== $description) { ?>
        <p>
          <?= $description ?>
        </p>
      <?php } ?>
    </div>
  </div>
</div>