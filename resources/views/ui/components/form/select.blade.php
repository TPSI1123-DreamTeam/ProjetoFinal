<div class="form-group">
    <label for="{{$name}}">{{$title}}</label>

    <select required id="{{$name}}" class="form-control" name="{{$name}}">
        <option>Choose...</option>
        @foreach($list as $item)
            <option value="{{$getId($item)}}">{{$getDisplayValue($item)}}</option>
        @endforeach
    </select>
</div>
