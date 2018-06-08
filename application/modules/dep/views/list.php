<div class="x_panel">
                  <div class="x_title">
                    <h2>List Transaki (Harian)</h2>
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
                    <div class="table-responsive">
                      <table class="table table-striped jambo_table bulk_action">
                        <thead>
                          <tr>
                            <th class="column-title">ID Transaki</th>
                            <th class="column-title">Tanggal</th>
                            <th class="column-title">Pelanggan </th>
                            <th class="column-title">Produk </th>
                            <th class="column-title">Qty </th>
                            <th class="column-title">Subtotal (Rp.)</th>
                            <th class="column-title">Ket.</th>
                            <th class="column-title no-link last"><span class="nobr">Aksi</span>
                            </th>
                          </tr>
                        </thead>

                        <tbody>
                          <?php foreach ($list as $key): ?>
                            <tr>
                              <td><a class="btn btn-success btn-xs" href="<?php echo base_url('dep/invoice/'.$key->id_transaksi)  ?>"><?php echo $key->id_transaksi ?></a></td>
                              <td><?php echo tgl_indo($key->tgl_transaksi) ?></td>
                              <td><?php echo $key->id_pelanggan ?></td>
                              <td><?php echo $key->nama_barang ?></td>
                              <td><?php echo $key->qty ?></td>
                              <td><?php echo number_format($key->subtotal,0,'.','.') ?></td>
                              <td><?php echo $key->nama_status ?></td>
                              <td><a href="<?=base_url()?>dep/hapus/<?=$key->id ?>" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a></td>
                            </tr>
                          <?php endforeach; ?>
                        </tbody>
                      </table>
                    </div>


                  </div>
                </div>
