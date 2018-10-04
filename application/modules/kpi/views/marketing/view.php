
<?php 
$count['responden'] = 0;
$count['user'] = 0;
$count['retail'] = 0;
$count['qty'] = 0;

foreach ($days as $d):?>
<tr>
    <td><?php echo tgl_indo($d)?></td>
    <?php
        $responden = $this->model->get_kategori($d, $id_karyawan, 0);
        $retail = $this->model->get_kategori($d, $id_karyawan, 1);
        $user = $this->model->get_kategori($d, $id_karyawan, 4);
        $qty = $this->model->get_count_qty($d, $id_karyawan);
        $tgl_kirim = $this->model->get_tgl_kirim($d, $id_karyawan);

        $terkirim = $this->model->get_terkirim($d, $id_karyawan);
        $pending = $qty - $terkirim;
        if ($pending < 0) {
            $pending = 0;
        }
        $count['responden'] += $responden;
        $count['user'] += $user;
        $count['retail'] += $retail;
        $count['qty'] += $qty;
        echo '<td>'.angka($responden).'</td>';
        echo '<td>'.angka($user).'</td>';
        echo '<td>'.angka($retail).'</td>';
        echo '<td>'.angka($qty).'</td>';
        echo '<td>'.tgl_indo($tgl_kirim['tgl_kirim']).'</td>';
        echo '<td>'.angka($terkirim).'</td>';
        echo '<td>'.angka($pending).'</td>';
        echo '<td>'.$tgl_kirim['keterangan'].'</td>';
    ?>
</tr>
<?php endforeach?>
<tr>
    <th>Jumlah</th>
    <?php
        echo "
        <th>".angka($count['responden'])."</th>
        <th>".angka($count['user'])."</th>
        <th>".angka($count['retail'])."</th>
        <th>".angka($count['qty'])."</th>
        ";
        
    ?>

</tr>
