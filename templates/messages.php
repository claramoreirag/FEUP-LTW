<?php function display_messages() { 
 ?>
<link href="../css/message-style.css" rel="stylesheet">
<?php if (isset($_SESSION['messages'])) {?>
    <br>
        <section id="messages">
          <?php foreach($_SESSION['messages'] as $message) { ?>
            <div class="<?=$message['type']?>"><?=$message['content']?></div>
          <?php } ?>
        </section>
      <?php unset($_SESSION['messages']); } ?>


<?php } ?>