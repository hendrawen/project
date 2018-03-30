<?php if ($this->session->flashdata('message')): ?>
        <div class="alert bg-primary alert-right">
            <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>
            <span class="text-semibold"><?php echo $this->session->flashdata('message');?></span>
        </div>
        <?php endif; ?>

<div class="x_panel">
      <div class="x_title">
            <h2><i class="fa fa-user"></i> Group List</h2>
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
          <div class="row">
            <div class="col-md-6">

                <a href="<?php echo base_url('users/groups/create'); ?>" type="button" class="btn btn-primary" > <i class="fa fa-plus"></i> Tambah</a>
            </div>
          </div>
            <div class="col-md-6 text-right">
                <div style="margin-top: 8px" id="message">
                    <!-- <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?> -->
                </div>
            </div>
            <!-- table table-striped table-bordered dt-responsive nowrap -->
              <div class="x_content">
                  <table class="table table-striped jambo_table table-bordered dt-responsive nowrap" id="datatable">
                      <thead>
                          <tr>
                              <th>#</th>
                              <th>Id Group</th>
                              <th>Nama Group</th>
                              <th>Deskripsi</th>
                              <th style="text-align:center">Aksi</th>
                          </tr>
                      </thead>
                      <tbody>
                        <?php
                        $no = 1;
                        foreach($groups as $key){ ?>
                       <tr>
                           <td><?php echo $no++ ?></td>
                           <td><?php echo $key->id;?></td>
                           <td><?php echo $key->name;?></td>
                           <td><?php echo $key->description;?></td>
                           <td style="text-align:center">
 <a href="<?=base_url()?>users/groups/update/<?=$key->id?>" class="btn btn-primary btn-xs"><i class="fa fa-folder"></i> Edit</a>
 <a class="btn btn-danger btn-xs" onclick="return swal({
                         title: 'Yakin akan hapus data ini?',
                         text: 'Anda tidak akan melihat data ini lagi!',
                         type: 'warning',
                         showCancelButton: true,
                         confirmButtonColor: '#d9534f',
                            }, function(){
                               window.location.href ='<?=base_url()?>users/groups/delete/<?=$key->id ?>';
                             });"><i class="fa fa-folder"></i> Delete</a>
                           </td>
                      </tr>
                      <?php } ?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>#</th>
                        <th>Id Group</th>
                        <th>Nama Group</th>
                        <th>Deskripsi</th>
                        <th style="text-align:center">Aksi</th>
                      </tr>
                    </tfoot>
                  </table>

          </div>
              <div class="row">
                  <div class="col-md-6">
                      <a></a>
                      <?php //echo anchor(site_url('suplier/excel'), 'Excel', 'class="btn btn-primary"'); ?>
                      <?php //echo anchor(site_url('suplier/word'), 'Word', 'class="btn btn-primary"'); ?>
                </div>
              </div>
            </div>
