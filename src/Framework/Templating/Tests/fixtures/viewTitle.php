<?php /** @var string $title */ ?>
<?php
  /** @noinspection UnSafeIsSetOverArrayInspection */
  if (isset($subTitle)) {
    $title = $title . ' :: ' . $subTitle;
  }
?>
<h1><?= $title ?></h1>