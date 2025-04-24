<?php
require "connection.php";

if (isset($_POST['query'])) {

?>
    <table id="userTable">
        <tbody>
            <?php
            $query = $_POST['query'];
            $rs = Database::search("SELECT * FROM `user` WHERE `username` LIKE '%$query%' OR `firstname` LIKE '%$query%' OR `lastname` LIKE '%$query%' OR `email` LIKE '%$query%'");
            $nun = $rs->num_rows;
            for ($x = 0; $x < $nun; $x++) {
                $d = $rs->fetch_assoc();
            ?>
                <tr>
                    <td data-label="Name"><?php echo $d["firstname"] . " " . $d["lastname"]; ?></td>
                    <td data-label="Rating"><?php echo $d["email"]; ?></td>
                    <td data-label="Actions">
                        <button class="btn-action btn-view">Recipies</button>
                        <?php
                        if ($d["status"] == 1) {
                        ?>
                            <button class="btn-action btn-inactive" onclick="changeStatus(this, '<?php echo $d['username']; ?>')">Deactivate</button>
                        <?php
                        } else {
                        ?>
                            <button class="btn-action btn-active" onclick="changeStatus(this, '<?php echo $d['username']; ?>')">Activate</button>
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