@php
    $menu = DB::table('rbacdev.rbac.mstgrup')
        ->join('rbacdev.rbac.tranusergrup', 'rbacdev.rbac.mstgrup.grupid', 'rbacdev.rbac.tranusergrup.grupid')
        ->join('rbacdev.rbac.trangrupakses', 'rbacdev.rbac.mstgrup.grupid', 'rbacdev.rbac.trangrupakses.grupid')
        ->join('rbacdev.rbac.mstmodul', 'rbacdev.rbac.trangrupakses.modulid', 'rbacdev.rbac.mstmodul.modulid')
        ->join('rbacdev.rbac.mstmenu', 'rbacdev.rbac.mstmodul.menuid', 'rbacdev.rbac.mstmenu.menuid')
        ->where('rbacdev.rbac.mstmenu.aplikasiid', '6BCA89C2-70E2-4BA3-A604-3B27EADA142A')
        // ->where('rbacdev.rbac.mstgrup.aplikasiid','4E5E6C0B-0E75-48C3-9C18-6DFE424E76F1')
        ->where('rbacdev.rbac.tranusergrup.userid', session()->get('userid'))
        // ->where('menuid',$nm->menuid)
        ->select('mstmenu.menuid', 'mstmenu.namamenu', 'mstmenu.deskripsi')
        ->groupBy('mstmenu.menuid', 'mstmenu.namamenu', 'mstmenu.deskripsi')
        ->orderBy('mstmenu.namamenu', 'asc')
        ->get();
@endphp
<!-- Left Sidenav -->
<div class="left-sidenav">
    <!-- LOGO -->
    <div class="brand">
        <a href="/" class="logo">
            <span>
                <img src="{{ URL::asset('images/lldikti.png') }}" alt="logo-small" class="logo-sm">
            </span>
        </a>
    </div>
    <!--end logo-->
    <div class="menu-content h-100" data-simplebar>
        <ul class="metismenu left-sidenav-menu">
            <li class="menu-label mt-0">Menu</li>
            <li>
                <a href="/"><i data-feather="home"
                        class="align-self-center menu-icon"></i><span>Dashboard</span></a>
            </li>

            @foreach ($menu as $nm)
                <li>
                    <a href="javascript: void(0);"> <i data-feather="grid"
                            class="align-self-center menu-icon"></i><span>{{ $nm->namamenu }}</span><span
                            class="menu-arrow"><i class="mdi mdi-chevron-right"></i></span></a>
                    <ul class="nav-second-level" aria-expanded="false">
                        @php
                            $submenu = DB::table('rbacdev.rbac.mstgrup')
                                ->join('rbacdev.rbac.tranusergrup', 'rbacdev.rbac.mstgrup.grupid', 'rbacdev.rbac.tranusergrup.grupid')
                                ->join('rbacdev.rbac.trangrupakses', 'rbacdev.rbac.mstgrup.grupid', 'rbacdev.rbac.trangrupakses.grupid')
                                ->join('rbacdev.rbac.mstmodul', 'rbacdev.rbac.trangrupakses.modulid', 'rbacdev.rbac.mstmodul.modulid')
                                ->where('rbacdev.rbac.mstgrup.aplikasiid', '6BCA89C2-70E2-4BA3-A604-3B27EADA142A')
                                ->where('rbacdev.rbac.tranusergrup.userid', session()->get('userid'))
                                ->where('menuid', $nm->menuid)
                                ->get();
                        @endphp
                        @foreach ($submenu as $submn)
                            <li class="nav-item"><a class="nav-link" href="{{ route($submn->modulpath) }}"><i
                                        class="ti-control-record"></i>{{ $submn->namamodul }}</a>
                            </li>
                        @endforeach
                    </ul>
                </li>
            @endforeach
            <hr class="hr-dashed hr-menu">
        </ul>
    </div>
</div>


<!-- end left-sidenav-->
