<?php
//Membuat Token Keamanan Ajax Request (Csrf Token)
session_start();
if (empty($_SESSION['csrf_token'])) {
  $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
include 'koneksi.php';
?>

<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />    
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <link rel="icon" href="dk.png">
	<title>Crud PHP &amp; MySQLi - www.dewankomputer.com</title>
	<!-- Csrf Token -->
	<meta name="csrf-token" content="<?= $_SESSION['csrf_token'] ?>">
	<!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="css/font-awesome.min.css">
</head>
<body>
	<nav class="navbar navbar-dark bg-primary">
	  <a class="navbar-brand" href="index.php" style="color: #fff;">
	    Dewan Komputer
	  </a>
	</nav>
	
	<div class="container">
		<h2 align="center" style="margin: 30px;">CRUD Ajax Encoding / Decoding Base64</h2>

        <form method="post" class="form-data" id="form-data">  
        	<div class="row">
        		<div class="col-sm-3">
        			<div class="form-group">
						<label>Nama Mahasiswa</label>
						<input type="hidden" name="id" id="id">
						<input type="text" name="nama_mahasiswa" id="nama_mahasiswa" class="form-control" required="true">
						<p class="text-danger" id="err_nama_mahasiswa"></p>
					</div>
        		</div>
	            <div class="col-sm-3">
	            	<div class="form-group">
						<label>Jurusan</label>
						<select name="jurusan" id="jurusan" class="form-control" required="true">
							<option value=""></option>
							<option value="Sistem Informasi">Sistem Informasi</option>
							<option value="Teknik Informatika">Teknik Informatika</option>
						</select>
						<p class="text-danger" id="err_jurusan"></p>
					</div>
	            </div>
	            <div class="col-sm-3">
	            	<div class="form-group">
						<label>Tanggal Masuk</label>
						<input type="date" name="tanggal_masuk" id="tanggal_masuk" class="form-control" required="true">
						<p class="text-danger" id="err_tanggal_masuk"></p>
					</div>
	            </div>
	            <div class="col-sm-3">
	            	<div class="form-group">
						<label>Jenis Kelamin</label><br>
						<input type="radio" name="jenkel" id="jenkel1" value="Laki-laki" required="true"> Laki-laki
						<input type="radio" name="jenkel" id="jenkel2" value="Perempuan"> Perempuan
					</div>
					<p class="text-danger" id="err_jenkel"></p>
	            </div>
			</div>
			
			<div class="form-group">
				<label>Alamat</label>
				<textarea name="alamat" id="alamat" class="form-control" required="true"></textarea>
				<p class="text-danger" id="err_alamat"></p>
			</div>
			
			<div class="form-group">
				<button type="button" name="simpan" id="simpan" class="btn btn-primary">
					<i class="fa fa-save"></i> Simpan
				</button>
			</div>
        </form>
        <hr>

        <div class="row mb-3">
		    <div class="col-sm-12"><h4>Cari</h4></div>
		    <div class="col-sm-3">
		        <div class="form-group form-inline">
		            <label>Jurusan</label>
		            <select name="s_jurusan" id="s_jurusan" class="form-control">
		                <option value=""></option>
		                <option value="Sistem Informasi">Sistem Informasi</option>
		                <option value="Teknik Informatika">Teknik Informatika</option>
		            </select>
		        </div>
		    </div>
		    <div class="col-sm-4">
		        <div class="form-group form-inline">
		            <label>Keyword</label>
		            <input type="text" name="s_keyword" id="s_keyword" class="form-control">
		        </div>
		    </div>
		    <div class="col-sm-4">
		        <button id="search" name="search" class="btn btn-warning"><i class="fa fa-search"></i> Cari</button>
		    </div>
		</div>

		<div class="data"></div>
		
    </div>

    <div class="text-center">© <?php echo date('Y'); ?> Copyright:
	    <a href="https://dewankomputer.com/"> Dewan Komputer</a>
	</div>

    <script src="js/jquery.min.js"></script>
  	<script src="js/bootstrap.min.js"></script>
	<script type="text/javascript">
	$(document).ready(function(){
		//Mengirimkan Token Keamanan
		$.ajaxSetup({
            headers : {
                'Csrf-Token': $('meta[name="csrf-token"]').attr('content')
            }
        });

	    $('.data').load("data.php");
	    $("#search").click(function(){
	    	var jurusan = $("#s_jurusan").val();
	    	var nama_mahasiswa = $("#s_keyword").val();
	    	$.ajax({
	            type: 'POST',
	            url: "data.php",
	            data: {jurusan: jurusan, nama_mahasiswa:nama_mahasiswa},
	            success: function(msg) {
	            	console.log(msg)
	                $('.data').html(msg);
	            }, error: function(response){
	            	console.log(response.responseText);
	            }
	        });
	    });

	    $("#simpan").click(function(){
	        var data = $('.form-data').serialize();
	        var jenkel1 = document.getElementById("jenkel1").value;
	        var jenkel2 = document.getElementById("jenkel2").value;
            var nama_mahasiswa = document.getElementById("nama_mahasiswa").value;
            var tanggal_masuk = document.getElementById("tanggal_masuk").value;
            var alamat = document.getElementById("alamat").value;
            var jurusan = document.getElementById("jurusan").value;

            if (nama_mahasiswa=="") {
            	document.getElementById("err_nama_mahasiswa").innerHTML = "Nama Mahasiswa Harus Diisi";
            } else {
            	document.getElementById("err_nama_mahasiswa").innerHTML = "";
            }
            if (alamat=="") {
            	document.getElementById("err_alamat").innerHTML = "Alamat Mahasiswa Harus Diisi";
            } else {
            	document.getElementById("err_alamat").innerHTML = "";
            }
            if (jurusan=="") {
            	document.getElementById("err_jurusan").innerHTML = "Jurusan Mahasiswa Harus Diisi";
            } else {
            	document.getElementById("err_jurusan").innerHTML = "";
            }
            if (tanggal_masuk=="") {
            	document.getElementById("err_tanggal_masuk").innerHTML = "Tanggal Masuk Mahasiswa Harus Diisi";
            } else {
            	document.getElementById("err_tanggal_masuk").innerHTML = "";
            }
            if (document.getElementById("jenkel1").checked==false && document.getElementById("jenkel2").checked==false) {
            	document.getElementById("err_jenkel").innerHTML = "Jenis Kelamin Harus Dipilih";
            } else {
            	document.getElementById("err_jenkel").innerHTML = "";
            }

            if (nama_mahasiswa!="" && tanggal_masuk!=""  && alamat!=""  && jurusan!=""  && (document.getElementById("jenkel1").checked==true || document.getElementById("jenkel2").checked==true)) {
            	$.ajax({
		            type: 'POST',
		            url: "form_action.php",
		            data: data,
		            success: function() {
		                $('.data').load("data.php");
		                document.getElementById("id").value = "";
		                document.getElementById("form-data").reset();
		            }, error: function(response){
		            	console.log(response.responseText);
		            }
		        });
            }
	    });
	});
	</script>
</body>
</html>