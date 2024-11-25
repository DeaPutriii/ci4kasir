<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pelanggan</title>

    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>">
    <!-- <link rel="stylesheet" href="<?= base_url('assets/fontawesome-free-6.0.0-web/fontawesome-free-6.6.0-web/css/fontawesome.css') ?>"> -->
</head>
 
<body>
    <div class="container"> 
        <div class="row mt-3">
            <div class="col-12">
                <h3 class="text-center">Data Pelanggan</h3>
                <button type="button" class="btn btn-success float-end" data-bs-toggle="modal" data-bs-target="#modalTambahPelanggan"><i class="fa-solid fa-cart-plus"></i> Tambah Data</button>
            </div> 
        </div>

        <div class="row">
            <div class="col-12">
                <div class="container mt-5">
                    <table class="table table-bordered" id="pelangganTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Pelanggan</th>
                                <th>Alamat</th>
                                <th>Nomor Telepon</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Data akan dimasukkan melalui AJAX -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Modal Tambah Produk -->
        <div class="modal fade" id="modalTambahPelanggan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalTambahPelanggan" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-secondary text-white">
                        <h1 class="modal-title fs-5" data-bs-toggle="modal" data-bs-target="#modalTambahPelanggan">Tambah Pelanggan</h1>
                        <button type="button" class="btn btn-success float-end" data-bs-toggle="modal" data-bs-target="#modalTambahPelanggan">X</button>
                    </div>
                    <div class="modal-body">
                        <form id="formPelanggan">
                            <div class="row mb-3">
                                <label for="nama_pelanggan" class="col-sm-4 col-form-label">Nama Pelanggan</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="nama_pelanggan" name="nama_pelanggan">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="alamat" class="col-sm-4 col-form-label">Alamat</label>
                                <div class="col-sm-8">
                                    <input type="text" step="0.01" class="form-control" id="alamat">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="nomor_telepon" class="col-sm-4 col-form-label">Nomor Telepon</label>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control" id="nomor_telepon">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="simpanPelanggan" class="btn btn-secondary float-end">Simpan</button>
                    </div>
                </div>
            </div>
        </div>     
    </div>

    <div class="modal fade" id="modalEditPelanggan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalEditPelanggan" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-secondary text-white">
                <h1 class="modal-title fs-5" id="modalEditPelanggan">Edit Pelanggan</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formPelanggan">
                    <div class="row mb-3">
                        <label for="namaPelangganEdit" class="col-sm-4 col-form-label">Nama Pelanggan</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="namaPelangganEdit" name="namaPelanggan">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="alamatPelangganEdit" class="col-sm-4 col-form-label">Alamat</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="alamatPelangganEdit">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="nomorTeleponPelangganEdit" class="col-sm-4 col-form-label">Nomor Telepon</label>
                        <div class="col-sm-8">
                            <input type="number" class="form-control" id="nomorTeleponPelangganEdit">
                        </div>
                    </div>
                    <button type="button" class="btn btn-secondary" id="editPelangganSimpan">Simpan Perubahan</button>
                </form>
            </div>
        </div> 
    </div>
</div>


    <script src="<?= base_url("assets/jquery.min.js") ?>"></script>
    <script src="<?= base_url("assets/js/bootstrap.min.js") ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(document).ready(function(){
        // Fungsi untuk menampilkan pelanggan
        function tampilPelanggan() {
                $.ajax({
                    url: '<?=base_url('pelanggan/tampil') ?>',
                    type: 'GET',
                    dataType: 'json',
                    success: function(hasil) {
                        if (hasil.status === 'success') {
                            var pelangganTable = $('#pelangganTable tbody');
                            pelangganTable.empty();

                            var pelanggan = hasil.pelanggan;
                            var no = 1;

                            pelanggan.forEach(function(item) {
                                var row = '<tr>' +
                                    '<td>' + no + '</td>' +
                                    '<td>' + item.nama_pelanggan + '</td>' +
                                    '<td>' + item.alamat + '</td>' +
                                    '<td>' + item.nomor_telepon + '</td>' +
                                    '<td>' +
                                        '<button class="btn btn-warning btn-sm editPelanggan" data-id="' + item.id_pelanggan + '" data-bs-toggle="modal" data-bs-target="#modalEditPelanggan"><i class="fa-solid fa-pencil"></i> Edit</button> ' +
                                        '<button class="btn btn-danger btn-sm hapusPelanggan" data-id="' + item.id_pelanggan + '"><i class="fa-solid fa-trash-can"></i> Hapus</button> ' +
                                    '</td>' +
                                '</tr>';
                                pelangganTable.append(row);
                                no++;
                            });
                        } else {
                            alert('Gagal mengambil data.');
                        }
                    },
                    error: function(xhr, status, error) {
                        alert('Terjadi kesalahan: ' + error);
                    }
                });
            }

            // Panggil fungsi tampil pelanggan untuk menampilkan data produk saat halaman pertama kali dimuat
            tampilPelanggan();

            // Simpan data produk baru
            $('#simpanPelanggan').on("click", function(){
                var formData = {
                    nama_pelanggan: $('#nama_pelanggan').val(),
                    alamat: $('#alamat').val(),
                    nomor_telepon: $('#nomor_telepon').val()
                };

                $.ajax({
                    url: '<?=base_url('pelanggan/simpan');?>',
                    type: 'POST',
                    data: formData,
                    dataType: 'json',
                    success: function(hasil){
                        if(hasil.status === 'success'){
                            $("#modalTambahPelanggan").modal("hide");
                            $("#formPelanggan")[0].reset();
                            tampilPelanggan() 
                            Swal.fire({
                                title: "PRODUK BERHASIL DI TAMBAHKAN",
                                icon: "success"
                            });
                        } else {
                            alert('Gagal menyimpan data: ' + JSON.stringfy(hasil.errors));
                        }
                    },
                    error: function(xhr, status, error) {
                        alert('Terjadi kesalahan: ' + error);
                    }
                });
            });

            $(document).ready(function() {
                function tampilPelanggan() {
                    $.ajax({
                        url: '<?= base_url('pelanggan/tampil') ?>',
                        type: 'GET',
                        dataType: 'json',
                        success: function(response) {
                            if (response.status === 'success') {
                                var pelangganTable = $('#pelangganTable tbody');
                                pelangganTable.empty();
                            }
                        }
                    })
                }
            })
        

        // Fungsi untuk menghapus data pelanggan
        $('#pelangganTable').on('click', '.hapusPelanggan', function() {
            var pelangganId = $(this).data('id');
            var konfirmasi = confirm("Apakah Anda yakin ingin menghapus pelanggan ini?");

            if (konfirmasi) {
                $.ajax({
                    url: '<?= base_url('pelanggan/hapus'); ?>/' + pelangganId,
                    type: 'DELETE',
                    dataType: 'json',
                    success: function(hasil) {
                        tampilPelanggan();
                        Swal.fire({
                        title: "DATA PELANGGAN BERHASIL DI HAPUS!",
                        icon: "success"
                        });
                    },
                    error: function(xhr, status, error) {
                        alert('Terjadi kesalahan: ' + error);
                    }
                });
            }
        });

        // Fungsi untuk mengedit data pelanggan
        $('#pelangganTable').on('click', '.editPelanggan', function() {
            var row = $(this).closest('tr');
            // Pastikan id yang digunakan sesuai dengan yang ada di modal
            $('#namaPelangganEdit').val(row.find('td:eq(1)').text());
            $('#alamatPelangganEdit').val(row.find('td:eq(2)').text());
            $('#nomorTeleponPelangganEdit').val(row.find('td:eq(3)').text());                
            
            var id = $(this).data('id');
            $('#editPelangganSimpan').off('click').on('click', function() {
                var formData = {
                    'id_pelanggan': id,
                    'nama_pelanggan': $('#namaPelangganEdit').val(),
                    'alamat': $('#alamatPelangganEdit').val(),
                    'nomor_telepon': $('#nomorTeleponPelangganEdit').val()
                }

                if (confirm('Apakah anda yakin ingin edit data pelanggan ini?')) {
                    $.ajax({
                        url: '<?= base_url('pelanggan/updatePelanggan') ?>',
                        type: 'POST',
                        dataType: 'json',
                        data: formData,
                        success: function(response) {
                            $("#modalEditPelanggan").modal('hide');
                            tampilPelanggan(); // Refresh table
                            Swal.fire({
                                title: "DATA PELANGGAN BERHASIL DI UBAH!",
                                icon: "success"
                            });
                        },
                        error: function(xhr, status, error) {
                            alert('Terjadi kesalahan saat edit data.');
                        }
                    });
                }
            });
        });
    })

    </script>
</body>