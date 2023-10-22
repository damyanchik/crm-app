<div class="left message">
    <li class="d-flex justify-content-between mb-3 me-4">
        <img src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/avatar-6.webp" alt="avatar"
             class="rounded-circle d-flex align-self-start me-3 shadow-1-strong" width="60">
        <div class="card w-100">
            <div class="d-flex justify-content-between pb-1 pt-2 px-3">
                <p class="fw-bold mb-0 message-name">{{ $name }}</p>
                <p class="text-muted small mb-0">
                    <small class="message-time">{{ $time }}</small>
                </p>
            </div>
            <div class="card-body">
                <p class="mb-0 message-content">
                    {{ $message }}
                </p>
            </div>
        </div>
    </li>
</div>
