<div class="x_panel">
    <div class="x_title">
      <h2><?php echo $button ?> Kategori kas </h2>
      <ul class="nav navbar-right panel_toolbox" style="min-width: 45px;">
        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
        </li>
        <li class="dropdown">
        </li>
        <li><a class="close-link"><i class="fa fa-close"></i></a>
        </li>
      </ul>
      <div class="clearfix"></div>
    </div>
    <div class="x_content">
      <br />
    <?php echo form_open_multipart($action);?>

        <div class="form-group">
              <label for="nama">Nama <?php echo form_error('nama') ?></label>
              <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama Kategori Kas" value="<?php echo $nama; ?>" required/>
          </div>

        <input type="hidden" name="id" value="<?php echo $id; ?>" />
        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> <?php echo $button ?></button>
        <a href="<?php echo site_url('kas/kategorikas') ?>" class="btn btn-danger">Kembali</a>
    </form>
    </div>
  </div>
