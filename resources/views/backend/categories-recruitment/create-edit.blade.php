@extends('backend.layouts.app')
@section('controller', 'Danh mục tuyển dụng' )
@section('controller_route', route('categories-recruitment.index'))
@section('action', renderAction(@$module['action']))
@section('content')
	<div class="content">
		<div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
               	@include('flash::message')
               	<form action="{!! updateOrStoreRouteRender( @$module['action'], $module['module'], @$data) !!}" method="POST">
					@csrf
					@if(isUpdate(@$module['action']))
				        {{ method_field('put') }}
				    @endif
				    <div class="nav-tabs-custom">
		                <ul class="nav nav-tabs">
		                    <li class="active">
		                        <a href="#activity" data-toggle="tab" aria-expanded="true">Danh mục tuyển dụng</a>
		                    </li>
		                    <li class="">
		                    	<a href="#setting" data-toggle="tab" aria-expanded="true">Cấu hình seo</a>
		                    </li>
		                </ul>
		                <div class="tab-content">
		                    <div class="tab-pane active" id="activity">
								<div class="form-group">
									<label for="">Tên danh mục</label>
									<input type="text" class="form-control" name="name" id="name" value="{{ old('name', @$data->name) }}">
								</div>
								<div class="form-group">
									<label for="">Tên danh mục tiếng anh</label>
									<input type="text" class="form-control" name="name_en" id="name_en" value="{{ old('name_en', @$data->name_en) }}">
								</div>
								<div class="form-group">
									<label for="">Đường dẫn tĩnh</label>
									<input type="text" class="form-control" name="slug"  id="slug" value="{{ old('slug', @$data->slug) }}">
								</div>
		                    </div>
		                    <div class="tab-pane" id="setting">
		                    	<div class="row">
		                    		{{-- <div class="col-sm-2">
		                    			<div class="form-group">
		                    				<label for="">Hình ảnh</label>
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
		                    		<div class="col-sm-2">
		                    			<div class="form-group">
		                    				<label for="">Banner</label>
		                    				 <div class="image">
					                            <div class="image__thumbnail">
					                                <img src="{{ !empty(@$data->banner) ? @$data->banner : __IMAGE_DEFAULT__ }}"
					                                     data-init="{{ __IMAGE_DEFAULT__ }}">
					                                <a href="javascript:void(0)" class="image__delete" onclick="urlFileDelete(this)">
					                                    <i class="fa fa-times"></i></a>
					                                <input type="hidden" value="{{ old('banner', @$data->banner) }}" name="banner"/>
					                                <div class="image__button" onclick="fileSelect(this)">
					                                	<i class="fa fa-upload"></i>
					                                    Upload
					                                </div>
					                            </div>
					                        </div>
		                    			</div>
		                    		</div> --}}
		                    		<div class="col-sm-12">
		                    			 <div class="form-group">
				                            <label>Title SEO</label>
				                            <input type="text" class="form-control" name="meta_title" value="{!! old('meta_title', @$data->meta_title) !!}">
				                        </div>

				                        <div class="form-group">
				                            <label>Meta Description</label>
				                            <textarea name="meta_description" id="" class="form-control" rows="5">{!! old('meta_description', @$data->meta_description) !!}</textarea>
				                        </div>

				                        <div class="form-group">
				                            <label>Meta Keyword</label>
				                            <input type="text" class="form-control" name="meta_keyword" value="{!! old('meta_keyword', @$data->meta_keyword) !!}">
				                        </div>
		                    		</div>
		                    	</div>
		                    </div>
		                    <button type="submit" class="btn btn-primary">Lưu lại</button>
		                </div>
		            </div>
				</form>
			</div>
		</div>
	</div>
@stop