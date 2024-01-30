$(document).ready(function () {
    // event ketika keyword ditulis
    $('keyword').on('keyup', function () {
        $('container').load('../ajax/produk.php?keyword=' + $('keyword').val());
    });
});