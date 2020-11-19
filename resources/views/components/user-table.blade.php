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
        @foreach($users as $user)
            <tr id='row-{{$user->id}}'>
                <td>{{$user->id}}</th>
                @foreach($headers as $header)
                    <td>{{$user->{Str::snake($header)} }}</th>
                @endforeach
                <td>
                        <a class="edit" href="/admin/users/{{$user->id}}">Edit</a>
                </td>
                @isset($detachableItem)
                    <td>
                        <button id="{{$user->id}}" class="remove">Remove</button>
                    </td>
                @endisset
            </tr>
        @endforeach
    </tbody>
</table>

@isset($detachableItem)
<script>
    
    let removeAnchors = document.querySelectorAll('.remove')
    removeAnchors.forEach((anchor, i) => anchor.onclick = async () => {
        let response = await fetch(`/admin/users/${anchor.id}/detach/{{$detachableItem->id}}`,{
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{csrf_token()}}'
            }
        })
        if (response.status === 200){
            document.getElementById(`row-${anchor.id}`.toString()).remove();

            //TODO: show toast for few seconds
            location.reload() //refresh when toast is over
        }
        
    })
</script>
@endisset

