<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title>Chat</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <style>
        .list-group {
            overflow-y: scroll;
            height: 200px;
        }
    </style>
</head>
<body>

<div class="container">


    <div class="row" id="app">
        CHAT ROOM

        <div class="col-md-12" style="display: inline">
            <div class="col-md-4">

                <li class="list-group-item active">Chat <span
                        class="badge badge-pill badge-warning">@{{ numberOfUsers }} </span>
                </li>
                <div class="badge badge-pill">
                    @{{ typing }}
                </div>
                <ul class="list-group" v-chat-scroll>
                    <message-component v-for="value,index in chat.message"
                                       :key=value.index
                                       :color=chat.color[index]
                                       :user=chat.user[index]
                                       :time=chat.time[index]
                    >
                        @{{ value }}
                    </message-component>

                </ul>
                <input type="text" class="form-control" v-model="message" @keyup.enter="send">
            </div>

        </div>
    </div>
</div>

<script src="{{ asset('js/app.js') }}"></script>
</body>

