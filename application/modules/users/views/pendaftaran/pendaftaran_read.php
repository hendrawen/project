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

        <div class="content">
        <div class="panel panel-info">
        <div class="panel-heading">
        <h2 style="margin-top:0px">Pendaftaran Read</h2>
        <table class="table">
	    <tr><td>Nama Lengkap</td><td><?php echo $nama_lengkap; ?></td></tr>
	    <tr><td>Email</td><td><?php echo $email; ?></td></tr>
	    <tr><td>No Telp</td><td><?php echo $no_telp; ?></td></tr>
	    <tr><td>Nama Subdomain</td><td><?php echo $nama_subdomain; ?></td></tr>
	    <tr><td>Paket Layanan</td><td><?php echo $paket_layanan; ?></td></tr>
	    <tr><td>Kota</td><td><?php echo $kota; ?></td></tr>
	    <tr><td>Tgl Entry</td><td><?php echo $tgl_entry; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('users/pendaftaran') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
</div>
</div>
</div>
<?php
$this->load->view('administrator/template/footer');
?>