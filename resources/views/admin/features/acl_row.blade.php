
<tr class="tr_clone" id="tr_{{$index}}">
   <td class="w-20">
      <select class="form-control main_option" name="feature_id[{{$index}}]" id="main_option{{$idstr}}">
         <option value="0">Choose Option</option>
         @forelse($features as $key => $value)
            <option value="{{$key}}">{{$value}}</option>
         @empty
         @endforelse
      </select>
   </td>
   <td class="w-20">
      {{Form::select('conflict['.$index.'][]',$features,null,['class'=>'form-control  conflict js-example-basic-single','id'=>'conflict'.$idstr, "multiple"=>"multiple"])}}
   </td>
   <td class="w-20">
      {{Form::select('dependency['.$index.'][]',$features,null,['class'=>'form-control  dependency js-example-basic-single','id'=>'dependency'.$idstr, "multiple"=>"multiple"])}}
   </td>
   <td class="w-20">
      {{Form::select('togetherness['.$index.'][]',$features,null,['class'=>'form-control  togetherness js-example-basic-single','id'=>'togetherness'.$idstr, "multiple"=>"multiple"])}}
   </td>
   <td class="w-20 delete_acl_row">

      <a href="#" class="removeACLRowBtn"><i class="fas fa-trash-alt"></i> Delete</a>
   </td>
</tr>