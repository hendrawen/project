
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

        <h2>Gudang List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Nama Gudang</th>
		<th>Alamat</th>

            </tr><?php
            foreach ($gudang as $gudang)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $gudang->nama_gudang ?></td>
		      <td><?php echo $gudang->alamat ?></td>
                </tr>
                <?php
            }
            ?>
        </table>
    
