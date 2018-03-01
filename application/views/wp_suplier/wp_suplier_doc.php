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
        <h2>Wp_suplier List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Id Suplier</th>
		<th>Nama Suplier</th>
		<th>Alamat</th>
		
            </tr><?php
            foreach ($wp_suplier_data as $wp_suplier)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $wp_suplier->id_suplier ?></td>
		      <td><?php echo $wp_suplier->nama_suplier ?></td>
		      <td><?php echo $wp_suplier->alamat ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>