@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Messages</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="body">
                        @foreach(\App\Message::all() as $message)
                            @if($message->user_id == Auth::user()->id)
                                <div class="sentMsg">
                                    <small style="color:grey;">{{ $message->created_at }}</small><br>
                                    <strong>You:</strong>
                                    <p>{{ $message->content }}</p>
                                </div>
                            @else
                                <div class="receiveMsg">
                                    <small style="color:grey;">{{ $message->created_at }}</small><br>
                                    <strong>{{ $message->user->name }}:</strong>
                                    <p>{{ $message->content }}</p>
                                </div>
                            @endif
                        @endforeach
                    </div>

                    {{ Form::open(array('url' => '/dashboard')) }}
                        <div class="row">
                            <input type="text" name="message" class="col-md-10" autofocus placeholder="Type a message...">
                            <button type="submit" class="col-md-2">Send</button>
                        </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
