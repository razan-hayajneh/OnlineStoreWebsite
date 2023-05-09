
<a href= '{{route('optionKeys',$query->id)}}'>
<button   class="btn btn-success btn-round-2">
    __('option keys') 
  </button>
</a>

'<div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success" style="direction: ltr">
  <input type="checkbox" onchange="getOptions('.$query->id.')"  class="custom-control-input" id="customSwitch'.$query->id.'">
  <label class="custom-control-label" id="status_label'.$query->id.'" for="customSwitch'.$query->id.'"></label>
</div>'


' <a href= "{{ route(' . 'optionKeys.index' . ') }}">