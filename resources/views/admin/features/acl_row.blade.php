
<tr class="tr_clone" id="tr_{{$index}}">
   <td class="w-25">
      <select class="form-control main_option" name="feature_id[{{$index}}]" id="main_option{{$index}}">
         @forelse($features as $key => $value)
            <option value="{{$key}}">{{$value}}</option>
         @empty
         @endforelse
      </select>
   </td>
   <td class="w-25">
      {{Form::select('conflict['.$index.'][]',$features,null,['class'=>'form-control  conflict js-example-basic-single','id'=>'conflict'.$index, "multiple"=>"multiple"])}}
   </td>
   <td class="w-25">
      {{Form::select('togetherness['.$index.'][]',$features,null,['class'=>'form-control  togetherness js-example-basic-single','id'=>'togetherness'.$index, "multiple"=>"multiple"])}}
   </td>
   <td class="w-25">
      {{Form::select('dependency['.$index.'][]',$features,null,['class'=>'form-control  dependency js-example-basic-single','id'=>'dependency'.$index, "multiple"=>"multiple"])}}
   </td>
</tr>