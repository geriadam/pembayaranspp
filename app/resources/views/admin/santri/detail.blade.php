@extends('layouts.default')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="ibox">
            <div class="ibox-content">
                <a href="{{ route('admin.santri.index') }}">
                    <button type="button" class="btn btn-info btn-raised"><span class="glyphicon glyphicon-triangle-left"></span> 
                      Back
                    </button>
                </a>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        @if(count($transactionItem) > 0)
            @foreach($transactionItem as $year => $transactionItems)
                <div class="ibox">
                    <div class="ibox-title">
                        <h2>Tahun : {{ $year }}</h2>
                    </div>
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTable" id="index-table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tipe Pembayaran</th>
                                        <th>Bulan</th>
                                        <th>Harga</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($transactionItems as $i => $transactionitem)
                                        <tr>
                                            <td>{{ $i+1 }}</td>
                                            <td>{{ $transactionitem->paymenttype->payment_type_name }}</td>
                                            <td>
                                                @if($transactionitem->transaction_month != 0)
                                                    {{ $month[$transactionitem->transaction_month] }}
                                                @else
                                                    {{ "-" }}
                                                @endif
                                            </td>
                                            <td>{{ NumberHelper::format_uang($transactionitem->transaction_price) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="ibox">
                <div class="ibox-content">
                    <p>Maaf tidak ada transaksi</p>
                </div>
            </div>
        @endif
    </div>
</div> 
@endsection