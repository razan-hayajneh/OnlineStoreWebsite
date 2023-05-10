{!! Form::open(['route' => ['order.cancel', ['order_id'=>$id]], 'method' => 'post']) !!}
<div class='btn-group'>
    <a href="{{ route('orders.show', $id) }}" class='btn btn-default btn-xs'>
        <i class="fa fa-eye"></i>
    </a>
    {!! Form::button('<i class="fa fa-trash"></i>', [
        'type' => 'submit',
        'class' => 'btn btn-danger btn-xs',
        'onclick' => 'return confirm("'.__('crud.are_you_sure').'")'
    ]) !!}
</div>
{!! Form::close() !!}
