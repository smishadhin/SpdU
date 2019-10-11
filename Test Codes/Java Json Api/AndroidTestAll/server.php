<?php

$server = "localhost";
$username = "hlqkyuhi_shadhin";
$password = "2603shadhin1994";
$database = "hlqkyuhi_routine";

$con=mysqli_connect($server, $username, $password,$database) or die("<h1>Koneksi Mysql Error : </h1>" . mysqli_error());

@$operasi = $_GET['operasi'];


switch ($operasi) {
    case "view":
        /* Source code untuk Menampilkan Biodata */
		$sql="select * from tabel_biodata";

        $query_tampil_biodata = mysqli_query($con,$sql);
        $data_array = array();
        while ($data = mysqli_fetch_assoc($query_tampil_biodata)) {
            $data_array[] = $data;
        }
        echo json_encode($data_array);

        //print json_encode($data_array);
        //[{"id":"1","nama":"Jhohannes H Purba","alamat":"Kabanjahe"},{"id":"2","nama":"Berkat Junaidi Banurea","Alamat":"Sidikalang"},{"id":"3","nama":"Totok BluesMan Silalahi","Alamat":"Medan"}]

        break;
    case "insert":
        /* Source code untuk Insert data */
        @$nama = $_GET['nama'];
        @$alamat = $_GET['alamat'];
		
		$sql="INSERT INTO tabel_biodata (nama, alamat) VALUES('$nama', '$alamat')";
		
        $query_insert_data = mysqli_query($con,$sql);
        if ($query_insert_data) {
            echo "Data Berhasil Disimpan";
        } else {
            echo "Error Inser Biodata " . mysqli_error();
        }

        break;
    case "get_biodata_by_id":
        /* Source code untuk Edit data dan mengirim data berdasarkan id yang diminta */
        @$id = $_GET['id'];
		$sql="SELECT * FROM tabel_biodata WHERE id='$id'";
		
        $query_tampil_biodata = mysqli_query($con,$sql);
        $data_array = array();
        $data_array = mysqli_fetch_assoc($query_tampil_biodata);
        echo "[" . json_encode($data_array) . "]";


        break;
    case "update":
        /* Source code untuk Update Biodata */
        @$nama = $_GET['nama'];
        @$alamat = $_GET['alamat'];
        @$id = $_GET['id'];
		$sql="UPDATE tabel_biodata SET nama='$nama', alamat='$alamat' WHERE id='$id'";
        $query_update_biodata = mysqli_query($con,$sql);
        if ($query_update_biodata) {
            echo "Update Data Berhasil";
        } else {
            echo mysqli_error();
        }
        break;
    case "delete":
        /* Source code untuk Delete Biodata */
        @$id = $_GET['id'];
		$sql="DELETE FROM tabel_biodata WHERE id='$id'";
        $query_delete_biodata = mysqli_query($con,$sql);
        if ($query_delete_biodata) {
            echo "Delete Data Berhasil";
        } else {
            echo mysqli_error();
        }

        break;

    default:
        break;
}
?>