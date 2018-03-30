<?php if ($this->session->flashdata('activate_unsuccessful')): ?>
        <div class="alert bg-primary alert-right">
            <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>
            <span class="text-semibold"><?php echo $this->session->flashdata('activate_unsuccessful');?></span>
        </div>
        <?php endif; ?>

<?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>

<div class="x_panel">
      <div class="x_title">
            <h2><i class="fa fa-user"></i> User List</h2>
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

                <a href="<?php echo base_url('users/create'); ?>" type="button" class="btn btn-primary" > <i class="fa fa-plus"></i> Tambah</a>
            </div>
          </div>
            <div class="col-md-6 text-right">
                <div style="margin-top: 8px" id="message">
                    <!-- <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?> -->
                </div>
            </div>
            <!-- table table-striped table-bordered dt-responsive nowrap -->
              <div class="x_content">
                  <table class="table jambo_table table-striped table-bordered dt-responsive nowrap" id="datatable">
                      <thead>
                          <tr>
                              <th>#</th>
                              <th>First Name</th>
                              <th>Last Name</th>
                              <th>Username</th>
                              <th>Company</th>
                              <th>Email</th>
                              <th>Phone</th>
                              <th>Status</th>
                              <th style="text-align:center">Aksi</th>
                          </tr>
                      </thead>
                      <tbody>
                        <?php
                        $no = 1;
                        foreach($users as $key){ ?>
                       <tr>
                           <td><?php echo $no++ ?></td>
                           <td><?php echo $key->first_name;?></td>
                           <td><?php echo $key->last_name;?></td>
                           <td><?php echo $key->username;?></td>
                           <td><?php echo $key->company;?></td>
                           <td><?php echo $key->email;?></td>
                           <td><?php echo $key->phone;?></td>
                           <td><?php echo $key->active;?></td>
                           <td style="text-align:center">
 <a href="<?=base_url()?>users/auth/edit_user/<?=$key->id?>" class="btn btn-primary btn-xs"><i class="fa fa-folder"></i> Edit</a>
 <a href="<?=base_url()?>users/auth/activate/<?=$key->id?>" class="btn btn-success btn-xs"><i class="fa fa-folder"></i> Activate</a>
 <a href="<?=base_url()?>users/auth/deactivate/<?=$key->id?>" class="btn btn-warning btn-xs"><i class="fa fa-folder"></i> Deactivate</a>
 <a class="btn btn-danger btn-xs" onclick="return swal({
                         title: 'Yakin akan hapus data ini?',
                         text: 'Anda tidak akan melihat data ini lagi!',
                         type: 'warning',
                         showCancelButton: true,
                         confirmButtonColor: '#d9534f',
                            }, function(){
                               window.location.href ='<?=base_url()?>users/auth/delete/<?=$key->id ?>';
                             });"><i class="fa fa-folder"></i> Delete</a>
                          <!-- <div class="btn-group">
                          <button type="button" class="btn btn-theme03">Action</button>
                          <button type="button" class="btn btn-theme03 dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                            <span class="sr-only">Toggle Dropdown</span>
                          </button>
                          <ul class="dropdown-menu" role="menu">
                            <li><a href="<?php echo base_url('users/auth/edit_user/'.$key->id);?>">Edit</a></li>
                            <li><a href="<?php echo base_url('users/auth/activate/'.$key->id);?>">Active</a></li>
                            <li><a href="<?php echo base_url('users/auth/deactivate/'.$key->id);?>">Deactive</a></li>
                            <li>
                              <a onclick="return swal({
                                                      title: 'Yakin akan hapus data ini?',
                                                      text: 'Anda tidak akan melihat data ini lagi!',
                                                      type: 'warning',
                                                      showCancelButton: true,
                                                      confirmButtonColor: '#d9534f',
                                                         }, function(){
                                                            window.location.href ='<?php echo base_url('users/auth/delete/'.$key->id);?>';
                                                          });">Delete</a>
                            </li>
                          </ul>
                        </div> -->


                           </td>
                      </tr>
                      <?php } ?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>#</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Username</th>
                        <th>Company</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Status</th>
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
