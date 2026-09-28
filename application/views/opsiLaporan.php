
<?php
if ($opsi=="Server") {
	$dbnye="servers";
	$nama="server_id";
} elseif ($opsi=="Akun Server") {
	$nama="acc_id";
} elseif ($opsi=="Sistem Operasi") {
	$dbnye="os";
	$nama="os_id";
} elseif ($opsi=="Database") {
	$dbnye="db";
	$nama="db_id";
}
?>

    <label class="small mb-1" for="pilih<?= $opsi ?>">Pilih <?= $opsi ?></label>
    <select class="form-select" name="<?= $nama ?>" id="pilih<?= $opsi ?>" required>
        <option selected disabled>--- Silahkan pilih <?= $opsi ?> ---</option>
        <?php
        date_default_timezone_set("Asia/Jakarta");
        $tgl = date("Y-m-d H:i:s");

        if ($opsi=="Akun Server") {
        	$sql = $this->db
        		   ->from("accounts")
        		   ->where("expired_at !=", $tgl)
        		   ->get();
        } else {
        	
        	if ($opsi=="Server") {
        		$sql = $this->db->order_by("server_id", "DESC")->get_where($dbnye, ["status" => "Active"]);
        	} else {
        		$sql = $this->db->order_by($dbnye . "_id", "DESC")->get_where($dbnye, ["status" => "Active"]);
        	}

        }

        foreach ($sql->result() as $gb) :
        	if ($opsi=="Server") {
	        	$fetchID   = $gb->server_id;
	        	$fetchData = $gb->server_name;
	        } elseif ($opsi=="Akun Server") {
	        	$fetchID   = $gb->account_id;
	        	$fetchData = $gb->username;
	        } elseif ($opsi=="Sistem Operasi") {
	        	$fetchID   = $gb->os_id;
	        	$fetchData = $gb->os_name;
	        } elseif ($opsi=="Database") {
	        	$fetchID   = $gb->db_id;
	        	$fetchData = $gb->db_name;
	        }
        ?>
        <option value="<?= $fetchID ?>"><?= $fetchData ?></option>
	    <?php endforeach; ?>
    </select>