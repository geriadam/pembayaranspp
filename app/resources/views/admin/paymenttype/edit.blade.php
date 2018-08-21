@extends('layouts.default')
@section('content')
@if ($errors->any())
  <div class="alert alert-danger alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
    <em>
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </em>
  </div>
@endif
<div class="row">
    <div class="col-lg-12">
        <div class="ibox">
            <div class="ibox-content">
                <a href="{{ route('admin.paymenttype.index') }}">
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
    {{ Form::open(['route' => ['admin.paymenttype.update', $paymenttype->payment_type_id], 'method' => "PUT", "files" => TRUE]) }}
    <div class="ibox float-e-margins">
      <div class="ibox-title">
        <div class="ibox-tools">
          <a class="collapse-link">
            <i class="fa fa-chevron-up"></i>
          </a>
        </div>
      </div>
      <div class="ibox-content">
        <div class="alert alert-danger alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <i>* Jika Pembyaran SPP Tulis (SPP/Spp/spp) saja</i>
        </div>
        <div class="form-group">
            <strong>Nama Pembayaran</strong>
            {!! Form::text('payment_type_name', $paymenttype->payment_type_name , ["class" => "form-control"]) !!}
        </div>
        <div class="form-group">
            <strong>Nominal</strong>
            {!! Form::text('payment_type_price', $paymenttype->payment_type_price, ["class" => "form-control meta-desc"]) !!}
        </div>
        <div class="form-group">
            <strong>Tipe:</strong>
            {!! Form::select('payment_type_unit', $unit ,$paymenttype->payment_type_unit , ["class" => "form-control"]) !!}
        </div>
      </div>
      <div class="ibox-content">
        <button type="submit" class="btn btn-primary">Save</button>
        <button type="reset" class="btn btn-danger btn-large">Reset</button>
      </div>
    </div>
    {!! Form::close() !!}  
  </div>
</div>
@endsection