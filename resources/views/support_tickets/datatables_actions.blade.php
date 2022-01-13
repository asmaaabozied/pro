{!! Form::open(['route' => ['supportTickets.destroy', $id], 'method' => 'delete']) !!}
<div class='btn-group'>
    @can('supportTickets.list')
        <a href="{{ route('supportTickets.show', $id) }}" class='btn btn-primary btn-xs'>
            <i class="glyphicon glyphicon-eye-open"></i>
        </a>
    @endcan
    @can('supportTickets.edit')
        <a href="{{ route('supportTickets.edit', $id) }}" class='btn btn-success btn-xs'>
            <i class="glyphicon glyphicon-edit"></i>
        </a>
    @endcan
    @can('supportTickets.delete')
        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', [
            'type' => 'submit',
            'class' => 'btn btn-danger btn-xs',
            'onclick' => "return confirm('Are you sure?')"
        ]) !!}
    @endcan
</div>
{!! Form::close() !!}
