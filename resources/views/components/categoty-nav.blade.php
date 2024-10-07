<ul class="mega-menu">
    <li>
        <ul class="sub-menu">
            @foreach ($category as $item)
                <li><a href="{{route('user.findcategory',$item->name)}}">{{$item->name}}</a></li>
            @endforeach
        </ul>
    </li>
</ul>