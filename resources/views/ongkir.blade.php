<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cek Ongkir</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <h1>Cek Ongkir</h1>

    <label for="province">Provinsi:</label>
    <select id="province">
        <option value="">Pilih Provinsi</option>
    </select>

    <label for="city">Kota:</label>
    <select id="city" disabled>
        <option value="">Pilih Kota</option>
    </select>

    <label for="weight">Berat (gram):</label>
    <input type="number" id="weight" value="1000">

    <label for="courier">Kurir:</label>
    <select id="courier">
        <option value="jne">JNE</option>
        <option value="pos">POS</option>
        <option value="tiki">TIKI</option>
    </select>

    <h3>Biaya Ongkir:</h3>
    <div id="cost">Pilih kota dan kurir untuk melihat ongkir</div>

    <script>
        $(document).ready(function () {
            // Ambil daftar provinsi
            $.get('/provinces', function (data) {
                data.forEach(function (province) {
                    $('#province').append('<option value="' + province.province_id + '">' + province.province + '</option>');
                });
            });

            // Ketika provinsi dipilih, ambil kota
            $('#province').change(function () {
                var province_id = $(this).val();
                $('#city').prop('disabled', false).empty().append('<option value="">Pilih Kota</option>');

                $.get('/cities/' + province_id, function (data) {
                    data.forEach(function (city) {
                        $('#city').append('<option value="' + city.city_id + '">' + city.city_name + '</option>');
                    });
                });
            });

            // Ketika kota atau berat atau kurir berubah, hitung ongkir
            $('#city, #weight, #courier').change(function () {
                var city_id = $('#city').val();
                var weight = $('#weight').val();
                var courier = $('#courier').val();

                if (city_id && weight) {
                    $.post('/cost', {
                        _token: '{{ csrf_token() }}',
                        origin: 501, // Kota asal (contoh: Yogyakarta)
                        destination: city_id,
                        weight: weight,
                        courier: courier
                    }, function (data) {
                        var cost = data[0].costs[0].cost[0].value;
                        $('#cost').text('Rp ' + cost);
                    });
                }
            });
        });
    </script>
</body>
</html>
