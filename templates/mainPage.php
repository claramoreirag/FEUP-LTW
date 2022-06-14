<?php function draw_mainPage() { 
 ?>

<!DOCTYPE html>
<html lang="en-US">
  <head>
    <title>mainPage</title>    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/mainPage-style.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
  </head>
  <body>
    
    <div class="welcome">
      <div class="headerText">
        <h3>Animal Shelter</h3>
        <h1>True Friends</h1>
      </div>
    </div>

    <div class="presentation">
      <div class="presentation__container">
        <h1>Who are we?</h1>
        <p>We are a website that helps people find their perfect pet. In here we will give our users the possibility to adopt and ask people to adopt their pets. Every user is verified and we check that the animals are in good health and are not being misstreated. Each pet is getting all the care and love that they deserve.</p>
        <p>At True Friends we believe that there is a home for every pet and we hope we can give every one the home they deserve. We respect, above all else, the animal rights and we are proud to be on the vanguard of helping animals have a better life.</p>
        <p>Join us in our quest to help people find their perfect companion and maybe you can even find your new best friend.</p>
      </div>
    </div>

    <div class="carousel">

      <button class="carousel__button carousel__button--left">
        <img src="..\img\ui\back.svg" alt="">
      </button>

      <div class="carousel__track-container">
        <ul class="carousel__track">
          <li class="carousel__slide current-slide">
            <img class="carousel__image" src="..\img\dogs\cat_and_dog.jpg" alt="" />
          </li>
          <li class="carousel__slide">
            <img class="carousel__image" src="..\img\dogs\cutedog_8.jpg" alt="" />
          </li>
          <li class="carousel__slide">
            <img class="carousel__image" src="..\img\cats\cutecat_10.jpg" alt="" />
          </li>
        </ul>
      </div>

      <button class="carousel__button carousel__button--right">
        <img src="../img/ui/next.svg" alt="">
      </button>

      <div class="carousel__nav">
        <button class="carousel__indicator current-slide"></button>
        <button class="carousel__indicator"></button>
        <button class="carousel__indicator"></button>
      </div>

    </div>

    <script src="../js/carousel.js"></script>

    <div class="contactUs">
      <div style="text-align:center">
        <h2>Contact Us</h2>
        <p>Venha conhecer os nossos animais ou deixe uma mensagem:</p>
      </div>
      <div class="form__container">
        <div class="column">
          <img src="../img/ui/animalRescue.png" style="width:100%">
        </div>
        <div class="column">
          <form action="../actions/mainPageAction.php">
            <label for="fname">Primeiro Nome</label>
            <input type="text" id="fname" name="firstname" placeholder="O teu nome..">
            <label for="lname">Last Name</label>
            <input type="text" id="lname" name="lastname" placeholder="O teu apelido..">
            <label for="country">District</label>
            <select id="country" name="country">
              <option value="viana">Viana do Castelo</option>
              <option value="braga">Braga</option>
              <option value="vilaReal">Vila Real</option>
              <option value="bragança">Brangança</option>
              <option value="porto">Porto</option>
              <option value="aveiro">Aveiro</option>
              <option value="viseu">Viseu</option>
              <option value="guarda">Guarda</option>
              <option value="coimbra">Coimbra</option>
              <option value="casteloBranco">Castelo Branco</option>
              <option value="leiria">Leiria</option>
              <option value="lisboa">Lisboa</option>
              <option value="santarem">Santarém</option>
              <option value="portalegre">Portalegre</option>
              <option value="setubal">Setubal</option>
              <option value="evora">Évora</option>
              <option value="beja">Beja</option>
              <option value="faro">Faro</option>
            </select>
            <label for="subject">Message</label>
            <textarea id="subject" name="subject" placeholder="Write your message.." style="height:170px"></textarea>
            <input type="submit" value="Enviar">
          </form>
        </div>
      </div>
    </div>
<!-- 
    <footer>
      <p>&copy; True Friends, 2020</p>
    </footer> -->
  </body>
</html>

















 <?php } ?>