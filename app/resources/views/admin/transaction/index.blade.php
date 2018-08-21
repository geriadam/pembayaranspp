@extends('layouts.default')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="ibox">
            <div class="ibox-content">
                <a href="{{ route('admin.transaction.create') }}">
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
                                <th width="15%">No Transaksi</th>
                                <th width="20%">Tanggal Transaksi</th>
                                <th width="30%">Total</th>
                                <th width="35%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($model as $i => $transaction)
                                <tr>
                                    <td>{{ $i+1 }}</td>
                                    <td>{{ $transaction->santri->santri_name }}</td>
                                    <td>{{ $transaction->transaction_number }}</td>
                                    <td>{{ \Carbon\Carbon::parse($transaction->transaction_date)->format('d M Y') }}</td>
                                    <td>{{ NumberHelper::format_uang($transaction->transaction_total) }}</td>
                                    <td>
                                        <a href="{{ route('admin.transaction.show', ['id' => $transaction->transaction_id]) }}" class="buttonShow">
                                            <span class="btn btn-info dim btn-sm glyphicon glyphicon-eye-open"></span>
                                        </a>
                                        <a target="_blank" href="{{ route('admin.transaction.print', ['id' => $transaction->transaction_id]) }}">
                                            <span class="btn btn-primary dim btn-sm glyphicon glyphicon-print"></span>
                                        </a>
                                        <a href="{{ route('admin.transaction.destroy', ['id' => $transaction->transaction_id]) }}" id="delete-btn">
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
<div class="modal fade" id="modalTransaction" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content" id="modalShow">
    </div>
  </div>
</div>

<script src="{{ url('js/jquery.min.js') }}"></script>
<script>
    $(document).ready(function(){
        $(".buttonShow").click(function(e){
            e.preventDefault();      
            $('#modalTransaction').modal('show')
                       .find('#modalShow')
                       .load($(this).attr('href'));  
        });
    });
</script>
@endsection