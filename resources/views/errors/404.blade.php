@extends('errors::minimal')
@section('title', __('404 - Không tìm thấy'))
<main>
    <div class="main-site page-site page-404-site">
        <div class="main-container">
            <article class="art-banners">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="banners-box">
                                <div class="banners-content">
                                    <h1><span>404</span></h1>
    
                                    <h2>Không tìm thấy trang</h2>
    
                                    <h3>Trang đã bị xóa hoặc địa chỉ URL không đúng</h3>
    
                                    <div class="button">
                                        <a href="{{ url('/') }}"> <button class="btn">Quay về trang chủ</button></a>
                                    </div>
                                </div>							
                            </div>
                        </div>
                    </div>
            </article>
        </div>
    </div>
</main>
    
