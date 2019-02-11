<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top" style="display: inline;">
      <i class="fa fa-angle-up"></i>
    </a>
<!-- Logout Modal-->
<div class="modal fade" id="logout" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Deseja sair?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">Selecione "Logout" abaixo se você estiver pronto para terminar sua sessão atual.</div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        <a id="sair" class="btn btn-primary" href="index.php">Logout</a>
      </div>
    </div>
  </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="/modelo/assets/vendor/jquery/jquery.min.js"></script>
<script src="/modelo/assets/vendor/jquery/jquery.js"></script>
<script src="/modelo/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Core plugin JavaScript-->
<script src="/modelo/assets/vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="/modelo/assets/vendor/datatables/jquery.dataTables.js"></script>
<script src="/modelo/assets/vendor/datatables/dataTables.bootstrap4.js"></script>
<!-- Custom scripts for all pages-->
<script src="/modelo/assets/js/sb-admin.min.js"></script>
<!-- Custom scripts for this page-->
<script src="/modelo/assets/vendor/select2/js/select2.min.js"></script>
<script type="text/javascript" src="/modelo/assets/vendor/multiselect/js/bootstrap-multiselect.js"></script>

</div>
<script>
  $("#sair").on("click", function() {
    $.ajax({
      type: "POST",
      url: "../route/excluir.php",
      data: {
        'acao': 'logout'
      },
      success: function(resp) {
        alert(resp)
        window.location.replace("index.php");
      },
      dataType: 'json'
    });
  });
</script>
</body>
</html>
