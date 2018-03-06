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
        <h2>Wp_barang List</h2>
        <table class="word-table" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Id Barang</th>
		<th>Nama Barang</th>
		<th>Harga Beli</th>
		<th>Harga Jual</th>
		<th>Wp Suplier Id</th>
		<th>Created At</th>
		<th>Updated At</th>
		
            </tr><?php
            foreach ($wp_barang_data as $wp_barang)
            {
                ?>
                <tr>
		      <td><?php echo ++$start ?></td>
		      <td><?php echo $wp_barang->id_barang ?></td>
		      <td><?php echo $wp_barang->nama_barang ?></td>
		      <td><?php echo $wp_barang->harga_beli ?></td>
		      <td><?php echo $wp_barang->harga_jual ?></td>
		      <td><?php echo $wp_barang->wp_suplier_id ?></td>
		      <td><?php echo $wp_barang->created_at ?></td>
		      <td><?php echo $wp_barang->updated_at ?></td>	
                </tr>
                <?php
            }
            ?>
        </table>
    </body>
</html>