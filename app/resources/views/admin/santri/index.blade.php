@extends('layouts.default')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="ibox">
            <div class="ibox-content">
                <a href="{{ route('admin.santri.create') }}">
                    <button type="button" class="btn btn-primary btn-raised"> Create</button>
                </a>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="ibox">
            <div class="ibox-content">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTable" id="index-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th width="20%">Nama Santri</th>
                                <th width="20%">Tempat, Tanggal Lahir</th>
                                <th width="20%">Jenis Kelamin</th>
                                <th width="20%">No Telepon Ortu</th>
                                <th width="20%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($model as $i => $santri)
                                <tr>
                                    <td>{{ $i+1 }}</td>
                                    <td>{{ $santri->santri_name }}</td>
                                    <td>{{ $santri->santri_birth_place }}, 
                                        {{ \Carbon\Carbon::parse($santri->santri_birth_date)->format("d M Y") }}
                                    </td>
                                    <td>{{ $santri->santri_gender == 'man' ? 'Laki-Laki' : 'Perempuan' }}</td>
                                    <td>{{ $santri->santri_parent_telephone }}</td>
                                    <td>
                                        <a href="{{ route('admin.santri.show', ['id' => $santri->santri_id]) }}" class="buttonShow">
                                            <span class="btn btn-primary dim btn-sm glyphicon glyphicon-eye-open"></span>
                                        </a>
                                        <a href="{{ route('admin.santri.detail', ['id' => $santri->santri_id]) }}">
                                            <span class="btn btn-info dim btn-sm glyphicon glyphicon-tags"></span>
                                        </a>
                                        <a href="{{ route('admin.santri.edit', ['id' => $santri->santri_id]) }}">
                                            <span class="btn btn-warning dim btn-sm glyphicon glyphicon-pencil"></span>
                                        </a>
                                        <a href="{{ route('admin.santri.destroy', ['id' => $santri->santri_id]) }}" id="delete-btn">
                                            <span class="btn btn-danger dim btn-sm glyphicon glyphicon-remove-sign"></span>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div> 
@endsection