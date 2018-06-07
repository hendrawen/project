<div class="x_panel">
  <div class="x_title">
    <h2><i class="fa fa-group"></i> Data Kategori</h2>
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
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <?php echo anchor(site_url('setup/kategori/create'),'<i class="fa fa-plus"></i> Create', 'class="btn btn-primary"'); ?>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                
            </div>
        </div>
        <table class="table jambo_table table-striped table-bordered dt-responsive nowrap" id="datatable">
          <thead>
            <tr>
                <th>No</th>
            		<th>Nama Kategori</th>
            		<th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            foreach ($kategori_data as $kategori)
            {
                ?>
                <tr>
            			<td width="80px"><?php echo ++$start ?></td>
            			<td><?php echo $kategori->nama_kategori ?></td>
            			<td style="text-align:center" width="200px">
            				<?php 
                    echo anchor(site_url('setup/kategori/update/'.$kategori->id_kategori), '<button type="button" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Update</button>');
                    echo '&nbsp;';
                    echo anchor(site_url('setup/kategori/delete/'.$kategori->id_kategori),'<button type="button" class="btn btn-danger btn-xs"><i class="fa fa-times"></i> Delete</button>','onclick="javasciprt: return confirm(\'Are You Sure ?\')"');
            				?>
            			</td>
            		</tr>
                <?php
            }
            ?>
          </tbody>
            <tfoot>
              <tr>
                  <th>No</th>
              		<th>Nama Kategori</th>
              		<th>Action</th>
              </tr>
            </tfoot>
        </table>
        
    </div>
    </div>