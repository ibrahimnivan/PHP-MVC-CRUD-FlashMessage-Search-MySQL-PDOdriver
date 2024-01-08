$(function () {
  // ketika dokumen sudah siap fungsi ini dijalankan

  //// untuk tambah data
  $("#modalTambah").on("click", function () {
    $("#judulModal").html("Tambah Data Mahasiswa").html("Tambah data");
  });

  //// untuk ubah data
  $(".modalUpdate").on("click", function () { // harus class kl id ngga bisa lebih dri 1
    $("#judulModal").html("Ubah Data Mahasiswa");
    $(".modal-body button[type=submit]").html("Ubah data");
    
    // mengubah attr action
    $('.modal-body form').attr('action', 'http://localhost/projects/003%20mvc/public/mahasiswa/ubah')

    // dari data-id attr
    const id = $(this).data("id");

    // untuk mengambil data by Id
    $.ajax({
      url: "http://localhost/projects/003%20mvc/public/mahasiswa/getubah",
      data: { id: id },
      method: "post",
      dataType: 'json',
      success: function (data) { // dijalankan kl success
        $('#nama').val(data.nama)
        $('#nrp').val(data.nrp)
        $('#email').val(data.email)
        $('#jurusan').val(data.jurusan)
        $('#id').val(data.id)
      },
    });
  });
});
