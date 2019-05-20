@forelse ($menus as $menu)
@php
   $checked = $menu->permission->is_permission ?? 0 == 1 ? 'checked' : '';
@endphp

<li>
    {{$menu->name}}
    <input type="hidden" name="inactivebox[]" class="inactivebox" value="{{ $menu->id }}">
    <label class="checkbox-inline pull-right">
        <input type="checkbox" name="checkbox[]" id="menuId" class="minimal checkbox" value="{{ $menu->id }}" {{$checked}}>
    </label>
</li>
@empty
<div class="overlay"><i class="fa fa-info-circle" aria-hidden="true"></i></div>
@endforelse
