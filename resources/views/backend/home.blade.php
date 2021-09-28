@extends('backend.layouts.app')
@section('controller','')
@section('controller_route', route('backend.home'))
@section('action','')
@section('content')
    <div class="content">
		<div class="row">
			<div class="col-md-3 col-sm-6 col-xs-12">
		        <div class="info-box bg-yellow">
		            <span class="info-box-icon"><i class="fa fa-bookmark-o"></i></span>

		            <div class="info-box-content">
		                <span class="info-box-text">Sản Phẩm</span>
		                <span class="info-box-number">{{ \App\Models\Products::count() }} sản phẩm</span>

		                <div class="progress">
		                    <div class="progress-bar" style="width: 70%"></div>
		                </div>
		                <span class="progress-description">
		                    <a href="{{ route('products.index') }}" style="color: #fff">Xem chi tiết</a>
		                </span>
		            </div>
		        </div>
		    </div>
			 <div class="col-md-3 col-sm-6 col-xs-12">
		        <div class="info-box bg-aqua">
		            <span class="info-box-icon"><i class="fa fa-bookmark-o"></i></span>

		            <div class="info-box-content">
		                <span class="info-box-text">Tin tức</span>
		                <span class="info-box-number">{{ \App\Models\Posts::count() }} tin tức</span>

		                <div class="progress">
		                    <div class="progress-bar" style="width: 70%"></div>
		                </div>
		                <span class="progress-description">
		                    <a href="{{ route('posts.index', ['type'=> 'blog']) }}" style="color: #fff">Xem chi tiết</a>
		                </span>
		            </div>
		        </div>
		    </div>
			 <div class="col-md-3 col-sm-6 col-xs-12">
		        <div class="info-box bg-green">
		            <span class="info-box-icon"><i class="fa fa-bookmark-o"></i></span>

		            <div class="info-box-content">
		                <span class="info-box-text">Tuyển dụng</span>
		                <span class="info-box-number">{{ \App\Models\Recruitment::count() }} tuyển dụng</span>

		                <div class="progress">
		                    <div class="progress-bar" style="width: 70%"></div>
		                </div>
		                <span class="progress-description">
		                    <a href="{{ route('recruitment.index') }}" style="color: #fff">Xem chi tiết</a>
		                </span>
		            </div>
		        </div>
			</div>

			<div class="col-md-3 col-sm-6 col-xs-12">
		        <div class="info-box bg-red">
		            <span class="info-box-icon"><i class="fa fa-bookmark-o"></i></span>

		            <div class="info-box-content">
		                <span class="info-box-text">Danh sách ứng tuyển</span>
		                <span class="info-box-number">{{ \App\Models\ApplyJob::count() }} ứng tuyển</span>

		                <div class="progress">
		                    <div class="progress-bar" style="width: 70%"></div>
		                </div>
		                <span class="progress-description">
		                    <a href="{{ route('get.list.job') }}" style="color: #fff">Xem chi tiết</a>
		                </span>
		            </div>
		        </div>
		    </div>
			
			 <div class="col-md-3 col-sm-6 col-xs-12">
		        <div class="info-box bg-red">
		            <span class="info-box-icon"><i class="fa fa-bookmark-o"></i></span>

		            <div class="info-box-content">
		                <span class="info-box-text">Liên hệ</span>
		                <span class="info-box-number">{{ \App\Models\Contact::count() }} liên hệ</span>

		                <div class="progress">
		                    <div class="progress-bar" style="width: 70%"></div>
		                </div>
		                <span class="progress-description">
		                    <a href="{{ route('get.list.contact') }}" style="color: #fff">Xem chi tiết</a>
		                </span>
		            </div>
		        </div>
		    </div>
		   
		</div>

		<div class="row">
			<div class="col-sm-12">
				<div class="box box-primary">
		            <div class="box-body">
		            	<div class="table-translate">
					        <table class="table table-hover">
					            <thead>
					                <tr>
					                    <th width="30px">STT</th>
					                    <th width="">Tên trang</th>
					                    <th width="">Liên kết</th>
					                </tr>
					            </thead>
					            <tbody class="table-body-pro">
					                @foreach ($dataPages as $item)
					                    <tr>
					                        <td>{{ $loop->index + 1 }}</td>
					                        <td>{{ $item->name_page }}</td>
					                        <td>
					                            @if (\Route::has($item->route))
					                                <a href="{{ route($item->route) }}" target="_blank">
					                                    <i class="fa fa-hand-o-right" aria-hidden="true"></i>
					                                    Link: {{ route($item->route) }}
					                                </a>
					                            @else
					                            	---------------
					                            @endif
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
    </div>
@endsection
