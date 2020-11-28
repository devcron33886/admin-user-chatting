<div>
    <div class="row justify-content-center">
        @if(auth()->user()->is_admin == true)
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        Users
                    </div>
                    <div class="card-body chatbox p-0">
                        <ul class="list-group list-group-flush">
                            @foreach($users as $user)
                                <a href="{{ route('inbox.show', $user->id) }}" class="text-dark link">
                                    <li class="list-group-item" wire:click="getUser({{ $user->id }})" id="user_{{ $user->id }}">
                                        <img class="img-fluid avatar" src="https://cdn.pixabay.com/photo/2017/06/13/12/53/profile-2398782_1280.png">
                                        {{ $user->name }}
                                    </li>
                                </a>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ $sender->name }}
                </div>
                <div class="card-body message-box" wire:poll.10ms="mount">
                    @if(!$messages)
                        No messages to show
                    @else
                        @if(isset($messages))
                            @foreach($messages as $message)
                                <div class="single-message @if($message->user_id !== auth()->id()) received @else sent @endif">
                                    <p class="font-weight-bolder my-0">{{ $message->user->name }}</p>
                                    {{ $message->message }}
                                    <br><small class="text-muted w-100">Sent <em>{{ $message->created_at }}</em></small>
                                </div>
                            @endforeach
                        @else
                            No messages to show
                        @endif
                    @endif
                </div>
                <div class="card-footer">
                    <form wire:submit.prevent="SendMessage">
                        <div class="row">
                            <div class="col-md-8">
                                <textarea wire:model="message" rows="2" class="form-control input shadow-none w-100 d-inline-block" placeholder="Type a message" required></textarea>
                            </div>

                            <div class="col-md-4">
                                <button class="btn btn-primary d-inline-block w-100"><i class="far fa-paper-plane"></i> Send</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>