    <form action="" method="post">
        @csrf
        <div class="name-cell">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" value="{{$item->name ?? ''}}" >
        </div>
        <div class="description-cell">
            <label for="description">Description</label>
            <textarea name="description" id="description" cols="30" rows="10" >
                {{ $item->description ?? ''}}
            </textarea>
        </div>
        <div class="price-cell">
            <label for="price">Price</label>
            <input type="number" name="price" id="price" value="{{$item->price ?? ''}}" >
        </div>
        <div class="city-cell">
            <label for="city">City</label>
            <input type="text" name="city" id="city" value="{{$item->city ?? ''}}" >
        </div>
        @isset($new)
            <div class="user-id-cell">
                <label for="user_id">Owner</label>
                <input type="text" name="user_id" id="user_id" value="">
            </div>
        @endisset
        <div class="button-cell">
            @empty($new)
                <button class="form-btn" type="button">Edit</button>
            @endempty
            <button class="form-btn" type="submit">Save</button>
        </div>
    </form>