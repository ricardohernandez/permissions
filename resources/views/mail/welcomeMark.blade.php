@component('mail::message')
# titulo

<img src="{{ url('storage/'.$user->profile_photo_path) }}" style="width:30%" alt="App Logo">


Hello Dev.

@component('mail::table')
| Name       | Role         |  Permissions         |
| :--------- | :------------- |:------------- |
| {{ $user->name }} | {{ $user->roles[0]->name }}  | @foreach ($user->permission as $p) <p>{{ $p->name }}</p> @endforeach
@endcomponent


Thanks,

{{ config('app.name') }}
@endcomponent