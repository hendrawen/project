

        <h2>Wp_stok List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
        <th>Wp Barang Id</th>
        <th>Stok</th>
        <th>Updated At</th>

            </tr><?php
            foreach ($wp_stok_data as $wp_stok)
            {
                ?>
                <tr>
          <td><?php echo ++$start ?></td>
          <td><?php echo $wp_stok->wp_barang_id ?></td>
          <td><?php echo $wp_stok->stok ?></td>
          <td><?php echo $wp_stok->updated_at ?></td>
                </tr>
                <?php
            }
            ?>
        </table>
