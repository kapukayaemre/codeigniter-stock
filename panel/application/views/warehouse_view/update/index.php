<!DOCTYPE html>
<html lang="tr">
<head>
    <?php $this->load->view('includes/head'); ?>
</head>

<body class="menubar-left menubar-unfold menubar-light theme-primary">
<!--============= start main area -->

<!-- APP NAVBAR ==========-->
<?php $this->load->view('includes/navbar'); ?>
<!--========== END app navbar -->

<!-- APP ASIDE ==========-->
<?php $this->load->view('includes/aside'); ?>
<!--========== END app aside -->

<!-- navbar search -->
<?php $this->load->view('includes/navbar-search'); ?>
<!-- .navbar-search -->

<!-- APP MAIN ==========-->
<main id="app-main" class="app-main">
    <div class="wrap">
        <section class="app-content">
            <?php $this->load->view("{$viewFolder}/{$subViewFolder}/content"); ?>
        </section><!-- #dash-content -->
    </div><!-- .wrap -->

    <!-- APP FOOTER -->
    <?php $this->load->view('includes/footer'); ?>
    <!-- /#app-footer -->
</main>
<!--========== END app main -->

<!-- build:js ../assets/js/core.min.js -->
<?php $this->load->view('includes/include_script'); ?>

<script>

$(document).ready(function (){
  $('#city').attr('disabled', 'disabled');
  $('#town').attr('disabled', 'disabled');
  $('#warehouse'). on ('change', function(){
    if($(this).val() != '') {
      $('#city').removeAttr('disabled');
    }
  $('#city'). on('change', function(){
      $('#town').removeAttr('disabled');
    });
  });
});




  var SITE_URL = "http://localhost/sms/panel/"
    //! Ana Kategoriler Seçilince Alt Kategorilerin Bağlantılı Gelmesi İçin
    $(document).ready(function () {
    $('select[name=city_id]').on('change', function (){
    var id = $(this).val();
    if (id) {
      $.ajax({
        url : SITE_URL+'warehouse/' + id,    
        type : 'GET',
        dataType : 'json',
        success : function(data) {
          $('select[name = "town_id"]').empty();
          $('select[name = "town_id"]').append('<option value=" ">' + 'Seçmek için tıklayınız...' + '</option>');
          $.each(data, function (key, value)
          {
            $('select[name = "town_id"]').append('<option value=" ' + value.town_id +' ">' + value.town_name + '</option>');
          });
        }
      });
    } else {
      $('select[name = "town_id"]').empty();
    }
  });
  

});

</script>

</body>
</html>