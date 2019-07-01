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
<script type="text/javascript">
    $(document).ready(function(){
        $('#sProvince').on('change', function(){
            $('#sRegencie').html('');
            var CSRF_TOKEN = $('input[name="_token"]').val();
            $.ajax({
                url: '{{ route('dropdownAddress') }}',
                type: 'POST',
                data: {_token: CSRF_TOKEN, type: 'kabupaten', id: $('#sProvince').val()},
                success: function(e){
                    $('#sRegencie').html(e);
                    $('#sDistrict').html('');
                    $('#sVillage').html('');
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });        
        });
        $('#sRegencie').on('change', function(){
            $('#sDistrict').html('');
            var CSRF_TOKEN = $('input[name="_token"]').val();
            $.ajax({
                url: '{{ route('dropdownAddress') }}',
                type: 'POST',
                data: {_token: CSRF_TOKEN, type: 'kecamatan', id: $('#sRegencie').val()},
                success: function(e){
                    $('#sDistrict').html(e);
                    $('#sVillage').html('');
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        });
        $('#sDistrict').on('change', function(){
            $('#sVillage').html('');
            var CSRF_TOKEN = $('input[name="_token"]').val();
            $.ajax({
                url: '{{ route('dropdownAddress') }}',
                type: 'POST',
                data: {_token: CSRF_TOKEN, type: 'kelurahan', id: $('#sDistrict').val()},
                success: function(e){
                    console.log($('#sDistrict').val());
                    $('#sVillage').html(e);
                },
                error: function (data) {
                    console.log('Error:', data);
                }
            });
        });
    });
</script>


