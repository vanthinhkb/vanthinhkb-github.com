@extends('backend.layouts.app')
@section('controller', $module['name'] )
@section('controller_route', route($module['module'].'.index'))
@section('action', renderAction(@$module['action']))
@section('content')
	<div class="content">
		<div class="clearfix"></div>
       	@include('flash::message')
       	<form action="{!! updateOrStoreRouteRender( @$module['action'], $module['module'], @$data) !!}" method="POST">
			@csrf
			@if(isUpdate(@$module['action']))
		        {{ method_field('put') }}
		    @endif
			<div class="row">
				<div class="col-sm-9">
					<div class="nav-tabs-custom">
		                <ul class="nav nav-tabs">
							<li class="active">
		                        <a href="#info" data-toggle="tab" aria-expanded="true">Nội dung thông báo</a>
							</li>
		                </ul>
		                <div class="tab-content">

							<div class="tab-pane active" id="info">
								<div class="row">
			                        <div class="col-sm-6">
			                            <div class="form-group">
											<label for="">Tiêu đề tiếng việt</label>
											<input type="text" name="title" class="form-control" value="{{ @$data->title }}">
										</div>
										<div class="form-group">
											<label for="">Nội dung tiếng việt</label>
											<textarea name="content" class="form-control" rows="8">{!! @$data->content !!}</textarea>
										</div>
									</div>
									<div class="col-sm-6">
			                            <div class="form-group">
											<label for="">Tiêu đề tiếng anh</label>
											<input type="text" name="title_en" class="form-control" value="{{ @$data->title_en }}">
										</div>
										<div class="form-group">
											<label for="">Nội dung tiếng anh</label>
											<textarea name="content_en" class="form-control" rows="8">{!! @$data->content_en !!}</textarea>
										</div>
			                        </div>
			                    </div>
							</div>
						</div>
		            </div>
				</div>
				<div class="col-sm-3">
					<div class="box box-success">
		                <div class="box-header with-border">
		                    <h3 class="box-title">Hình ảnh</h3>
		                </div>
		                <div class="box-body">
		                    <div class="form-group">
		                        <label class="custom-checkbox">
		                        	@if(isUpdate(@$module['action']))
		                            	<input type="checkbox" name="status" value="1" {{ @$data->status == 1 ? 'checked' : null }}> Hiển thị
		                            @else
		                            	<input type="checkbox" name="status" value="1" checked> Hiển thị
		                            @endif
		                        </label>
		                    </div>
		                    <div class="form-group text-right">
		                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Lưu lại</button>
		                    </div>
		                </div>
		            </div>
					
		            <div class="box box-success">
		                <div class="box-header with-border">
		                    <h3 class="box-title">Hình ảnh</h3>
		                </div>
		                <div class="box-body">
		                    <div class="form-group" style="text-align: center;">
		                        <div class="image">
		                            <div class="image__thumbnail">
		                                <img src="{{ !empty(@$data->image) ? @$data->image : __IMAGE_DEFAULT__ }}"
		                                     data-init="{{ __IMAGE_DEFAULT__ }}">
		                                <a href="javascript:void(0)" class="image__delete" onclick="urlFileDelete(this)">
		                                    <i class="fa fa-times"></i></a>
		                                <input type="hidden" value="{{ old('image', @$data->image) }}" name="image"/>
		                                <div class="image__button" onclick="fileSelect(this)">
		                                	<i class="fa fa-upload"></i>
		                                    Upload
		                                </div>
		                            </div>
		                        </div>
		                    </div>
		                </div>
		            </div>
				</div>
			</div>
		</form>
	</div>
@stop
