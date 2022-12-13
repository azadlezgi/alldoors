@foreach($attributeGroups as $attributeGroup)

    @if(in_array($attributeGroup->id,$checkAttributeGroupList))
        <ul>
            <li class="attribute-group-name">{{ $attributeGroup->name }}</li>
            <ul class="attribute-name">
                @foreach($attributes as $attribute)
                    @if($attribute->attribute_group_id == $attributeGroup->id)
                        <li data-attribute-value="{{ $attribute->id }}">{{ $attribute->name }}</li>
                    @endif
                @endforeach
            </ul>
        </ul>
    @endif


@endforeach





