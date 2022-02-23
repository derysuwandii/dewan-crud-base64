<h3 align="center" class="bg-success pb-1 pt-1 text-white">Data Setelah Di Decoding dengan Base64</h3>
<table class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <td>No</td>
            <td>Nama Mahasiswa</td>
            <td>Alamat</td>
            <td>Jurusan</td>
            <td>Jenis Kelamin</td>
            <td>Tanggal Masuk</td>
            <td>Action</td>
        </tr>
    </thead>
    <tbody>
        <?php
            include 'koneksi.php';
            $s_jurusan="";
            $s_nama_mahasiswa="";
            if (isset($_POST['jurusan'])) {
                $s_jurusan = $_POST['jurusan'];
                $s_nama_mahasiswa = $_POST['nama_mahasiswa'];
            }
            $no = 1;
            $search_jurusan = '%'. $s_jurusan .'%';
            $search_nama_mahasiswa = '%'. $s_nama_mahasiswa .'%';

            $query = "SELECT * FROM tbl_mahasiswa_base64 WHERE
                        CONVERT ( from_base64 ( jurusan ) USING utf8mb4 ) LIKE ? 
                        AND (
                            CONVERT ( from_base64 ( nama_mahasiswa ) USING utf8mb4 ) LIKE ? 
                            OR CONVERT ( from_base64 ( alamat ) USING utf8mb4 ) LIKE ? 
                            OR CONVERT ( from_base64 ( jurusan ) USING utf8mb4 ) LIKE ? 
                            OR CONVERT ( from_base64 ( jenis_kelamin ) USING utf8mb4 ) LIKE ? 
                            OR CONVERT ( from_base64 ( tgl_masuk ) USING utf8mb4 ) LIKE ? 
                        ) ORDER BY id DESC";
            $dewan1 = $db1->prepare($query);
            $dewan1->bind_param('ssssss', $search_jurusan, $search_nama_mahasiswa, $search_nama_mahasiswa, $search_nama_mahasiswa, $search_nama_mahasiswa, $search_nama_mahasiswa);
            $dewan1->execute();
            $res1 = $dewan1->get_result();

            if ($res1->num_rows > 0) {
                while ($row = $res1->fetch_assoc()) {
                    $id = $row['id'];
                    $nama_mahasiswa = $row['nama_mahasiswa'];
                    $alamat = $row['alamat'];
                    $jurusan = $row['jurusan'];
                    $jenis_kelamin = $row['jenis_kelamin'];
                    $tgl_masuk = $row['tgl_masuk'];
        ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo base64_decode($nama_mahasiswa); ?></td>
                <td><?php echo base64_decode($alamat); ?></td>
                <td><?php echo base64_decode($jurusan); ?></td>
                <td><?php echo base64_decode($jenis_kelamin); ?></td>
                <td><?php echo base64_decode($tgl_masuk); ?></td>
                <td>
                    <button id="<?php echo $id; ?>" class="btn btn-success btn-sm edit_data"> <i class="fa fa-edit"></i> Edit </button>
                    <button id="<?php echo $id; ?>" class="btn btn-danger btn-sm hapus_data"> <i class="fa fa-trash"></i> Hapus </button>
                </td>
            </tr>
        <?php } } else { ?> 
            <tr>
                <td colspan='7'>Tidak ada data ditemukan</td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<h3 align="center" class="bg-danger pb-1 pt-1 text-white">Data Asli Yang Tersimpan di Database</h3>
<table class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <td>No</td>
            <td>Nama Mahasiswa</td>
            <td>Alamat</td>
            <td>Jurusan</td>
            <td>Jenis Kelamin</td>
            <td>Tanggal Masuk</td>
        </tr>
    </thead>
    <tbody>
        <?php
            $no = 1;
            $query = "SELECT * FROM tbl_mahasiswa_base64 WHERE LOWER(from_base64(jurusan)) LIKE '%$s_jurusan%' AND from_base64(nama_mahasiswa) LIKE '%$s_nama_mahasiswa%' ORDER BY id DESC";
            $dewan1 = $db1->prepare($query);
            $dewan1->execute();
            $res1 = $dewan1->get_result();

            if ($res1->num_rows > 0) {
                while ($row = $res1->fetch_assoc()) {
                    $id = $row['id'];
                    $nama_mahasiswa = $row['nama_mahasiswa'];
                    $alamat = $row['alamat'];
                    $jurusan = $row['jurusan'];
                    $jenis_kelamin = $row['jenis_kelamin'];
                    $tgl_masuk = $row['tgl_masuk'];
        ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $nama_mahasiswa; ?></td>
                <td><?php echo $alamat; ?></td>
                <td><?php echo $jurusan; ?></td>
                <td><?php echo $jenis_kelamin; ?></td>
                <td><?php echo $tgl_masuk; ?></td>
            </tr>
        <?php } } else { ?> 
            <tr>
                <td colspan='7'>Tidak ada data ditemukan</td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<?php $db1->close(); ?>

<script type="text/javascript">
    function reset(){
        document.getElementById("err_nama_mahasiswa").innerHTML = "";
        document.getElementById("err_alamat").innerHTML = "";
        document.getElementById("err_jurusan").innerHTML = "";
        document.getElementById("err_tanggal_masuk").innerHTML = "";
        document.getElementById("err_jenkel").innerHTML = "";
    }

    $(document).on('click', '.edit_data', function(){
        let id = $(this).attr('id');
        $.ajax({
            type: 'POST',
            url: "get_data.php",
            data: {id:id},
            dataType:'json',
            success: function(response) {
                console.log(response)
                reset();
                document.getElementById("id").value = response.id;
                document.getElementById("nama_mahasiswa").value = response.nama_mahasiswa;
                document.getElementById("tanggal_masuk").value = response.tgl_masuk;
                document.getElementById("alamat").value = response.alamat;
                document.getElementById("jurusan").value = response.jurusan;
                if (response.jenis_kelamin=="Laki-laki") {
                    document.getElementById("jenkel1").checked = true;
                } else {
                    document.getElementById("jenkel2").checked = true;
                }
                
            }, error: function(response){
                console.log(response.responseText);
            }
        });
    });

    $(document).on('click', '.hapus_data', function(){
        var id = $(this).attr('id');
        $.ajax({
            type: 'POST',
            url: "hapus_data.php",
            data: {id:id},
            success: function() {
                $('.data').load("data.php");
            }, error: function(response){
                console.log(response.responseText);
            }
        });
    });
</script>