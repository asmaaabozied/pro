<!-- Order Id Field -->
<div class="form-group">
    {!! Form::label('order_id', 'Order Id:') !!}
    <p>{{ $orderAction->order_id }}</p>
</div>

<!-- Reason Id Field -->
<div class="form-group">
    {!! Form::label('reason_id', 'Reason Id:') !!}
    <p>{{ $orderAction->reason_id }}</p>
</div>

<!-- Detail Field -->
<div class="form-group">
    {!! Form::label('detail', 'Detail:') !!}
    <p>{{ $orderAction->detail }}</p>
</div>

<!-- Status Field -->
<div class="form-group">
    {!! Form::label('status', 'Status:') !!}
    <p>{{ $orderAction->status }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $orderAction->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $orderAction->updated_at }}</p>
</div>

