@extends('layouts.default')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="ibox">
            <div class="ibox-title">
                Laporan
            </div>
            <div class="ibox-content">
                <p><a href="{{ route('admin.report.santri.index') }}">Santri</a></p>
                <p><a href="{{ route('admin.report.transaksi.index') }}">Transaksi</a></p>
            </div>
        </div>
    </div>
</div>
@endsection