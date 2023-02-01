$(document).ready(function () {
  $(".remove-btn").click(function (e) {
    //attr("data-url") ile aynı işlev
    var $data_url = $(this).data("url");

    Swal.fire({
      title: "Emin misiniz?",
      text: "Bu İşlemi Geri Alamayacaksınız!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Evet, Sil!",
      cancelButtonText: "Hayır",
    }).then(function (result) {
      if (result.isConfirmed) {
        window.location.href = $data_url;
      }
    });
  });
});
