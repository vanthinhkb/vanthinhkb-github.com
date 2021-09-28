
<button class="addon__cols">
    <i class="fas fa-times-circle"></i>
</button>
<a href="#" class="group">
    <div class="group__item group__avata">
        <img src="{{ @$data->image }}" alt="{{ app()->getLocale() == 'vi' ? @$data->title : @$data->title_en }}">
    </div>
    <div class="group__item group__content
    ">
        <h3 class="addon__title">
            {{ app()->getLocale() == 'vi' ? @$data->title : @$data->title_en }}
        </h3>
        <p class="addon__desc">
            {{ app()->getLocale() == 'vi' ? @$data->content : @$data->content_en }}
        </p>
    </div>
</a>
