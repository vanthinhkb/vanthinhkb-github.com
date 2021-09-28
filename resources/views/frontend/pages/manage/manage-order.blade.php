<div class="control__filter">
    <div class="filter__item">
        <input class="form-control input__text" type="text" name="key" placeholder="{{ trans('message.tu_khoa') }}...">
    </div>
    <div class="filter__item">
        <label class="">
            {{ trans('message.tu_ngay') }}
        </label>
        <input type="text" class="form-control input__text datepicker" data-date-format="yyyy-mm-dd" name="from_day">
    </div>
    <div class="filter__item">
        <label for="" class="">
            - {{ trans('message.den_ngay') }}
        </label>
        <input type="text" class="form-control input__text datepicker" data-date-format="yyyy-mm-dd" name="to_day">
    </div>
    <button type="submit" class=" filter__item btn btn__search">
        {{ trans('message.tim_kiem') }}
    </button>
</div>
<div class="manage__table">
    <div class="table-responsive-lg">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Nō</th>
                    <th scope="col">{{ trans('message.ten_san_pham') }} </th>
                    <th scope="col">{{ trans('message.ma_san_pham') }}</th>
                    <th scope="col">{{ trans('message.so_luong') }}</th>
                    <th scope="col">{{ trans('message.ngay_mua') }}</th>
                </tr>
            </thead>
            <tbody class="search-order">
			@if(!empty($orderDetail))
                @foreach ($orderDetail as $key => $item)
                    <tr>
                        <th scope="row">{{ $key + 1 }}</th>
                        <td>{{ app()->getLocale() == 'vi' ? $item->Products()->first()->name : $item->Products()->first()->name_en }}</td>
                        <td>{{ $item->Products()->first()->code }}</td>
                        <td></td>
                        <td>{{ $item->created_at->format('d-m-Y') }}</td>
                    </tr>
                @endforeach
			@endif
            </tbody>
        </table>
    </div>
</div>