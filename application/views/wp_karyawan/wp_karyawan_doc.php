<!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
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
    </head>
    <body>
        <h2>Wp_karyawan List</h2>
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
            foreach ($wp_karyawan_data as $wp_karyawan)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $wp_karyawan->nama ?></td>
		      <td><?php echo $wp_karyawan->alamat ?></td>
		      <td><?php echo $wp_karyawan->no_telp ?></td>
		      <td><?php echo $wp_karyawan->photo ?></td>
		      <td><?php echo $wp_karyawan->status ?></td>
		      <td><?php echo $wp_karyawan->wp_jabatan_id ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>