              <div class="x_panel">
                  <div class="x_title">
                    <h5>ID Pelanggan : <?php echo $this->uri->segment(3); ?></h5>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <table class="table table-striped jambo_table">
                      <thead>
                        <tr>
                          <th>Nama Barang</th>
                          <th>Qty</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($detail as $key): ?>
                          <tr>
                            <td><?php echo $key->nama_barang ?></td>
                            <td><?php echo $key->qty ?></td>
                          </tr>
                        <?php endforeach; ?>
                      </tbody>
                    </table>
                  </div>
                </div>
            <div class="form-group text-right">
              <a class="btn btn-success" href="<?php echo base_url('debt'); ?>">Kembali</a>
            </div>
