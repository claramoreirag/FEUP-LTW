<?php

$pets = getPetsFromUser($_SESSION['userid']);


foreach ($pets as $pet) { ?>
    <div class="pet">
        <img class="petpic" src="<?= $pet['photo'] ?>" alt="pet pic">
        <p class="petname"><?= $pet['name'] ?></p>
    </div>
<?php
}
?>