<?php
  /** @var string $title */
  use Funivan\Gallery\App\Pages\ListPage\ListUrl;
  use Funivan\Gallery\FileStorage\Fs\Local\LocalPath;

  /** @var string $content */
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

        <ul class="left ">
          <li>
            <a href="#">
              <i class="material-icons">play_circle_filled</i>
            </a>
          </li>
        </ul>


        <a href="<?= (new ListUrl(new LocalPath('/')))->build() ?>" class="brand-logo center hide-on-med-and-down">Images </a>

        <ul class="right">
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
        </ul>
      </div>
    </nav>


    <div>
      <?= $content ?>
    </div>

  </body>
</html>

