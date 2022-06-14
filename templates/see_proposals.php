<?php function draw_see_proposals()
{

    $proposals = getAllProposals($_SESSION['userid']);
?>

    <!DOCTYPE html>
    <html lang="en-US">

    <head>
        <title>
            Proposals
        </title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="../css/feed_style.css">
        <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
        <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    </head>

    <body>

        

        <h1>Proposals</h1>

        <?php foreach ($proposals as $proposal) {

            $pet = getPetofPost($proposal['postid']);
            $user = getUserbyId($proposal['user']);

        ?>



            <div class="post">

                <div class="info">

                    <h1 class="name"><?= $pet['name'] ?>, <?= $pet['age'] ?></h1>
                    <h2>Who made the proposal: <?= $user['name'] ?>, @<?= $user['username'] ?></h2>
                    <p>Proposal message: <?= $proposal['message'] ?>
                        <div class="flex__container">

                        <img class="petpic" src="<?= $pet['photo'] ?>" alt="profile picture">
                        </div>
                        <form method="post" action="../actions/accept_proposal.php?post=<?= $proposal['postid'] ?>&user=<?=$proposal['user']?>">
                            <input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">
                            <button id="accept" class="btn accept"><a  href="../actions/accept_proposal.php?post=<?= $proposal['postid'] ?>&user=<?= $proposal['user'] ?>">Accept</a></button>
                        </form>
                        
                        <form method="post" action="../actions/reject_proposal.php?post=<?= $proposal['postid'] ?>&user=<?= $proposal['user'] ?>">
                            <input type="hidden" name="csrf" value="<?=$_SESSION['csrf']?>">
                            <button id="reject" class="btn reject"><a  href= "../actions/reject_proposal.php?post=<?= $proposal['postid'] ?>&user=<?= $proposal['user'] ?>">Reject</a></button>
                        </form>
                        
                        
                </div>

            </div>
            <br>


            </div>




        <?php } ?>

    </body>

    </html>

<?php } ?>