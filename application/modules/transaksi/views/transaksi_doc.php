
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

        <h2>Wp_transaksi List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Id Transaksi</th>
		<th>Wp Barang Id</th>
		<th>Harga</th>
		<th>Qty</th>
		<th>Satuan</th>
		<th>Tgl Transaksi</th>
		<th>Updated At</th>
		<th>Wp Pelanggan Id</th>
		<th>Username</th>
		<th>Wp Status Id</th>

            </tr><?php
            foreach ($transaksi_data as $wp_transaksi)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $wp_transaksi->id_transaksi ?></td>
		      <td><?php echo $wp_transaksi->wp_barang_id ?></td>
		      <td><?php echo $wp_transaksi->harga ?></td>
		      <td><?php echo $wp_transaksi->qty ?></td>
		      <td><?php echo $wp_transaksi->satuan ?></td>
		      <td><?php echo $wp_transaksi->tgl_transaksi ?></td>
		      <td><?php echo $wp_transaksi->updated_at ?></td>
		      <td><?php echo $wp_transaksi->wp_pelanggan_id ?></td>
		      <td><?php echo $wp_transaksi->username ?></td>
		      <td><?php echo $wp_transaksi->wp_status_id ?></td>
                </tr>
                <?php
            }
            ?>
        </table>
