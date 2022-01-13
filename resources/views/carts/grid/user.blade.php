<a href="{{route('users.show', ['user' => $user_id])}}" target="_blank"><i class="fa fa-user"></i> {{\App\User::find($user_id) ? \App\User::find($user_id)->name : 'User Not Found'}}</a>
