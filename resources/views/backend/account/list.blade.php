@extends('backend.layouts.app')
@section('controller','Thành viên')
@section('action','Danh sách')
@section('controller_route', route('account.index'))
@section('content')
	<div class="content">
		<div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
               	@include('flash::message')
			    <table id="example1" class="table table-bordered table-striped">
			    	<thead>
			    		<tr>
			    			<th>STT</th>
			    			<th>Tên thành viên</th>
			    			<th>Số điện thoại</th>
			    			<th>Email</th>
			    			<th>Trạng thái</th>
			    			<th>Hành động</th>
			    		</tr>
			    	</thead>
			    	<tbody>
			    		@foreach ($data as $item)
			    		<tr>
			    			<td>{{ $loop->index +1 }}</td>
			    			<td>
			    				{{ $item->name }}
			    			</td>
			    			<td>{{ $item->phone }}</td>
			    			<td>{{ $item->email }}</td>
			    			<td>
			    				@if ($item->status == 1)
			    					<span class="label label-success">Đang hoạt động</span>
			    				@else
			    					<span class="label label-danger">Đang khóa</span>
			    				@endif
			    			<td>
		    					@if ($item->user_name != 'gco_admin')
			    					<a href="javascript:;" class="btn-destroy" data-href="{{ route( 'account.destroy',  $item->id ) }}"
			    						data-toggle="modal" data-target="#confim">
			    						<i class="fa fa-trash-o fa-fw"></i> Xóa
			    					</a>
			    					@if($item->status == 1)
			    					<a href="{{ route( 'account.unlock', ['id'=>$item->id] ) }}" class="btn-destroy">
			    						<i class="fa fa-unlock"></i> Khóa
			    					</a>
			    					@else
			    					<a href="{{ route( 'account.lock',  ['id'=>$item->id] ) }}" class="btn-destroy">
			    						<i class="fa fa-unlock-alt"></i> Mở
			    					</a>
			    					@endif
								@endif
								<a href="{{ route( 'account.detail',  ['id'=>$item->id] ) }}" class="btn-destroy">
		    						<i class="fa fa-eye fa-fw"></i> Xem
		    					</a>
			    			</td>
			    		</tr>
			    		@endforeach
		    		</tbody>
		    	</table>
           </div>
        </div>
	</div>
@stop