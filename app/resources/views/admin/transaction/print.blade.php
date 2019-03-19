<html>
<head>
    <title>Print Transaksi - {{ \Carbon\Carbon::parse(date('d-m-Y'))->format('d M Y') }}</title>
    <style type="text/css">
        body, html { height: 100%; padding: 30px; margin: 0;  }
        .hr { width: 100%;border-style: dashed;border-top-width: 0.5px;border-bottom-width: 0.5px;margin-top: 5px;margin-bottom: 25px }
        #table-santri-detail td, #table-detail-transaksi td, #table-item-transaksi td, #table-item-transaksi th { font-size: 9pt; }
        #table-santri-detail .title-detail-santri { width: 30%; }
        #table-detail-transaksi { margin-bottom: 20px; margin-top: 60px }
        #detail-profile h2 { margin-bottom: 0 }
        #detail-profile h6 { margin-bottom: 0 }
        .ganti-baris { margin-top: 60px }
    </style>
</head>
<body>
        <table align="center" id="table-detail-transaksi">
            <tr>
                <td width="10%">No. Transaksi</td>
                <td>:</td>
                <td>#{{ $model->transaction_number }}</td>
            </tr>
            <tr>
                <td width="10%">Operator</td>
                <td>:</td>
                <td>{{ \Session::get('name') }}</td>
            </tr>
            <tr>
                <td width="10%">Waktu</td>
                <td>:</td>
                <td>{{ \Carbon\Carbon::parse(date('d-m-Y H:i:s'))->format("d/m/Y H:i:s") }}</td>
            </tr>
            <tr>
                <td class="title-detail-santri">Nama Santri</td>
                <td width="5%">:</td>
                <td>{{ $model->santri->santri_name }}</td>
            </tr>
            <tr>
                <td class="title-detail-santri">Tempat, Tanggal lahir</td>
                <td width="5%">:</td>
                <td>{{ $model->santri->santri_birth_place }}, {{ \Carbon\Carbon::parse($model->santri->santri_birth_date)->format("d M Y") }}</td>
            </tr>
            <tr>
                <td class="title-detail-santri">Jenis Kelamin</td>
                <td width="5%">:</td>
                <td>{{ $model->santri->santri_gender == 'man' ? 'Laki' : 'Perempuan' }}</td>
            </tr>
            <tr>
                <td class="title-detail-santri">Alamat</td>
                <td width="5%">:</td>
                <td>{{ $model->santri->santri_address }}</td>
            </tr>
        </table>
    <br>
    <table border="0" width="100%" id="table-item-transaksi">
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="25%">Jenis Pembayaran</th>
                <th width="20%">Bulan</th> 
                <th width="20%">Rupiah</th>
            </tr>
        </thead>
        <tbody>
            @foreach($modelItem as $i => $transactionitem)
                <tr>
                    <td>{{ $i+1 }}</td>
                    <td>{{ $transactionitem->paymenttype->payment_type_name }}</td>
                    <td>
                        @if($transactionitem->transaction_month != 0)
                            {{ $month[$transactionitem->transaction_month] }}-{{ $transactionitem->transaction_year }}
                        @else
                            {{ "-" }}
                        @endif
                    </td>
                    <td>{{ NumberHelper::format_uang($transactionitem->transaction_price) }}</td>
                </tr> 
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td colspan="2"></td>
                <td>Total</td>
                <td><b>{{NumberHelper::format_uang($model->transaction_total) }}</b></td>
            </tr>
        </tfoot>
    </table>
</body>
</html> 