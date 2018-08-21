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
        <button type="button" class="btn btn-success btn-add">Tambah (F2)</button>
        <table class="table table-stripped table-transaction">
          <thead>
              <th>No</th>
              <th>Jenis Pembayaran</th>
              <th>Harga</th>
              <th>Aksi</th>
          </thead>
          <tbody id="newClone">
          </tbody>
          <tfoot>
              <tr>
                  <td></td>
                  <td>Total Akhir</td>
                  <td><p id="label-transaction-total">Rp 0</p>
                      {!! Form::hidden('transaction_total', null, array('class' => 'form-control row-transaction-total')) !!}
                  </td>
                  <td>&nbsp;</td>
              </tr>
          </tfoot>
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
<script src="{{ url('js/jquery.min.js') }}"></script>
<script>
var i = 0;

function rearrangeRowNumber()
{
  $(".row-number").each(function(index){
    $(this).html(parseInt(index+1));
  });
}

function countSetTotal()
{
    var transactionTotal=0;
    $('.table-transaction td .price').each(function() {
        if ($(this).val() != ""){
            transactionTotal += parseFloat($(this).val());
        }
    });
    $(".row-transaction-total").val(transactionTotal);
    $("#label-transaction-total").html("Rp "+formatNumber(transactionTotal));
}

function getPaymentType(){
  showPaymentType   = "";
  var paymentType = <?php echo json_encode($paymenttype); ?>;  
  for(var key in paymentType) {
      if(paymentType.hasOwnProperty(key)){
          var showPaymentType = showPaymentType + "<option value='"+key+"' class='form-control'>"+paymentType[key]+"</option>";
      }
  }
  return showPaymentType;
}

function formatNumber(x) {
  return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

function addRow() 
{
    i++;
    var paymentType = getPaymentType();
    var add = '\n\
    <tr id="row-'+i+'" class="row-item"> \n\
      <td class="row-number"></td> \n\
      <td><select name="payment_type_id[]" class="form-control paymentType" data-item-id="'+i+'">';
        add = add + paymentType;
        add = add + '</select>\n\
        <br>\n\
        <div style="display:none" id="divMonth-'+i+'"> \n\
          <strong>Bulan</strong>\n\
          {!! Form::select("transaction_month[]",$month, date('m'), ["class" => "form-control", "id" => "i-month-'+i+'"]) !!}\n\
        </div> \n\
        <br>\n\
        <div style="display:none" id="divYear-'+i+'"> \n\
          <strong>Tahun</strong>\n\
          {!! Form::select("transaction_year[]",$year, date('Y'), ["class" => "form-control", "id" => "i-year-'+i+'"]) !!}\n\
        </div> \n\
      </td> \n\
      <td><p id="label-price-'+i+'"></p>\n\
          <input type="hidden" id="input-type-month-'+i+'">\n\
          <input name="transaction_price[]" type="hidden" class="price" value="" id="input-price-'+i+'"></td>\n\
      <td><button class="btn btn-danger btn_remove" id="'+i+'" type="button">\n\
            <span class="glyphicon glyphicon-trash"></span>\n\
          </button></td>\n\
    </tr>';
    $('#newClone').append(add);
    rearrangeRowNumber();
}

$(document).on("change", ".paymentType", function(){
  var index = $(this).attr('data-item-id');
  var value = $(this).val();
  $.get("../transaksi/payment/"+value+"", function(data){
    $("#label-price-"+index+"").html("Rp "+formatNumber(data.payment_type_price));
    $("#input-price-"+index+"").val(data.payment_type_price);
    $("#input-type-month-"+index+"").val(data.payment_type_unit);
    countSetTotal();

    var label = $("#input-type-month-"+index+"").val();
    console.log(label)
    if(label == 'month'){
      $("#divMonth-"+index).css('display', 'block');
      $("#divYear-"+index).css('display', 'block');

      $("#i-month-"+index).focus();
    } else {
      $("#divMonth-"+index).css('display', 'none');
      $("#divYear-"+index).css('display', 'none');
    }
  });
});


// Untuk Tombol Add dan Remove
$(".btn-add").click(function(){
  addRow();
});

$(document).on('click','.btn_remove', function(){
    var id = $(this).attr("id");
    $("#row-"+id+"").remove();

    rearrangeRowNumber();
    countSetTotal();
});

$(document).keydown(function(event) {
    if(event.which == 113) { //F2
        $(".btn-add").trigger("click")
    }
});

</script>
@endsection













