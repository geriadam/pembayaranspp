
@extends('layouts.default')
@section('content')
	<div class="col-md-6">
		<div class="ibox float-e-margins">
            <div class="ibox-title">
                <span class="label label-info pull-right">Hari Ini</span>
                <h5>Santri</h5>
            </div>
            <div class="ibox-content">
                <h1 class="no-margins">{{ $countDateNowSantri }}</h1>
                <small>Santri Baru</small>
            </div>
        </div>
	</div>
	<div class="col-md-6">
		<div class="ibox float-e-margins">
            <div class="ibox-title">
                <span class="label label-info pull-right">Hari Ini</span>
                <h5>Transaksi</h5>
            </div>
            <div class="ibox-content">
                <h1 class="no-margins">{{ $countDateNowTransaction }}</h1>
                <small>Transaksi Masuk</small>
            </div>
        </div>
	</div>
	<div class="col-md-6">
		<div id="chartSantri"></div>
		{!! $chartSantri !!}
	</div>
	<div class="col-md-6">
		<div id="chartTransaction"></div>
		{!! $chartTransaction !!}
	</div>
	<div class="row"></div><div class="row"></div><br><br>
@endsection