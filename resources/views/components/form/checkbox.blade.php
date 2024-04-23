<div class="inputArea">
    <label for="{{$name}}">
       {{$label ?? ''}}
    </label>
    <input
    type={{$type}}
    name="{{$name}}"
    {{empty($required) ? '' : 'required'}}
    value="1"
    {{$checked ? 'checked' : ''}}
    />
</div>
