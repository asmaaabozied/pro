@if($type == 'system')
    <a href="{{route(strtolower($module).'.show', $module_id)}}" target="_blank"><i class="fa fa-link"></i>  {{$module.'/'.$module_id}}</a>
@else
    ـــــ
@endif