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
                <a href="{{ route('admin.transaction.index') }}">
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
    {{ Form::open(['route' => 'admin.transaction.store']) }}
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
            {!! Form::select('santri_id', $santri ,null , ["class" => "form-control select2-select"]) !!}
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
        <label>Tahun</label>
        {!! Form::selectYear('transaction_year', date('Y', strtotime("-2 Year")), date('Y', strtotime("+2 year")), date('Y'), ['class' => 'form-control']) !!}
        <table class="table table-stripped table-transaction">
          <thead>
              <tr>
                <th rowspan="2">No</th>
                <th rowspan="2">Jenis Pembayaran</th>
                <th colspan="12">Bulan</th>
              </tr>
              <tr>
                <th>Januari</th>
                <th>Februari</th>
                <th>Maret</th>
                <th>April</th>
                <th>Mei</th>
                <th>Juni</th>
                <th>Juli</th>
                <th>Agustus</th>
                <th>September</th>
                <th>Oktober</th>
                <th>November</th>
                <th>Desember</th>
              </tr>
          </thead>
          <tbody>
            @foreach($paymentType as $no => $payment)
              <tr>
                <td>
                  {{ ++$no }}
                </td>
                <td>
                  {!! Form::hidden('payment_type_id[]', $payment->payment_type_id, ["class" => "form-control"]) !!}
                  {!! Form::text('payment_type_name[]', $payment->payment_type_name, ["class" => "form-control"]) !!}
                </td>
                <td>
                  {!! Form::checkbox("transaction_month[$payment->payment_type_id][]", 1, false) !!}
                </td>
                <td>
                  {!! Form::checkbox("transaction_month[$payment->payment_type_id][]", 2, false) !!}
                </td>
                <td>
                  {!! Form::checkbox("transaction_month[$payment->payment_type_id][]", 3, false) !!}
                </td>
                <td>
                  {!! Form::checkbox("transaction_month[$payment->payment_type_id][]", 4, false) !!}
                </td>
                <td>
                  {!! Form::checkbox("transaction_month[$payment->payment_type_id][]", 5, false) !!}
                </td>
                <td>
                  {!! Form::checkbox("transaction_month[$payment->payment_type_id][]", 6, false) !!}
                </td>
                <td>
                  {!! Form::checkbox("transaction_month[$payment->payment_type_id][]", 7, false) !!}
                </td>
                <td>
                  {!! Form::checkbox("transaction_month[$payment->payment_type_id][]", 8, false) !!}
                </td>
                <td>
                  {!! Form::checkbox("transaction_month[$payment->payment_type_id][]", 9, false) !!}
                </td>
                <td>
                  {!! Form::checkbox("transaction_month[$payment->payment_type_id][]", 10, false) !!}
                </td>
                <td>
                  {!! Form::checkbox("transaction_month[$payment->payment_type_id][]", 11, false) !!}
                </td>
                <td>
                  {!! Form::checkbox("transaction_month[$payment->payment_type_id][]", 12, false) !!}
                </td>
              </tr>
            @endforeach
          </tbody>
      </table>
      </div>
      <div class="ibox-content">
        <button type="submit" value="save" name="submit" class="btn btn-primary">Save</button>
        <button type="submit" value="save-print" name="submit" class="btn btn-info">Save & Print</button>
      </div>
    </div>
    {!! Form::close() !!}
  </div>
</div>
@endsection













