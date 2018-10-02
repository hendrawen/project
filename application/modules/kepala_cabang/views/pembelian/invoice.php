<div class="x_panel">
                  <div class="x_content" style="display: block;">

                    <section class="content invoice">
                      <!-- title row -->
                      <div class="row">
                        <div class="col-xs-12 invoice-header">
                          <h1>
                                          <i class="fa fa-globe"></i> Invoice.
                                      </h1>
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- info row -->
                      <div class="row invoice-info">
                        <div class="col-sm-4 invoice-col">
                          Dari
                          <address>
                            <?php
                                foreach ($profile as $value) {
                                    ?>
                                          <strong><?php echo $value->nama_perusahaan ?></strong>
                                          <br><?php echo $value->alamat ?>
                                          <br>Phone: <?php echo $value->no_telp ?>
                                          <br>Email: <?php echo $value->email ?>
                                          <br>Website: <?php echo $value->website ?>
                                <?php
                                } ?>
                          </address>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                          Ke
                          <address>
                            <?php foreach ($idinvoice as $value): ?>
                              <strong><?php echo $value->nama_pelanggan ?></strong>
                              <br>Nama Dagang : <?php echo $value->nama_dagang ?>
                              <br>Alamat : <?php echo $value->alamat ?>
                              <br>Phone: <?php echo $value->no_telp ?>
                            <?php endforeach; ?>
                          </address>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                          <?php foreach ($idinvoice as $value): ?>
                            <b>ID Transaksi:</b> <?php echo $value->id_transaksi ?>
                            <br>
                            <b>Tanggal Transaksi:</b> <?php echo tgl_indo($value->tgl_transaksi) ?>
                            <br>
                            <b>ID Pelanggan:</b> <?php echo $value->id_pelanggan ?>
                          <?php endforeach; ?>
                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- /.row -->

                      <!-- Table row -->
                      <div class="row">
                        <div class="col-xs-12 table">
                          <table class="table table-bordered table-striped jambo_table bulk_action">
                            <thead>
                              <tr>
                                <th>Nama Barang</th>
                                <th>Qty</th>
                                <th>Satuan</th>
                                <th>Harga (Rp.)</th>
                                <th>Subtotal (Rp.)</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php foreach ($cetak_invoice as $value): ?>
                              <tr>
                                  <td><?php echo $value->nama_barang ?></td>
                                  <td><?php echo $value->qty ?></td>
                                  <td><?php echo $value->satuan ?></td>
                                  <td><?php echo number_format($value->harga,0,'.','.') ?></td>
                                  <td><?php echo number_format($value->subtotal,0,'.','.') ?></td>
                              </tr>
                              <?php endforeach; ?>
                              <tfoot>
                                <tr>
                                  <td colspan="4"><b>Total (Rp.)</b></td>
                                  <td><?php foreach ($total_invoice as $value): ?>
                                    <?php echo number_format($value->total,0,'.','.') ?>
                                  <?php endforeach; ?></td>
                                </tr>
                              </tfoot>
                            </tbody>
                          </table>
                        </div>
                        <!-- /.col -->
                      </div>
                        <!-- /.col -->
                      </div>
                      <!-- /.row -->
                      <div class="row">
                        <!-- accepted payments column -->
                        <div class="col-xs-6">
                          <p><span class="form-group danger">*</span>Ket. </p>
                          <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                            <?php foreach ($status as $key): ?>
                              Jenis pembayaran : <?php echo $key->nama_status; ?>
                            <?php endforeach; ?>
                          </p>
                        </div>
                        <!-- /.col -->
                        <div class="col-xs-6">

                        </div>
                        <!-- /.col -->
                      </div>
                      <!-- this row will not appear when printing -->
                      <div class="row no-print">
                        <div class="col-xs-12">
                          <button class="btn btn-default" onclick="window.print();"><i class="fa fa-print"></i> Print</button>
                          <a href="<?php echo base_url('dep/list') ?>" class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Kembali</a>
                          <button class="btn btn-primary pull-right" style="margin-right: 5px;"><i class="fa fa-download"></i> Generate PDF</button>
                        </div>
                      </div>
                    </section>
                  </div>
                </div>
