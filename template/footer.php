<!-- BEGIN VENDOR JS-->
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="/projet/template/theme-assets/vendors/js/vendors.min.js" type="text/javascript"></script>
<!-- BEGIN VENDOR JS-->
<!-- BEGIN PAGE VENDOR JS-->
<script src="/projet/template/theme-assets/vendors/js/charts/chartist.min.js" type="text/javascript"></script>
<!-- END PAGE VENDOR JS-->
<!-- BEGIN CHAMELEON  JS-->
<script src="/projet/template/theme-assets/js/core/app-menu-lite.js" type="text/javascript"></script>
<script src="/projet/template/theme-assets/js/core/app-lite.js" type="text/javascript"></script>
<!-- END CHAMELEON  JS-->
<!-- BEGIN PAGE LEVEL JS-->
<script src="/projet/template/theme-assets/js/scripts/pages/dashboard-lite.js" type="text/javascript"></script>
<!-- END PAGE LEVEL JS-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<script type="text/javascript">
  function confirmDelete(firstname, cin) {
    swal({
        title: "Vous êtes sure?",
        text: "Cet infecté va être supprimer!",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Oui!",
        closeOnConfirm: false
      },
      function() {
        $.post("./delete_infected.php", {
          cin: cin
        }, function(data) {
          swal("Supprimé!", `${firstname} a été supprimé!`, "success").then(function() {
            window.location.href = "./infected.php";
          });
        });

      });
  }
</script>
</body>

</html>