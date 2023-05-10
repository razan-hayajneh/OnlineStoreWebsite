{!! Form::open(['route' => ['order.cancel', ['order_id'=>$id]], 'method' => 'post']) !!}
<div class='btn-group'>
    <a href="{{ route('orders.show', $id) }}" class='btn btn-default btn-xs'>
        <i class="fa fa-eye"></i>
    </a>
    <button onclick="getOrderStatuses()" data-toggle="modal" data-target="#editStutus" class="group"
        style="border: none;background-color: #FFFFFF;color:#007BFF">
        <i class="fa fa-edit"></i>
    </button>

    {{-- <a href="{{ route('orders.edit', $id) }}" class='btn btn-default btn-xs'>
        <i class="fa fa-edit"></i>
    </a> --}}
    {!! Form::button('<i class="fa fa-trash"></i>', [
        'type' => 'submit',
        'class' => 'btn btn-danger btn-xs',
        'onclick' => 'return confirm("'.__('crud.are_you_sure').'")'
    ]) !!}
</div>
{!! Form::close() !!}
<!-- Modal Example Start-->
{!! Form::open(['route' => 'order.editStatus']) !!}
<div class="modal fade" id="editStutus" tabindex="-1" role="dialog" aria-labelledby="editStutusLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editStutusLabel">{{ __('awt.Add New Product To order #' ). $id }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::text('type', 'index', ['class' => 'form-control','style'=>'display:none']) !!}
                {!! Form::number('order_id', $id ?? null, ['class' => 'form-control','style'=>'display:none']) !!}
                <!-- Parent Id Field -->
                <div class="form-group col-sm-5" style="display: inline-block;">
                    {!! Form::label('order_status', __('awt.order_status') . ':') !!}
                    {!! Form::select(
                        'order_status',
                        isset($orderStatuses) ? $orderStatuses : [],
                        $order_status,
                        [
                            'class' => 'form-control custom-select',
                            'id' => 'order_status',
                        ],
                    ) !!}
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"
                    aria-label="Close">{{ __('awt.Close') }}</button>
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
            </div>
        </div>
    </div>
</div>
<!-- Modal Example End-->
<script>
    function getOrderStatuses() {
        var html = '';
        let order_status = {{!!$order_status!!}};
        $.ajax({
            url: `{{ route('admin.ajax.getOrderStatuses') }}`,
            type: 'get',
            dataType: 'json',
            data: {},
            success: function(res) {
                alter(res.data)
                html +=
                    `<option value="" hidden selected>{{ app()->getLocale() == 'ar' ? '--اختر--' : '--select--' }}</option>`;
                $.each(res.data, function(index, value) {
                    html +=
                        `<option value="${index}" ${order_status == index ? 'selected':'' }>${value}</option>`;
                });
                $('#order_status').append(html);
            }
        });
    }
</script>
