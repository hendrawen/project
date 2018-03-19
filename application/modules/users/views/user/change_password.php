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
        <h6 class="panel-title">Change Password</h6>   </div>
        <div class="panel panel-flat">
        <div class="panel-body">
        <?php echo form_open("users/auth/change_password");?>
         <div class="form-group">
            <label for="varchar">Old Password <?php echo form_error('old_password') ?></label>
            <input type="password" class="form-control" name="old" id="old" placeholder="Insert your old Password" <?php echo form_input($old_password);?> 
        </div>
         <div class="form-group">
            <label for="varchar">New Password <?php echo form_error('new_password') ?></label>
            <input type="password" class="form-control" name="new" id="new" placeholder="insert password" <?php echo form_input($new_password);?> 
        </div>

	   
         <div class="form-group">
            <label for="varchar">Confirm Password <?php echo form_error('new_password_confirm') ?></label>
            <input type="password" class="form-control" name="new_confirm" id="new_confirm" placeholder="Confirm Password" <?php echo form_input($new_password_confirm);?> 
        </div>
       
       
         <div class="text-right">
        <?php echo form_input($user_id);?>
                <!-- Id gambar kita hidden pada input field dimana berfungsi sebagai identitas yang dibawa untuk update -->
	     <a href="<?php echo site_url('users') ?>" class="btn btn-danger"><i class=" icon- icon-cancel-circle2"></i> Cancel</a>
              <button type="submit" value="upload" class="btn btn-success"><i class="icon-floppy-disk"></i> Save</button> 
        </div>
        </div>
        </div>
	<?php echo form_close(); ?>
<?php
$this->load->view('administrator/template/footer');
