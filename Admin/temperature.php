<?php
include('./partials/menu.php');
?>


<section style="margin-top: 100px;">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4 class="page-header text-center text-white">Temprature</h4>

                <div class="container">
                    <table class="table text-light">
                        <thead>
                            <th>ID</th>
                            <th>Celcius</th>
                            <th>Reading Time</th>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT * FROM tbl_temperature";
                            $res = mysqli_query($conn, $sql);
                            $count = mysqli_num_rows($res);
                            if ($count > 0) {
                                while ($row = mysqli_fetch_assoc($res)) {
                                    $id = $row['id'];
                                    $value = $row['value'];
                                    $reading_time = $row['reading_time']; ?>
                                    <tr>
                                        <td><?php echo $id; ?></td>
                                        <td><?php echo $value; ?></td>
                                        <td><?php echo $reading_time; ?></td>
                                    </tr>
                            <?php
                                }
                            }
                            ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>