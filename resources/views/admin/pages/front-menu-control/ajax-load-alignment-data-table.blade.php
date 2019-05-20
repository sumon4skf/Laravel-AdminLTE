@forelse ($menus as $menu)
<li>
    {{$menu->name}}
    <input type="hidden" name="{{$menuDepth."Parent"}}" value="{{ $menu->parent_id }}">
    <input type="hidden" name="{{$menuDepth."[]"}}" id="menuId" value="{{ $menu->id }}">
    <!-- drag handle -->
    <span class="handle pull-right">
        <i class="fa fa-ellipsis-v"></i>
        <i class="fa fa-ellipsis-v"></i>
    </span>
</li>
@empty
<div class="overlay"><i class="fa fa-info-circle" aria-hidden="true"></i></div>
@endforelse
