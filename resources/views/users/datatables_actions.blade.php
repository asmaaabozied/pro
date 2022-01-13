{!! Form::open(['route' => ['users.destroy', $id], 'method' => 'delete']) !!}
@can('users.list')
    <a href="{{ route('users.show', $id) }}" class='btn btn-primary btn-xs'>
        <i class="glyphicon glyphicon-eye-open"></i>
    </a>
@endcan
@if($id != 1 || (!empty($currentUser) &&  $currentUser->hasRole('super-admin') ))
    @can('users.edit')
        <a href="{{ route('users.edit', $id) }}" class='btn btn-success btn-xs'>
            <i class="glyphicon glyphicon-edit"></i>
        </a>
    @endcan
    @can('users.delete')
        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', [
            'type' => 'submit',
            'class' => 'btn btn-danger btn-xs',
            'onclick' => "return confirm('Are you sure?')"
        ]) !!}
    @endcan
@endif
{!! Form::close() !!}
