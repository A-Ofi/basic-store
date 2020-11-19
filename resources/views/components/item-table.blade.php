<table class="tidy">
    <thead>
        <tr class="stick">
            <th>ID</th>
            @foreach($headers as $header)
                <th>{{$header}}</th>
            @endforeach
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($items as $item)
            <tr id='row-{{$item->id}}'>
                <td>{{$item->id}}</th>
                @foreach($headers as $header)
                    <td>{{$item->{Str::snake($header)} }}</th>
                @endforeach
                <td>
                        <a class="edit" href="/admin/items/{{$item->id}}">Edit</a>
                </td>
                @isset($detachableUser)
                    <td>
                        <button id="{{$item->id}}" class="remove">Remove</button>
                    </td>
                @endisset
            </tr>
        @endforeach
    </tbody>
</table>

@isset($detachableUser)
<script>
    let removeAnchors = document.querySelectorAll('.remove')
    removeAnchors.forEach((anchor, i) => anchor.onclick = async () => {
        let response = await fetch(`/admin/users/{{$detachableUser->id}}/detach/${anchor.id}`,{
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{csrf_token()}}'
            }
        })
        if (response.status === 200){
            document.getElementById(`row-${anchor.id}`.toString()).remove(); 
            //show toast for few seconds
            location.reload() //refresh when toast is over
        }
        
    })
</script>
@endisset

