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
    {{ Form::open(['route' => ['admin.santri.update', $santri->santri_id], 'method' => "PUT", "files" => TRUE]) }}
    <div class="ibox float-e-margins">
      <div class="ibox-title">
        <div class="ibox-tools">
          <a class="collapse-link">
            <i class="fa fa-chevron-up"></i>
          </a>
        </div>
      </div>
      <div class="ibox-content">
        <div class="form-group">
            <strong>Nama Santri:</strong>
            {!! Form::text('santri_name', $santri->santri_name, ["class" => "form-control"]) !!}
        </div>
        <div class="form-group">
            <strong>Nama Panggilan:</strong>
            {!! Form::text('santri_nick_name', $santri->santri_nick_name, ["class" => "form-control"]) !!}
        </div>
        <div class="form-group">
          <strong>Tempat, Tanggal lahir:</strong>
        </div>
        <div class="form-group col-md-4">
            {!! Form::text('santri_birth_place', $santri->santri_birth_place, ["class" => "form-control"]) !!}
        </div>
        <div class="form-group col-md-8">
          {!! Form::text('santri_birth_date', $santri->santri_birth_date, ["class" => "form-control datepicker"]) !!}
        </div>
        <div class="form-group">
            <strong>Jenis Kelamin:</strong>
            {!! Form::select('santri_gender', $gender ,$santri->santri_gender , ["class" => "form-control"]) !!}
        </div>
        <div class="form-group">
            <strong>Anak Ke - :</strong>
            {!! Form::text('santri_order_child', $santri->santri_order_child , ["class" => "form-control"]) !!}
        </div>
        <div class="form-group">
            <strong>Alamat</strong>
            {!! Form::textarea('santri_address', $santri->santri_address, ["class" => "form-control meta-desc"]) !!}
        </div>
      </div>
    </div>

    <div class="ibox float-e-margins">
      <div class="ibox-title">
        <div class="ibox-tools">
          <a class="collapse-link">
            <i class="fa fa-chevron-up"></i>
          </a>
        </div>
      </div>
      <div class="ibox-content">
        <div class="form-group">
            <strong>Nama Sekolah</strong>
            {!! Form::text('santri_school', $santri->santri_school , ["class" => "form-control"]) !!}
        </div>
        <div class="form-group">
            <strong>Alamat Sekolah</strong>
            {!! Form::textarea('santri_school_address', $santri->santri_school_address, ["class" => "form-control meta-desc"]) !!}
        </div>
      </div>
    </div>

    <div class="ibox float-e-margins">
      <div class="ibox-title">
        <div class="ibox-tools">
          <a class="collapse-link">
            <i class="fa fa-chevron-up"></i>
          </a>
        </div>
      </div>
      <div class="ibox-content">
        <div class="form-group">
            <strong>Nama Orang Tua</strong>
            {!! Form::text('santri_parent_name', $santri->santri_parent_name , ["class" => "form-control"]) !!}
        </div>
        <div class="form-group">
            <strong>Alamat Orang Tua</strong>
            {!! Form::textarea('santri_parent_address', $santri->santri_parent_address, ["class" => "form-control meta-desc"]) !!}
        </div>
        <div class="form-group">
            <strong>Pekerjaan Orang Tua</strong>
            {!! Form::text('santri_parent_job', $santri->santri_parent_job, ["class" => "form-control"]) !!}
        </div>
        <div class="form-group">
            <strong>Telepon Orang Tua</strong>
            {!! Form::text('santri_parent_telephone', $santri->santri_parent_job, ["class" => "form-control"]) !!}
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