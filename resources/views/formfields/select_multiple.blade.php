{{-- If this is a relationship and the method does not exist, show a warning message --}}
@if(isset($options->relationship) && !method_exists( $dataType->model_name, $row->field ) )
    <p class="label label-warning"><i class="voyager-warning"></i> Make sure to setup the appropriate relationship in the {{ $row->field . '()' }} method of the {{ $dataType->model_name }} class.</p>
@endif

<select class="form-control select2" name="{{ $row->field }}[]" multiple>
    @if(isset($options->relationship))
        {{-- Check that the method relationship exists --}}
        @if( method_exists( $dataType->model_name, $row->field ) )
            <?php $selected_values = isset($dataTypeContent) ? $dataTypeContent->{$row->field}()->pluck($options->relationship->key)->all() : array(); ?>
            <?php $relationshipClass = get_class(app($dataType->model_name)->{$row->field}()->getRelated()); ?>
            <?php $relationshipOptions = $relationshipClass::all(); ?>
            @foreach($relationshipOptions as $relationshipOption)
                <option value="{{ $relationshipOption->{$options->relationship->key} }}" @if(in_array($relationshipOption->{$options->relationship->key}, $selected_values)){{ 'selected="selected"' }}@endif>{{ $relationshipOption->{$options->relationship->label} }}</option>
            @endforeach
        @endif
    @elseif(isset($options->options))
        @foreach($options->options as $key => $label)
            <?php $selected = ''; ?>
            @if(is_array($dataTypeContent->{$row->field}) && in_array($key, $dataTypeContent->{$row->field}))
                <?php $selected = 'selected="selected"'; ?>
            @endif
            <option value="{{ $key }}" {!! $selected !!}>
                {{ $label }}
            </option>
        @endforeach
    @endif
</select>