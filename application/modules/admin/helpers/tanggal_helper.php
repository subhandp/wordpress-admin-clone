<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

   function bulan($bln)
        {
            switch ($bln)
            {
                //22
                case 1:
                //23
                    return "Januari";
                //24
                    break;
                //25
                case 2:
                //26
                    return "Februari";
                //27
                    break;
                //28
                case 3:
                //29
                    return "Maret";
                //30
                    break;
                //31
                case 4:
                //32
                    return "April";
                //33
                    break;
                //34
                case 5:
                //35
                    return "Mei";
                //36
                    break;
                //37
                case 6:
                //38
                    return "Juni";
                //39
                    break;
                //40
                case 7:
                //41
                    return "Juli";
                //42
                    break;
                //43
                case 8:
                //44
                    return "Agustus";
                //45
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


       function tgl_indo($data,$batas)
        {
            $waktu=explode(" ", $data);
            $date_data = explode("-",$waktu[0]);
            $date_now=explode("-",date('Y-m-d'));
            $jam_indo=date('g:i a',strtotime($data));

            $tanggal=$date_data[2];
            $tahun=$date_data[0];
            if ($batas) {
                $bulan=substr(bulan($date_data[1]), 0,$batas);
            }
            else{
                $bulan = bulan($date_data[1]);
            }

            $date_now_now= mktime(0, 0, 0, $date_now[1]  , $date_now[2], $date_now[0]);
            $date_now_kemarin= mktime(0, 0, 0, $date_now[1]  , $date_now[2]-1, $date_now[0]);
            $date_data_real= mktime(0, 0, 0, $date_data[1]  , $date_data[2], $date_data[0]);
            
            if ($date_now_now==$date_data_real) {
                $tgl= "Hari ini, ".$jam_indo;
            }
            else if ($date_now_kemarin==$date_data_real) {
                $tgl= "Kemarin, ".$jam_indo;
            }
            else{
                if ($date_now[0]==$date_data[0]) 
                    $tgl= $bulan." ".$tanggal.", ".$jam_indo;
                else
                    $tgl= $bulan." ".$tanggal." ".$tahun.", ".$jam_indo;                
            }

            return $tgl;
        }


        function tgl_native($data){
            $waktu=explode(" ", $data);
            $date_data = explode("-",$waktu[0]);
            $tgl=implode("/", $date_data);
            return $tgl;
        }

 ?>