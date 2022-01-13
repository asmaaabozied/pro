<a href="{{route('users.show', ['user' => $owner_id])}}" target="_blank"><i class="fa fa-user"></i> {{\App\User::find($owner_id)->name}}</a>
