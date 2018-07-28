<script src="{{ url('js/jquery.min.js') }}"></script>
<script src="{{ url('js/sweetalert.min.js') }}"></script>
<script src="{{ url('js/jquery.dataTables.min.js') }}"></script>
<script src="{{ url('js/datatables.bootstrap4.js') }}"></script>
<script src="{{ url('js/bootstrap.min.js') }}"></script>
<script src="{{ url('js/plugins/metisMenu/jquery.metisMenu.js') }}"></script>
<script src="{{ url('js/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>
<script src="{{ url('js/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
<script src="{{ url('js/plugins/select2/select2.full.min.js') }}"></script>
<script src="{{ url('js/plugins/dropzone/dropzone.js') }}"></script>
<script src="{{ url('js/inspinia.js') }}"></script>
<script src="{{ url('js/plugins/pace/pace.min.js') }}"></script>
<script src="{{ url('js/plugins/summernote/summernote.min.js') }}"></script>
<script src="{{ url('js/plugins/packery/packery.pkgd.min.js') }}"></script>
<script src="{{ url('js/plugins/summernote/summernote.min.js') }}"></script>
<script src="{{ url('js/plugins/colorpicker/bootstrap-colorpicker.min.js') }}"></script>
<script src="{{ url('js/myjs.js') }}"></script>
<script src="{{ url('js/lightbox.js') }}"></script>
<script>
$(document).ready(function(){
    $('#index-table').DataTable({
        pageLength: 10,
        responsive: true,
        processing: true,
    });
});
$(document).on('click', '#delete-btn', function(e) {
    e.preventDefault();
    var link = $(this);
    swal({
        title: "Confirm Delete",
        text: "Are you sure to delete this item?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, delete it!",
        closeOnConfirm: true
     },
     function(isConfirm){
         if(isConfirm){
            window.location = link.attr('href');
         }
         else{
            swal("cancelled","Deletion Cancelled", "error");
         }
     });
});
</script>

