@extends('layouts.default')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="ibox">
            <div class="ibox-content">
                <a href="{{ route('admin.paymenttype.create') }}">
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
                                <th width="20%">Jenis Pembayaran</th>
                                <th width="20%">Nominal Pembayaran</th>
                                <th width="40%">Jenis Pembayaran</th>
                                <th width="20%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($model as $i => $paymenttype)
                                <tr>
                                    <td>{{ $i+1 }}</td>
                                    <td>{{ $paymenttype->payment_type_name }}</td>
                                    <td>{{ NumberHelper::format_uang($paymenttype->payment_type_price) }}</td>
                                    <td>
                                        @if($paymenttype->payment_type_unit == 'day')
                                            Harian
                                        @elseif($paymenttype->payment_type_unit == 'month')
                                            Bulanan
                                        @else
                                            Tahunan
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.paymenttype.edit', ['id' => $paymenttype->payment_type_id]) }}">
                                            <span class="btn btn-warning dim btn-sm glyphicon glyphicon-pencil"></span>
                                        </a>
                                        <a href="{{ route('admin.paymenttype.destroy', ['id' => $paymenttype->payment_type_id]) }}" id="delete-btn">
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
@endsection