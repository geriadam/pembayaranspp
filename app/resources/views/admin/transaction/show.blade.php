<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title" id="myModalLabel">Detail</h4>
</div>
<div class="modal-body" id="modalShow">
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
            @foreach($model as $i => $transactionitem)
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
<div class="modal-footer">
    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
</div>