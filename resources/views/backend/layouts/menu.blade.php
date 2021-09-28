<li class="header">TRANG QUẢN TRỊ</li>

<li class="{{ Request::segment(2) == 'home' ? 'active' : null }}">
    <a href="{{ route('backend.home') }}">
        <i class="fa fa-home"></i> <span>Trang chủ</span>
    </a>
</li>
<li class="{{ Request::segment(2) == 'users' ? 'active' : null }}">
    <a href="{{ route('users.index') }}">
        <i class="fa fa-user"></i> <span>Tài khoản</span>
    </a>
</li>

<li class="{{ Request::segment(2) == 'account' ? 'active' : null }}">
    <a href="{{ route('account.index') }}">
        <i class="fa fa-user"></i> <span>Quản lý thành viên</span>
    </a>
</li>

<li class="treeview {{ Request::segment(2) === 'category' || Request::segment(2) === 'products' ? 'active' : null }}">
    <a href="#">
        <i class="fa fa-building" aria-hidden="true"></i> <span>Sản phẩm</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
        <li class="{{ Request::segment(2) === 'products' ? 'active' : null }}">
            <a href="{{ route('products.index') }}"><i class="fa fa-circle-o"></i> Danh sách sản phẩm</a>
        </li>
        <li class="{{ Request::segment(2) === 'category' ? 'active' : null }}">
            <a href="{{ route('category.index') }}"><i class="fa fa-circle-o"></i> Danh mục sản phẩm</a>
        </li>
    </ul>
</li>

<li class="{{ Request::segment(2) == 'orders' ? 'active' : null  }}">

    <a href="{{ route('order.index') }}">

        <i class="fa fa-line-chart" aria-hidden="true"></i> <span>Đơn hàng</span>

    </a>

</li>

<li
    class="treeview {{ Request::segment(2) === 'recruitment' || Request::segment(2) === 'categories-recruitment' ? 'active' : null }}">
    <a href="#">
        <i class="fa fa-building" aria-hidden="true"></i> <span>Tuyển dụng</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">
        <li class="{{ Request::segment(2) === 'recruitment' ? 'active' : null }}">
            <a href="{{ route('recruitment.index') }}"><i class="fa fa-circle-o"></i> Danh sách tuyển dụng</a>
        </li>
        <li class="{{ Request::segment(2) === 'categories-recruitment' ? 'active' : null }}">
            <a href="{{ route('categories-recruitment.index') }}"><i class="fa fa-circle-o"></i> Danh mục tuyển dụng</a>
        </li>
    </ul>
</li>

<li class="{{ Request::segment(2) == 'apply-job' ? 'active' : null }}">
    <?php $number = \App\Models\ApplyJob::where('status', 0)->count(); ?>
    <a href="{{ route('get.list.job') }}">
        <i class="fa fa-tags" aria-hidden="true"></i> <span>Danh sách đơn ứng tuyển ({{ $number }})</span>
    </a>
</li>

<li class="{{ Request::segment(2) == 'posts' ? 'active' : null }}">
    <a href="{{ route('posts.index', ['type' => 'blog']) }}">
        <i class="fa fa-newspaper-o" aria-hidden="true"></i> <span>Bài viết</span>
    </a>
</li>

<li class="{{ Request::segment(2) == 'projects' ? 'active' : null }}">
    <a href="{{ route('projects.index') }}">
        <i class="fa fa-building" aria-hidden="true"></i> <span>Dự án</span>
    </a>
</li>

<li class="{{ Request::segment(2) == 'media' ? 'active' : null }}">
    <a href="{{ route('media.index') }}">
        <i class="fa fa-newspaper-o" aria-hidden="true"></i> <span>Truyền thông</span>
    </a>
</li>

<li class="{{ Request::segment(2) == 'downloads' ? 'active' : null }}">
    <a href="{{ route('downloads.index') }}">
        <i class="fa fa-newspaper-o" aria-hidden="true"></i> <span>Downloads</span>
    </a>
</li>

<li class="{{ Request::segment(2) == 'faqs' ? 'active' : null }}">
    <a href="{{ route('faqs.index') }}">
        <i class="fa fa-tags" aria-hidden="true"></i> <span>FAQs</span>
    </a>
</li>

<li class="{{ Request::segment(2) == 'notifications' ? 'active' : null }}">
    <a href="{{ route('notifications.index') }}">
        <i class="fa fa-bell" aria-hidden="true"></i> <span>Notifications</span>
    </a>
</li>


<li class="{{ Request::segment(2) == 'pages' ? 'active' : null }}">
    <a href="{{ route('pages.list') }}">
        <i class="fa fa-paper-plane" aria-hidden="true"></i> <span>Cài đặt trang</span>
    </a>
</li>
<li class="{{ Request::segment(2) == 'register' ? 'active' : null }}">
    <?php $number = \App\Models\Contact::where('status', 0)
    ->where('type', 'register')
    ->count(); ?>
    <a href="{{ route('get.list.register') }}">
        <i class="fa fa-bell" aria-hidden="true"></i> <span>Đăng ký đại lý ({{ $number }})
        </span>
    </a>
</li>
<li class="{{ Request::segment(2) == 'contact' ? 'active' : null }}">
    <?php $number = \App\Models\Contact::where('status', 0)
    ->where('type', 'contact')
    ->orWhere('type', 'order')
    ->count(); ?>
    <a href="{{ route('get.list.contact') }}">
        <i class="fa fa-bell" aria-hidden="true"></i> <span>Liên hệ ({{ $number }})
        </span>
    </a>
</li>


<li class="header">Cấu hình hệ thống</li>
<li
    class="treeview {{ Request::segment(2) === 'options' || Request::segment(2) === 'image' || Request::segment(2) === 'menu' || Request::segment(2) === 'backup' ? 'active' : null }}">
    <a href="#">
        <i class="fa fa-cog" aria-hidden="true"></i> <span>Cấu hình</span>
        <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
        </span>
    </a>
    <ul class="treeview-menu">

        <li class="{{ Request::segment(3) === 'general' ? 'active' : null }}">
            <a href="{{ route('backend.options.general') }}"><i class="fa fa-circle-o"></i> Cấu hình chung</a>
        </li>
        <li class="{{ request()->get('type') == 'slider' ? 'active' : null }}">
            <a href="{{ route('image.index', ['type' => 'slider']) }}"><i class="fa fa-circle-o"></i> Slider</a>
        </li>

        <li class="{{ request()->get('type') == 'partner' ? 'active' : null }}">
            <a href="{{ route('image.index', ['type' => 'partner']) }}"><i class="fa fa-circle-o"></i> Đối tác</a>
        </li>
        <li class="{{ Request::segment(2) === 'menu' ? 'active' : null }}">
            <a href="{{ route('setting.menu') }}"><i class="fa fa-circle-o"></i> Menu</a>
        </li>

        <li class="{{ Request::segment(2) === 'backup' ? 'active' : null }}">
            <a href="{{ route('setting.backup') }}"><i class="fa fa-circle-o"></i> Backup</a>
        </li>

    </ul>
</li>
<div style="display: none;">
    <li class="header">Cấu hình hệ thống</li>
    <li class="treeview {{ Request::segment(2) == 'options' ? 'active' : null }}">
        <a href="#">
            <i class="fa fa-folder"></i> <span>Setting (Developer)</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li class="{{ Request::segment(3) == 'developer-config' ? 'active' : null }}">
                <a href="{{ route('backend.options.developer-config') }}"><i class="fa fa-circle-o"></i> Developer -
                    Config</a>
            </li>
        </ul>
    </li>
</div>
