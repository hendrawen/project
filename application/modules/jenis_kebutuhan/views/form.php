<div class="x_panel">
  <div class="x_title">
    <h2>Form <?php echo $button ?> Jenis</h2>
    <ul class="nav navbar-right panel_toolbox">
      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
      </li>
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
        <ul class="dropdown-menu" role="menu">
          <li><a href="#">Settings 1</a>
          </li>
          <li><a href="#">Settings 2</a>
          </li>
        </ul>
      </li>
      <li><a class="close-link"><i class="fa fa-close"></i></a>
      </li>
    </ul>
    <div class="clearfix"></div>
  </div>
  <div class="x_content">
    <br>
      <form action="<?php echo $action; ?>" method="post">
      <div class="form-group">
          <label for="varchar">Jenis <?php echo form_error('jenis') ?></label>
          <input type="text" class="form-control" name="jenis" id="jenis" placeholder="Jenis" value="<?php echo $jenis; ?>" />
      </div>
      <input type="hidden" value="<?php echo $id; ?>" name="id"/>
      <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>">
      <div class="text-right">
        <a href="<?php echo base_url('jenis_kebutuhan')?>" type="button" class="btn btn-default" >Kembali</a>
        <button type="submit" class="btn btn-success"><?php echo $button ?></button>
      </div>
      </form>
    </div>
  </div>
