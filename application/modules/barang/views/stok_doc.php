
<style>
    .word-table {
        border:1px solid black !important;
        border-collapse: collapse !important;
        width: 100%;
    }
    .word-table tr th, .word-table tr td{
        border:1px solid black !important;
        padding: 5px 10px;
    }
</style>

        <h2>Stok List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
            		<th>Wp Barang Id</th>
            		<th>Stok</th>
            		<th>Updated At</th>

            </tr><?php
            foreach ($stok_data as $wp_stok)
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
