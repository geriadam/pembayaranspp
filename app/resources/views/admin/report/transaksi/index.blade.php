@extends('layouts.default')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="ibox">
            <div class="ibox-title">
                Filter
            </div>
            {{ Form::open(['route' => 'admin.report.transaksi.search', 'method' => 'GET']) }}
            <div class="ibox-content">
                <div class="form-group">
                    <strong>Nama Santri:</strong>
                    {!! Form::select('santri_id', $santri ,null , ["class" => "form-control select2-select"]) !!}
                </div>
                <div class="form-group">
                    <strong>No Transaksi:</strong>
                    {!! Form::text('transaction_number', null, ["class" => "form-control"]) !!}
                </div>
                <div class="col-md-12 row">
                    <div class="col-md-6" style="padding-left: 0; margin-bottom: 2%">
                        <strong>Dari Tanggal</strong>
                        {!! Form::text('start_date', null, ["class" => "form-control datepicker"]) !!}
                    </div>
                    <div class="col-md-6">
                        <strong>Ke Tanggal</strong>
                        {!! Form::text('end_date', null, ["class" => "form-control datepicker"]) !!}
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" value="true" name="submit" class="btn btn-primary">Filter</button>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="ibox">
            <div class="ibox-title">
                <a href="{{ route('admin.report.transaksi.export') }}" target="_blank">
                    <button type="button" class="btn btn-primary">Export</button>
                </a>
            </div>
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
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div> 
<script src="{{ url('js/jquery.min.js') }}"></script>
@endsection