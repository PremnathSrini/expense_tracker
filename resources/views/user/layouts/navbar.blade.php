  <nav class="navbar navbar-main navbar-expand-lg px-0 mx-3 shadow-none border-radius-xl" id="navbarBlur" data-scroll="true">
    <div class="container-fluid py-1 px-3">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
          <li class="breadcrumb-item h4 text-dark active" aria-current="page">Hi {{ucfirst(Auth::user()->name)}} </li>
        </ol>
      </nav>
      <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
        <div class="ms-md-auto pe-md-3 d-flex align-items-center">
          <div class="input-group input-group-outline">
            <label class="form-label">Type here...</label>
            <input type="text" class="form-control">
          </div>
        </div>
        <ul class="navbar-nav d-flex align-items-center  justify-content-end">
          <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
            <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
              <div class="sidenav-toggler-inner">
                <i class="sidenav-toggler-line"></i>
                <i class="sidenav-toggler-line"></i>
                <i class="sidenav-toggler-line"></i>
              </div>
            </a>
          </li>
          <li class="nav-item px-3 d-flex align-items-center">
            <a href="javascript:;" class="nav-link text-body p-0">
              <i class="material-symbols-rounded fixed-plugin-button-nav">settings</i>
            </a>
          </li>
          <li class="nav-item dropdown pe-3 d-flex align-items-center">
            <a href="javascript:;" class="nav-link text-body p-0" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="material-symbols-rounded">notifications</i>
            </a>
            <ul class="dropdown-menu  dropdown-menu-end  px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">
              {{-- <li class="mb-2">
                <a class="dropdown-item border-radius-md" href="javascript:;">
                  <div class="d-flex py-1">
                    <div class="my-auto">
                      <img src="admin_assets/img/team-2.jpg" class="avatar avatar-sm  me-3 ">
                    </div>
                    <div class="d-flex flex-column justify-content-center">
                      <h6 class="text-sm font-weight-normal mb-1">
                        <span class="font-weight-bold">New message</span> from Laur
                      </h6>
                      <p class="text-xs text-secondary mb-0">
                        <i class="fa fa-clock me-1"></i>
                        13 minutes ago
                      </p>
                    </div>
                  </div>
                </a>
              </li>
              <li class="mb-2">
                <a class="dropdown-item border-radius-md" href="javascript:;">
                  <div class="d-flex py-1">
                    <div class="my-auto">
                      <img src="{{asset('admin_assets/img/small-logos/logo-spotify.svg')}}" class="avatar avatar-sm bg-gradient-dark  me-3 ">
                    </div>
                    <div class="d-flex flex-column justify-content-center">
                      <h6 class="text-sm font-weight-normal mb-1">
                        <span class="font-weight-bold">New album</span> by Travis Scott
                      </h6>
                      <p class="text-xs text-secondary mb-0">
                        <i class="fa fa-clock me-1"></i>
                        1 day
                      </p>
                    </div>
                  </div>
                </a>
              </li> --}}
              @foreach (auth()->user()->unreadNotifications as $notification)              
              <li>
                <a class="dropdown-item border-radius-md" href="javascript:;">
                  <div class="d-flex py-1">
                    <div class="avatar avatar-sm bg-gradient-secondary  me-3  my-auto">
                      <i class="material-symbols-rounded fixed-plugin-button-nav">notifications_active</i>
                    </div>
                    <div class="d-flex flex-column justify-content-center">
                      <h6 class="text-sm font-weight-normal mb-1">
                        {{ $notification->data['message'] }}
                      </h6>
                      <p class="text-xs text-secondary mb-0 d-flex align-items-center justify-content-between">
                        <span>
                            <i class="fa fa-clock me-1"></i>
                            {{ \Carbon\Carbon::parse($notification->created_at)->diffForHumans() }}
                        </span>
                        <i class="material-symbols-rounded text-success ms-2 mark-as-read-btn" data-id="{{$notification->id}}" data-href="{{route('notification.read',$notification->id)}}" title="Mark as Read">done_all</i>
                    </p>
                    </div>
                  </div>
                </a>
              </li>
              @endforeach
            </ul>
          </li>
          <li class="nav-item d-flex align-items-center">
            <a href="{{route('user.logout')}}" class="nav-link text-body font-weight-bold px-0 log-out">
              <i class="material-symbols-rounded">logout</i>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
@push('custom-scripts')
  <script>
    $(document).ready(function () {
        $('.log-out').click(function (e) {
            e.preventDefault();

            var href = $(this).attr('href');
            console.log(href);
            Swal.fire({
            title: 'Are you sure?',
            text: 'Do you want to logout?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, Logout',
            cancelButtonText: 'No, Stay'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = href;
                }
            });
        });

        $('.mark-as-read-btn').on('click',function(){
          const href = $(this).data('href');
          const notificationId = $(this).data('id');
          const clickedElement = $(this);
          console.log(href,notificationId,clickedElement);
          $.ajax({
            url: href,
            method: 'POST',
            data: {
              _token: `{{ csrf_token() }}`,
              notification_id: notificationId,
            },
            success: function(response){
              clickedElement.closest('li').remove();
            }
          });
        });
    });
    </script>
@endpush

