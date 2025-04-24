<?php

require "connection.php";

if (isset($_GET["id"])) {
    $currentRecipe = $_GET["id"];
?>
    <div id="modalContent" class="container mt-2">
        <?php
        $comment_rs = Database::search("SELECT * FROM `comment` WHERE `recipe_recipeId`= '" . $currentRecipe . "'");
        $comment_num = $comment_rs->num_rows;
        if ($comment_num == 0) {
        ?>
            <div class="card mb-3">
                <div class="card-body">
                    <p class="card-text">No comments yet.</p>
                </div>
            </div>
        <?php
        }
        for ($x = 0; $x < $comment_num; $x++) {
            $comment_data = $comment_rs->fetch_assoc();
        ?>
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $comment_data["user_username"] ?></h5>
                    <p class="card-text"><?php echo $comment_data["comment"] ?></p>
                    <button class="btn btn-sm btn-outline-primary" data-bs-toggle="collapse" data-bs-target="#replyForm1" aria-expanded="false">Reply</button>

                    <div class="collapse mt-2" id="replyForm1">
                        <form>
                            <textarea id="replyText" class="form-control mb-2" rows="2" placeholder="Write your reply..."></textarea>
                            <button type="submit" class="btn btn-sm btn-primary" onclick="submitReply('<?php echo $comment_data['commentId'] ?>')">Post Reply</button>
                        </form>
                    </div>
                </div>
            </div>
        
        <div class="ms-4">
            <?php
            $reply_rs = Database::search("SELECT * FROM `reply` WHERE `comment_commentId`= '" . $comment_data["commentId"] . "'");
            $reply_num = $reply_rs->num_rows;
            for ($y = 0; $y < $reply_num; $y++) {
                $reply_data = $reply_rs->fetch_assoc();
            ?>
                <div class="card mb-2">
                    <div class="card-body">
                        <p class="card-text"><?php echo $reply_data["replycontent"] ?></p>
                    </div>
                </div>
            <?php
            }
            ?>

        </div>
        <?php
        }
        ?>
    </div>
<?php
} else {
    echo ("Invalid Recipe ID");
}


?>