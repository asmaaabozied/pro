{!! Form::open(['route' => ['users.destroy', $id], 'method' => 'delete']) !!}
@can('users.list')
    <a href="{{ route('users.show', $id) }}" class='btn btn-primary btn-xs'>
        <i class="glyphicon glyphicon-eye-open"></i>
    </a>
@endcan

<span type="button" class="notifyBtn" id="{{$id}}_notifyBtn" data-toggle="modal" data-target="#ModelNotify">
    <i class="glyphicon glyphicon-bell btn btn-info btn-xs"></i>
</span>

<span type="button" class="giftBtn" id="{{$id}}_giftBtn" data-referral="{{$referrals_count}}" data-toggle="modal" data-target="#ModelGift">
    <i class="glyphicon glyphicon-gift btn btn-warning btn-xs"></i>
</span>
   
{!! Form::close() !!}
