{{--
    $name : name 값
    $default : 기본 선택 값
    $list : select list 값
    $placeholder : placeholder 값 (default와 다르게 표시 하기 위함)
--}}

<select name="{{$name}}">
    @if(isset($default))
        <option value="">
            {{$default}}
        </option>
    @endif
    @foreach($list as $key => $value)
        <option value="{{$key}}"
            @if(old($name) == $key)
                selected
            @endif
        >{{$value}}</option>
    @endforeach
    @if(count($list) == 0 && isset($placeholder))
        <option>
            {{$placeholder}}
        </option>
    @endif
</select>
