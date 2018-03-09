
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

        <h2>karyawan List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Nama</th>
		<th>Alamat</th>
		<th>No Telp</th>
		<th>Photo</th>
		<th>Status</th>
		<th>Wp Jabatan Id</th>

            </tr><?php
            foreach ($karyawan_data as $karyawan)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $karyawan->nama ?></td>
		      <td><?php echo $karyawan->alamat ?></td>
		      <td><?php echo $karyawan->no_telp ?></td>
		      <td><?php echo $karyawan->photo ?></td>
		      <td><?php echo $karyawan->status ?></td>
		      <td><?php echo $karyawan->wp_jabatan_id ?></td>
                </tr>
                <?php
            }
            ?>
        </table>
    
