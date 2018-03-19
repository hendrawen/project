<div class="x_panel">
    <div class="x_title">
      <h2>Suspended User </h2>
      <ul class="nav navbar-right panel_toolbox" style="min-width: 45px;">
        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
        </li>
        <li class="dropdown">
        <!--   <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="#">Settings 1</a>
            </li>
            <li><a href="#">Settings 2</a>
            </li>
          </ul> -->
        </li>
        <li><a class="close-link"><i class="fa fa-close"></i></a>
        </li>
      </ul>
      <div class="clearfix"></div>
    </div>
    <div class="x_content">
      <br />
		<p><?php echo sprintf(lang('deactivate_subheading'), $user->username);?></p>

		<?php echo form_open("users/auth/deactivate/".$user->id);?>

		  <p>
		  	<?php echo lang('deactivate_confirm_y_label', 'confirm');?>
		    <input type="radio" name="confirm" value="yes" checked="checked" />
		    <?php echo lang('deactivate_confirm_n_label', 'confirm');?>
		    <input type="radio" name="confirm" value="no" />
		  </p>

		  <?php echo form_hidden($csrf); ?>
		  <?php echo form_hidden(array('id'=>$user->id)); ?>

		  <p><?php echo form_submit('submit', lang('deactivate_submit_btn'),'class="btn btn-primary"');?></p>

		<?php echo form_close();?>

  </div>
  </div>
