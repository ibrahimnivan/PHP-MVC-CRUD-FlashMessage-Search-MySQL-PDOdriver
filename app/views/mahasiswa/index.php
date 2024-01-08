<div class="container mt-5">

  <div class="row">
    <div class="col-lg-6">
      <?php Flasher::flash(); ?>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-6">
      <!-- Button trigger modal -->
      <button id="modalTambah" type="button" class="btn btn-primary" data-toggle="modal" data-target="#formModal">
        Tambah Data Mahasiswa
      </button>
    </div>

  </div>
  <div class="row mt-3">
    <div class="col-lg-6">
      <form action="<?= BASEURL ?>/mahasiswa/car" method="post">
        <div class="input-group mb-3">
          <input type="text" class="form-control" placeholder="cari mahasiswa" name="keyword" id="keyword"
            autocomplete="off">
          <div class="input-group-append">
            <button class="btn btn-outline-primary" type="button" id="tombolCari">Cari</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <div class="row">
    <div class="col-6">
      <!-- Button trigger modal -->
      <h3 class="mt-4">Daftar Mahasiswa</h3>
      <ul class=" list-group mt-3 ">
        <?php foreach( $data['mhs'] as $mhs) : ?>
        <li class=" list-group-item"><?= $mhs['nama']?>
          <a style=" color: red" href="<?= BASEURL ?>/mahasiswa/hapus/<?= $mhs['id'] ?>" class="float-right m-1"
            onclick="return confirm('are you sure?')">hapus</a>
          <a id="modalUpdate" style=" color: green" href=" <?= BASEURL ?>/mahasiswa/ubah/<?= $mhs['id'] ?>"
            class="float-right m-1 modalUpdate" data-toggle="modal" data-target="#formModal" data-id="<?= 
          $mhs['id']; ?>">ubah</a>
          <a href=" <?= BASEURL ?>/mahasiswa/detail/<?= $mhs['id'] ?>" class="float-right m-1">detail</a>
        </li>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="formModal" tabindex="-1" role="dialog" aria-labelledby="judulModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="judulModal">Tambah Data Mahasiswa</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?= BASEURL ?>/mahasiswa/tambah" method="post">
          <!-- hidden buat ubah data -->
          <input type="hidden" name="id" id="id">
          <div class="form-group">
            <label for="nama">Nama</label>
            <input type="text" class="form-control" id="nama" name="nama" placeholder="">
          </div>
          <div class="form-group">
            <label for="nrp">NRP</label>
            <input type="number" class="form-control" id="nrp" name="nrp" placeholder="">
          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="">
          </div>

          <div class="form-group">
            <label for="jurusan">Jurusan</label>
            <select class="form-control" id="jurusan" name="jurusan">
              <option value="tdk memilih">--pilih--</option>
              <option value="farmasi">Farmasi</option>
              <option value="kimia">Kimia</option>
              <option value="ilmu politik">Ilmu politik</option>
              <option value="sosiologi">Sosiologi</option>
              <option value="kehutanan">Kehutanan</option>
              <option value="pertanian">Pertanian</option>
            </select>
          </div>
          <button type="submit" class="btn btn-primary">Tambah Data</button>
        </form>
      </div>
      <div class="modal-footer">
      </div>

    </div>
  </div>
</div>