
        <h2 style="margin-top:0px">Profile</h2>
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <?php echo anchor(site_url('profile/create'),'Create', 'class="btn btn-primary"'); ?>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                <form action="<?php echo site_url('profile/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('profile'); ?>" class="btn btn-default">Reset</a>
                                    <?php
                                }
                            ?>
                          <button class="btn btn-primary" type="submit">Search</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
        <table class="table table-striped table-bordered">
          <thead>
            <tr>
                <th>No</th>
            		<th>Nama Perusahaan</th>
            		<th>Alamat</th>
            		<th>No Telp</th>
            		<th>Email</th>
            		<th>Website</th>
            		<th>Action</th>
            </tr>
          </thead>
            <?php
            foreach ($profile_data as $profile)
            {
                ?>
          <tbody>
            <tr>
              <td width="80px"><?php echo ++$start ?></td>
              <td><?php echo $profile->nama_perusahaan ?></td>
              <td><?php echo $profile->alamat ?></td>
              <td><?php echo $profile->no_telp ?></td>
              <td><?php echo $profile->email ?></td>
              <td><?php echo $profile->website ?></td>
              <td style="text-align:center" width="200px">
                <?php
                echo anchor(site_url('profile/read/'.$profile->id),'Read');
                echo ' | ';
                echo anchor(site_url('profile/update/'.$profile->id),'Update');
                echo ' | ';
                echo anchor(site_url('profile/delete/'.$profile->id),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"');
                ?>
              </td>
          </tr>
          </tbody>
                <?php
            }
            ?>
        </table>
        <div class="row">
            <div class="col-md-6">
                <a href="#" class="btn btn-primary">Total Record : <?php echo $total_rows ?></a>
	    </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>

        <div class="x_panel">
                      <div class="x_title">
                        <h2>Boardered table <small>Bordered table subtitle</small></h2>
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

                        <table class="table table-bordered">
                          <thead>
                            <tr>
                              <th>#</th>
                              <th>First Name</th>
                              <th>Last Name</th>
                              <th>Username</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <th scope="row">1</th>
                              <td>Mark</td>
                              <td>Otto</td>
                              <td>@mdo</td>
                            </tr>
                            <tr>
                              <th scope="row">2</th>
                              <td>Jacob</td>
                              <td>Thornton</td>
                              <td>@fat</td>
                            </tr>
                            <tr>
                              <th scope="row">3</th>
                              <td>Larry</td>
                              <td>the Bird</td>
                              <td>@twitter</td>
                            </tr>
                          </tbody>
                        </table>

                      </div>
                    </div>
