@if(date('Y-m-d') <= date('Y-m-d',strtotime($end_date)))
    <i style="color: green;" class="fa fa-2x fa-check-circle-o"></i>
@else
    <i style="color: red;" class="fa fa-lg fa-times"></i>
@endif