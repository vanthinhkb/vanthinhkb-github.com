@extends('backend.layouts.app')
@section('controller','Trang')
@section('controller_route',route('pages.list'))
@section('action','Danh sách')
@section('content')
	<div class="content">
		<div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
               	@include('flash::message')
               	<form action="{{ route('pages.build.post') }}" method="POST">
					{{ csrf_field() }}
					<input name="type" value="{{ $data->type }}" type="hidden">
					<input name="lang" value="{{ $data->lang }}" type="hidden">

					<div class="row">
						<div class="col-sm-12">
							<div class="form-group">
								<label for="">Trang</label>
								<input type="text" class="form-control" value="{{ $data->name_page }}" disabled="">
				 				
								@if (\Route::has($data->route))
									<h5>
										<a href="{{ route($data->route) }}" target="_blank">
					                        <i class="fa fa-hand-o-right" aria-hidden="true"></i>
					                        Link: {{ route($data->route) }}
					                    </a>
									</h5>
				                @endif
							</div>
							
						</div>
					</div>
					<div class="nav-tabs-custom">
				        <ul class="nav nav-tabs">
							<li class="active">
				            	<a href="#about" data-toggle="tab" aria-expanded="true">Về chúng tôi</a>
				            </li>

				            <li class="">
				            	<a href="#why" data-toggle="tab" aria-expanded="true">Tại sao chọn chúng tôi</a>
				            </li>
				        </ul>
				    </div>
				    <?php if(!empty($data->content)){
						$content = json_decode($data->content);

					} ?>
				    <div class="tab-content">

				    	<div class="tab-pane active" id="about">
				    		<div class="row">
								<div class="col-sm-12">
									<div class="form-group">
										<label for="">Tiêu đề</label>
										<input type="text" class="form-control" name="content[about][title]" value="{{ @$content->about->title }}">
									</div>
								</div>
								<div class="col-sm-2">
									<div class="form-group">
			                           <label>Hình ảnh</label>
			                           <div class="image">
			                               <div class="image__thumbnail">
			                                   <img src="{{ @$content->about->image ?  $url.$content->about->image : __IMAGE_DEFAULT__ }}"  
			                                   data-init="{{ __IMAGE_DEFAULT__ }}">
			                                   <a href="javascript:void(0)" class="image__delete" onclick="urlFileDelete(this)">
			                                    <i class="fa fa-times"></i></a>
			                                   <input type="hidden" value="{{ @$content->about->image }}" name="content[about][image]"  />
			                                   <div class="image__button" onclick="fileSelect(this)"><i class="fa fa-upload"></i> Upload</div>
			                               </div>
			                           </div>
			                       </div>
								</div>
								<div class="col-sm-10">
									<div class="form-group">
										<label for="">Mô tả</label>
										<textarea class="content" name="content[desc]">{!! @$content->desc !!}</textarea>
									</div>
								</div>
				    		</div>
				    	</div>

				    	<div class="tab-pane" id="why">
				    		<div class="col-sm-12">
								<div class="repeater" id="repeater">
									<table class="table table-bordered table-hover whychoose">
										<thead>
											<tr>
												<th style="width: 30px;">STT</th>
												<th style="width: 200px;">Icon</th>
												<th>Nội dung</th>
												<th></th>
											</tr>
										</thead>
										<tbody id="sortable">
											@if (!empty($content->whychoose->list))
												@foreach ($content->whychoose->list as $key => $value)
													<?php $index = $loop->index + 1 ; ?>
													@include('backend.repeater.row-whychoose')
												@endforeach
											@endif
										</tbody>
									</table>
									<div class="text-right">
										<button class="btn btn-primary" style="display: none"
											onclick="repeater(event,this,'{{ route('get.layout') }}','.index', 'whychoose', '.whychoose')">Thêm
										</button>
									</div>
								</div>
							</div>
				    	</div>
			           	<button type="submit" class="btn btn-primary">Lưu lại</button>
			        </div>
				</form>
			</div>
		</div>
	</div>
@stop