<div class="modal-header btn-primary">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title" id="myModalLabel">Detail</h4>
</div>
<div class="modal-body" id="modalShow">
    <div class="ibox float-e-margins">
      <div class="ibox-title">
        Info
      </div>
      <div class="ibox-content">
        <table class="table table-responsive table-striped">
            <thead>
                <tr>
                    <td width="40%">Nomor Santri</td>
                    <td width="5%">:</td>
                    <td width="50%">{{ $santri->santri_number }}</td>
                </tr>
                <tr>
                    <td width="40%">Nama Santri</td>
                    <td width="5%">:</td>
                    <td width="50%">{{ $santri->santri_name }}</td>
                </tr>
                <tr>
                    <td width="40%">Nama Panggilan</td>
                    <td width="5%">:</td>
                    <td width="50%">{{ $santri->santri_nick_name }}</td>
                </tr>
                <tr>
                    <td width="40%">Tempat, Tanggal lahir</td>
                    <td width="5%">:</td>
                    <td width="50%">{{ \Carbon\Carbon::parse($santri->santri_birth_date)->format("d M Y") }}</td>
                </tr>
                <tr>
                    <td width="40%">Jenis Kelamin</td>
                    <td width="5%">:</td>
                    <td width="50%">
                        @if($santri->santri_gender == 'man')
                            {{ "Laki-Laki" }}
                        @else
                            {{ "Perempuan" }}
                        @endif
                    </td>
                </tr>
                <tr>
                    <td width="40%">Anak Ke - </td>
                    <td width="5%">:</td>
                    <td width="50%">{{ $santri->santri_order_child }}</td>
                </tr>
                <tr>
                    <td width="40%">Alamat</td>
                    <td width="5%">:</td>
                    <td width="50%">{{ $santri->santri_address }}</td>
                </tr>
            </thead>
        </table>
      </div>
    </div>

    <div class="ibox float-e-margins">
      <div class="ibox-title">
        Sekolah
      </div>
      <div class="ibox-content">
        <table class="table table-responsive table-striped">
            <thead>
                <tr>
                    <td width="40%">Nama Sekolah</td>
                    <td width="5%">:</td>
                    <td width="50%">{{ $santri->santri_school }}</td>
                </tr>
                <tr>
                    <td width="40%">Alamat Sekolah</td>
                    <td width="5%">:</td>
                    <td width="50%">{{ $santri->santri_school_address }}</td>
                </tr>
            </thead>
        </table>
      </div>
    </div>

    <div class="ibox float-e-margins">
      <div class="ibox-title">
        Info Orang Tua
      </div>
      <div class="ibox-content">
        <table class="table table-responsive table-striped">
            <thead>
                <tr>
                    <td width="40%">Nama Orang Tua</td>
                    <td width="5%">:</td>
                    <td width="50%">{{ $santri->santri_parent_name }}</td>
                </tr>
                <tr>
                    <td width="40%">Alamat Orang Tua</td>
                    <td width="5%">:</td>
                    <td width="50%">{{ $santri->santri_parent_address }}</td>
                </tr>
                <tr>
                    <td width="40%">Pekerjaan Orang Tua</td>
                    <td width="5%">:</td>
                    <td width="50%">{{ $santri->santri_parent_job }}</td>
                </tr>
                <tr>
                    <td width="40%">Telepon Orang Tua</td>
                    <td width="5%">:</td>
                    <td width="50%">{{ $santri->santri_parent_telephone }}</td>
                </tr>
            </thead>
        </table>
      </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
</div>