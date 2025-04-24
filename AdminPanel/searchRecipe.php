<?php
require "connection.php";

if (isset($_POST['query'])) {

?>
    <table id="recipeTable">
        <tbody>
            <?php
            $query = $_POST['query'];
            $rs = Database::search("SELECT * FROM `recipe` WHERE `user_username` LIKE '%$query%' OR `recipeName` LIKE '%$query%' ");
            $nun = $rs->num_rows;
            for ($x = 0; $x < $nun; $x++) {
                $d = $rs->fetch_assoc();
            ?>
                <tr>
                    <td data-label="Name"><?php echo $d["recipeName"]; ?></td>
                    <td data-label="Rating">4.2</td>
                    <td data-label="Actions">
                        <button class="btn-action btn-view">View</button>
                        <?php
                        if ($d["status"] == 1) {
                        ?>
                            <button class="btn-action btn-inactive" onclick="changeRecipeStatus(this, '<?php echo $d['recipeId']; ?>')">Deactivate</button>
                        <?php
                        } else {
                        ?>
                            <button class="btn-action btn-active" onclick="changeRecipeStatus(this, '<?php echo $d['recipeId']; ?>')">Activate</button>
                        <?php
                        }
                        ?>
                    </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>

<?php
}
?>