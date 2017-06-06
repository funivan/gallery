<?php

  use Funivan\Gallery\App\Pages\Auth\LoginPage\LoginUrl;
  use Funivan\Gallery\App\Pages\Auth\LogoutPage\LogoutUrl;
  use Funivan\Gallery\Framework\Auth\AuthComponentInterface;

  /** @var AuthComponentInterface $auth */
  /** @var string[] $errors */
?>
<div class="row" style="margin-top: 150px;">
  <div class="col s4"></div>
  <div class="col s4">
    <?php if ($auth->authenticated()) { ?>
      <div class="row">
        <div class="col s12">
          <div class="card blue darken-1">
            <div class="card-content white-text">
              <span class="card-title">You are successfully logged in as <?= $auth->user()->uid() ?>!</span>
              <p>
                You have access to the following operations:
                <br>
                -- mark photo as favourite<br>
                -- delete photo<br>
                -- change public visibility<br>
              </p>
            </div>
            <div class="card-action">
              <a href="<?= (new LogoutUrl())->build() ?>">Logout</a>
            </div>
          </div>
        </div>
      </div>


    <?php } else { ?>
      <form method="post" action="<?= (new LoginUrl())->build() ?>">
        <?php if (count($errors) > 0) { ?>
          <div class="red-text col s10">
            <?= implode('<br>', $errors) ?>
          </div>
        <?php } ?>
        <div class="input-field col s10">
          <input id="login" name="login" type="text" class="validate">
          <label for="login">Login</label>
        </div>
        <div class="input-field col s10">
          <input id="pass" name="pass" type="password" class="validate">
          <label for="pass">Pass</label>
        </div>
        <div class="input-field col s10">
          <input type="submit" class="btn"/>
        </div>
      </form>
    <?php } ?>
  </div>
  <div class="col s4"></div>
</div>



