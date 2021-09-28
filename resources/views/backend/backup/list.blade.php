@extends('backend.layouts.app')
@section('controller', 'Backup' )
@section('controller_route', route('setting.backup'))
@section('action', 'Danh sách')
@section('content')
    <div class="content">
        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                @include('flash::message')
                <div class="btnAdd">
                    <a href="{{ route('setting.backup-source') }}">
                        <fa class="btn btn-primary"> Backup Source</fa>
                    </a>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
					  	Backup DB
					</button>
                    <!-- <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn xóa không ?')">
                        <i class="fa fa-trash-o"></i> Xóa
                    </button> -->
                </div>
                <table id="example1" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tiêu đề</th>
                            <th>Loại</th>
                            <th>Thời gian</th>
                            <th width="150px">Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($data as $item)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $item->title }}</td>
                            <td>
                                {{ $item->type == 'code' ? 'Source code' : 'Database' }}
                            </td>
                            <td>{{ $item->created_at }}</td>
                            <td>
                                <a href="{{ asset($item->link) }}" download>
                                    <i class="fa fa-download fa-fw"></i> Download
                                </a>
                                <a href="javascript:;" class="btn-destroy" data-href="{{ route('setting.destroy.backup', $item->id) }}"
                                    data-toggle="modal" data-target="#confim">
                                <i class="fa fa-trash-o fa-fw"></i> Xóa</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	    <div class="modal-dialog" role="document">
	        <div class="modal-content">
	        	<form action="{{ route('setting.backup-db') }}" method="POST">
	        		@csrf
		            <div class="modal-header">
		                <h5 class="modal-title" id="exampleModalLabel">Backup DB</h5>
		                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		                    <span aria-hidden="true">&times;</span>
		                </button>
		            </div>
		            <div class="modal-body">
                        <div class="form-group">
                            <label class="control-label mb-10" >Host</label>
                            <input type="text" class="form-control" placeholder="Enter Server Name EX: Localhost" name="host" id="host" required="">
                        </div>
                        <div class="form-group">
                            <label class="control-label mb-10" >Database Username</label>
                            <input type="text" class="form-control" placeholder="Enter Database Username EX: root" name="username" id="username" autocomplete="on">
                        </div>
                        <div class="form-group">
                            <label class="pull-left control-label mb-10" >Database Password</label>
                            <input type="password" class="form-control" placeholder="Enter Database Password" name="password" id="password" >
                        </div>
                        <div class="form-group">
                            <label class="pull-left control-label mb-10">Database Name</label>
                            <input type="text" class="form-control" placeholder="Enter Database Name" name="dbname" id="dbname"  autocomplete="on">
                        </div>
		            </div>
		            <div class="modal-footer">
		                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		                <button type="submit" class="btn btn-info btn-rounded">Initiate Backup</button>
		            </div>
		        </form>
	        </div>
	    </div>
	</div>
@stop
