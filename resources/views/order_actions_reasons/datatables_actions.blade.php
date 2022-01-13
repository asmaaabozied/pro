{!! Form::open(['route' => ['orderActionsReasons.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
    @can('orderActionsReasons.list')
        <a href="{{ route('orderActionsReasons.show', $id) }}" class='btn btn-primary btn-xs'>
            <i class="glyphicon glyphicon-eye-open"></i>
        </a>
    @endcan
    @can('orderActionsReasons.edit')
        <a href="{{ route('orderActionsReasons.edit', $id) }}" class='btn btn-success btn-xs'>
            <i class="glyphicon glyphicon-edit"></i>
        </a>
    @endcan
    @can('orderActionsReasons.delete')
        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', [
            'type' => 'submit',
            'class' => 'btn btn-danger btn-xs',
            'onclick' => "return confirm('Are you sure?')"
        ]) !!}
    @endcan
</div>
{!! Form::close() !!}
