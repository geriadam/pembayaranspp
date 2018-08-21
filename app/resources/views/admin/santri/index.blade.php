@extends('layouts.default')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="ibox">
            <div class="ibox-content">
                <a href="{{ route('admin.santri.create') }}">
                    <button type="button" class="btn btn-primary btn-raised"> Create</button>
                </a>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="ibox">
            <div class="ibox-content">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTable" id="index-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th width="20%">Nama Santri</th>
                                <th width="20%">Tempat, Tanggal Lahir</th>
                                <th width="40%">Jenis Kelamin</th>
                                <th width="20%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($model as $i => $santri)
                                <tr>
                                    <td>{{ $i+1 }}</td>
                                    <td>{{ $santri->santri_name }}</td>
                                    <td>{{ $santri->santri_birth_place }}, 
                                        {{ \Carbon\Carbon::parse($santri->santri_birth_date)->format("d M Y") }}
                                    </td>
                                    <td>{{ $santri->santri_gender == 'man' ? 'Laki-Laki' : 'Perempuan' }}</td>
                                    <td>
                                        <a href="{{ route('admin.santri.show', ['id' => $santri->santri_id]) }}" class="buttonShow">
                                            <span class="btn btn-primary dim btn-sm glyphicon glyphicon-eye-open"></span>
                                        </a>
                                        <a href="#" class="buttonDetail" data-id="{{ $santri->santri_id }}">
                                            <span class="btn btn-info dim btn-sm glyphicon glyphicon-tags"></span>
                                        </a>
                                        <a href="{{ route('admin.santri.edit', ['id' => $santri->santri_id]) }}">
                                            <span class="btn btn-warning dim btn-sm glyphicon glyphicon-pencil"></span>
                                        </a>
                                        <a href="{{ route('admin.santri.destroy', ['id' => $santri->santri_id]) }}" id="delete-btn">
                                            <span class="btn btn-danger dim btn-sm glyphicon glyphicon-remove-sign"></span>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div> 

<div class="modal fade" id="modalSantri" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content" id="modalShow">
    </div>
  </div>
</div>

<div class="modal fade" id="modalSpp" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header btn-primary">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title" id="myModalLabel">Detail</h4>
        </div>
        <div class="modal-body" id="modalDetail">
            <div class="ibox float-e-margins">
              <div class="ibox-title">
                Info
              </div>
              <div class="ibox-content">
                <div class="form-group">
                    {!! Form::select("year_select",$year, "", ["class" => "form-control year_search", "data-id" => ""]) !!}
                </div> 
                <table class="table table-responsive table-striped">
                    <thead>
                        <tr>
                            <th>Bulan</th>
                            <th>Tahun</th>
                        </tr>
                    </thead>
                    <tbody class="table-santri-detail"></tbody>
                </table>
              </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
    </div>
  </div>
</div>

<script src="{{ url('js/jquery.min.js') }}"></script>
<script>

    function reset_modal()
    {
        $(".table-santri-detail").empty();
    }

    $(document).ready(function(){
        $(".buttonShow").click(function(e){
            e.preventDefault();      
            $('#modalSantri').modal('show')
                       .find('#modalShow')
                       .load($(this).attr('href'));  
        });
    });

    $(document).ready(function(){
        var i;
        $(".buttonDetail").click(function(e){
            var id_data = $(this).attr('data-id');
            var url     = "{{ url("admin/santri/detail/") }}";
            var html   = "";
            $.ajax({
              type: "GET", 
              url: url+"/"+id_data,
              dataType: 'json',
              success: function(data){
                reset_modal();
                for(i = 0; i < data.data.length; i++){
                    html += "<tr><td>"+data.data[i].month+"</td><td>"+data.data[i].year+"</td></tr>";
                }

                if(data.data.length == 0){
                    html += "<tr><td colspan='2'>Data tidak ada</td></tr>";
                }

                $(".table-santri-detail").html(html);
                $(".year_search").attr("data-id", data.santri_id)
                $('#modalSpp').modal('show')
              }
            });
        }); 
    });

    $(".year_search").change(function(){
        var i;
        var year    = $(this).val();
        var html    = "";
        var id_data = $(this).attr('data-id');
        var url     = "{{ url("admin/santri/detail/") }}";
        $.ajax({
          type: "GET", 
          url: url+"/"+id_data+"/"+year,
          dataType: 'json',
          success: function(data){
            reset_modal();
            for(i = 0; i < data.data.length; i++){
                    html += "<tr><td>"+data.data[i].month+"</td><td>"+data.data[i].year+"</td></tr>";
                }

            if(data.data.length == 0){
                    html += "<tr><td colspan='2'>Data tidak ada</td></tr>";
                }
            
            $(".table-santri-detail").html(html);
          }
        });
    });
</script>
@endsection