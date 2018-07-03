
<?php 
$count['responden'] = 0;
$count['user'] = 0;
$count['retail'] = 0;
$count['qty'] = 0;

foreach ($days as $d):?>
<tr>
    <td><?php echo tgl_indo($d)?></td>
    <?php
        $responden = $this->model->get_count_kategori($d, '4', $id_karyawan);
        $user = $this->model->get_count_kategori($d, '1', $id_karyawan);
        $retail = $this->model->get_count_kategori($d, '2', $id_karyawan);
        $qty = $this->model->get_count_qty($d, $id_karyawan);
        $count['responden'] += $responden;
        $count['user'] += $user;
        $count['retail'] += $retail;
        $count['qty'] += $qty;
        echo '<td>'.angka($responden).'</td>';
        echo '<td>'.angka($user).'</td>';
        echo '<td>'.angka($retail).'</td>';
        echo '<td>'.angka($qty).'</td>';
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