<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang</title>

    <link rel="stylesheet" href="/assets/css/bulma.min.css">
    <link rel="stylesheet" href="/assets/css/fontawesome.min.css">
</head>

<body>
    <section class="section">
        <div class="container">
            <div class="columns is-centered">
                <div class="column is-10">
                    <h4 class="title">Selamat Datang di Perpustakaan</h4>
                    <div class="box">
                        <div class="columns">
                            <div class="column">
                                <h1 class="subtitle">Data Buku</h1>
                            </div>
                            <div class="colum">
                                <button class="button is-primary toggle-modal" data-target="#tambahBukuModal">Tambah Buku</button>
                            </div>
                        </div>
                        <table class="table is-striped is-fullwidth" id="tabelBuku">
                            <thead>
                                <th>Judul Buku</th>
                                <th>Pengarang</th>
                                <th>Penerbit</th>
                                <th>Tahun</th>
                                <th>ISBN</th>
                                <th>Aksi</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="5">Belum ada buku di tambahkan</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal" id="tambahBukuModal">
        <div class="modal-background"></div>
        <form method="post" id="formTambahBuku">
            <div class="modal-card">
                <header class="modal-card-head">
                    <p class="modal-card-title">Tambah Buku Baru</p>
                    <button class="delete close-modal" type="button" data-target="#tambahBukuModal"></button>
                </header>
                <section class="modal-card-body">
                    <div class="field">
                        <div class="control">
                            <label class="label">Judul Buku</label>
                            <input type="text" required class="input" name="judul">
                        </div>
                    </div>
                    <div class="field">
                        <div class="control">
                            <label class="label">Nama Pengarang</label>
                            <input type="text" required class="input" name="pengarang">
                        </div>
                    </div>
                    <div class="columns">
                        <div class="column">
                            <div class="field">
                                <div class="control">
                                    <label class="label">Penerbit</label>
                                    <input type="text" class="input" name="penerbit">
                                </div>
                            </div>
                        </div>
                        <div class="column is-4">
                            <div class="field">
                                <div class="control">
                                    <label class="label">Tahun</label>
                                    <input type="text" class="input" name="tahun">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="control">
                        <label class="label">ISBN</label>
                        <input type="text" class="input" name="isbn">
                    </div>
                </section>
                <footer class="modal-card-foot">
                    <button class="button is-success" type="submit">Simpan Buku</button>
                    <button class="button" class="close-modal" data-target="#tambahBukuModal">Batal</button>
                </footer>
            </div>
        </form>
    </div>

    <div class="modal" id="editBukuModal">
        <div class="modal-background"></div>
        <form method="post" id="formEditBuku">
            <div class="modal-card">
                <header class="modal-card-head">
                    <p class="modal-card-title">Edit Buku</p>
                    <button class="delete close-modal" type="button" data-target="#editBukuModal"></button>
                </header>
                <section class="modal-card-body">
                    <input type="hidden" name="id">
                    <div class="field">
                        <div class="control">
                            <label class="label">Judul Buku</label>
                            <input type="text" required class="input" name="judul">
                        </div>
                    </div>
                    <div class="field">
                        <div class="control">
                            <label class="label">Nama Pengarang</label>
                            <input type="text" required class="input" name="pengarang">
                        </div>
                    </div>
                    <div class="columns">
                        <div class="column">
                            <div class="field">
                                <div class="control">
                                    <label class="label">Penerbit</label>
                                    <input type="text" class="input" name="penerbit">
                                </div>
                            </div>
                        </div>
                        <div class="column is-4">
                            <div class="field">
                                <div class="control">
                                    <label class="label">Tahun</label>
                                    <input type="text" class="input" name="tahun">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="control">
                        <label class="label">ISBN</label>
                        <input type="text" class="input" name="isbn">
                    </div>
                </section>
                <footer class="modal-card-foot">
                    <button class="button is-success" type="submit">Perbarui Buku</button>
                    <button class="button" class="close-modal" data-target="#editBukuModal">Batal</button>
                </footer>
            </div>
        </form>
    </div>
</body>

<script src="/assets/js/jquery-3.5.1.min.js"></script>
<script src="/assets/js/sweetalert2.min.js"></script>
<script src="/assets/js/main.js"></script>

</html>