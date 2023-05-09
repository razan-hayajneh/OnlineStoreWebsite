@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    {{ __('item option') }}
                </div>
                <div class="col-sm-6">
                    <a class="btn btn-default float-right"
                       href="{{ route('products.index',['id'=>$category_id]) }}">
                         @lang('crud.back')
                    </a>
                </div>
            </div>
        </div>
    </section>
    <div class="content px-3">

        @include('flash::message')
        @if (\Session::has('message'))
        <div class="alert alert-danger">
            <ul>
                <li>{!! \Session::get('message') !!}</li>
            </ul>
        </div>
    @endif
        <div class="clearfix"></div>

        <div class="card">
            <div class="card-body p-8">

              {{-- <button    class="group" style=" height:40px; border-radius: 8px; margin-bottom:15px">
                    <a href="{{ route('create.itemOption',['item_id'=>$item_id]) }}" style="color:#fff" >
                    <i class="fa fa-plus"></i>
                    {{ __('awt.add') }}
                    </a>
                </button> --}}

                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    <i class="fa fa-plus"></i>
                    {{ __('Add') }}
                  </button>


                  {{-- <button type="button" class=" group" style="width: 80px;height:40px">
                    <a href="{{ route('products.exportPdf',['category_id'=>$category_id]) }}" style="color:#fff" target="__blank">
                        <div style="display: inline-block;">
                            <i class="fas fa-file-pdf" style="color:#fff"></i>
                            <span style="font-size: 12px">{{ __('awt.pdf') }}</span>
                        </div>
                    </a>
                </button>
                </button>
                <button type="button" class=" group" style="width: 80px;height:40px">
                    <a href="{{ route('products.exportExcel',['category_id'=>$category_id]) }}" style="color:#fff">
                        <div style="display: inline-block;">
                            <i class="fas fa-file-excel" style="color:#fff"></i>
                            <span style="font-size: 12px">{{ __('awt.excel') }}</span>
                        </div>
                    </a>
                </button> --}}

                <div class="clearfix " style="margin-top: 15px">
                    <div >

                        <table class="table">

                            <thead>

                              <tr>
                                <th scope="col">{{ __('Option') }}</th>
                                <th scope="col">{{ __('awt.key') }}</th>
                                <th scope="col">{{ __('Price') }}</th>
                                <th scope="col">{{ __('Quantity') }}</th>
                                <th scope="col">{{ __('Action') }}</th>


                              </tr>
                            </thead>
                            <tbody>
                                    @foreach ($item_options as $ob)
                                        <tr>
                                            <td>{{ $ob->optionKey->option->name }}</td>
                                            <td>{{ $ob->optionKey->key }}</td>
                                           <td>{{ $ob->price }}</td>
                                           <td>{{ $ob->quantity }}</td>
                                           <td>
                                            <div class='btn-group'>
                                                <button onclick="edit({{ $ob }} , {{ $ob->optionKey->option->id}} ,{{ $ob->optionKey->id}})" data-toggle="modal"
                                                        data-target="#editModel" data-placement="top"
                                                        data-original-title="{{ awtTrans('تعديل') }}"
                                                        class="btn btn-sm btn-clean btn-icon btn-icon-md">
                                                        <i class="fa fa-edit" style="    margin-top: -16px;
                                                        "></i>
                                                    </button>
                                                {!! Form::open(['route' => ['Option.destroy', $ob->id], 'method' => 'delete']) !!}
                                                {!! Form::button('<i class="fa fa-trash"></i>', [
                                                    'type' => 'submit',
                                                    'class' => 'btn btn-danger btn-xs',
                                                    'onclick' => 'return confirm("'.__('crud.are_you_sure').'")'
                                                ]) !!}
                                                {!! Form::close() !!}

                                            </div>
                                           </td>


                                    @endforeach


                            </tbody>
                          </table>



                    </div>

                </div>


            </div>

        </div>
    </div>
    <div style="height:700px" class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content " style="padding-inline: 20px">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">add</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            {!! Form::open(['route' => 'create.itemOption']) !!}
            <div class="form-group ">
                {!! Form::label('option_id', __('models/.fields.option') . ':') !!}
                {!! Form::select('option_id', $options, null, [
                    'class' => 'form-control custom-select ',
                    'id' => 'optionId',
                    'onchange' => 'getOptionKey()',
                ]) !!}
            </div>

            <!-- option key Id Field -->
            <div class="form-group ">
                {!! Form::label('option_key_id', __('models/.fields.option_key') . ':') !!}
                {!! Form::select('option_key_id', isset($cities) ? $cities : [], isset($order) ? $order->address->city_id : null, [
                    'class' => 'form-control custom-select ',
                    'id' => 'optionKeyId',
                ]) !!}
            </div>

            <div class="form-group ">
                {!! Form::label('option_price', __('models/.fields.option_price').':') !!}
                {!! Form::number('option_price', null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group ">
                {!! Form::label('option_quantity', __('models/.fields.option_quantity').':') !!}
                {!! Form::number('option_quantity', null, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group ">
                {!! Form::hidden('item_id',$item_id, null, ['class' => 'form-control']) !!}
            </div>


            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
            </div>

            {!! Form::close() !!}
          </div>
        </div>
      </div>
    </div>




   <div class="modal fade" id="editModel">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">{{ __('edit') }}</h4>
                </div>
                    @csrf
                    <div class="modal-body">
                        <!--begin::Portlet-->
                        {!! Form::open(['route' => 'itemOption.update']) !!}
                        <div class="form-group ">
                            {!! Form::label('option_id', __('models/.fields.option') . ':') !!}
                            {!! Form::select('option_id', $options, null, [
                                'class' => 'form-control custom-select ',
                                'id' => 'optionIdEdit',
                                'onchange' => 'getOptionKeyEdit()',
                            ]) !!}
                        </div>

                        <!-- option key Id Field -->
                        <div class="form-group ">
                            {!! Form::label('option_key_id', __('models/.fields.option_key') . ':') !!}
                            {!! Form::select('option_key_id', isset($cities) ? $cities : [], isset($order) ? $order->address->city_id : null, [
                                'class' => 'form-control custom-select ',
                                'id' => 'optionKeyIdEdit',
                            ]) !!}
                        </div>

                        <div class="form-group ">
                            {!! Form::label('option_price', __('models/.fields.option_price').':') !!}
                            {!! Form::text('price', null,  [
                                'class' => 'form-control custom-select ',
                                'id' => 'price',
                            ]) !!}
                        </div>

                        <div class="form-group ">
                            {!! Form::label('option_quantity', __('models/.fields.option_quantity').':') !!}
                            {!! Form::text('quantity', null,[
                                'class' => 'form-control custom-select ',
                                'id' => 'quantity',
                            ]) !!}
                        </div>
                        <div class="form-group ">
                            {!! Form::text('id', null ,['class' => 'form-control' ,
                             'id' => 'id' ,
                             'style'=>"display:none"
                             ]) !!}
                        </div>


                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                        </div>


                        {!! Form::close() !!}
            </div>
        </div>
    </div>




@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script>

function edit(ob ,x, y) {
var html = '';
$.ajax({
   url: `{{ route('admin.ajax.getOptionKey') }}`,
       type: 'get',
       dataType: 'json',
       data: {
         id: x
       },
       success: function(res) {
          html +=
          `<option value="" hidden selected>{{ app()->getLocale() == 'ar' ? 'اختر ' : 'select ' }}</option>`;
           $.each(res.data, function(index, value) {

           html +=
             `<option value="${value.id}" ${value.id == y ? 'selected':'' } >${value.key.ar}</option>`;
           });
           $('#optionKeyIdEdit').append(html);
        }
   });
  $("input#id:text").val(ob.id);
  $("input#quantity:text").val(ob.quantity);
  $("input#price:text").val(ob.price);
  $("select#optionIdEdit").val(x);
}
</script>
