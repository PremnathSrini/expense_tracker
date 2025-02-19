<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-radius-lg fixed-start ms-2  bg-white my-2"
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-dark opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand px-4 py-3 m-0" href="#">
            <img src="{{ asset('admin_assets/img/logo-ct-dark.png') }}" class="navbar-brand-img" width="26" height="26"
                alt="main_logo">
            <span class="ms-1 text-sm text-dark">Expense Tracker</span>
        </a>
    </div>
    <hr class="horizontal dark mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a id="dashboard-link" class="nav-link text-dark active bg-gradient-dark text-white sidebar-links"
                    href="{{ route('user.index') }}">
                    <i class="material-symbols-rounded opacity-5">dashboard</i>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>

            <li class="nav-item">
                <a id="transactions-link" class="nav-link text-dark sidebar-links"
                    href="{{ route('user.transactions') }}">
                    <i class="material-symbols-rounded opacity-5">account_balance</i>
                    <span class="nav-link-text ms-1">Transactions</span>
                </a>
            </li>

            <li class="nav-item">
                <a id="bills-link" class="nav-link text-dark sidebar-links" href="{{ route('user.bills') }}">
                    <i class="material-symbols-rounded opacity-5">receipt_long</i>
                    <span class="nav-link-text ms-1">Billing</span>
                </a>
            </li>
            <li class="nav-item">
                <a id="payments-link" class="nav-link text-dark sidebar-links" href="{{ url('/coming-soon') }}">
                    <i class="material-symbols-rounded opacity-5">qr_code_scanner</i>
                    <span class="nav-link-text ms-1">Payments</span>
                </a>

        </ul>
    </div>
    <div class="sidenav-footer position-absolute w-100 bottom-0 ">
        <div class="mx-3">
            {{-- <a class="btn btn-outline-dark mt-4 w-100"
                href="https://www.creative-tim.com/learning-lab/bootstrap/overview/material-dashboard?ref=sidebarfree"
                type="button">Documentation</a> --}}
            <a class="btn bg-gradient-dark w-100" href="#" type="button">Support</a>
        </div>
    </div>
</aside>
@push('custom-scripts')
<script>
    $(document).ready(function() {
            const $links = $('.sidebar-links');
            const currentUrl = window.location.href;

            $links.each(function() {
                console.log(this.href);
                if (this.href === currentUrl) {
                    $links.removeClass('active bg-gradient-dark text-white');
                    $(this).addClass('active bg-gradient-dark text-white');
                    localStorage.setItem('activeLink', $(this).attr('id'));
                }
            });

            const activeLink = localStorage.getItem('activeLink');

            if (activeLink) {
                $links.removeClass('active bg-gradient-dark text-white');
                $(`#${activeLink}`).addClass('active bg-gradient-dark text-white');
            }

            $links.on('click', function() {
                $links.removeClass('active bg-gradient-dark text-white');
                $links.addClass('text-dark');

                $(this).removeClass('text-dark');
                $(this).addClass('active bg-gradient-dark text-white');

                localStorage.setItem('activeLink', $(this).attr('id'));
            });
        });
</script>
@endpush
