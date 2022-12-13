@foreach($optionGroups as $optionGroup)

    @if(in_array($optionGroup->id,$checkOptionGroupList))
        <ul>
            <li class="option-group-name">{{ $optionGroup->name }}</li>
            <ul class="option-name">
                @foreach($options as $option)
                    @if($option->option_group_id == $optionGroup->id)
                        <li data-option-value="{{ $option->id }}" data-option-type="{{ $option->type }}">{{ $option->name }}</li>
                    @endif
                @endforeach
            </ul>
        </ul>
    @endif


@endforeach





