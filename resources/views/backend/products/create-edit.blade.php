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
		                        <a href="#activity" data-toggle="tab" aria-expanded="true">Thông tin sản phẩm</a>
							</li> 
		                    <li class="">
		                    	<a href="#gallery" data-toggle="tab" aria-expanded="true">Thư viện ảnh</a>
							</li>
							<li class="">
		                    	<a href="#setting" data-toggle="tab" aria-expanded="true">Cấu hình seo</a>
		                    </li>
		                </ul>
		                <div class="tab-content">

		                    <div class="tab-pane active" id="activity">
		                    	<div class="row">
                                    <?php 
		                    			$code = old('code', @$data->code);
		                    			if(empty($code)){
		                    				$code = generateRandomCode();
										}
										$url = explode("/",url('/'));
        								$url = $url[0].'//'.$url[2];
		                    		?>
		                    		<div class="col-sm-12">
		                    			<div class="form-group">
				                    		<label for="">Mã sản phẩm</label>
				                    		<input type="text" name="code" class="form-control" value="{{ @$code }}">
				                    	</div>
		                    		</div>
		                    		<div class="col-sm-6">
		                    			<div class="form-group">
		                                    <label>Tên sản phẩm tiếng việt</label>
		                                    <input type="text" class="form-control" name="name" value="{!! old('name', @$data->name) !!}" required="">
										</div>
									</div>
									<div class="col-sm-6">
		                    			<div class="form-group">
		                                    <label>Tên sản phẩm tiếng anh</label>
		                                    <input type="text" class="form-control" name="name_en" value="{!! old('name_en', @$data->name_en) !!}" required="">
		                                </div>
		                                
									</div>
									<div class="col-sm-12">
										@if(isUpdate(@$module['action']))
											<div class="form-group" id="edit-slug-box">
												@include('backend.products.permalink')
											</div>
										@endif
									</div>
                                    <div class="col-sm-12">
										<div class="form-group">
											<label for="">Giá bán</label>
										</div>
										<div class="row">
											<div class="col-sm-12">
												<?php $price = @$data->price != 0 ? @$data->price : null ?>
												<div class="col-sm-1">
													<div class="form-group">
														<label class="custom-checkbox">
															@if(isUpdate(@$module['action']))
																<input type="radio" name="checkprice" value="0" {{ @$data->checkprice == 0 ? 'checked' : null }}>
															@else
																<input type="radio" name="checkprice" value="0" checked>
															@endif
														</label>
													</div>
												</div>
												<div class="col-sm-5">
													<div class="form-group">
														<input type="text" id="price" class="form-control" value="{{ is_numeric(@$data->price) ? number_format(@$price, '0', ',' , ',') : '' }}">
														<input type="hidden" name="price" value="{{ old('price', @$price) }}">
													</div>
												</div>
											</div>
											<div class="col-sm-12">
												<div class="col-sm-1">
													<div class="form-group">
														<label class="custom-checkbox">
															@if(isUpdate(@$module['action']))
																<input type="radio" name="checkprice" value="1" {{ @$data->checkprice == 1 ? 'checked' : null }}>
															@else
																<input type="radio" name="checkprice" value="1">
															@endif
														</label>
													</div>
												</div>
												<div class="col-sm-5">
													<div class="form-group">
														<input type="text" class="form-control" value="Liên hệ" readonly>
														<input type="hidden" name="contact" value="lien_he">
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label for="">Xuất xứ tiếng việt</label>
											<input type="text" class="form-control" name="origin" value="{{ old('origin', @$data->origin) }}">
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label for="">Xuất xứ tiếng anh</label>
											<input type="text" class="form-control" name="origin_en" value="{{ old('origin_en', @$data->origin_en) }}">
										</div>
									</div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="">Mô tả tiếng việt</label>
                                            <textarea class="content" name="content" rows="5">{!! old('content', @$data->content) !!}</textarea>
                                        </div>
									</div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="">Mô tả tiếng anh</label>
                                            <textarea class="content" name="content_en" rows="5">{!! old('content_en', @$data->content_en) !!}</textarea>
                                        </div>
                                    </div>
		                    	</div>
							</div>

		                    <div class="tab-pane" id="gallery">
		                    	<div class="row">
			                        <div class="col-sm-12 image">
			                            <button type="button" class="btn btn-success" onclick="fileMultiSelect(this)"><i class="fa fa-upload"></i>  
			                                Chọn hình ảnh
			                            </button>
			                            <br><br>
			                            <div class="image__gallery">
			                            	@if (!empty($data->more_image))
			                            		<?php $more_image = json_decode($data->more_image) ?>
			                            		@foreach ($more_image as $item)
			                            			<div class="image__thumbnail image__thumbnail--style-1">
			                            				<img src="{{ $url.@$item }}">
			                            				<a href="javascript:void(0)" class="image__delete" onclick="urlFileMultiDelete(this)">
			                            					<i class="fa fa-times"></i>
			                            			    </a>
			                            				<input type="hidden" name="gallery[]" value="{{ @$item }}">
			                            			</div>
			                            		@endforeach
			                            	@endif
			                            </div>
			                        </div>
			                    </div>
							</div>
							<div class="tab-pane" id="setting">
		                    	<div class="form-group">
			                        <label>Title SEO</label>
			                        <label style="float: right;">Số ký tự đã dùng: <span id="countTitle">{{ @$data->meta_title != null ? mb_strlen( $data->meta_title, 'UTF-8') : 0 }}/70</span></label>
			                        <input type="text" class="form-control" name="meta_title" value="{!! old('meta_title', isset($data->meta_title) ? $data->meta_title : null) !!}" id="meta_title">
			                    </div>

			                    <div class="form-group">
			                        <label>Meta Description</label>
			                        <label style="float: right;">Số ký tự đã dùng: <span id="countMeta">{{ @$data->meta_description != null ? mb_strlen( $data->meta_description, 'UTF-8') : 0 }}/360</span></label>
			                        <textarea name="meta_description" class="form-control" id="meta_description" rows="3">{!! old('meta_description', isset($data->meta_description) ? $data->meta_description : null) !!}</textarea>
			                    </div>

			                    <div class="form-group">
			                        <label>Meta Keyword</label>
			                        <input type="text" class="form-control" name="meta_keyword" value="{!! old('meta_keyword', isset($data->meta_keyword) ? $data->meta_keyword : null) !!}">
			                    </div>
			                    @if(isUpdate(@$module['action']))
				                    <h4 class="ui-heading">Xem trước kết quả tìm kiếm</h4>
				                    <div class="google-preview">
				                        <span class="google__title"><span>{!! !empty($data->meta_title) ? $data->meta_title : @$data->name !!}</span></span>
				                        <div class="google__url">
				                            {{ asset( 'san-pham/'.$data->slug ) }}
				                        </div>
				                        <div class="google__description">{!! old('meta_description', isset($data->meta_description) ? @$data->meta_description : '') !!}</div>
				                    </div>
			                    @endif
		                    </div>
		                </div>
		            </div>
				</div>
				<div class="col-sm-3">
					<div class="box box-success">
		                <div class="box-header with-border">
		                    <h3 class="box-title">Đăng sản phẩm</h3>
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
								<label class="custom-checkbox">
									@if(isUpdate(@$module['action']))
		                            	<input type="checkbox" name="hot" value="1" {{ @$data->hot == 1 ? 'checked' : null }}>Sản phẩm nổi bật
		                            @else
		                            	<input type="checkbox" name="hot" value="1" checked> Sản phẩm nổi bật
		                            @endif
								</label>
								<label class="custom-checkbox">
									@if(isUpdate(@$module['action']))
		                            	<input type="checkbox" name="status_product" value="1" {{ @$data->status_product == 1 ? 'checked' : null }}>Sản phẩm còn hàng
		                            @else
		                            	<input type="checkbox" name="status_product" value="1" checked> Sản phẩm còn hàng
		                            @endif
		                        </label>
		                    </div>
		                    <div class="form-group text-right">
		                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Lưu lại sản phẩm</button>
		                    </div>
		                </div>
		            </div>
		            
                    <div class="box box-success">
                        <div class="box-header with-border">
		                    <h3 class="box-title">Danh mục sản phẩm</h3>
		                </div>
		                <div class="box-body">
                            <?php 
		                        $category_list = [];
		                        if(!empty(@$data->category)){
		                           $category_list = @$data->category->pluck('id')->toArray();
		                        }
		                    ?>
		                    @if (!empty($categories))
		                        @foreach ($categories as $item)
		                            @if ($item->parent_id == 0)
		                                <label class="custom-checkbox">
		                                    <input type="radio" class="category" name="category[]" value="{{ $item->id }}" {{ in_array( $item->id, $category_list ) ? 'checked' : null }}> {{ $item->name }}
		                                 </label>
		                                 <?php checkBoxCategory( $categories, $item->id, $item, $category_list ) ?>
		                            @endif
		                        @endforeach
		                    @endif
		                </div>
		            </div>
		            <div class="box box-success">
		                <div class="box-header with-border">
		                    <h3 class="box-title">Ảnh sản phẩm</h3>
						</div>
						
		                <div class="box-body">
		                    <div class="form-group" style="text-align: center;">
		                        <div class="image">
		                            <div class="image__thumbnail">
		                                <img src="{{ !empty(@$data->image) ? $url.$data->image : __IMAGE_DEFAULT__ }}"
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
@section('scripts')
	<script>
		$(document).ready(function($) {
			$('#btn-ok').click(function(event) {
		        var slug_new = $('#new-post-slug').val();
		        var name = $('#name').val();
		        $.ajax({
		        	url: '{{ route($module['module'].'.get-slug') }}',
		        	type: 'GET',
		        	data: {
		        		id: $('#idPost').val(),
		        		slug : slug_new.length > 0 ? slug_new : name,
		        	},
		        })
		        .done(function(data) {
		        	$('#change_slug').show();
			        $('#btn-ok').hide();
			        $('.cancel.button-link').hide();
			        $('#current-slug').val(data);
		        	cancelInput(data);
		        })
		    });
		});	
		$('input#price').keyup(function(event) {
			if(event.which >= 37 && event.which <= 40) return;
			$(this).val(function(index, value) {
				return value
				.replace(/\D/g, "")
				.replace(/\B(?=(\d{3})+(?!\d))/g, ",")
				;
			});
			var price = $(this).val().replace(/,/g, '');
			$('input[name="price"]').val(price);
		});
	</script>
@endsection

