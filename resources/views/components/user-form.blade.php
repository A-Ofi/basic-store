<form action="" method="post">
    @csrf
    <div class="name-cell">
        <label for="name">Name: </label>
        <input type="text" name="name" value="{{ $user->name ?? '' }}" >
    </div>
    <div class="email-cell">
        <label for="email">Email: </label>
        <input type="text" name="email" value="{{ $user->email ?? ''}}" >
    </div>
    @isset($create)
        <div class="password-cell">
            <label for="password">Password: </label>
            <input type="password" name="password" value="" >
        </div>
        <div class="confirmation-cell">
            <label for="password_confirmation">Password confirmation: </label>
            <input type="password" name="password_confirmation" value="" >
        </div>
        <div class="button-cell">
        @endisset
            @empty($create)
                <button class="form-btn" type="button">Edit</button>
            @endempty
            <button class="form-btn" type="submit">Save</button>
        </div>
</form>