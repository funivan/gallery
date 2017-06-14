<?php
  /** @var \Funivan\Gallery\Framework\Auth\AuthComponentInterface $auth */
  /** @var string $title */

  /** @var string $content */

  use Funivan\Gallery\App\Pages\Auth\LoginPage\LoginUrl;
  use Funivan\Gallery\App\Pages\Auth\LogoutPage\LogoutUrl;
  use Funivan\Gallery\App\Pages\ListPage\ListUrl;
  use Funivan\Gallery\FileStorage\Fs\Local\LocalPath;

  $auth = $auth ?? null;
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <title><?= $title ?></title>

    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.2/css/materialize.min.css">
    <!--Import jQuery before materialize.js-->
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.2/js/materialize.min.js"></script>

  </head>
  <body>

    <nav>
      <div class="nav-wrapper">
        <?php if (null !== $auth) { ?>
          <ul>
            <?php if ($auth->authenticated()) { ?>
              <li>
                <a href="<?= (new LogoutUrl())->build() ?>">
                  <i class="material-icons">power_settings_new</i>
                </a>
              </li>
            <?php } else { ?>
              <li>
                <a href="<?= (new LoginUrl())->build() ?>">
                  <i class="material-icons">person_pin</i>
                </a>
              </li>
            <?php } ?>
          </ul>
        <?php } ?>

        <a href="<?= (new ListUrl(new LocalPath('/')))->build() ?>" class="brand-logo center hide-on-med-and-down">Images </a>

        <?php if (null !== $auth) { ?>

          <ul class="right">
            <?php if ($auth->authenticated()) { ?>
              <li>
                <a href="#">
                  <i class="material-icons">visibility_off</i>
                </a>
              </li>
              <li>
                <a href="#">
                  <i class="material-icons">visibility</i>
                </a>
              </li>
              <li>
                <a href="#">
                  <i class="material-icons">delete</i>
                </a>
              </li>
            <?php } ?>
          </ul>
        <?php } ?>
      </div>
    </nav>

    <div>
      <?= $content ?>
    </div>

  </body>
</html>

