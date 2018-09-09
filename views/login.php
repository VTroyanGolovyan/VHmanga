<main>
  <div class = "aboutLogin">
    <div class = "hello"> Заходи,не пожалеешь!</div>
    <div class = "mobileForm">
      <form method="post" action="?cmd=login">
        <input class = "blockinput" name = "login" type = "text" placeholder="Почта" autocomplete="off">
        <input class = "blockinput" name = "password" type = "password" placeholder="Пароль" autocomplete="off">
        <input class = "blocksubmit" type = "submit" value = "Войти">
      </form>
    </div>
     <?php include 'panels/slider.php'; ?>
  </div>
</main>
  <div class = "rightAuth">
    <div class = "avtorizationTitle">Авторизация</div>
    <form method="post" action="?cmd=login">
      <input class = "blockinput" name = "login" type = "text" placeholder="Почта" autocomplete="off">
      <input class = "blockinput" name = "password" type = "password" placeholder="Пароль" autocomplete="off">
      <input class = "blocksubmit" type = "submit" value = "Войти">
    </form>
  </div>
