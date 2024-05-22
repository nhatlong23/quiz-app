@extends('layouts.app')

@section('content')
    <div class="app-main__outer">
        <div class="app-main__inner">
            <div class="app-page-title">
                <div class="page-title-wrapper">
                    <div class="page-title-heading">
                        <div class="page-title-icon">
                            <i class="pe-7s-car icon-gradient bg-mean-fruit"></i>
                        </div>
                        <div>Trang tổng quan
                            <div class="page-title-subheading">Đây là trang tổng quan của trang quản trị website trắc nghiệm.</div>
                        </div>
                    </div>
                    <div class="page-title-actions">
                        <button type="button" data-toggle="tooltip" title="Example Tooltip" data-placement="bottom"
                            class="btn-shadow mr-3 btn btn-dark">
                            <i class="fa fa-star"></i>
                        </button>
                        <div class="d-inline-block dropdown">
                            <button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                class="btn-shadow dropdown-toggle btn btn-info">
                                <span class="btn-icon-wrapper pr-2 opacity-7">
                                    <i class="fa fa-business-time fa-w-20"></i>
                                </span>
                                Buttons
                            </button>
                            <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-right">
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link">
                                            <i class="nav-link-icon lnr-inbox"></i>
                                            <span> Inbox</span>
                                            <div class="ml-auto badge badge-pill badge-secondary">86</div>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link">
                                            <i class="nav-link-icon lnr-book"></i>
                                            <span> Book</span>
                                            <div class="ml-auto badge badge-pill badge-danger">5</div>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link">
                                            <i class="nav-link-icon lnr-picture"></i>
                                            <span> Picture</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a disabled class="nav-link disabled">
                                            <i class="nav-link-icon lnr-file-empty"></i>
                                            <span> File Disabled</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tabs-animation">
                <div class="mb-3 card">
                    <div class="card-header-tab card-header">
                        <div class="card-header-title font-size-lg text-capitalize font-weight-normal">
                            <i class="header-icon lnr-charts icon-gradient bg-happy-green"> </i>
                            Portfolio Performance
                        </div>
                        <div class="btn-actions-pane-right text-capitalize">
                            <button class="btn-wide btn-outline-2x mr-md-2 btn btn-outline-focus btn-sm">View
                                All</button>
                        </div>
                    </div>
                    <div class="no-gutters row">
                        <div class="col-sm-6 col-md-4 col-xl-4">
                            <div class="card no-shadow rm-border bg-transparent widget-chart text-left">
                                <div class="icon-wrapper rounded-circle">
                                    <div class="icon-wrapper-bg opacity-10 bg-warning"></div>
                                    <i class="lnr-laptop-phone text-dark opacity-8"></i>
                                </div>
                                <div class="widget-chart-content">
                                    <div class="widget-subheading">Cash Deposits</div>
                                    <div class="widget-numbers">1,7M</div>
                                    <div class="widget-description opacity-8 text-focus">
                                        <div class="d-inline text-danger pr-1">
                                            <i class="fa fa-angle-down"></i>
                                            <span class="pl-1">54.1%</span>
                                        </div>
                                        less earnings
                                    </div>
                                </div>
                            </div>
                            <div class="divider m-0 d-md-none d-sm-block"></div>
                        </div>
                        <div class="col-sm-6 col-md-4 col-xl-4">
                            <div class="card no-shadow rm-border bg-transparent widget-chart text-left">
                                <div class="icon-wrapper rounded-circle">
                                    <div class="icon-wrapper-bg opacity-9 bg-danger"></div>
                                    <i class="lnr-graduation-hat text-white"></i>
                                </div>
                                <div class="widget-chart-content">
                                    <div class="widget-subheading">Invested Dividents</div>
                                    <div class="widget-numbers"><span>9M</span></div>
                                    <div class="widget-description opacity-8 text-focus">
                                        Grow Rate:
                                        <span class="text-info pl-1">
                                            <i class="fa fa-angle-down"></i>
                                            <span class="pl-1">14.1%</span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="divider m-0 d-md-none d-sm-block"></div>
                        </div>
                        <div class="col-sm-12 col-md-4 col-xl-4">
                            <div class="card no-shadow rm-border bg-transparent widget-chart text-left">
                                <div class="icon-wrapper rounded-circle">
                                    <div class="icon-wrapper-bg opacity-9 bg-success"></div>
                                    <i class="lnr-apartment text-white"></i>
                                </div>
                                <div class="widget-chart-content">
                                    <div class="widget-subheading">Capital Gains</div>
                                    <div class="widget-numbers text-success"><span>$563</span></div>
                                    <div class="widget-description text-focus">
                                        Increased by
                                        <span class="text-warning pl-1">
                                            <i class="fa fa-angle-up"></i>
                                            <span class="pl-1">7.35%</span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center d-block p-3 card-footer">
                        <button class="btn-pill btn-shadow btn-wide fsize-1 btn btn-primary btn-lg">
                            <span class="mr-2 opacity-7">
                                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 512 512">
                                    <path
                                        d="M256 48C141.1 48 48 141.1 48 256s93.1 208 208 208 208-93.1 208-208S370.9 48 256 48zM76 256c0-48.1 18.7-93.3 52.7-127.3S207.9 76 256 76c48.1 0 93.3 18.7 127.3 52.7 32.2 32.2 50.7 74.5 52.6 119.7-8.8-10.3-24.2-24-43.8-24-27.5 0-41.7 25.7-51 42.7-1.4 2.5-2.7 4.9-3.9 7-11.4 19.2-27.3 30-42.5 28.9-13.4-.9-24.8-11.2-32.2-28.8-9.2-22.1-29.1-45.8-52.9-49.2-11.3-1.6-28.1.8-44.7 21.4-3.2 4-6.9 9.4-11.1 15.6-10.4 15.5-26.2 38.8-38.1 40.8-17.3 2.8-30.9-7.5-36.4-12.3-2.2-11.2-3.3-22.8-3.3-34.5z"
                                        fill="currentColor" />
                                </svg>
                            </span>
                            <span class="mr-1">View Complete Report</span>
                        </button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-xl-3">
                        <div
                            class="card mb-3 widget-chart widget-chart2 text-left card-btm-border card-shadow-success border-success">
                            <div class="widget-chat-wrapper-outer">
                                <div class="widget-chart-content pt-3 pl-3 pb-1">
                                    <div class="widget-chart-flex">
                                        <div class="widget-numbers">
                                            <div class="widget-chart-flex">
                                                <div class="fsize-4">
                                                    <small class="opacity-5">$</small>
                                                    <span>874</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <h6 class="widget-subheading mb-0 opacity-5">sales last month</h6>
                                </div>
                                <div class="no-gutters widget-chart-wrapper mt-3 mb-3 pl-2 he-auto row">
                                    <div class="col-md-9">
                                        <div id="dashboard-sparklines-1"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-3">
                        <div
                            class="card mb-3 widget-chart widget-chart2 text-left card-btm-border card-shadow-primary border-primary">
                            <div class="widget-chat-wrapper-outer">
                                <div class="widget-chart-content pt-3 pl-3 pb-1">
                                    <div class="widget-chart-flex">
                                        <div class="widget-numbers">
                                            <div class="widget-chart-flex">
                                                <div class="fsize-4">
                                                    <small class="opacity-5">$</small>
                                                    <span>1283</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <h6 class="widget-subheading mb-0 opacity-5">sales Income</h6>
                                </div>
                                <div class="no-gutters widget-chart-wrapper mt-3 mb-3 pl-2 he-auto row">
                                    <div class="col-md-9">
                                        <div id="dashboard-sparklines-2"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-3">
                        <div
                            class="card mb-3 widget-chart widget-chart2 text-left card-btm-border card-shadow-warning border-warning">
                            <div class="widget-chat-wrapper-outer">
                                <div class="widget-chart-content pt-3 pl-3 pb-1">
                                    <div class="widget-chart-flex">
                                        <div class="widget-numbers">
                                            <div class="widget-chart-flex">
                                                <div class="fsize-4">
                                                    <small class="opacity-5">$</small>
                                                    <span>1286</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <h6 class="widget-subheading mb-0 opacity-5">last month sales</h6>
                                </div>
                                <div class="no-gutters widget-chart-wrapper mt-3 mb-3 pl-2 he-auto row">
                                    <div class="col-md-9">
                                        <div id="dashboard-sparklines-3"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-3">
                        <div
                            class="card mb-3 widget-chart widget-chart2 text-left card-btm-border card-shadow-danger border-danger">
                            <div class="widget-chat-wrapper-outer">
                                <div class="widget-chart-content pt-3 pl-3 pb-1">
                                    <div class="widget-chart-flex">
                                        <div class="widget-numbers">
                                            <div class="widget-chart-flex">
                                                <div class="fsize-4">
                                                    <small class="opacity-5">$</small>
                                                    <span>564</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <h6 class="widget-subheading mb-0 opacity-5">total revenue</h6>
                                </div>
                                <div class="no-gutters widget-chart-wrapper mt-3 mb-3 pl-2 he-auto row">
                                    <div class="col-md-9">
                                        <div id="dashboard-sparklines-4"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-lg-6">
                        <div class="mb-3 card">
                            <div class="card-header-tab card-header">
                                <div class="card-header-title font-size-lg text-capitalize font-weight-normal">
                                    <i class="header-icon lnr-cloud-download icon-gradient bg-happy-itmeo"></i>
                                    Technical Support
                                </div>
                                <div class="btn-actions-pane-right text-capitalize actions-icon-btn">
                                    <div class="btn-group dropdown">
                                        <button type="button" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false" class="btn-icon btn-icon-only btn btn-link">
                                            <i class="pe-7s-menu btn-icon-wrapper"></i>
                                        </button>
                                        <div tabindex="-1" role="menu" aria-hidden="true"
                                            class="dropdown-menu-right rm-pointers dropdown-menu-shadow dropdown-menu-hover-link dropdown-menu">
                                            <h6 tabindex="-1" class="dropdown-header">Header</h6>
                                            <button type="button" tabindex="0" class="dropdown-item">
                                                <i class="dropdown-icon lnr-inbox"> </i><span>Menus</span>
                                            </button>
                                            <button type="button" tabindex="0" class="dropdown-item">
                                                <i class="dropdown-icon lnr-file-empty">
                                                </i><span>Settings</span>
                                            </button>
                                            <button type="button" tabindex="0" class="dropdown-item">
                                                <i class="dropdown-icon lnr-book"> </i><span>Actions</span>
                                            </button>
                                            <div tabindex="-1" class="dropdown-divider"></div>
                                            <div class="p-3 text-right">
                                                <button class="mr-2 btn-shadow btn-sm btn btn-link">View
                                                    Details</button>
                                                <button class="mr-2 btn-shadow btn-sm btn btn-primary">Action</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="p-0 card-body">
                                <div class="p-1 slick-slider-sm mx-auto">
                                    <div class="slick-slider">
                                        <div>
                                            <div class="widget-chart widget-chart2 text-left p-0">
                                                <div class="widget-chat-wrapper-outer">
                                                    <div class="widget-chart-content widget-chart-content-lg pb-0">
                                                        <div class="widget-chart-flex">
                                                            <div class="widget-title opacity-5 text-muted text-uppercase">
                                                                New Accounts since 2018</div>
                                                        </div>
                                                        <div class="widget-numbers">
                                                            <div class="widget-chart-flex">
                                                                <div>
                                                                    <span class="opacity-10 text-success pr-2">
                                                                        <i class="fa fa-angle-up"></i>
                                                                    </span>
                                                                    <span>78</span>
                                                                    <small class="opacity-5 pl-1">%</small>
                                                                </div>
                                                                <div
                                                                    class="widget-title ml-2 font-size-lg font-weight-normal text-muted">
                                                                    <span class="text-success pl-2">+14</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="widget-chart-wrapper he-auto opacity-10 m-0">
                                                        <div id="dashboard-sparkline-3"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="widget-chart widget-chart2 text-left p-0">
                                                <div class="widget-chat-wrapper-outer">
                                                    <div class="widget-chart-content widget-chart-content-lg pb-0">
                                                        <div class="widget-chart-flex">
                                                            <div class="widget-title opacity-5 text-muted text-uppercase">
                                                                Last Year Total Sales</div>
                                                        </div>
                                                        <div class="widget-numbers">
                                                            <div class="widget-chart-flex">
                                                                <div>
                                                                    <small class="opacity-3 pr-1">$</small>
                                                                    <span>629</span>
                                                                    <span class="text-primary pl-3">
                                                                        <i class="fa fa-angle-down"></i>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="widget-chart-wrapper he-auto opacity-10 m-0">
                                                        <div id="dashboard-sparkline-1"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="widget-chart widget-chart2 text-left p-0">
                                                <div class="widget-chat-wrapper-outer">
                                                    <div class="widget-chart-content widget-chart-content-lg pb-0">
                                                        <div class="widget-chart-flex">
                                                            <div class="widget-title opacity-5 text-muted text-uppercase">
                                                                Helpdesk Tickets</div>
                                                        </div>
                                                        <div class="widget-numbers">
                                                            <div class="widget-chart-flex">
                                                                <div>
                                                                    <span class="text-warning">34</span>
                                                                </div>
                                                                <div
                                                                    class="widget-title ml-2 font-size-lg font-weight-normal text-dark">
                                                                    <span class="opacity-5 text-muted pl-2 pr-1">5%</span>
                                                                    increase
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="widget-chart-wrapper he-auto opacity-10 m-0">
                                                        <div id="dashboard-sparkline-2"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <h6
                                    class="text-muted text-uppercase font-size-md opacity-5 pl-3 pr-3 pb-1 font-weight-normal">
                                    Sales Progress
                                </h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-lg-6">
                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                <h5 class="card-title">Area with Negative Values</h5>
                                <div id="chart-apex-negative"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-lg-6">
                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                <h5 class="card-title">Pie Chart</h5>
                                <canvas id="chart-area"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
