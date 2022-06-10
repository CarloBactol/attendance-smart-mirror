<?php
include('./config/db_connection.php');


$sql = "SELECT * FROM tbl_test order by id desc limit 1";
$res = mysqli_query($conn, $sql);
$count = mysqli_num_rows($res);
if (mysqli_num_rows($res) === 1) {
    $row = mysqli_fetch_array($res);
?>
    <table class=" text-center">
        <thead>
            <tr>
                <th class="text-light">Temperature</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <small class="text-warning">Person_trace_time: <?php echo date("Y-m-d H:i:sa", strtotime($row['date'])); ?></small> </br>
                    <?php
                    if ($row['value'] > 37.5) { ?>
                        <span class="text-danger"><?php echo $row['value']; ?> C&deg;</span>
                    <?php } else { ?>
                        <span class="text-success"><?php echo $row['value']; ?> C&deg;</span>
                    <?php }
                    ?>
                    <?php if ($row['value'] > 37.5) { ?>
                        <div class="" style="display: none;">
                            <audio id="myAudio" controls>
                                <source src="alarm.mp3" type="audio/mpeg">
                            </audio>
                        </div>
                        <!-- <script>
                            setInterval(function() {
                                load();
                            }, 8000);


                            function load() {
                                jQuery.ajax({
                                    url: 'get.php',
                                    success: function(result) {
                                        var data = jQuery.parseJSON(result);
                                        if (data.sound == "yes") {
                                            jQuery('#audioBox')[0].play();
                                        }
                                    }
                                });
                            }
                        </script> -->
                    <?php  } ?>
                </td>
            </tr>
        </tbody>
    </table>


<?php }
