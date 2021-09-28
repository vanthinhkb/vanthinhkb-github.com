<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pages;
use App\Models\Options;
use App\Models\Recruitment;
use DateTime;
use SEO;
use SEOMeta;
use OpenGraph;
use App\Models\Menu;
use Illuminate\Support\Facades\Mail;
use App\Models\Image;
use App\Models\Customer;
use App\Models\Posts;
use App\Models\Categories;
use App\Models\RecruitmentCategory;
use App\Models\Products;
use App\Models\ProductCategory;
use App\Models\Contact;
use App\Models\ApplyJob;
use App\Models\Notifications;
use App\Models\Faq;
use App\Models\Account;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use DB;
use View;
use App\Models\ResetPassword;
use App\Events\SendMailResetPassword;
use Illuminate\Support\Str;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Projects;
use App\Models\Media;
use App\Models\Downloads;

class IndexController extends Controller
{

	public $config_info;

    public function __construct()
    {
        $site_info = Options::where('type', 'general')->first();
        if ($site_info) {
            $site_info = json_decode($site_info->content);
            $this->config_info = $site_info;

            OpenGraph::setUrl(\URL::current());
            OpenGraph::addProperty('locale', 'vi');
            OpenGraph::addProperty('type', 'article');
            OpenGraph::addProperty('author', 'GCO-GROUP');

            SEOMeta::addKeyword($site_info->site_keyword);

            $menuHeader = Menu::where('id_group', 1)->orderBy('position')->get();
            $menuFooter = Menu::where('id_group', 2)->orderBy('position')->get();
            $partner = Image::where('status', 1)->where('type', 'partner')->get();
            $listCategory = Categories::where('type', 'product_category')->get();
            $totalProduct = Products::where('status', 1)->count();
            $product = Pages::where('type', 'product')->whereLang(app()->getLocale())->first();
            $url = explode("/",url('/'));
            $url = $url[0].'//'.$url[2];
            view()->share(compact('site_info', 'menuHeader', 'menuFooter', 'partner', 'listCategory', 'totalProduct', 'product', 'url'));
        }
    }

    public function createSeo($dataSeo = null)
    {
        $site_info = $this->config_info;
        if (!empty($dataSeo->meta_title)) {
            SEO::setTitle($dataSeo->meta_title);
        } else {
            SEO::setTitle($site_info->site_title);
        }
        if (!empty($dataSeo->meta_description)) {
            SEOMeta::setDescription($dataSeo->meta_description);
            OpenGraph::setDescription($dataSeo->meta_description);
        } else {
            SEOMeta::setDescription($site_info->site_description);
            OpenGraph::setDescription($site_info->site_description);
        }
        if (!empty($dataSeo->image)) {
            OpenGraph::addImage($dataSeo->image, ['height' => 400, 'width' => 400]);
        } else {
            OpenGraph::addImage($site_info->logo_share, ['height' => 400, 'width' => 400]);
        }
        if (!empty($dataSeo->meta_keyword)) {
            SEOMeta::addKeyword($dataSeo->meta_keyword);
        }
    }

    public function createSeoPost($data)
    {
        if(!empty($data->meta_title)){
            SEO::setTitle($data->meta_title);
        }else {
            SEO::setTitle($data->name);
        }
        if(!empty($data->meta_description)){
            SEOMeta::setDescription($data->meta_description);
            OpenGraph::setDescription($data->meta_description);
        }else {
            SEOMeta::setDescription($this->config_info->site_description);
            OpenGraph::setDescription($this->config_info->site_description);
        }
        if (!empty($data->image)) {
            OpenGraph::addImage($data->image, ['height' => 400, 'width' => 400]);
        } else {
            OpenGraph::addImage($this->config_info->logo_share, ['height' => 400, 'width' => 400]);
        }
        if (!empty($data->meta_keyword)) {
            SEOMeta::addKeyword($data->meta_keyword);
        }
    }

    public function getChangeLanguage($lang)
    {
        session(['lang' => $lang]);
        return redirect()->back();
    }

    public function getHome()
    { 
    	$this->createSeo();
        $contentHome = Pages::where('type', 'home')->whereLang(app()->getLocale())->first();
        $slider = Image::where('status', 1)->where('type', 'slider')->get();
        $product_hot = Products::where('status', 1)->where('hot', 1)->orderBy('created_at', 'DESC')->get();
        $posts_hot = Posts::where('status', 1)->where('hot', 1)->orderBy('created_at', 'DESC')->take(10)->get();
        $notifications = Notifications::where('status', 1)->get();
    	return view('frontend.pages.home', compact('contentHome', 'slider', 'posts_hot', 'product_hot', 'notifications'));
    }

    public function getListAbout()
    {
        $dataSeo = Pages::where('type', 'about')->whereLang(app()->getLocale())->first();
        $this->createSeo($dataSeo);
        return view('frontend.pages.about', compact('dataSeo'));
    }

    public function getListRecruitment()
    {
        $dataSeo = Pages::where('type', 'recruitment')->whereLang(app()->getLocale())->first();
        $this->createSeo($dataSeo);
        $listCategory = Categories::where('type', 'recruitment_category')->get();
        $data = Recruitment::where('status', 1)->orderBy('created_at', 'DESC')->paginate(9);
        return view('frontend.pages.archives-recruitment', compact('dataSeo', 'data', 'listCategory'));
    }

    public function getCategoryRecruitment($slug)
    {
        $dataSeo = Pages::where('type', 'recruitment')->whereLang(app()->getLocale())->first();
        $this->createSeo($dataSeo);
        $listCategory = Categories::where('type', 'recruitment_category')->get();
        $category = Categories::where('slug', $slug)->where('type', 'recruitment_category')->firstOrFail();
        $list_id_children = get_list_ids($category);
        $list_id_children[] = $category->id;
        $list_id_recruitment = RecruitmentCategory::whereIn('id_category', $list_id_children)->get()->pluck('id_recruitment')->toArray();
        $data = Recruitment::whereIn('id', $list_id_recruitment)->where('status', 1)->orderBy('created_at', 'DESC')->paginate(9);

        return view('frontend.pages.archives-recruitment', compact('data', 'listCategory', 'dataSeo'));
    }

    public function getSingleRecruitment($slug)
    {
        $dataSeo = Pages::where('type', 'recruitment')->whereLang(app()->getLocale())->first();
        $listCategory = Categories::where('type', 'recruitment_category')->get();
        $data = Recruitment::where('status', 1)->where('slug', $slug)->firstOrFail();
        $this->createSeoPost($data);
        return view('frontend.pages.single-recruitment', compact('data', 'dataSeo', 'listCategory'));
    }

    public function getFormRecruitment($slug) {
        $dataSeo = Pages::where('type', 'recruitment')->whereLang(app()->getLocale())->first();
        $data = Recruitment::where('status', 1)->where('slug', $slug)->firstOrFail();
        $this->createSeoPost($data);
        return view('frontend.pages.recruitment-form', compact('data', 'dataSeo'));
    }

    public function getListNew()
    {
        $dataSeo = Pages::where('type', 'news')->whereLang(app()->getLocale())->first();
        $this->createSeo($dataSeo);
        $data = Posts::where('status', 1)->orderBy('created_at', 'DESC')->paginate(6);
        $post_view_much = Posts::where('status', 1)->where('view', '>', 0)->orderBy('view', 'DESC')->take(10)->get();
        return view('frontend.pages.archives-news', compact('dataSeo', 'data', 'post_view_much'));
    }

    public function getSingleNews($slug)
    {
        $dataSeo = Pages::where('type', 'news')->whereLang(app()->getLocale())->first();
        $data = Posts::where('status', 1)->where('slug', $slug)->firstOrFail();
        $this->createSeoPost($data);
        $data->view = $data->view + 1;
        $data->save();
        $post_view_much = Posts::where('status', 1)->where('view', '>', 0)->orderBy('view', 'DESC')->take(10)->get();
        $post_same = Posts::where('id', '!=', $data->id)->where('status', 1)->inRandomOrder()->get();
        return view('frontend.pages.single-news', compact('dataSeo', 'data', 'post_view_much', 'post_same'));
    }

    public function getListProducts()
    {
        $dataSeo = Pages::where('type', 'product')->whereLang(app()->getLocale())->first();
        $this->createSeo($dataSeo);
        $products = Products::where('status', 1)->orderBy('created_at', 'DESC')->paginate(12);
        return view('frontend.pages.archives-products', compact('products', 'dataSeo'));
    }

    public function getSingleProduct($slug)
    {
        $data = Products::where('status', 1)->where('slug', $slug)->firstOrFail();
        $this->createSeoPost($data);
        $list_category = $data->category->pluck('id')->toArray();
        $list_post_related = ProductCategory::whereIn('id_category', $list_category)->get()->pluck('id_product')->toArray();
        $product_same_category = Products::where('id', '!=', $data->id)->where('status', 1)
                                ->whereIn('id', $list_post_related)->orderBy('created_at', 'DESC')->get();
        return view('frontend.pages.single-product', compact('data', 'product_same_category'));
    }

    public function getCatetoryProducts($slug)
    {
        $dataSeo = Pages::where('type', 'product')->whereLang(app()->getLocale())->first();
        $category = Categories::where('slug', $slug)->firstOrFail();
        $list_id_children = get_list_ids($category);
        $list_id_children[] = $category->id;
        $list_id_product = ProductCategory::whereIn('id_category', $list_id_children)->get()->pluck('id_product')->toArray();
        $this->createSeoPost($category);
        $products = Products::where('status', 1)->whereIn('id', $list_id_product)->orderBy('created_at', 'DESC')->paginate(12);
        return view('frontend.pages.archives-products', compact('category', 'dataSeo', 'products'));
    }

    public function getContact()
    {
        $dataSeo = Pages::where('type', 'contact')->whereLang(app()->getLocale())->first();
        $this->createSeo($dataSeo);
        return view('frontend.pages.contact', compact('dataSeo'));
    }

    public function postContact(Request $request)
    {
        $result = [];
        if ($request->name == '' || $request->name == null) {
            $result['message_name'] = trans('message.ban_chua_nhap_ho_ten');
        }
        if ($request->email == '' || $request->email == null) {
            $result['message_email'] = trans('message.ban_chua_nhap_email');
        } else {
            if (!filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
                $result['message_email'] = trans('message.email_phai_la_mot_dia_chi_email_hop_le');
            }
        }
        if ($request->phone == '' || $request->phone == null) {
            $result['message_phone'] = trans('message.ban_chua_nhap_so_dien_thoai');
        } else {
            if (!is_numeric($request->phone) || strlen($request->phone) != 10) {
                $result['message_phone'] = trans('message.so_dien_thoai_sai');
            }
        } 
        if (strlen($request->content) > 500) {
            $result['message_content'] = trans('message.noi_dung_khong_duoc_lon_hon_500_ky_tu');
        }
        if($result != []){
            return json_encode($result);
        }

        $data = [
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
        ];

        $email_admin = getOptions('general', 'email_admin');

        $customer = Customer::create($data);
        if ($request->type == 'contact') {
            $contact = new Contact;
            $contact->title = 'Liên hệ từ khách hàng';
            $contact->customer_id = $customer->id;
            $contact->type = $request->type;
            $contact->content = $request->content;
            $contact->status = 0;
            $contact->save();
    
            $content_email = [
                'title' => 'Liên hệ từ khách hàng',
                'type' => $request->type,
                'name' => $request->name,
                'phone' => $request->phone,
                'email' => $request->email,
                'content' => $request->content,
                'url' => route('contact.edit', $contact->id),
            ];

            Mail::send('frontend.mail.mail-teamplate', $content_email, function ($msg) use($email_admin) {
                $msg->from('tuannd.mkt@ae-techvn.com', 'Website - HICHEM');
                $msg->to($email_admin, 'Website - HICHEM')->subject('Khách hàng liên hệ');
            });

        } else if ($request->type == 'register') {
            $contact = new Contact;
            $contact->title = 'Đăng ký làm đại lý';
            $contact->customer_id = $customer->id;
            $contact->type = $request->type;
            $contact->content = $request->content;
            $contact->status = 0;
            $contact->save();
    
            $content_email = [
                'title' => 'Đăng ký làm đại lý',
                'type' => $request->type,
                'name' => $request->name,
                'phone' => $request->phone,
                'email' => $request->email,
                'content' => $request->content,
                'url' => route('contact.edit', $contact->id),
            ];

            Mail::send('frontend.mail.mail-teamplate', $content_email, function ($msg) use($email_admin) {
                $msg->from('tuannd.mkt@ae-techvn.com', 'Website - HICHEM');
                $msg->to($email_admin, 'Website - HICHEM')->subject('Đăng ký làm đại lý');
            });

        } else {
            $contact = new Contact;
            $contact->title = 'Khách hàng đặt hàng';
            $contact->customer_id = $customer->id;
            $contact->type = $request->type;
            $contact->content = $request->content;
            $contact->link_product = $request->link_product;
            $contact->status = 0;
            $contact->save();
    
            $content_email = [
                'title' => 'Khách hàng đặt hàng',
                'type' => $request->type,
                'name' => $request->name,
                'phone' => $request->phone,
                'email' => $request->email,
                'content' => $request->content,
                'link_product' => $request->link_product,
                'url' => route('contact.edit', $contact->id),
            ];

            Mail::send('frontend.mail.mail-teamplate', $content_email, function ($msg) use($email_admin) {
                $msg->from('tuannd.mkt@ae-techvn.com', 'Website - HICHEM');
                $msg->to($email_admin, 'Website - HICHEM')->subject('Khách hàng đặt hàng');
            });
        }

        $result['success'] = ucfirst(trans('message.thong_bao_thanh_cong'));
        return json_encode($result);
    }

    public function postRecruitment(Request $request)
    {
        $result = [];
        if ($request->name == '' || $request->name == null) {
            $result['message_name'] = trans('message.ban_chua_nhap_ho_ten');
        }
        if ($request->email == '' || $request->email == null) {
            $result['message_email'] = trans('message.ban_chua_nhap_email');
        } else {
            if (!filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
                $result['message_email'] = trans('message.email_phai_la_mot_dia_chi_email_hop_le');
            }
        }
        if ($request->phone == '' || $request->phone == null) {
            $result['message_phone'] = trans('message.ban_chua_nhap_so_dien_thoai');
        } else {
            if (!is_numeric($request->phone) || strlen($request->phone) != 10) {
                $result['message_phone'] = trans('message.so_dien_thoai_sai');
            }
        }
        if ($request->dateOfBirth == '' || $request->dateOfBirth == null) {
            $result['message_date'] = trans('message.ban_chua_chon_ngay_thang_nam_sinh');
        }
        if ($request->level == '' || $request->level == null) {
            $result['message_level'] = trans('message.ban_chua_nhap_trinh_do');
        }
        if ($request->experience == '' || $request->experience == null) {
            $result['message_experience'] = trans('message.ban_chua_nhap_kinh_nghiem');
        }
        if (empty($request->myfile)) {
            $result['message_myfile'] = trans('message.ban_chua_upload_file');
        } else {
            $myfile = $request->myfile;
            $allowed = [
                'application/vnd.openxmlformats-officedocument.wordprocessingml.document', // docx
                'application/pdf', // pdf
            ];
            $filetype = $myfile->getMimeType();
            if (!in_array($filetype, $allowed)) {
                $result['message_myfile'] = trans('message.khong_dung_dinh_dang');
            }
        }
        if($result != []){
            return json_encode($result);
        }

        if (!empty($request->myfile)) {
            $cv = $request->myfile;
            $nameCV = time() . '_' . $cv->getClientOriginalName();
            $path = "uploads/CV/";
            $cv->move($path, $nameCV);
        }
        $applyJob = new ApplyJob;
        $applyJob->name = $request->name;
        $applyJob->phone = $request->phone;
        $applyJob->email = $request->email;
        $applyJob->dateOfBirth = $request->dateOfBirth;
        $applyJob->level = $request->level;
        $applyJob->experience = $request->experience;
        $applyJob->id_recruitment = $request->id_recruitment;
        $applyJob->file_cv = $path . $nameCV;
        $applyJob->save();

        $content_email = [
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'id_recruitment' => $request->id_recruitment,
            'link_cv' => url('/') . '/' . $path . $nameCV,
            'url' => route('get.edit.job', $applyJob->id),
        ];

        $email_admin = getOptions('general', 'email_admin');

        Mail::send('frontend.mail.mail-apply', $content_email, function ($msg) use($email_admin) {
            $msg->from('tuannd.mkt@ae-techvn.com', 'Website - HICHEM');
            $msg->to($email_admin, 'Website - HICHEM')->subject('Nộp đơn ứng tuyển');
        });

        $result['success'] = ucfirst(trans('message.thong_bao_thanh_cong'));

        return json_encode($result);
    }

    public function postContactAll(Request $request) {
        $result = [];
        if ($request->name == '' || $request->name == null) {
            $result['message_name'] = trans('message.ban_chua_nhap_ho_ten');
        }
        if ($request->email == '' || $request->email == null) {
            $result['message_email'] = trans('message.ban_chua_nhap_email');
        } else {
            if (!filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
                $result['message_email'] = trans('message.email_phai_la_mot_dia_chi_email_hop_le');
            }
        }
        if ($request->phone == '' || $request->phone == null) {
            $result['message_phone'] = trans('message.ban_chua_nhap_so_dien_thoai');
        } else {
            if (!is_numeric($request->phone) || strlen($request->phone) != 10) {
                $result['message_phone'] = trans('message.so_dien_thoai_sai');
            }
        } 
        if (strlen($request->content) > 500) {
            $result['message_content'] = trans('message.noi_dung_khong_duoc_lon_hon_500_ky_tu');
        }
        if($result != []){
            return json_encode($result);
        }

        $data = [
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
        ];

        $customer = Customer::create($data);

        $contact = new Contact;
        $contact->title = 'Liên hệ từ khách hàng';
        $contact->customer_id = $customer->id;
        $contact->type = 'contact';
        $contact->content = $request->content;
        $contact->link_news = $request->link_news;
        $contact->link_product = $request->link_product;
        $contact->status = 0;
        $contact->save();

        $content_email = [
            'title' => 'Liên hệ từ khách hàng',
            'type' => 'contact',
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'content' => $request->content,
            'link_news' => $request->link_news,
            'link_product' => $request->link_product,
            'url' => route('contact.edit', $contact->id),
        ];

        $email_admin = getOptions('general', 'email_admin');

        Mail::send('frontend.mail.mail-teamplate', $content_email, function ($msg) use($email_admin) {
            $msg->from('tuannd.mkt@ae-techvn.com', 'Website - HICHEM');
            $msg->to($email_admin, 'Website - HICHEM')->subject('Khách hàng liên hệ');
        });

        $result['success'] = ucfirst(trans('message.thong_bao_thanh_cong'));

        return json_encode($result);
    } 

    public function getListFaq() {
        $dataSeo = Pages::where('type', 'faqs')->whereLang(app()->getLocale())->first();
        $this->createSeo($dataSeo);
        $faqs = Faq::orderBy('created_at', 'DESC')->get();
        $news_hot = Posts::where('hot', 1)->where('status', 1)->orderBy('created_at', 'DESC')->take(10)->get();
        $product = Products::inRandomOrder()->where('status', 1)->get();
        return view('frontend.pages.faqs', compact('dataSeo', 'faqs', 'news_hot', 'product'));
    }

    // Đăng ký
    public function postRegistration(Request $request) {
        $result = [];
        if ($request->name == '' || $request->name == null) {
            $result['message_name'] = trans('message.ban_chua_nhap_ho_ten');
        }
        if ($request->email == '' || $request->email == null) {
            $result['message_email'] = trans('message.ban_chua_nhap_email');
        } else {
            if (!filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
                $result['message_email'] = trans('message.email_phai_la_mot_dia_chi_email_hop_le');
            }
        }
        if ($request->phone == '' || $request->phone == null) {
            $result['message_phone'] = trans('message.ban_chua_nhap_so_dien_thoai');
        } else {
            if (!is_numeric($request->phone) || strlen($request->phone) != 10) {
                $result['message_phone'] = trans('message.so_dien_thoai_sai');
            }
        } 
        if ($request->password == '' || $request->password == null) {
            $result['message_password'] = trans('message.ban_chua_nhap_mat_khau');
        } else {
            if (strlen($request->password) < 6) {
                $result['message_password'] = trans('message.mat_khau_phai_lon_hon_6_ky_tu');
            }
        } 
        if ($request->re_password == '' || $request->re_password == null) {
            $result['message_re_password'] = trans('message.ban_chua_nhap_lai_mat_khau');
        } else {
            if ($request->re_password != $request->password) {
                $result['message_re_password'] = trans('message.nhap_lai_mat_khau_sai');
            }
        } 
        if($result != []){
            return json_encode($result);
        }

        $data = Account::where('email', $request->email)->first();
        
        if ($data) {
            $result['warning'] = trans('message.email_ton_tai');
            $result['notification'] = trans('message.canh_bao');

            return json_encode($result);
        } else {
            $account = new Account();
            $account->name = $request->name;
            $account->phone = $request->phone;
            $account->email = $request->email;
            $account->password = Hash::make($request->password);
            $account->status = 1;
            $account->save();
    
            $result['success'] = trans('message.dang_ky_tai_khoan_thanh_cong');
            $result['notification'] = trans('message.thanh_cong');
    
            return json_encode($result);
        }
    }

    // Đăng nhập
    public function postLogin(Request $request) {
        $result = [];
        if ($request->username == '' || $request->username == null) {
            $result['message_username'] = trans('message.ban_chua_nhap_email_phone');
        }
        if ($request->password == '' || $request->password == null) {
            $result['message_password'] = trans('message.ban_chua_nhap_mat_khau');
        }
        if($result != []){
            return json_encode($result);
        }

        if (!empty($request->username) && !empty($request->password)) {
            $credentials = array('email' => $request->username, 'password' => $request->password);
            $credentials1 = array('phone' => $request->username, 'password' => $request->password);
            if (is_numeric($request->username)) {
                $account = Account::where([
                    ['phone','=',$request->username],
                    ['status','=','1']
                ])->first();
            } else {
                $account = Account::where([
                    ['email','=',$request->username],
                    ['status','=','1']
                ])->first();
            }
            if (!empty($account)) {
                if (is_numeric($request->username)) {
                    if(Auth::guard('customer')->attempt($credentials1)){
                        $result['success'] = trans('message.dang_nhap_thanh_cong');
                        return json_encode($result);
                    } 
                } else {
                    if(Auth::guard('customer')->attempt($credentials)){
                        $result['success'] = trans('message.dang_nhap_thanh_cong');
                        $result['url'] = url()->current();
                        return json_encode($result);
                    } 
                }

                $result['info'] = trans('message.dang_nhap_khong_thanh_cong');
                return json_encode($result);
            } else {
                $result['info'] = trans('message.dang_nhap_khong_thanh_cong');
                return json_encode($result);
            }
        }
    }

    public function postLogout(Request $request) {
        Auth::guard('customer')->logout();
        return redirect()->back();
    }

    public function pageThanks() {
        SEO::setTitle('Trang cảm ơn');
        return view('frontend.pages.thanks');
    }

    public function manageAccount() {
        if (Auth::guard('customer')->check()) {
            SEO::setTitle(trans('message.quan_ly_tai_khoan'));
            $account = DB::table('account')->select()->where('id',Auth::guard('customer')->user()->id)->where('status', 1)->first();
            $order = Order::where('id_account', $account->id)->get();
            foreach ($order as $item) {
                $orderDetail[] = OrderDetail::where('id_order', $item->id)->first();
            }

            return view('frontend.pages.manage.account', compact('orderDetail'));
        } else {
            if (url()->current() == url('/quan-ly-tai-khoan')) {
                return redirect()->route('home.index');
            } else {
                abort(404);
            }
        }
    }

    public function postManageAccount(Request $request) {
        $data = [
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'sex' => $request->sex,
            'day' => $request->day != 0 ? $request->day : null,
            'month' => $request->month != 0 ? $request->sex : null,
            'year' => $request->year != 0 ? $request->year : null,
        ];

        $account = Account::where('id', $request->id_account)->update($data);

        return redirect()->route('home.manage-account')->with([
            'level' => 'success',
            'message' => trans('message.cap_nhat_thanh_cong'),
        ]);

    }

    public function postChangePassword(Request $request) {
        $account = Account::select()->where('id',$request->id_account)->first();

        $result = [];
        if ($request->old_password == '' || $request->old_password == null) {
            $result['message_old_password'] = trans('message.ban_chua_nhap_mat_khau');
        } else {
            if (!Hash::check($request->old_password, $account->password)) {
                $result['message_old_password'] = trans('message.mat_khau_sai');
            }
        }
        if ($request->new_password == '' || $request->new_password == null) {
            $result['message_new_password'] = trans('message.ban_chua_nhap_mat_khau_moi');
        } else {
            if (strlen($request->new_password) < 6) {
                $result['message_new_password'] = trans('message.mat_khau_phai_lon_hon_6_ky_tu');
            }
        }
        if ($request->re_password == '' || $request->re_password == null) {
            $result['message_re_password'] = trans('message.ban_chua_nhap_lai_mat_khau');
        } else {
            if ($request->re_password != $request->new_password) {
                $result['message_re_password'] = trans('message.nhap_lai_mat_khau_sai');
            }
        } 
        if($result != []){
            return json_encode($result);
        }

        $account->update(['password' => Hash::make($request->new_password)]);

        $result['success'] = trans('message.cap_nhat_mat_khau_thanh_cong');
        $result['notification'] = trans('message.thanh_cong');
        return json_encode($result);

    }

    // TO DO
    public function searchOrder(Request $request) {
        // dd($request->all());
        if (Auth::guard('customer')->check()) {
            $account = DB::table('account')->select()->where('id', Auth::guard('customer')->user()->id)->where('status', 1)->first();
            
            $data = Products::select('products.name', 'products.name_en', 'products.code', 'orders.created_at')
                            ->join('order_detail', 'order_detail.id_product', 'products.id')
                            ->join('orders', 'orders.id', 'order_detail.id_order')
                            ->where('orders.id_account', $account->id)
                            ->where(function ($query) use ($request) {
                                if (strlen(trim($request->key)) > 0) {
                                    $query->where('products.name', 'like', '%' . $request->key . '%')
                                    ->orWhere('products.name_en', 'like', '%' . $request->key . '%');
                                }
                                if ($request->from_day || $request->to_day) {
                                    $query->whereDate('orders.created_at', '>=', $request->from_day)

                                        ->whereDate('orders.created_at', '<=', $request->to_day);

                                }
                            })->orderBy('orders.created_at', 'DESC')->get();
                            
            $view = (string) View::make('frontend.ajax.list-order', compact('data'));
            // dd($view);
            return $view;
        } else {
            if (url()->current() == url('/quan-ly-tai-khoan')) {
                return redirect()->route('home.index');
            } else {
                abort(404);
            }
        }
    }

    public function searchAll(Request $request) {
        $this->createSeo();
        SEO::setTitle('Tìm kiếm từ khóa: '.$request->q);
        $keyword = $request->q;
        $type = $request->t;
        $all = $request->all();
        if ($request->t == 'san_pham' || $request->t == '') {
            $data = Products::where(function ($query) use ($request) {
                return $query->where('name', 'like', '%' . $request->q . '%')->orWhere('name_en', 'like', '%' . $request->q . '%');
            })->orderBy('created_at', 'DESC')->paginate(12);
        } else {
            $data = Posts::where(function ($query) use ($request) {
                return $query->where('name', 'like', '%' . $request->q . '%')->orWhere('name_en', 'like', '%' . $request->q . '%');
            })->orderBy('created_at', 'DESC')->paginate(12);
        }
       
        return view('frontend.pages.search', compact('data', 'keyword', 'type', 'all'));
    }

    public function sendForgotPassword(Request $request) {
        $result = [];
        if ($request->email_reset == '' || $request->email_reset == null) {
            $result['message_forgetpass'] = trans('message.ban_chua_nhap_email');
        } else {
            if (!filter_var($request->email_reset, FILTER_VALIDATE_EMAIL)) {
                $result['message_forgetpass'] = trans('message.email_phai_la_mot_dia_chi_email_hop_le');
            }
        }

        if($result != []){
            return json_encode($result);
        }
        
        $result = Account::where('email', $request->email_reset)->first();

        if($result) {
            $resetPassword = ResetPassword::firstOrCreate(['email'=>$request->email_reset, 'token'=>Str::random(60)]);

            $token = ResetPassword::where('email', $request->email_reset)->first();

            $link = url('resetPassword')."/".$token->token; //send it to email

            $content_email = [
                'title' => trans('message.xacnhanmk'),
                'url' => $link,
            ];

            $message = trans('message.xacnhanmk');

            event(new SendMailResetPassword($request->all(),$content_email,$message));

            $result['success_forgetpass'] = trans('message.mess_success');
            $result['success'] = trans('message.thanh_cong');
            
            return json_encode($result);
        } else {
            $result['error_forgetpass'] = trans('message.mess_error');
            $result['error'] = trans('message.that_bai');
            return json_encode($result);
        }
    }

    public function resetPassword($token)
    {
        $result = ResetPassword::where('token', $token)->first();

        if($result){
            return view('frontend.pages.new-password', compact('result'));
        } else {
            echo 'This link is expired';
        }
    }

    public function newPassword(Request $request)
    {
        if($request->password == '' || $request->confirm == ''){
            return redirect()->back()->with([
                'level' => 'warning',
                'message' => trans('message.nhapmk'),
            ]);
        }
        if($request->password == $request->confirm) {
            // Check email with token
            $result = ResetPassword::where('token', $request->token)->first();

            // Update new password 
            Account::where('email', $result->email)->update(['password'=>Hash::make($request->password)]);

            ResetPassword::where('token', $request->token)->delete();

            return redirect()->route('home.index')->with([
                'level' => 'success',
                'message' => trans('message.thay_doi_mat_khau_thanh_cong'),
            ]);
        } else {
            return redirect()->back()->with([
                'level' => 'error',
                'message' => trans('message.nhap_lai_mat_khau_sai'),
            ]);
        }
    }

    public function postOrder(Request $request)
    {
        $result = [];
        if ($request->name == '' || $request->name == null) {
            $result['message_name'] = trans('message.ban_chua_nhap_ho_ten');
        }
        if ($request->email == '' || $request->email == null) {
            $result['message_email'] = trans('message.ban_chua_nhap_email');
        } else {
            if (!filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
                $result['message_email'] = trans('message.email_phai_la_mot_dia_chi_email_hop_le');
            }
        }
        if ($request->phone == '' || $request->phone == null) {
            $result['message_phone'] = trans('message.ban_chua_nhap_so_dien_thoai');
        } else {
            if (!is_numeric($request->phone) || strlen($request->phone) != 10) {
                $result['message_phone'] = trans('message.so_dien_thoai_sai');
            }
        } 
        if (strlen($request->content) > 500) {
            $result['message_content'] = trans('message.noi_dung_khong_duoc_lon_hon_500_ky_tu');
        }
        if($result != []){
            return json_encode($result);
        }

        $data = [
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
        ];

        Account::findOrFail($request->id_account)->update($data);

        $email_admin = getOptions('general', 'email_admin');

        
        $order = new Order;
        $order->id_account = $request->id_account;
        $order->content = $request->content;
        $order->status = 1;
        $order->save();

        $orderDetail                   = new OrderDetail;
        $orderDetail->id_order         = $order->id;
        $orderDetail->id_product       = $request->id_product;
        $orderDetail->save();

        $content_email = [
            'title' => 'Khách hàng đặt hàng',
            'type' => 'order',
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'content' => $request->content,
            'link_product' => $request->link_product,
            'url' => route('order.edit', $order->id),
        ];

        Mail::send('frontend.mail.mail-teamplate', $content_email, function ($msg) use($email_admin) {
            $msg->from('tuannd.mkt@ae-techvn.com', 'Website - HICHEM');
            $msg->to($email_admin, 'Website - HICHEM')->subject('Khách hàng đặt hàng');
        });

        $result['success'] = ucfirst(trans('message.thong_bao_thanh_cong'));
        $result['notification'] = trans('message.thanh_cong');
        return json_encode($result);
    }

    public function getNotifications(Request $request) {

        $id = $request->id;

        $data = Notifications::where('id', $id)->first();

        $view = (string) View::make('frontend.ajax.notification',compact('data'));

        return $view;
    }

    public function getPrivacyPolicy() {
        $dataSeo = Pages::where('type', 'privacy-policy')->whereLang(app()->getLocale())->first();
        $this->createSeo($dataSeo);
        return view('frontend.pages.privacy-policy', compact('dataSeo'));
    }

    public function getListProject() {
        $dataSeo = Pages::where('type', 'projects')->whereLang(app()->getLocale())->first();
        $this->createSeo($dataSeo);
        $data = Projects::where('status', 1)->orderBy('created_at', 'DESC')->paginate(6);
        $project_view_much = Projects::where('status', 1)->where('view', '>', 0)->orderBy('view', 'DESC')->take(10)->get();

         return view('frontend.pages.archives-project', compact('dataSeo', 'data', 'project_view_much'));
    }

    public function getSingleProject($slug) {
        $dataSeo = Pages::where('type', 'projects')->whereLang(app()->getLocale())->first();
        $data = Projects::where('status', 1)->where('slug', $slug)->firstOrFail();
        $this->createSeoPost($data);
        $data->view = $data->view + 1;
        $data->save();
        $project_view_much = Projects::where('status', 1)->where('view', '>', 0)->orderBy('view', 'DESC')->take(10)->get();
        $project_same = Projects::where('id', '!=', $data->id)->where('status', 1)->inRandomOrder()->take(6)->get();

        return view('frontend.pages.single-project', compact('dataSeo', 'data', 'project_view_much', 'project_same'));
    }

    public function getListMedia() {
        $dataSeo = Pages::where('type', 'media')->whereLang(app()->getLocale())->first();
        $this->createSeo($dataSeo);
        $data = Media::where('status', 1)->orderBy('created_at', 'DESC')->paginate(6);
        $media_view_much = Media::where('status', 1)->where('view', '>', 0)->orderBy('view', 'DESC')->take(10)->get();

         return view('frontend.pages.archives-media', compact('dataSeo', 'data', 'media_view_much'));
    }

    public function getSingleMedia($slug) {
        $dataSeo = Pages::where('type', 'media')->whereLang(app()->getLocale())->first();
        $data = Media::where('status', 1)->where('slug', $slug)->firstOrFail();
        $this->createSeoPost($data);
        $data->view = $data->view + 1;
        $data->save();
        $media_view_much = Media::where('status', 1)->where('view', '>', 0)->orderBy('view', 'DESC')->take(10)->get();
        $media_same = Media::where('id', '!=', $data->id)->where('status', 1)->inRandomOrder()->take(10)->get();

        return view('frontend.pages.single-media', compact('dataSeo', 'data', 'media_view_much', 'media_same'));
    }

    public function getListDownload() {
        $dataSeo = Pages::where('type', 'download')->whereLang(app()->getLocale())->first();
        $this->createSeo($dataSeo);
        $data = Downloads::where('status', 1)->orderBy('created_at', 'DESC')->paginate(6);
        $download_view_much = Downloads::where('status', 1)->where('view', '>', 0)->orderBy('view', 'DESC')->take(10)->get();

         return view('frontend.pages.archives-download', compact('dataSeo', 'data', 'download_view_much'));
    }

    public function getSingleDownload($slug) {
        $dataSeo = Pages::where('type', 'download')->whereLang(app()->getLocale())->first();
        $data = Downloads::where('status', 1)->where('slug', $slug)->firstOrFail();
        $this->createSeoPost($data);
        $data->view = $data->view + 1;
        $data->save();
        $download_view_much = Downloads::where('status', 1)->where('view', '>', 0)->orderBy('view', 'DESC')->take(10)->get();
        $download_same = Downloads::where('id', '!=', $data->id)->where('status', 1)->inRandomOrder()->take(10)->get();

        return view('frontend.pages.single-download', compact('dataSeo', 'data', 'download_view_much', 'download_same'));
    }

}
