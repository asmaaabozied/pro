{!! Form::open(['route' => ['roles.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
    @can('roles.list')
        <a href="{{ route('roles.show', $id) }}" class='btn btn-primary btn-xs'>
            <i class="glyphicon glyphicon-eye-open"></i>
        </a>
    @endcan
    @if($id != 1 || (!empty($currentUser) && $currentUser->hasRole('super-admin' )))
        @can('roles.edit')
            <a href="{{ route('roles.edit', $id) }}" class='btn btn-success btn-xs'>
                <i class="glyphicon glyphicon-edit"></i>
            </a>
        @endcan
        @can('roles.delete')
            {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', [
                'type' => 'submit',
                'class' => 'btn btn-danger btn-xs',
                'onclick' => "return confirm('Are you sure?')"
            ]) !!}
        @endcan
    @endif
</div>
{!! Form::close() !!}
