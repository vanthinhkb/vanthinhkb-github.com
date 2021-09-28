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
				<div class="col-sm-12">
					<div class="nav-tabs-custom">
		                <ul class="nav nav-tabs">
							<li class="active">
		                        <a href="#info" data-toggle="tab" aria-expanded="true">Thông tin hỏi đáp</a>
							</li>
		                </ul>
		                <div class="tab-content">

							<div class="tab-pane active" id="info">
								<div class="row">
			                        <div class="col-sm-6">
			                            <div class="form-group">
											<label for="">Câu hỏi tiếng việt</label>
											<input type="text" name="title" class="form-control" value="{{ @$data->title }}">
										</div>
										<div class="form-group">
											<label for="">Câu trả lời tiếng việt</label>
											<textarea name="content" class="content">{!! @$data->content !!}</textarea>
										</div>
									</div>
									<div class="col-sm-6">
			                            <div class="form-group">
											<label for="">Câu hỏi tiếng anh</label>
											<input type="text" name="title_en" class="form-control" value="{{ @$data->title_en }}">
										</div>
										<div class="form-group">
											<label for="">Câu trả lời tiếng anh</label>
											<textarea name="content_en" class="content">{!! @$data->content_en !!}</textarea>
										</div>
			                        </div>
			                    </div>
							</div>
							<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Lưu lại</button>
						</div>
		            </div>
				</div>
			</div>
		</form>
	</div>
@stop
