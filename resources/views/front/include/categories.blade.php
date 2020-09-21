<div class="categories">
    <span class="left-cat">Categories</span>
</div>
<ul class="nav nav__product-list" id="lp-tab" role="tablist" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
    <li class="nav-item">
        <a class="nav-link active" data-toggle="tab" href="#all_tab">All Items</a>
    </li>
    @foreach($show_category as $key => $c_info)
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#tab-{{$c_info->id}}">{!! $c_info->main_category !!}</a>
        </li>
    @endforeach
</ul>
