<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi Input Data</title>
    <!-- Bootstrap CSS -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2 class="text-center">Masukkan Data Anda</h2>
        <form id="dataForm">
            @csrf
            <div class="form-group">
                <label for="nik">NIK:</label>
                <input type="number" maxlength="16" class="form-control" id="nik" name="nik" required>
            </div>
            <div class="form-group">
                <label for="nama">Nama:</label>
                <input type="text" class="form-control" id="nama" name="nama" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#dataForm').on('submit', function(e) {
                e.preventDefault(); // Mencegah form untuk melakukan submit secara default

                var nik = $('#nik').val();
                var nama = $('#nama').val();

                // Placeholder untuk domain yang akan diakses
                var domain = 'http://localhost:8083/api/login-satset';

                // Contoh penggunaan AJAX untuk mengirim data ke domain tertentu
                var token = $('meta[name="csrf-token"]').attr('content');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': token
                    }
                });
                $.ajax({
                    url: domain,
                    type: 'POST',
                    data: {
                        nik: nik,
                        nama: nama
                    },
                    success: function(response) {
                        alert('Data berhasil dikirim!');
                        if (response.status == 'success') {
                            window.open(response.url, '_blank');
                        }
                        console.log(response);
                    },
                    error: function(xhr, status, error) {
                        alert('Terjadi kesalahan saat mengirim data.');
                        console.error(error);
                    }
                });
            });
        });
    </script>
</body>

</html>
