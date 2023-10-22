@extends('layout')

@section('content')
    <section class="bg-base p-4 rounded">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body" style="overflow: auto; height: 30rem">
                            <ul class="list-unstyled mb-0">
                                <li class="p-2 border-bottom" style="background-color: #eee;">
                                    <a href="#!" class="d-flex justify-content-between">
                                        <div class="d-flex flex-row">
                                            <div class="p-1 bg-primary d-flex align-self-center me-3 shadow-1-strong" style="width: 60px; height: 60px; border-radius: 50%"></div>
                                            <div class="pt-1">
                                                <p class="fw-bold mb-0">Czat firmowy</p>
                                                <p class="small text-muted">Hello, Are you there?</p>
                                            </div>
                                        </div>
                                        <div class="pt-1">
                                            <p class="small text-muted mb-1">Just now</p>
                                            <span class="badge bg-danger float-end">1</span>
                                        </div>
                                    </a>
                                </li>

                                <li class="p-2 border-bottom">
                                    <a href="#!" class="d-flex justify-content-between">
                                        <div class="d-flex flex-row">
                                            <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/avatar-1.webp" alt="avatar"
                                                 class="rounded-circle d-flex align-self-center me-3 shadow-1-strong" width="60">
                                            <div class="pt-1">
                                                <p class="fw-bold mb-0">Danny Smith</p>
                                                <p class="small text-muted">Lorem ipsum dolor sit.</p>
                                            </div>
                                        </div>
                                        <div class="pt-1">
                                            <p class="small text-muted mb-1">5 mins ago</p>
                                        </div>
                                    </a>
                                </li>

                            </ul>
                        </div>
                        <input type="text" placeholder="Wyszukaj użytkownika" class="form-control">
                    </div>
                </div>
                <div class="col-md-8 pt-2">
                    <ul class="chat messages list-unstyled p-3" style="height: 28rem; overflow: auto; background-color: #e8e7e7;"></ul>
                    <form class="pe-1">
                        <div class="bg-white mb-3 d-flex justify-content-between bg-base">
                            <div class="form-outline m-1 w-100 pe-2">
                                <input class="form-control w-100" id="message" name="message" type="text">
                            </div>
                            <button type="submit" class="btn btn-light btn-rounded float-end">Wyślij</button>
                        </div>
                    </form>
                </div>
            </div>
    </section>
    <script>
        var broadcastTemplateLink = @json(asset('html/chat/broadcast.html'));
        var receiveTemplateLink = @json(asset('html/chat/receive.html'));

        var sessionId = @json(Auth::user()->id);
        var csrfToken = @json(csrf_token());
        var ajaxLoadMessagesLink = @json(route('ajax.loadMessages'));

        const pusher = new Pusher('{{config('broadcasting.connections.pusher.key')}}', {cluster: 'eu'});
        const channel = pusher.subscribe('public');
    </script>
    <script src="{{ asset('/js/chat/function_replaceAll.js') }}"></script>
    <script src="{{ asset('/js/chat/loading_chat.js') }}"></script>
    <script src="{{ asset('/js/chat/scroll_chat.js') }}"></script>
    <script src="{{ asset('/js/chat/receive_messages.js') }}"></script>
    <script src="{{ asset('/js/chat/broadcast_messages.js') }}"></script>
@endsection
