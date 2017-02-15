<?php $options = json_decode($row->details); $checked = false; ?>
<input type="text" class="form-control" name="{{ $row->field }}"
       placeholder="{{ $row->display_name }}"
       {!! isBreadSlugAutoGenerator($options) !!}
       value="@if(isset($dataTypeContent->{$row->field})){{ old($row->field, $dataTypeContent->{$row->field}) }}@elseif(isset($options->default)){{ old($row->field, $options->default) }}@else{{ old($row->field) }}@endif">
