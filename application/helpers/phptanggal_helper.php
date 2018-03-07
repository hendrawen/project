<?php

    function getSearchTermToBold($text, $words){
        preg_match_all('~[A-Za-z0-9_äöüÄÖÜ]+~', $words, $m);
        if (!$m)
            return $text;
        $re = '~(' . implode('|', $m[0]) . ')~i';
        return preg_replace($re, '<b style="color:red">$0</b>', $text);
    }

    function tgl_indo($tgl){
            $tanggal = substr($tgl,8,2);
            $bulan = getBulan(substr($tgl,5,2));
            $tahun = substr($tgl,0,4);
            return $tanggal.' '.$bulan.' '.$tahun;
    }

    function tgl_simpan($tgl){
            $tanggal = substr($tgl,0,2);
            $bulan = substr($tgl,3,2);
            $tahun = substr($tgl,6,4);
            return $tahun.'-'.$bulan.'-'.$tanggal;
    }

    function tgl_view($tgl){
            $tanggal = substr($tgl,8,2);
            $bulan = substr($tgl,5,2);
            $tahun = substr($tgl,0,4);
            return $tanggal.'-'.$bulan.'-'.$tahun;
    }

    function tgl_grafik($tgl){
            $tanggal = substr($tgl,8,2);
            $bulan = getBulan(substr($tgl,5,2));
            $tahun = substr($tgl,0,4);
            return $tanggal.'_'.$bulan;
    }

    function generateRandomString($length = 10) {
        return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
    }

    /*function seo_title($s) {
        $c = array (' ');
        $d = array ('-','/','\\',',','.','#',':',';','\'','"','[',']','{','}',')','(','|','`','~','!','@','%','$','^','&','*','=','?','+','–');
        $s = str_replace($d, '', $s); // Hilangkan karakter yang telah disebutkan di array $d
        $s = strtolower(str_replace($c, '-', $s)); // Ganti spasi dengan tanda - dan ubah hurufnya menjadi kecil semua
        return $s;
    }*/

    function hari_ini($w){
        $seminggu = array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu");
        $hari_ini = $seminggu[$w];
        return $hari_ini;
    }

    function getBulan($bln){
                switch ($bln){
                    case 1:
                        return "Januari";
                        break;
                    case 2:
                        return "Februari";
                        break;
                    case 3:
                        return "Maret";
                        break;
                    case 4:
                        return "April";
                        break;
                    case 5:
                        return "Mei";
                        break;
                    case 6:
                        return "Juni";
                        break;
                    case 7:
                        return "Juli";
                        break;
                    case 8:
                        return "Agustus";
                        break;
                    case 9:
                        return "September";
                        break;
                    case 10:
                        return "Oktober";
                        break;
                    case 11:
                        return "November";
                        break;
                    case 12:
                        return "Desember";
                        break;
                }
            }

function cek_terakhir($datetime, $full = false) {
     $today = time();
     $createdday= strtotime($datetime);
     $datediff = abs($today - $createdday);
     $difftext="";
     $years = floor($datediff / (365*60*60*24));
     $months = floor(($datediff - $years * 365*60*60*24) / (30*60*60*24));
     $days = floor(($datediff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
     $hours= floor($datediff/3600);
     $minutes= floor($datediff/60);
     $seconds= floor($datediff);
     //year checker
     if($difftext=="")
     {
       if($years>1)
        $difftext=$years." Tahun";
       elseif($years==1)
        $difftext=$years." Tahun";
     }
     //month checker
     if($difftext=="")
     {
        if($months>1)
        $difftext=$months." Bulan";
        elseif($months==1)
        $difftext=$months." Bulan";
     }
     //month checker
     if($difftext=="")
     {
        if($days>1)
        $difftext=$days." Hari";
        elseif($days==1)
        $difftext=$days." Hari";
     }
     //hour checker
     if($difftext=="")
     {
        if($hours>1)
        $difftext=$hours." Jam";
        elseif($hours==1)
        $difftext=$hours." Jam";
     }
     //minutes checker
     if($difftext=="")
     {
        if($minutes>1)
        $difftext=$minutes." Menit";
        elseif($minutes==1)
        $difftext=$minutes." Menit";
     }
     //seconds checker
     if($difftext=="")
     {
        if($seconds>1)
        $difftext=$seconds." Detik";
        elseif($seconds==1)
        $difftext=$seconds." Detik";
     }
     return $difftext;
    }
