// Jalankan function getKodePos() jika form di submit
$("form").bind("submit", function (event) {
  getKodePos()
});

// Jalankan function getKodePos() jika keyboard telah ditekan
$("[name=q]").on("keyup", function (event) {
  getKodePos()
});

// Function getKodePos()
function getKodePos() {
  let inputSearch = $("[name=q]");
  let btnSearch = $("#btn-search");
  let container = $("#hasil");
  
  
  // Mengganti icon search ke icon loading pada tombol
  btnSearch.html(`
  <center>
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-clockwise spin" viewBox="0 0 16 16">
      <path fill-rule="evenodd" d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2v1z"/>
      <path d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466z"/>
    </svg>
  </center>
  `);
  
  // Memulai ajax untuk mendapatkan data
  $.ajax({
    url: "https://kodepos.vercel.app/search",
    type: "get",
    dataType: "json",
    data: inputSearch.serialize(),
    success: function (hasil) {
      
      // Mereset icon tombol pencarian dan isi container
      container.html("");
      btnSearch.html(`
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
          <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
        </svg>
      `);
      
      // Menyimpan data ke variabel
      let data = hasil.data;
      console.log("Success search: " + inputSearch.val());
      
      // Melakukan pengulangan data untuk ditampilkan
      $.each(data, function (i, data) {
          container.append(`
          <div class="card mb-3 shadow">
            <div class="card-header bg-primary"> No. `+(i+1)+`</div>
            <div class="card-body">
              <table class="table">
                <tr>
                  <td width="50%">Propinsi</td>
                  <td>`+data.province+`</td>
                </tr>
                <tr>
                  <td>Kota/Kab.</td>
                  <td>`+data.city+`</td>
                </tr>
                <tr>
                  <td>Kecamatan</td>
                  <td>`+data.subdistrict+`</td>
                </tr>
                <tr>
                  <td>Kelurahan</td>
                  <td>`+data.urban+`</td>
                </tr>
                <tr>
                  <td>Kode pos</td>
                  <td>`+data.postalcode+`</td>
                </tr>
              </table>
            </div>
          </div>
          `);
      });
    }
  });
  
  event.preventDefault();
}
