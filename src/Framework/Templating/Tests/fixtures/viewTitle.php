<?php /** @var string $title */ ?>
<?php
  if (isset($subTitle)) {
    $title = $title . ' :: ' . $subTitle;
  }
?>
<h1><?= $title ?></h1>