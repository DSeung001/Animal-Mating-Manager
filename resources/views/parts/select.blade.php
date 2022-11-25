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
