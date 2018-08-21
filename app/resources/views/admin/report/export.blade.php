<html>
<head>
    <title>Laporan - {{ \Carbon\Carbon::parse(date('d-m-Y'))->format('d M Y') }}</title>
    <style type="text/css">
        .hr { width: 100%;border-style: solid;border-top-width: 0.5px;border-bottom-width: 0.5px;margin-top: 5px;margin-bottom: 25px }
        #table-santri-detail td, #table-detail-transaksi td, #table-item-transaksi td, #table-item-transaksi th { font-size: 9pt; }

        #table-santri-detail .title-detail-santri { width: 30%; }
        #table-detail-transaksi { margin-bottom: 20px; margin-top: 20px }
        #detail-profile h2 { margin-bottom: 0 }
        #detail-profile h6 { margin-bottom: 0 }
    </style>
</head>
<body>
    <table border="0" width="100%" id="detail-profile">
        <tr>
            <td width="70%" align="center">
                <h2>{{ $profile->pesantren_profile_name }}</h2>
                <h6>{{ $profile->pesantren_profile_address }}</h6>
            </td>
            <td rowspan="2" align="center">
                @if(!empty($profile->pesantren_profile_logo) 
                    && file_exists(App\PesantrenProfile::IMAGE_PATH.$profile->pesantren_profile_logo))
                  <img src="{{ url(App\PesantrenProfile::IMAGE_PATH.$profile->pesantren_profile_logo) }}" width="50" height="50">
                @endif
            </td>
        </tr>
    </table>
    <div class="hr"></div>
    <table border="0" width="100%" id="table-item-transaksi">
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="25%">Nama Santri</th>
                <th width="25%">No Transaksi</th>
                <th width="20%">Tanggal Transaksi</th> 
                <th width="20%">Total</th>
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
        <tfoot>
            <tr>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td colspan="3"></td>
                <td>Total</td>
                <td><b>{{NumberHelper::format_uang($total) }}</b></td>
            </tr>
        </tfoot>
    </table>
</body>
</html> 