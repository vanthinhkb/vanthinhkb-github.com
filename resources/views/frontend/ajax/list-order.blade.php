@foreach ($data as $key => $item)
    <tr>
        <th scope="row">{{ $key + 1 }}</th>
        <td>{{ app()->getLocale() == 'vi' ? $item->name : $item->name_en }}</td>
        <td>{{ $item->code }}</td>
        <td></td>
        <td>{{ $item->created_at->format('d-m-Y') }}</td>
    </tr>
@endforeach