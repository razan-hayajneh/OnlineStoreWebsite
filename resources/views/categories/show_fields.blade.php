<!-- Name Field -->
{{-- <div class="col-sm-12">
    {!! Form::label('name', __('models/categories.fields.name').':') !!}
    <p>{{ $category->name }}</p>
</div>

<!-- Parent Id Field -->
<div class="col-sm-12">
    {!! Form::label('parent_id', __('models/categories.fields.parent_id').':') !!}
    <p>{{ $category->parent_id }}</p>
</div>

<!-- Active Field -->
<div class="col-sm-12">
    {!! Form::label('active', __('models/categories.fields.active').':') !!}
    <p>{{ $category->active }}</p>
</div>

<!-- Image Field -->
<div class="col-sm-12">
    {!! Form::label('image', __('models/categories.fields.image').':') !!}
    {{-- <p>{{ $category->image }}</p>
    <p><img
        src='http://online store.test/storage/{{ $category->image   }}'
      style="width:100px"></p>
</div>

<!-- Created At Field -->
<div class="col-sm-12">
    {!! Form::label('created_at', __('models/categories.fields.created_at').':') !!}
    <p>{{ $category->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="col-sm-12">
    {!! Form::label('updated_at', __('models/categories.fields.updated_at').':') !!}
    <p>{{ $category->updated_at }}</p>
</div> --}}
<strong style="text-align: center">{{ __('models/categories.fields.subCategory') }}</strong>

<table class="table">

    <thead>

      <tr>
        <th scope="col">#</th>
        <th scope="col">{{ __('models/categories.fields.name') }}</th>
        <th scope="col">{{  __('models/categories.fields.active') }}</th>
        <th scope="col">{{ __('models/categories.fields.image') }}</th>
        <th scope="col">  {{ awtTrans('action') }}</th>

      </tr>
    </thead>
    <tbody>
            @foreach ($categories as $ob)
                <tr>
                    <td>{{ $ob->id }}</td>
                    <td>{{ $ob->name }}</td>
                    <td><div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success" style="direction: ltr">
                        <input type="checkbox" onchange="changeActive({{ $ob->id }})" {{ $ob->active == 1 ? 'checked' : '' }}  class="custom-control-input" id="customSwitch{{ $ob->id }}">
                        <label class="custom-control-label" id="status_label{{ $ob->id }}" for="customSwitch{{ $ob->id }}"></label>
                    </div></td>

                    <td>
                       @if ($ob->image !=null)
                        <img src='{{ dashboard_url($ob->image_path)}}' style="width:100px">
                        @else <div></div>
                        @endif
                    </td>

                    <td>

                        <a href="{{ route('products.index', ['id' => $ob->id]) }}">
                            <button   class="btn btn-success btn-round-2">
                              Show product
                              </button>
                            </a>
                     </td>
            @endforeach


    </tbody>
  </table>

