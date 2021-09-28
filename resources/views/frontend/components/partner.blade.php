<article class="art-brands">
	<div class="container">
		<div class="row">
			<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
				<div class="brands-box">
					<div class="brands-content">
						<div class="slick-slider slick-brands">
							@foreach ($partner as $item)
								<div class="item">
									<div class="brand-box">
										<div class="brand-image">
											<a href="{{ $item->link }}" title="{{ $item->name }}">
												<img src="{{ $url.$item->image }}" alt="{{ $item->name }}" style="max-width: 210px; max-height: 120px; width: 100%; height: 100%;">
											</a>												
										</div>
									</div>
								</div>
							@endforeach
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</article> <!-- art-brands -->