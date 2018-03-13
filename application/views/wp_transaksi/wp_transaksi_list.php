<!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            body{
                padding: 15px;
            }
        </style>
    </head>
    <body>
        <h2 style="margin-top:0px">Wp_transaksi List</h2>
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <?php echo anchor(site_url('wp_transaksi/create'),'Create', 'class="btn btn-primary"'); ?>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                <form action="<?php echo site_url('wp_transaksi/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('wp_transaksi'); ?>" class="btn btn-default">Reset</a>
                                    <?php
                                }
                            ?>
                          <button class="btn btn-primary" type="submit">Search</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
        <table class="table table-bordered" style="margin-bottom: 10px">
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
		<th>Action</th>
            </tr><?php
            foreach ($wp_transaksi_data as $wp_transaksi)
            {
                ?>
                <tr>
			<td width="80px"><?php echo ++$start ?></td>
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
			<td style="text-align:center" width="200px">
				<?php 
				echo anchor(site_url('wp_transaksi/read/'.$wp_transaksi->id),'Read'); 
				echo ' | '; 
				echo anchor(site_url('wp_transaksi/update/'.$wp_transaksi->id),'Update'); 
				echo ' | '; 
				echo anchor(site_url('wp_transaksi/delete/'.$wp_transaksi->id),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
				?>
			</td>
		</tr>
                <?php
            }
            ?>
        </table>
        <div class="row">
            <div class="col-md-6">
                <a href="#" class="btn btn-primary">Total Record : <?php echo $total_rows ?></a>
		<?php echo anchor(site_url('wp_transaksi/excel'), 'Excel', 'class="btn btn-primary"'); ?>
		<?php echo anchor(site_url('wp_transaksi/word'), 'Word', 'class="btn btn-primary"'); ?>
	    </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>
    </body>
</html>