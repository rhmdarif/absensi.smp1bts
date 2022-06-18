
    <div class="section mt-2">
        <div class="profile-head">
            <div class="avatar">
                <img src="/{{ $user->userTeacher->foto }}" alt="avatar" class="imaged w64 rounded">
            </div>
            <div class="in">
                <h3 class="name">{{ $user->name }}</h3>
                <h5 class="subtext">{{ $user->userTeacher->pangkat }}</h5>
            </div>
        </div>
    </div>
