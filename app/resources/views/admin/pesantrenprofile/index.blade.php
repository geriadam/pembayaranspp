@extends('layouts.default')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="ibox">
            <div class="ibox-content">
                @if(count($model) == 0)
                    <a href="{{ route('admin.pesantrenprofile.create') }}">
                        <button type="button" class="btn btn-primary btn-raised"> Create</button>
                    </a>
                @else
                    <a href="#">
                        <button type="button" class="btn btn-primary btn-raised disabled"> Create</button>
                    </a>
                @endif
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
                                <th>Name</th>
                                <th>Address</th>
                                <th>Logo</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($model as $i => $pesantrenprofile)
                                <tr>
                                    <td>{{ $i+1 }}</td>
                                    <td>{{ $pesantrenprofile->pesantren_profile_name }}</td>
                                    <td>{{ $pesantrenprofile->pesantren_profile_address }}</td>
                                    <td>
                                        @if(!empty($pesantrenprofile->pesantren_profile_logo) 
                                            && file_exists(App\PesantrenProfile::IMAGE_PATH.$pesantrenprofile->pesantren_profile_logo))
                                          <br>
                                          <img src="{{ url(App\PesantrenProfile::IMAGE_PATH.$pesantrenprofile->pesantren_profile_logo) }}" width="100px" height="100px">
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.pesantrenprofile.edit', ['id' => $pesantrenprofile->pesantren_profile_id]) }}">
                                            <span class="btn btn-warning dim btn-sm glyphicon glyphicon-pencil"></span>
                                        </a>
                                        <a href="{{ route('admin.pesantrenprofile.destroy', ['id' => $pesantrenprofile->pesantren_profile_id]) }}" class="btn disabled" id="delete-btn">
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
<script src="{{ url('js/jquery.min.js') }}"></script>
@endsection