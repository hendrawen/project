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

        <h2>Suplier List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
            		<th>Id Suplier</th>
            		<th>Nama Suplier</th>
            		<th>Alamat</th>

            </tr><?php
            foreach ($suplier_data as $suplier)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $suplier->id_suplier ?></td>
		      <td><?php echo $suplier->nama_suplier ?></td>
		      <td><?php echo $suplier->alamat ?></td>
                </tr>
                <?php
            }
            ?>
        </table>
