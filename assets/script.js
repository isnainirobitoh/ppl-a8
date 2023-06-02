var harga_produk = document.getElementById('hargaproduk');
harga_produk.addEventListener('keyup', function(e) {
  var formattedValue = formatRupiah(this.value);
  this.value = formattedValue;
});

/* Fungsi */
function formatRupiah(angka) {
  var number_string = angka.replace(/[^,\d]/g, '').toString(),
    split = number_string.split(','),
    sisa = split[0].length % 3,
    rupiah = split[0].substr(0, sisa),
    ribuan = split[0].substr(sisa).match(/\d{3}/gi);

  if (ribuan) {
    separator = sisa ? '.' : '';
    rupiah += separator + ribuan.join('.');
  }

  rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
  return rupiah;
}

