   <div class="page-content">
        <div class="dashboard">
                <ul class="nav nav-dashboard flex-column mb-3 mb-md-0 " role="tablist">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('service-provider') ? 'active' : '' }}" id="tab-dashboard-link" href="{{route ('serviceProvider.main')}}" role="tab" aria-controls="tab-dashboard" aria-selected="true">{{trans('site.dashboard')}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('service-provider/account-details') ? 'active' : '' }}"  href="{{ route ('service.provider.account')}}">{{trans('site.account_details')}}</a>
                    </li>
                
                    <li class="nav-item">
                        <a class="nav-link  {{ Request::is('service-provider/all-services') ? 'active' : '' }}" href="{{ route ('all-services.index') }}" >{{trans('site.my_services')}}</a>
                    </li>

                    <li class="nav-item ">
                        <a class="nav-link {{ Request::is('service-provider/logout') ? 'active' : '' }}" href="{{ route ('service.provider.logout') }}">{{trans('site.log_out')}}</a>
                    </li>
                </ul>
        </div><!-- End .dashboard -->
    </div><!-- End .page-content -->