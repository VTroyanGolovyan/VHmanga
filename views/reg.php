<main>
  <div class = "aboutLogin">
     <div class = "hello"> Присоединяйся в наши ряды!</div>
     <div class="mobileForm">
       <form method = "POST" action = "?cmd=reg">
         <input class = "blockinput" name = "name" type = "text" placeholder="Имя">
         <br>
         <input class = "blockinput" name = "last_name" type = "text" placeholder="Фамилия">
         <br>
         <input class = "blockinput" name = "login" type = "text" placeholder="Почта">
         <br>
         <input class = "blockinput" name = "password" type = "password" placeholder="Пароль">
         <br>
         <input class = "blocksubmit" type = "submit" value = "Регистрация">
       </form>
     </div>
     <?php include 'panels/slider.php'; ?>

  </div>
</main>
  <div class = "rightAuth">
    <div class = "avtorizationTitle">Регистрация</div>
    <form method = "POST" action = "?cmd=reg">
      <input class = "blockinput" name = "name" type = "text" placeholder="Имя">
      <br>
      <input class = "blockinput" name = "last_name" type = "text" placeholder="Фамилия">
      <br>
      <input class = "blockinput" name = "login" type = "text" placeholder="Почта">
      <br>
      <input class = "blockinput" name = "password" type = "password" placeholder="Пароль">
      <br>
      <input class = "blocksubmit" type = "submit" value = "Регистрация">
    </form>
  </div>
