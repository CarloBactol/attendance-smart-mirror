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
              <th>Celcius</th>
              <th>Reading Time</th>
            </thead>
            <tbody>
              <?php
              $sql = "SELECT * FROM tbl_temperature ORDER BY id DESC";
              $res = mysqli_query($conn, $sql);
              $count = mysqli_num_rows($res);
              if ($count > 0) {
                while ($row = mysqli_fetch_assoc($res)) {
                  $id = $row['id'];
                  $value = $row['value'];
                  $reading_time = $row['reading_time']; ?>
                  <tr>
                    <td><?php
                        $bad = "<span class='text-danger'>Bad</span>";
                        $good = "<span>Good</span>";
                        if ($value >= '38') {
                          echo $value;
                          echo " ";
                          echo $bad;
                        } else {
                          echo $value;
                          echo " ";
                          echo $good;
                        }
                        ?></td>
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