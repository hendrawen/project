        
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Chart Js <small>Some examples to get you started</small></h3>
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Go!</button>
                    </span>
                  </div>
                </div>
              </div>
            </div>

            <div class="clearfix"></div>
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
              <div class="x_title">
                  <h2>Pembayaran<small>Chart</small>
                  </h2>
                  <div class="nav navbar-right panel_toolbox">
                      <select class="form-control" name="tahun-pembayaran" id="tahun-pembayaran">
                          <?php for ($tahun=(date('Y')-5); $tahun <= date('Y'); $tahun++) {
                      echo '<option selected value="'.$tahun.'">'.$tahun.'</option>';
                      } ?>
                      </select>
                  </div>
                  <div class="clearfix"></div>
              </div>
              <div class="x_content">
                  <canvas id="pembayaran_chart" width="300" height="75"></canvas>
              </div>
            </div>
          </div>
        </div>

        