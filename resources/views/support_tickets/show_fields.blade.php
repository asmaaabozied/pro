<div class="col-sm-12">
    <div class="col-sm-12" style="background: #3c8dbcab;">
        <h4 style="color: #222d32"><b>{{ trans('common.fields') }}</b></h4>
    </div>
    <div class="col-sm-12">
        <br/>
    </div>
</div>

<!-- Name Field -->
<div class="form-group col-sm-3">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('supportTicket.fields.name_help') }}"></i> &nbsp;{!! Form::label('name', trans('supportTicket.fields.name')) !!}
    <div class="field_show"><div class="col-sm-1">&nbsp;</div>{{ $supportTicket->name }}</div>
</div>

<!-- Email Field -->
<div class="form-group col-sm-3">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('supportTicket.fields.email_help') }}"></i> &nbsp;{!! Form::label('email', trans('supportTicket.fields.email')) !!}
    <div class="field_show"><div class="col-sm-1">&nbsp;</div> <a href="mailTo:{{ $supportTicket->email }}"><i class="fa fa-envelope"></i> {{ $supportTicket->email }}</a></div>
</div>

<!-- Phone Field -->
<div class="form-group col-sm-2">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('supportTicket.fields.title_en_help') }}"></i> &nbsp;{!! Form::label('phone', 'Phone:') !!}
    <div class="field_show"><div class="col-sm-1">&nbsp;</div> <a href="call:{{ $supportTicket->phone }}"><i class="fa fa-phone"></i> {{ $supportTicket->phone }}</a></div>
</div>

<!-- Type Field -->
<div class="form-group col-sm-2">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('supportTicket.fields.type_help') }}"></i> &nbsp;{!! Form::label('type', trans('supportTicket.fields.type')) !!}
    <div class="field_show text-center" style="background: {{array_search($supportTicket->type, trans('supportTicket.types'))}}"><div class="col-sm-1">&nbsp;</div> <span style="color: white">{{ $supportTicket->type }}</span></div>
</div>

<!-- Responded Field -->
<div class="form-group col-sm-2">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('supportTicket.fields.responded_help') }}"></i> &nbsp;{!! Form::label('responded', trans('supportTicket.fields.responded')) !!}<br/>
    <h4>
        @if($supportTicket->responded)
            <div class="col-sm-1">&nbsp;</div><i style="color: green;" class="fa fa-lg fa-check-circle-o"></i>
        @else
            <div class="col-sm-1">&nbsp;</div><i style="color: red;" class="fa fa-lg fa-times"></i>
        @endif
    </h4>
</div>

<!-- Message Field -->
<div class="form-group col-sm-9">
    <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top" title=" {{ trans('supportTicket.fields.message_help') }}"></i> &nbsp;{!! Form::label('message', trans('supportTicket.fields.message')) !!}
    <div class="field_show"><div class="col-sm-1">&nbsp;</div>{{ $supportTicket->message }}</div>
</div>


<!-- Back Field -->
<div class="form-group col-sm-12">
    <hr style="border-color: #3c8dbcab"/>
    @can('supportTickets.list')
        <a href="{{ route('supportTickets.index') }}" class="btn btn-default col-sm-2"><i class="fa fa-reply"></i> {{ trans('common.back') }}</a>
    @endcan
    <div class="col-sm-1">&nbsp;</div>
    @can('supportTickets.edit')
        <a href="{{ route('supportTickets.edit', $supportTicket->id) }}" class="btn btn-success col-sm-2"><i class="fa fa-pencil"></i> {{ trans('common.edit') }}</a>
    @endcan
    <div class="col-sm-1">&nbsp;</div>
    <!-- @can('supportTickets.delete')
        <a href="{{ route('supportTickets.destroy', $supportTicket->id) }}" onclick="return confirm('Are you sure?')" class="btn btn-danger pull-right"><i class="fa fa-trash"></i> {{ trans('common.delete') }}</a>
    @endcan -->
</div>
