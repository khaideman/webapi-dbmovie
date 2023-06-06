let hasSearched = false;

// Function searchMovies digunakan untuk melakukan pencarian film
function searchMovies () {
    // Menghapus konten yang ada di dalam elemen dengan id 'movie-list'
    $('#movie-list').html('');
    let year = $('#search-year').val();
    let type = '';

    // Mengecek apakah elemen dengan id 'search-movie' memiliki class 'active'
    if ($('#search-movie').hasClass('active')) {
        type = 'movie';
    } else if ($('#search-series').hasClass('active')) {
        type = 'series';
    }

    if (!hasSearched) {
        alert('Silahkan cari judul film terlebih dahulu');
        return;
    }    

    // Melakukan AJAX request ke API OMDB
    $.ajax({
        url: 'http://omdbapi.com',
        type: 'get',
        dataType: 'json',
        data: {
            'apikey' : 'aac5a3dc',
            's' : $('#search-input').val(),
            'y' : year,
            'type' : type
        },
        success: function (result) {
            console.log(result)
            if (result.Response == "True") {
                let movies = result.Search;

                // Mengurutkan daftar film berdasarkan tahun dari yang terbaru ke yang terlama
                movies.sort((a, b) => parseInt(b.Year) - parseInt(a.Year));

                // Membatasi jumlah film yang ditampilkan menjadi maksimal 8
                let count = 0;
                $.each(movies, function (i, data) {
                    if (count >= 8) {
                        return false;
                    }

                    // Menambahkan elemen card untuk setiap film ke dalam elemen dengan id 'movie-list'
                    $('#movie-list').append(`
                        <div class="col-md-3">
                            <div class="card mb-4 custom-card-size">
                                <img src="`+data.Poster+`" class="card-img-top" alt="..." width="" height="340">
                                <div class="card-body">
                                    <h5 class="card-title">`+data.Title+`</h5>
                                    <h6 class="card-subtitle mb-2 text-muted">`+data.Year+`</h6>
                                    <div class="card-link">
                                        <a href="#">See Details</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `);

                    count++;
                });

            } else {
                $('#movie-list').html(`
                    <div class="col">
                        <h1 class="text-center">` + result.Error + `</h1>
                    </div>
                `)
            }
        }
    })
}


$('#search-button').on('click', function () {
    $('#movie-list').html('')
    hasSearched = true
    searchMovies();
});

$('#search-input').on('keyup', function (e) {
    if (e.which === 13) {
        $('#movie-list').html('')
        searchMovies();
    }
});

$('#search-year').on('focus', function() {
    $(this).val('2023');
  });    

$('#search-year').on('change', function () {
    $('#movie-list').html('')
    searchMovies();
});

$('#search-movie').on('click', function () {
    $('#search-movie').addClass('active');
    $('#search-series').removeClass('active');
    $('#movie-list').html('')
    searchMovies();
});

$('#search-series').on('click', function () {
    $('#search-movie').removeClass('active');
    $('#search-series').addClass('active');
    $('#movie-list').html('')
    searchMovies();
});
