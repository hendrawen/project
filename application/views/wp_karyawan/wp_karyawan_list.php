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
        <h2 style="margin-top:0px">Wp_karyawan List</h2>
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <?php echo anchor(site_url('wp_karyawan/create'),'Create', 'class="btn btn-primary"'); ?>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                <form action="<?php echo site_url('wp_karyawan/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('wp_karyawan'); ?>" class="btn btn-default">Reset</a>
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
		<th>Nama</th>
		<th>Alamat</th>
		<th>No Telp</th>
		<th>Photo</th>
		<th>Status</th>
		<th>Wp Jabatan Id</th>
		<th>Action</th>
            </tr><?php
            foreach ($wp_karyawan_data as $wp_karyawan)
            {
                ?>
                <tr>
			<td width="80px"><?php echo ++$start ?></td>
			<td><?php echo $wp_karyawan->nama ?></td>
			<td><?php echo $wp_karyawan->alamat ?></td>
			<td><?php echo $wp_karyawan->no_telp ?></td>
			<td><?php echo $wp_karyawan->photo ?></td>
			<td><?php echo $wp_karyawan->status ?></td>
			<td><?php echo $wp_karyawan->wp_jabatan_id ?></td>
			<td style="text-align:center" width="200px">
				<?php 
				echo anchor(site_url('wp_karyawan/read/'.$wp_karyawan->id_karyawan),'Read'); 
				echo ' | '; 
				echo anchor(site_url('wp_karyawan/update/'.$wp_karyawan->id_karyawan),'Update'); 
				echo ' | '; 
				echo anchor(site_url('wp_karyawan/delete/'.$wp_karyawan->id_karyawan),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
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
		<?php echo anchor(site_url('wp_karyawan/excel'), 'Excel', 'class="btn btn-primary"'); ?>
		<?php echo anchor(site_url('wp_karyawan/word'), 'Word', 'class="btn btn-primary"'); ?>
	    </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>
    </body>
</html>