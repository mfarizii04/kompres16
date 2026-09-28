<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('getWaktuLokal')) {
	function getWaktuLokal()
	{

		date_default_timezone_set("Asia/Jakarta");
		$hariAsli = date("l");
		$hari     = [
			"Sunday" 	=> "Minggu",
			"Monday" 	=> "Senin",
			"Tuesday" 	=> "Selasa",
			"Wednesday" => "Rabu",
			"Thursday" 	=> "Kamis",
			"Friday"   	=> "Jum'at",
			"Saturday" 	=> "Sabtu"
		];
		
		$blnAsli = date("M");
		$bln     = [
			"Jan" => "Januari",
			"Feb" => "Februari",
			"Mar" => "Maret",
			"Apr" => "April",
			"May" => "Mei",
			"Jun" => "Juni",
			"Jul" => "Juli",
			"Aug" => "Agustus",
			"Sep" => "September",
			"Oct" => "Oktober",
			"Nov" => "November",
			"Dec" => "Desember"
		];

		return [
            "hari"  => $hari[$hariAsli],
            "tgl"   => date("d"),
            "bln"   => $bln[$blnAsli],
            "thn"   => date("Y"),
            "jam"   => date("H"),
            "menit" => date("i")
        ];

	}
}