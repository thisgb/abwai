<table class="table table-striped table-dark table-hover">
    <tr>
        <th>Tanggal</th>
        <th>Jam Masuk</th>
        <th>Jam Keluar</th>
        <th>Performances</th>
    </tr>

    <?php
    include "../connection.php";
    date_default_timezone_set("Asia/Jakarta");
    $employee_id = $_SESSION['employee_id'];

    $sql = "SELECT * FROM attendances WHERE employee_id = $employee_id";
    $result = $db->query($sql);

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['tgl'] . "</td>";
        echo "<td>" . $row['clock_in'] . "</td>";

        if (empty($row['clock_out'])) {
            echo "<td>
                    <form action='action.php' method='POST'>
                        <button type='submit' name='keluar' class='btn btn-outline-warning btn-sm'>ABSEN KELUAR</button>
                    </form>
                  </td>";
        } else {
            echo "<td>" . $row['clock_out'] . "</td>";
        }

        echo "<td> 😛</td>";
        echo "</tr>";
    }
    ?>
</table>
