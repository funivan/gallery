<?php /** @var string $title */ ?>
<?php
  //@codeCoverageIgnoreStart
  /** @noinspection UnSafeIsSetOverArrayInspection */
  if (isset($subTitle)) {
    $title = $title . ' :: ' . $subTitle;
  }
?>
<h1><?= $title ?></h1><?php //@codeCoverageIgnoreEnd ?>