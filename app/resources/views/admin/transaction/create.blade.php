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
            {!! Form::select('santri_id', $santri ,null , ["class" => "form-control"]) !!}
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
        <button type="button" class="btn btn-success btn-add">Tambah</button>
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
        <button type="submit" class="btn btn-primary">Save</button>
        <button type="reset" class="btn btn-danger btn-large">Reset</button>
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
    var add = '<tr id="row-'+i+'" class="row-item">';
    add += '<td class="row-number"></td>';
    add += '<td><select name="payment_type_id[]" class="form-control paymentType" data-item-id="'+i+'">';
    add = add + paymentType;
    add = add + '</select></td>';
    add += '<td><p id="label-price-'+i+'"></p>';
    add += '<input name="transaction_price[]" type="hidden" class="price" value="" id="input-price-'+i+'"></td>';
    add += '<td><button class="btn btn-danger btn_remove" id="'+i+'" type="button">'
    add += '<span class="glyphicon glyphicon-trash"></span>'
    add += '</button></td>';
    add += '</tr>';
    $('#newClone').append(add);
    rearrangeRowNumber();
}

$(document).on("change", ".paymentType", function(){
  var index = $(this).attr('data-item-id');
  var value = $(this).val();
  $.get("../transaksi/payment/"+value+"", function(data){
    $("#label-price-"+index+"").html("Rp "+formatNumber(data.payment_type_price));
    $("#input-price-"+index+"").val(data.payment_type_price);
    countSetTotal();
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

</script>
@endsection













