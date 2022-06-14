<?php

$pets = getPetsFromUser($id);


foreach ($pets as $pet) { ?>
    <div class="pet">
        <img class="petpicture" src="<?= $pet['photo'] ?>" alt="pet pic">
        <p class="petname"><?= $pet['name'] ?></p>
    </div>
<?php
}
?>