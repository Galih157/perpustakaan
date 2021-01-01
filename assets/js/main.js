jQuery(function () {
    const tabelBuku = {
        data: [],
        updateTableView: function () {
            var tbody = $('#tabelBuku tbody');
            tbody.html('');

            (this.data.length <= 0) && tbody.append('<tr><td colspan="5">Belum ada buku di tambahkan</td></tr>');

            if (this.data.length > 0) {

                this.data.forEach(function (data, index) {
                    var html = '<tr>';
                    html += `<td>${data.judul}</td>`;
                    html += `<td>${data.pengarang}</td>`;
                    html += `<td>${data.penerbit}</td>`;
                    html += `<td>${data.tahun}</td>`;
                    html += `<td>${data.isbn}</td>`;
                    html += `<td>
                    <button class="button toggle-modal is-primary" data-index="${index}" data-target="#editBukuModal">
                    <span class="icon"><span class="fas fa-edit"></span></span>
                    </button>
                    <button class="button hapus-buku is-danger" data-id="${data.id}">
                    <span class="icon"><span class="fas fa-trash"></span></span>
                    </button>
                    </td>`;
                    html += '</tr>';

                    tbody.append(html);
                })
            }
        },
        ambilData: function () {
            var _this = this;

            $.ajax({
                url: '/aksi/buku/ambil.php',
                success: function (res) {
                    _this.data = res.data || [];
                    _this.updateTableView();
                }
            });
        },
        hapusBuku: function (id) {
            var _this = this;

            $.ajax({
                url: '/aksi/buku/hapus.php',
                method: 'POST',
                data: { id },
                success: function (res) {
                    Swal.fire({
                        title: "Berhasil",
                        text: "Buku berhasil di hapus",
                        icon: "success",
                        confirmButtonText: "Okay",
                    });

                    _this.ambilData();
                }
            });
        }
    };

    $(document).on('click', '.toggle-modal', function () {
        var target = $(this).data('target');
        $(`${target}`).addClass('is-active');

        $(`${target} input[name="judul"]`).attr('required', true);
        $(`${target} input[name="pengarang"]`).attr('required', true);

        var index = $(this).data('index');

        if (index >= 0) {
            $(`${target} input[name="id"]`).val(tabelBuku.data[index].id);
            $(`${target} input[name="judul"]`).val(tabelBuku.data[index].judul);
            $(`${target} input[name="penerbit"]`).val(tabelBuku.data[index].penerbit);
            $(`${target} input[name="pengarang"]`).val(tabelBuku.data[index].pengarang);
            $(`${target} input[name="tahun"]`).val(tabelBuku.data[index].tahun);
            $(`${target} input[name="isbn"]`).val(tabelBuku.data[index].isbn);
        }
    });

    $('.close-modal').on('click', function () {
        var target = $(this).data('target');
        $(`${target}`).removeClass('is-active');

        $(`${target} input[name="judul"]`).removeAttr('required');
        $(`${target} input[name="pengarang"]`).removeAttr('required');
    });

    $('#formTambahBuku').submit(function (e) {
        e.preventDefault();

        var formData = $(this).serialize();

        $.ajax({
            url: '/aksi/buku/tambah.php',
            method: 'POST',
            data: formData,
            success: function (res) {
                $('.modal.is-active').removeClass('is-active');

                Swal.fire({
                    title: "Berhasil",
                    text: res.message || "Berhasil",
                    icon: "success",
                    confirmButtonText: "Okay",
                });

                tabelBuku.ambilData();
            }
        });
    });

    $('#formEditBuku').submit(function (e) {
        e.preventDefault();

        var formData = $(this).serialize();

        $.ajax({
            url: '/aksi/buku/update.php',
            method: 'POST',
            data: formData,
            success: function (res) {
                $('.modal.is-active').removeClass('is-active');

                Swal.fire({
                    title: "Berhasil",
                    text: res.message || "Berhasil",
                    icon: "success",
                    confirmButtonText: "Okay",
                });

                tabelBuku.ambilData();
            }
        });
    });

    $('#tabelBuku').on('click', '.hapus-buku', function (e) {
        var idBuku = $(this).data('id');

        Swal.fire({
            title: "Konfirmasi",
            text: "Apakah anda ingin menghapus data ini?",
            icon: "error",
            showCancelButton: true,
            confirmButtonText: "Ya",
            cancelButtonText: "Tidak"
        }).then(function (result) {
            (result.isConfirmed) && tabelBuku.hapusBuku(idBuku);
        });
    })

    tabelBuku.ambilData();
});