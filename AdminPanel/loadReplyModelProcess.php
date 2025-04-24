<?php

require "connection.php";

if (isset($_GET["id"])) {
    $currentMessage = $_GET["id"];
    Database::iud("UPDATE `contactus` SET `status` = '0' WHERE `massageId` = '" . $currentMessage . "'");
?>
    <div id="modalContent" class="container mt-2">
        <?php
        $message_rs = Database::search("SELECT * FROM `contactus` WHERE `massageId`= '" . $currentMessage . "'");
        $message_data = $message_rs->fetch_assoc();
        ?>
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title"><?php echo $message_data["senderEmail"] ?></h5>
                <p class="card-text"><small class="text-muted"><?php echo $message_data["dateTime"] ?></small></p>
                <p class="card-text"><?php echo $message_data["contain"] ?></p>
                <button class="btn btn-sm btn-outline-primary" data-bs-toggle="collapse" data-bs-target="#replyForm1" aria-expanded="false">Reply</button>

                <!-- Reply Form -->
                <div class="collapse mt-2" id="replyForm1">
                    <form>
                        <textarea id="replyText" class="form-control mb-2" rows="2" placeholder="Write your reply..."></textarea>
                        <button type="button" class="btn btn-sm btn-primary" onclick="submitReply('<?php echo $message_data['massageId'] ?>')">Post Reply</button>
                    </form>
                </div>
                <!-- Nested Reply -->
                <div class="mt-2 ms-4">
                    <?php
                    $reply_rs = Database::search("SELECT * FROM `contactusreply` WHERE `contactUs_massageId`= '" . $message_data["massageId"] . "'");
                    $reply_num = $reply_rs->num_rows;
                    for ($y = 0; $y < $reply_num; $y++) {
                        $reply_data = $reply_rs->fetch_assoc();
                    ?>
                        <div class="card mb-2">
                            <div class="card-body">
                                <p class="card-text"><small class="text-muted"><?php echo $reply_data["dateTime"] ?></small></p>
                                <p class="card-text"><?php echo $reply_data["contain"] ?></p>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
<?php
}
?>