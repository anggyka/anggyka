<fieldset>
            <form method="post" name="tsms" action="sms.php">
           		Nama Barang :
                  <p>
<textarea name="sms" id="textarea" cols="45" rows="5"></textarea></p>
</p><input type="submit" name="simpan" value="Simpan">
</form>
</fieldset>
        
<?php 
if (isset($_POST["sms"])) {
	try {
		$msg = $_POST["sms"];
		require_once("./Mesabot.php");
		define("MESABOT_TOKEN", "YblgsQ9EgwJuS4piAfBMm5S9Yl2rZ7HFSaXqcVww");

		$nomor = '+6281255461907'; //coba masukin nomer agan
		$data = [
			'destination' => $nomor,
			'text' => $msg
		];

		$mesabot = new Mesabot();
		$mesabot->sms($data);
		print_r($mesabot->response());
		
	} catch (Exception $e) {
		echo $e->getMessage();
	}
}
?>