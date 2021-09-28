<?php
    $data = App\Models\Notifications::where('status', 1)->get();
    $array = array();
    foreach ($data as $key => $item) {
        $array[$key+1] = $item->id;
    }
?>

<div class="addon-notification">
    <button class="addon__cols">
        <i class="fas fa-times-circle"></i>
    </button>
    <a href="#" class="group">
        <div class="group__item group__avata">
            <img src="{{ @$item->image }}" alt="{{ app()->getLocale() == 'vi' ? @$item->title : @$item->title_en }}">
        </div>
        <div class="group__item group__content
        ">
            <h3 class="addon__title">
                {{ app()->getLocale() == 'vi' ? @$item->title : @$item->title_en }}
            </h3>
            <p class="addon__desc">
                {{ app()->getLocale() == 'vi' ? @$item->content : @$item->content_en }}
            </p>
        </div>
    </a>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        var myArray = {
            @foreach($data as $k => $item)
            '{{$k+1}}': {{$item->id}},
            @endforeach
        };

        var b = 1;

        //getAjaxNotice();

        var countData = {{count($data)}};

       var rotator = function(){

           $.ajax({
            url: '{{route('home.notifications')}}',
            type: 'GET',
            data: {
                id: myArray[b],
            }
        }).done(function(ketqua) {
            
             $('.addon-notification').html(ketqua);

             $(".addon-notification").addClass("active");

             $(".addon__cols").click(function () {
                $(".addon-notification").removeClass("active");
            });

             setTimeout(function() {
                $(".addon-notification").removeClass("active");
            }, 3000);
        });

              b+=1;

              if(b==countData+1){
                  b=1;
              }
              setTimeout(rotator,12000);
        };
        // rotator();
        setTimeout(rotator,3000);
    });
</script>








