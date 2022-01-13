@for($i = 1; $i<=5; $i++)
    @if($i <= $rate)
        <span class="fa fa-star" style="color: #c69500"></span>
    @else
        <span class="fa fa-star-o"></span>
    @endif
@endfor