<div class="userProfile-wrapper">
    <div class="userProfile-img">
        <img src="{{ $user->userImage() }}" alt="">
    </div>
    <div class="userProfile-details">
        <div class="userName">
            <h4>{{ ($user->gender == 'Male') ? 'Mr.' :
                    (($user->gender == 'Female') ? 'Mrs.' : '') }}
                {{$user->name ?? ''}}
            </h4>
        </div>
        <div class="userInfo">
            <a href="tel:+11234567890"><span><img
                        src="{{ asset('dashboard-assets/images/phone.png') }}"
                        alt="image"
                        class="img-fluid"></span> {{$user->phone ?? ''}}</a>
            <a href="mailto:info@youremail.com"><span><img
                        src="{{ asset('dashboard-assets/images/email.png') }}"
                        alt="image" class="img-fluid"></span> {{$user->email ?? ''}}</a>
            <a href=""><span><img src="{{ asset('dashboard-assets/images/location.png') }}"
                                  alt="image"
                                  class="img-fluid"></span>
                {{$user->address ?? ''}}</a>
        </div>
        <div class="userCompletion-wrapper">
            <div class="userContent">
            </div>
        </div>
    </div>
</div>
