<<<<<<< Updated upstream
@extends('email.plantilla')
=======
@extends(View::exists('email.plantilla')?'email.plantilla':'iforms::frontend.emails.mainlayout')
>>>>>>> Stashed changes

@section('content')
    <div id="contend-mail" class="p-3">
        <h1>{{ $form->title }}</h1>
        <br>
        <div style="margin-bottom: 5px">
            @foreach($form->fields as $field)
                <p class="px-3"><strong>{{ $field['label'] }}:</strong> {{ $data[$field['name']] }} </p>
            @endforeach
        </div>
    </div>
@stop