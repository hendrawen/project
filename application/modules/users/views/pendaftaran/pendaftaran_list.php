<?php
$this->load->view('administrator/template/header');
$this->load->view('administrator/template/navbar');
?>


    <!-- Page container -->
    <div class="page-container">

        <!-- Page content -->
        <div class="page-content">

            <?php
                $this->load->view('administrator/template/sidebar');
            ?>
            <!-- Main content -->
        <div class="content-wrapper">
        <br>
        <div class="page-header">
            <div class="breadcrumb-line breadcrumb-line-component">
                        <ul class="breadcrumb">
                            <li><a href="index.html"><i class="icon-users position-left"></i> Manage User</a></li>
                            <li class="active">Pendaftaran</li>
                        </ul>
            </div>
        </div>
        <br>
                <!-- Content area -->
        <div class="content">
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">

            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                <form action="<?php echo site_url('pendaftaran/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('pendaftaran'); ?>" class="btn btn-default">Reset</a>
                                    <?php
                                }
                            ?>
                          <button class="btn btn-success" type="submit">Search</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
        <div class="panel panel-flat">
            <div class="panel-heading">
                <h5 class="panel-title">List pendaftaran</h5>
                            <div class="heading-elements">
                                <ul class="icons-list">
                                    <li><a data-action="collapse"></a></li>
                                    <li><a data-action="reload"></a></li>
                                </ul>
                            </div>
                        </div>
        <?php echo $this->session->flashdata('message'); ?>
        <div class="table-responsive">
        <table class="table table-togglable table-hover">
        <thead>
        <tr>
            <th>No</th>
            <th data-toggle="true">Nomer Registrasi</th>
    		<th data-hide="phone, tablet: 1024">Nama Lengkap</th>
    		<th data-hide="phone">Email</th>
    		<th data-hide="phone">No Telp</th>
    		<th data-hide="phone">Nama Subdomain</th>
    		<th data-hide="phone">Alamat</th>
    		<th data-hide="phone">Action</th>
        </tr>
        </thead>
        <?php
            foreach ($pendaftaran_data as $pendaftaran)
            {
                ?>
                <tr>
			<td width="80px"><?php echo ++$start ?></td>
            <td><?php echo $pendaftaran->id_pendaftaran ?></td>
			<td><?php echo $pendaftaran->nama_lengkap ?></td>
			<td><?php echo $pendaftaran->email ?></td>
			<td><?php echo $pendaftaran->no_telp ?></td>
			<td><?php echo $pendaftaran->nama_subdomain ?></td>
			<td><?php echo $pendaftaran->kota ?></td>
			<td style="text-align:center" width="200px">
				<?php
				echo anchor(site_url('users/pendaftaran/read/'.$pendaftaran->id_pendaftaran),'Read');
				echo ' | ';
				echo anchor(site_url('users/pendaftaran/delete/'.$pendaftaran->id_pendaftaran),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"');
				?>
			</td>
		</tr>
                <?php
            }
            ?>
        </table>
        </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <a href="#" class="btn btn-success">Total Record : <?php echo $total_rows ?></a>
	    </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>
<?php
    $this->load->view('administrator/template/footer');
?>
