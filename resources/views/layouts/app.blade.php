<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<meta http-equiv="content-type" content="text/html;charset=utf-8" />

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <title>بارک هلمند</title>

    <!-- ===============================================-->
    <!--    Favicons-->
    <!-- ===============================================-->
    <link rel="apple-touch-icon" sizes="180x180" href="assets/img/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="assets/img/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/img/favicons/favicon-16x16.png">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicons/favicon.ico">
    <link rel="manifest" href="assets/img/favicons/manifest.json">
    <meta name="msapplication-TileImage" content="assets/img/favicons/mstile-150x150.png">
    <meta name="theme-color" content="#ffffff">
    <script src="assets/js/config.js"></script>
    <script src="vendors/simplebar/simplebar.min.js"></script>


    <link rel="preconnect" href="https://fonts.gstatic.com/">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,500,600,700%7cPoppins:300,400,500,600,700,800,900&amp;display=swap"
        rel="stylesheet">
    <link href="vendors/simplebar/simplebar.min.css" rel="stylesheet">
    <link href="assets/css/theme-rtl.min.css" rel="stylesheet" id="style-rtl">
    <link href="assets/css/theme.min.css" rel="stylesheet" id="style-default">
    <link href="assets/css/user-rtl.min.css" rel="stylesheet" id="user-style-rtl">
    <link href="assets/css/user.min.css" rel="stylesheet" id="user-style-default">
    <script>
        var isRTL = JSON.parse(localStorage.getItem('isRTL'));
        // if (isRTL) {
        var linkDefault = document.getElementById('style-default');
        var userLinkDefault = document.getElementById('user-style-default');
        linkDefault.setAttribute('disabled', true);
        userLinkDefault.setAttribute('disabled', true);
        document.querySelector('html').setAttribute('dir', 'rtl');
        // } else {
        //     var linkRTL = document.getElementById('style-rtl');
        //     var userLinkRTL = document.getElementById('user-style-rtl');
        //     linkRTL.setAttribute('disabled', false);
        //     userLinkRTL.setAttribute('disabled', false);
        // }
    </script>
     <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.x.x/dist/alpine.min.js" defer></script>
</head>

<body>
    <!-- ===============================================-->
    <!--    Main Content-->
    <!-- ===============================================-->
    <main class="main" id="top">
        <div class="container" data-layout="container">
            <script>
                var isFluid = JSON.parse(localStorage.getItem('isFluid'));

                var container = document.querySelector('[data-layout]');
                container.classList.remove('container');
                container.classList.add('container-fluid');

            </script>

            <nav class="navbar navbar-light navbar-vertical navbar-expand-xl" style="display: none;">
                <script>
                    var navbarStyle = localStorage.getItem("navbarStyle");
                    if (navbarStyle && navbarStyle !== 'transparent') {
                        document.querySelector('.navbar-vertical').classList.add(`navbar-${navbarStyle}`);
                    }
                </script>
                <div class="d-flex align-items-center">
                    <div class="toggle-icon-wrapper">
                        <button class="btn navbar-toggler-humburger-icon navbar-vertical-toggle"
                            data-bs-toggle="tooltip" data-bs-placement="left" title="Toggle Navigation"><span
                                class="navbar-toggle-icon"><span class="toggle-line"></span></span></button>
                    </div><a class="navbar-brand" href="index.html">
                        <div class="py-3 d-flex align-items-center"><img class="me-2"
                                src="assets/img/icons/spot-illustrations/falcon.png" alt="" width="40" /><span
                                class="font-sans-serif">falcon</span></div>
                    </a>
                </div>
                <div class="collapse navbar-collapse" id="navbarVerticalCollapse">
                    <div class="navbar-vertical-content scrollbar">
                        <ul class="mb-3 navbar-nav flex-column" id="navbarVerticalNav">
                            <li class="nav-item">
                                <!-- parent pages--><a class="nav-link dropdown-indicator" href="#dashboard"
                                    role="button" data-bs-toggle="collapse" aria-expanded="true"
                                    aria-controls="dashboard">
                                    <div class="d-flex align-items-center"><span class="nav-link-icon"><span
                                                class="fas fa-chart-pie"></span></span><span
                                            class="nav-link-text ps-1">Dashboard</span></div>
                                </a>
                                <ul class="nav collapse show" id="dashboard">
                                    <li class="nav-item"><a class="nav-link active" href="index.html">
                                            <div class="d-flex align-items-center"><span
                                                    class="nav-link-text ps-1">Default</span></div>
                                        </a><!-- more inner pages-->
                                    </li>
                                    <li class="nav-item"><a class="nav-link" href="dashboard/analytics.html">
                                            <div class="d-flex align-items-center"><span
                                                    class="nav-link-text ps-1">Analytics</span></div>
                                        </a><!-- more inner pages-->
                                    </li>
                                    <li class="nav-item"><a class="nav-link" href="dashboard/crm.html">
                                            <div class="d-flex align-items-center"><span
                                                    class="nav-link-text ps-1">CRM</span></div>
                                        </a><!-- more inner pages-->
                                    </li>
                                    <li class="nav-item"><a class="nav-link" href="dashboard/e-commerce.html">
                                            <div class="d-flex align-items-center"><span class="nav-link-text ps-1">E
                                                    commerce</span></div>
                                        </a><!-- more inner pages-->
                                    </li>
                                    <li class="nav-item"><a class="nav-link" href="dashboard/lms.html">
                                            <div class="d-flex align-items-center"><span
                                                    class="nav-link-text ps-1">LMS</span><span
                                                    class="badge rounded-pill ms-2 badge-soft-success">New</span></div>
                                        </a><!-- more inner pages-->
                                    </li>
                                    <li class="nav-item"><a class="nav-link" href="dashboard/project-management.html">
                                            <div class="d-flex align-items-center"><span
                                                    class="nav-link-text ps-1">Management</span></div>
                                        </a><!-- more inner pages-->
                                    </li>
                                    <li class="nav-item"><a class="nav-link" href="dashboard/saas.html">
                                            <div class="d-flex align-items-center"><span
                                                    class="nav-link-text ps-1">SaaS</span></div>
                                        </a><!-- more inner pages-->
                                    </li>
                                    <li class="nav-item"><a class="nav-link" href="dashboard/support-desk.html">
                                            <div class="d-flex align-items-center"><span
                                                    class="nav-link-text ps-1">Support desk</span><span
                                                    class="badge rounded-pill ms-2 badge-soft-success">New</span></div>
                                        </a><!-- more inner pages-->
                                    </li>
                                </ul>
                            </li>

                        </ul>
                        <div class="mb-3 settings">
                            <div class="shadow-none card">
                                <div class="mb-0 card-body alert" role="alert">
                                    <div class="btn-close-falcon-container"><button
                                            class="p-0 btn btn-link btn-close-falcon" aria-label="Close"
                                            data-bs-dismiss="alert"></button></div>
                                    <div class="text-center"><img
                                            src="assets/img/icons/spot-illustrations/navbar-vertical.png" alt=""
                                            width="80" />
                                        <p class="mt-2 fs--2">Loving what you see? <br />Get your copy of <a
                                                href="#!">Falcon</a></p>
                                        <div class="d-grid"><a class="btn btn-sm btn-purchase"
                                                href="https://themes.getbootstrap.com/product/falcon-admin-dashboard-webapp-template/"
                                                target="_blank">Purchase</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- Top bar Navigation Bar -------------------------------------------------------- -->
            <nav class="navbar navbar-light navbar-glass navbar-top navbar-expand-lg" style="display: none;">
                <button class="btn navbar-toggler-humburger-icon navbar-toggler me-1 me-sm-3" type="button"
                    data-bs-toggle="collapse" data-bs-target="#navbarStandard" aria-controls="navbarStandard"
                    aria-expanded="false" aria-label="Toggle Navigation"><span class="navbar-toggle-icon"><span
                            class="toggle-line"></span></span></button>
                <a class="navbar-brand me-1 me-sm-3" href="index.html">
                    <div class="d-flex align-items-center"><img class="me-2"
                            src="assets/img/icons/spot-illustrations/falcon.png" alt="" width="40" /><span
                            class="font-sans-serif">falcon</span></div>
                </a>
                <div class="collapse navbar-collapse scrollbar" id="navbarStandard">
                    <ul class="navbar-nav" data-top-nav-dropdowns="data-top-nav-dropdowns">
                        <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                id="dashboards">Dashboard</a>
                            <div class="mt-0 border-0 dropdown-menu dropdown-caret dropdown-menu-card"
                                aria-labelledby="dashboards">
                                <div class="py-2 bg-white dark__bg-1000 rounded-3"><a
                                        class="dropdown-item link-600 fw-medium" href="index.html">Default</a><a
                                        class="dropdown-item link-600 fw-medium"
                                        href="dashboard/analytics.html">Analytics</a><a
                                        class="dropdown-item link-600 fw-medium" href="dashboard/crm.html">CRM</a><a
                                        class="dropdown-item link-600 fw-medium" href="dashboard/e-commerce.html">E
                                        commerce</a><a class="dropdown-item link-600 fw-medium"
                                        href="dashboard/lms.html">LMS<span
                                            class="badge rounded-pill ms-2 badge-soft-success">New</span></a><a
                                        class="dropdown-item link-600 fw-medium"
                                        href="dashboard/project-management.html">Management</a>
                                    < class="dropdown-item link-600 fw-medium" href="dashboard/saas.html">developer</><a
                                        class="dropdown-item link-600 fw-medium"
                                        href="dashboard/support-desk.html">Support desk<span
                                            class="badge rounded-pill ms-2 badge-soft-success">New</span></a>
                                </div>
                            </div>
                        </li>




                    </ul>
                </div>
                <ul class="flex-row navbar-nav navbar-nav-icons ms-auto align-items-center">
                    <li class="nav-item">
                        <div class="px-2 theme-control-toggle fa-icon-wait"><input
                                class="form-check-input ms-0 theme-control-toggle-input" id="themeControlToggle"
                                type="checkbox" data-theme-control="theme" value="dark" /><label
                                class="mb-0 theme-control-toggle-label theme-control-toggle-light"
                                for="themeControlToggle" data-bs-toggle="tooltip" data-bs-placement="left"
                                title="Switch to light theme"><span class="fas fa-sun fs-0"></span></label><label
                                class="mb-0 theme-control-toggle-label theme-control-toggle-dark"
                                for="themeControlToggle" data-bs-toggle="tooltip" data-bs-placement="left"
                                title="Switch to dark theme"><span class="fas fa-moon fs-0"></span></label></div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="px-0 nav-link notification-indicator notification-indicator-primary fa-icon-wait"
                            id="navbarDropdownNotification" role="button" data-bs-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false" data-hide-on-body-scroll="data-hide-on-body-scroll"><span
                                class="fas fa-bell" data-fa-transform="shrink-6" style="font-size: 33px;"></span></a>
                        <div class="dropdown-menu dropdown-caret dropdown-menu-end dropdown-menu-card dropdown-menu-notification dropdown-caret-bg"
                            aria-labelledby="navbarDropdownNotification">
                            <div class="shadow-none card card-notification">
                                <div class="card-header">
                                    <div class="row justify-content-between align-items-center">
                                        <div class="col-auto">
                                            <h6 class="mb-0 card-header-title">Notifications</h6>
                                        </div>
                                        <div class="col-auto ps-0 ps-sm-3"><a class="card-link fw-normal" href="#">Mark
                                                all as read</a></div>
                                    </div>
                                </div>
                                <div class="scrollbar-overlay" style="max-height:19rem">
                                    <div class="list-group list-group-flush fw-normal fs--1">
                                        <div class="list-group-title border-bottom">NEW</div>
                                        <div class="list-group-item">
                                            <a class="notification notification-flush notification-unread" href="#!">
                                                <div class="notification-avatar">
                                                    <div class="avatar avatar-2xl me-3">
                                                        <img class="rounded-circle" src="assets/img/team/1-thumb.png"
                                                            alt="" />
                                                    </div>
                                                </div>
                                                <div class="notification-body">
                                                    <p class="mb-1"><strong>Emma Watson</strong> replied to your comment
                                                        : "Hello world 😍"</p>
                                                    <span class="notification-time"><span class="me-2" role="img"
                                                            aria-label="Emoji">💬</span>Just now</span>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="list-group-item">
                                            <a class="notification notification-flush notification-unread" href="#!">
                                                <div class="notification-avatar">
                                                    <div class="avatar avatar-2xl me-3">
                                                        <div class="avatar-name rounded-circle"><span>AB</span></div>
                                                    </div>
                                                </div>
                                                <div class="notification-body">
                                                    <p class="mb-1"><strong>Albert Brooks</strong> reacted to
                                                        <strong>Mia Khalifa's</strong> status
                                                    </p>
                                                    <span class="notification-time"><span
                                                            class="me-2 fab fa-gratipay text-danger"></span>9hr</span>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="list-group-title border-bottom">EARLIER</div>
                                        <div class="list-group-item">
                                            <a class="notification notification-flush" href="#!">
                                                <div class="notification-avatar">
                                                    <div class="avatar avatar-2xl me-3">
                                                        <img class="rounded-circle"
                                                            src="assets/img/icons/weather-sm.jpg" alt="" />
                                                    </div>
                                                </div>
                                                <div class="notification-body">
                                                    <p class="mb-1">The forecast today shows a low of 20&#8451; in
                                                        California. See today's weather.</p>
                                                    <span class="notification-time"><span class="me-2" role="img"
                                                            aria-label="Emoji">🌤️</span>1d</span>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="list-group-item">
                                            <a class="border-bottom-0 notification-unread notification notification-flush"
                                                href="#!">
                                                <div class="notification-avatar">
                                                    <div class="avatar avatar-xl me-3">
                                                        <img class="rounded-circle" src="assets/img/logos/oxford.png"
                                                            alt="" />
                                                    </div>
                                                </div>
                                                <div class="notification-body">
                                                    <p class="mb-1"><strong>University of Oxford</strong> created an
                                                        event : "Causal Inference Hilary 2019"</p>
                                                    <span class="notification-time"><span class="me-2" role="img"
                                                            aria-label="Emoji">✌️</span>1w</span>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="list-group-item">
                                            <a class="border-bottom-0 notification notification-flush" href="#!">
                                                <div class="notification-avatar">
                                                    <div class="avatar avatar-xl me-3">
                                                        <img class="rounded-circle" src="assets/img/team/10.jpg"
                                                            alt="" />
                                                    </div>
                                                </div>
                                                <div class="notification-body">
                                                    <p class="mb-1"><strong>James Cameron</strong> invited to join the
                                                        group: United Nations International Children's Fund</p>
                                                    <span class="notification-time"><span class="me-2" role="img"
                                                            aria-label="Emoji">🙋‍</span>2d</span>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center card-footer border-top"><a class="card-link d-block"
                                        href="app/social/notifications.html">View all</a></div>
                            </div>
                        </div>
                    </li>
                    <li class="px-1 nav-item dropdown">
                        <a class="p-1 nav-link fa-icon-wait nine-dots" id="navbarDropdownMenu" role="button"
                            data-hide-on-body-scroll="data-hide-on-body-scroll" data-bs-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false"><svg xmlns="http://www.w3.org/2000/svg"
                                width="16" height="43" viewBox="0 0 16 16" fill="none">
                                <circle cx="2" cy="2" r="2" fill="#6C6E71"></circle>
                                <circle cx="2" cy="8" r="2" fill="#6C6E71"></circle>
                                <circle cx="2" cy="14" r="2" fill="#6C6E71"></circle>
                                <circle cx="8" cy="8" r="2" fill="#6C6E71"></circle>
                                <circle cx="8" cy="14" r="2" fill="#6C6E71"></circle>
                                <circle cx="14" cy="8" r="2" fill="#6C6E71"></circle>
                                <circle cx="14" cy="14" r="2" fill="#6C6E71"></circle>
                                <circle cx="8" cy="2" r="2" fill="#6C6E71"></circle>
                                <circle cx="14" cy="2" r="2" fill="#6C6E71"></circle>
                            </svg></a>
                        <div class="dropdown-menu dropdown-caret dropdown-menu-end dropdown-menu-card dropdown-caret-bg"
                            aria-labelledby="navbarDropdownMenu">
                            <div class="shadow-none card">
                                <div class="scrollbar-overlay nine-dots-dropdown">
                                    <div class="px-3 card-body">
                                        <div class="text-center row gx-0 gy-0">
                                            <div class="col-4">
                                                <a class="px-2 py-3 text-center d-block hover-bg-200 rounded-3 text-decoration-none"
                                                    href="pages/user/profile.html" target="_blank">
                                                    <div class="avatar avatar-2xl"> <img class="rounded-circle"
                                                            src="assets/img/team/3.jpg" alt="" /></div>
                                                    <p class="mb-0 fw-medium text-800 text-truncate fs--2">Account</p>
                                                </a>
                                            </div>
                                            <div class="col-4">
                                                <a class="px-2 py-3 text-center d-block hover-bg-200 rounded-3 text-decoration-none"
                                                    href="https://themewagon.com/" target="_blank"><img class="rounded"
                                                        src="assets/img/nav-icons/themewagon.png" alt="" width="40"
                                                        height="40" />
                                                    <p class="pt-1 mb-0 fw-medium text-800 text-truncate fs--2">
                                                        Themewagon</p>
                                                </a>
                                            </div>
                                            <div class="col-4">
                                                <a class="px-2 py-3 text-center d-block hover-bg-200 rounded-3 text-decoration-none"
                                                    href="https://mailbluster.com/" target="_blank"><img class="rounded"
                                                        src="assets/img/nav-icons/mailbluster.png" alt="" width="40"
                                                        height="40" />
                                                    <p class="pt-1 mb-0 fw-medium text-800 text-truncate fs--2">
                                                        Mailbluster</p>
                                                </a>
                                            </div>
                                            <div class="col-4"><a
                                                    class="px-2 py-3 text-center d-block hover-bg-200 rounded-3 text-decoration-none"
                                                    href="#!" target="_blank"><img class="rounded"
                                                        src="assets/img/nav-icons/google.png" alt="" width="40"
                                                        height="40" />
                                                    <p class="pt-1 mb-0 fw-medium text-800 text-truncate fs--2">Google
                                                    </p>
                                                </a></div>
                                            <div class="col-4">
                                                <a class="px-2 py-3 text-center d-block hover-bg-200 rounded-3 text-decoration-none"
                                                    href="#!" target="_blank"><img class="rounded"
                                                        src="assets/img/nav-icons/spotify.png" alt="" width="40"
                                                        height="40" />
                                                    <p class="pt-1 mb-0 fw-medium text-800 text-truncate fs--2">Spotify
                                                    </p>
                                                </a>
                                            </div>
                                            <div class="col-4">
                                                <a class="px-2 py-3 text-center d-block hover-bg-200 rounded-3 text-decoration-none"
                                                    href="#!" target="_blank"><img class="rounded"
                                                        src="assets/img/nav-icons/steam.png" alt="" width="40"
                                                        height="40" />
                                                    <p class="pt-1 mb-0 fw-medium text-800 text-truncate fs--2">Steam
                                                    </p>
                                                </a>
                                            </div>
                                            <div class="col-4">
                                                <a class="px-2 py-3 text-center d-block hover-bg-200 rounded-3 text-decoration-none"
                                                    href="#!" target="_blank"><img class="rounded"
                                                        src="assets/img/nav-icons/github-light.png" alt="" width="40"
                                                        height="40" />
                                                    <p class="pt-1 mb-0 fw-medium text-800 text-truncate fs--2">Github
                                                    </p>
                                                </a>
                                            </div>
                                            <div class="col-4">
                                                <a class="px-2 py-3 text-center d-block hover-bg-200 rounded-3 text-decoration-none"
                                                    href="#!" target="_blank"><img class="rounded"
                                                        src="assets/img/nav-icons/discord.png" alt="" width="40"
                                                        height="40" />
                                                    <p class="pt-1 mb-0 fw-medium text-800 text-truncate fs--2">Discord
                                                    </p>
                                                </a>
                                            </div>
                                            <div class="col-4">
                                                <a class="px-2 py-3 text-center d-block hover-bg-200 rounded-3 text-decoration-none"
                                                    href="#!" target="_blank"><img class="rounded"
                                                        src="assets/img/nav-icons/xbox.png" alt="" width="40"
                                                        height="40" />
                                                    <p class="pt-1 mb-0 fw-medium text-800 text-truncate fs--2">xbox</p>
                                                </a>
                                            </div>
                                            <div class="col-4">
                                                <a class="px-2 py-3 text-center d-block hover-bg-200 rounded-3 text-decoration-none"
                                                    href="#!" target="_blank"><img class="rounded"
                                                        src="assets/img/nav-icons/trello.png" alt="" width="40"
                                                        height="40" />
                                                    <p class="pt-1 mb-0 fw-medium text-800 text-truncate fs--2">Kanban
                                                    </p>
                                                </a>
                                            </div>
                                            <div class="col-4">
                                                <a class="px-2 py-3 text-center d-block hover-bg-200 rounded-3 text-decoration-none"
                                                    href="#!" target="_blank"><img class="rounded"
                                                        src="assets/img/nav-icons/hp.png" alt="" width="40"
                                                        height="40" />
                                                    <p class="pt-1 mb-0 fw-medium text-800 text-truncate fs--2">Hp</p>
                                                </a>
                                            </div>
                                            <div class="col-12">
                                                <hr class="my-3 mx-n3 bg-200" />
                                            </div>
                                            <div class="col-4">
                                                <a class="px-2 py-3 text-center d-block hover-bg-200 rounded-3 text-decoration-none"
                                                    href="#!" target="_blank"><img class="rounded"
                                                        src="assets/img/nav-icons/linkedin.png" alt="" width="40"
                                                        height="40" />
                                                    <p class="pt-1 mb-0 fw-medium text-800 text-truncate fs--2">Linkedin
                                                    </p>
                                                </a>
                                            </div>
                                            <div class="col-4">
                                                <a class="px-2 py-3 text-center d-block hover-bg-200 rounded-3 text-decoration-none"
                                                    href="#!" target="_blank"><img class="rounded"
                                                        src="assets/img/nav-icons/twitter.png" alt="" width="40"
                                                        height="40" />
                                                    <p class="pt-1 mb-0 fw-medium text-800 text-truncate fs--2">Twitter
                                                    </p>
                                                </a>
                                            </div>
                                            <div class="col-4">
                                                <a class="px-2 py-3 text-center d-block hover-bg-200 rounded-3 text-decoration-none"
                                                    href="#!" target="_blank"><img class="rounded"
                                                        src="assets/img/nav-icons/facebook.png" alt="" width="40"
                                                        height="40" />
                                                    <p class="pt-1 mb-0 fw-medium text-800 text-truncate fs--2">Facebook
                                                    </p>
                                                </a>
                                            </div>
                                            <div class="col-4">
                                                <a class="px-2 py-3 text-center d-block hover-bg-200 rounded-3 text-decoration-none"
                                                    href="#!" target="_blank"><img class="rounded"
                                                        src="assets/img/nav-icons/instagram.png" alt="" width="40"
                                                        height="40" />
                                                    <p class="pt-1 mb-0 fw-medium text-800 text-truncate fs--2">
                                                        Instagram</p>
                                                </a>
                                            </div>
                                            <div class="col-4">
                                                <a class="px-2 py-3 text-center d-block hover-bg-200 rounded-3 text-decoration-none"
                                                    href="#!" target="_blank"><img class="rounded"
                                                        src="assets/img/nav-icons/pinterest.png" alt="" width="40"
                                                        height="40" />
                                                    <p class="pt-1 mb-0 fw-medium text-800 text-truncate fs--2">
                                                        Pinterest</p>
                                                </a>
                                            </div>
                                            <div class="col-4">
                                                <a class="px-2 py-3 text-center d-block hover-bg-200 rounded-3 text-decoration-none"
                                                    href="#!" target="_blank"><img class="rounded"
                                                        src="assets/img/nav-icons/slack.png" alt="" width="40"
                                                        height="40" />
                                                    <p class="pt-1 mb-0 fw-medium text-800 text-truncate fs--2">Slack
                                                    </p>
                                                </a>
                                            </div>
                                            <div class="col-4">
                                                <a class="px-2 py-3 text-center d-block hover-bg-200 rounded-3 text-decoration-none"
                                                    href="#!" target="_blank"><img class="rounded"
                                                        src="assets/img/nav-icons/deviantart.png" alt="" width="40"
                                                        height="40" />
                                                    <p class="pt-1 mb-0 fw-medium text-800 text-truncate fs--2">
                                                        Deviantart</p>
                                                </a>
                                            </div>
                                            <div class="col-4">
                                                <a class="px-2 py-3 text-center d-block hover-bg-200 rounded-3 text-decoration-none"
                                                    href="app/events/event-detail.html" target="_blank">
                                                    <div class="avatar avatar-2xl">
                                                        <div
                                                            class="avatar-name rounded-circle bg-soft-primary text-primary">
                                                            <span class="fs-2">E</span>
                                                        </div>
                                                    </div>
                                                    <p class="mb-0 fw-medium text-800 text-truncate fs--2">Events</p>
                                                </a>
                                            </div>
                                            <div class="col-12"><a class="mt-4 btn btn-outline-primary btn-sm"
                                                    href="#!">Show more</a></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item dropdown"><a class="nav-link pe-0 ps-2" id="navbarDropdownUser" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <div class="avatar avatar-xl">
                                <img class="rounded-circle" src="assets/img/team/3-thumb.png" alt="" />
                            </div>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- Top bar Navigation Bar -------------------------------------------------------- -->

            <div class="content">
                <nav class="navbar navbar-light navbar-glass navbar-top navbar-expand" style="display: none;">
                    <button class="btn navbar-toggler-humburger-icon navbar-toggler me-1 me-sm-3" type="button"
                        data-bs-toggle="collapse" data-bs-target="#navbarVerticalCollapse"
                        aria-controls="navbarVerticalCollapse" aria-expanded="false"
                        aria-label="Toggle Navigation"><span class="navbar-toggle-icon"><span
                                class="toggle-line"></span></span></button>
                    <a class="navbar-brand me-1 me-sm-3" href="index.html">
                        <div class="d-flex align-items-center"><img class="me-2"
                                src="assets/img/icons/spot-illustrations/falcon.png" alt="" width="40" /><span
                                class="font-sans-serif">falcon</span></div>
                    </a>

                    <ul class="flex-row navbar-nav navbar-nav-icons ms-auto align-items-center">
                        <li class="nav-item">
                            <div class="px-2 theme-control-toggle fa-icon-wait"><input
                                    class="form-check-input ms-0 theme-control-toggle-input" id="themeControlToggle"
                                    type="checkbox" data-theme-control="theme" value="dark" /><label
                                    class="mb-0 theme-control-toggle-label theme-control-toggle-light"
                                    for="themeControlToggle" data-bs-toggle="tooltip" data-bs-placement="left"
                                    title="Switch to light theme"><span class="fas fa-sun fs-0"></span></label><label
                                    class="mb-0 theme-control-toggle-label theme-control-toggle-dark"
                                    for="themeControlToggle" data-bs-toggle="tooltip" data-bs-placement="left"
                                    title="Switch to dark theme"><span class="fas fa-moon fs-0"></span></label></div>
                        </li>
                        <li class="px-1 nav-item dropdown">
                            <a class="p-1 nav-link fa-icon-wait nine-dots" id="navbarDropdownMenu" role="button"
                                data-hide-on-body-scroll="data-hide-on-body-scroll" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false"><svg xmlns="http://www.w3.org/2000/svg"
                                    width="16" height="43" viewBox="0 0 16 16" fill="none">
                                    <circle cx="2" cy="2" r="2" fill="#6C6E71"></circle>
                                    <circle cx="2" cy="8" r="2" fill="#6C6E71"></circle>
                                    <circle cx="2" cy="14" r="2" fill="#6C6E71"></circle>
                                    <circle cx="8" cy="8" r="2" fill="#6C6E71"></circle>
                                    <circle cx="8" cy="14" r="2" fill="#6C6E71"></circle>
                                    <circle cx="14" cy="8" r="2" fill="#6C6E71"></circle>
                                    <circle cx="14" cy="14" r="2" fill="#6C6E71"></circle>
                                    <circle cx="8" cy="2" r="2" fill="#6C6E71"></circle>
                                    <circle cx="14" cy="2" r="2" fill="#6C6E71"></circle>
                                </svg></a>
                            <div class="dropdown-menu dropdown-caret dropdown-menu-end dropdown-menu-card dropdown-caret-bg"
                                aria-labelledby="navbarDropdownMenu">
                                <div class="shadow-none card">
                                    <div class="scrollbar-overlay nine-dots-dropdown">
                                        <div class="px-3 card-body">
                                            <div class="text-center row gx-0 gy-0">
                                                <div class="col-4"><a
                                                        class="px-2 py-3 text-center d-block hover-bg-200 rounded-3 text-decoration-none"
                                                        href="pages/user/profile.html" target="_blank">
                                                        <div class="avatar avatar-2xl"> <img class="rounded-circle"
                                                                src="assets/img/team/3.jpg" alt="" /></div>
                                                        <p class="mb-0 fw-medium text-800 text-truncate fs--2">Account
                                                        </p>
                                                    </a></div>
                                                <div class="col-4"><a
                                                        class="px-2 py-3 text-center d-block hover-bg-200 rounded-3 text-decoration-none"
                                                        href="https://themewagon.com/" target="_blank"><img
                                                            class="rounded" src="assets/img/nav-icons/themewagon.png"
                                                            alt="" width="40" height="40" />
                                                        <p class="pt-1 mb-0 fw-medium text-800 text-truncate fs--2">
                                                            Themewagon</p>
                                                    </a></div>
                                                <div class="col-4"><a
                                                        class="px-2 py-3 text-center d-block hover-bg-200 rounded-3 text-decoration-none"
                                                        href="https://mailbluster.com/" target="_blank"><img
                                                            class="rounded" src="assets/img/nav-icons/mailbluster.png"
                                                            alt="" width="40" height="40" />
                                                        <p class="pt-1 mb-0 fw-medium text-800 text-truncate fs--2">
                                                            Mailbluster</p>
                                                    </a></div>
                                                <div class="col-4"><a
                                                        class="px-2 py-3 text-center d-block hover-bg-200 rounded-3 text-decoration-none"
                                                        href="#!" target="_blank"><img class="rounded"
                                                            src="assets/img/nav-icons/google.png" alt="" width="40"
                                                            height="40" />
                                                        <p class="pt-1 mb-0 fw-medium text-800 text-truncate fs--2">
                                                            Google</p>
                                                    </a></div>
                                                <div class="col-4"><a
                                                        class="px-2 py-3 text-center d-block hover-bg-200 rounded-3 text-decoration-none"
                                                        href="#!" target="_blank"><img class="rounded"
                                                            src="assets/img/nav-icons/spotify.png" alt="" width="40"
                                                            height="40" />
                                                        <p class="pt-1 mb-0 fw-medium text-800 text-truncate fs--2">
                                                            Spotify</p>
                                                    </a></div>
                                                <div class="col-4"><a
                                                        class="px-2 py-3 text-center d-block hover-bg-200 rounded-3 text-decoration-none"
                                                        href="#!" target="_blank"><img class="rounded"
                                                            src="assets/img/nav-icons/steam.png" alt="" width="40"
                                                            height="40" />
                                                        <p class="pt-1 mb-0 fw-medium text-800 text-truncate fs--2">
                                                            Steam</p>
                                                    </a></div>
                                                <div class="col-4"><a
                                                        class="px-2 py-3 text-center d-block hover-bg-200 rounded-3 text-decoration-none"
                                                        href="#!" target="_blank"><img class="rounded"
                                                            src="assets/img/nav-icons/github-light.png" alt=""
                                                            width="40" height="40" />
                                                        <p class="pt-1 mb-0 fw-medium text-800 text-truncate fs--2">
                                                            Github</p>
                                                    </a></div>
                                                <div class="col-4"><a
                                                        class="px-2 py-3 text-center d-block hover-bg-200 rounded-3 text-decoration-none"
                                                        href="#!" target="_blank"><img class="rounded"
                                                            src="assets/img/nav-icons/discord.png" alt="" width="40"
                                                            height="40" />
                                                        <p class="pt-1 mb-0 fw-medium text-800 text-truncate fs--2">
                                                            Discord</p>
                                                    </a></div>
                                                <div class="col-4"><a
                                                        class="px-2 py-3 text-center d-block hover-bg-200 rounded-3 text-decoration-none"
                                                        href="#!" target="_blank"><img class="rounded"
                                                            src="assets/img/nav-icons/xbox.png" alt="" width="40"
                                                            height="40" />
                                                        <p class="pt-1 mb-0 fw-medium text-800 text-truncate fs--2">xbox
                                                        </p>
                                                    </a></div>
                                                <div class="col-4"><a
                                                        class="px-2 py-3 text-center d-block hover-bg-200 rounded-3 text-decoration-none"
                                                        href="#!" target="_blank"><img class="rounded"
                                                            src="assets/img/nav-icons/trello.png" alt="" width="40"
                                                            height="40" />
                                                        <p class="pt-1 mb-0 fw-medium text-800 text-truncate fs--2">
                                                            Kanban</p>
                                                    </a></div>
                                                <div class="col-4"><a
                                                        class="px-2 py-3 text-center d-block hover-bg-200 rounded-3 text-decoration-none"
                                                        href="#!" target="_blank"><img class="rounded"
                                                            src="assets/img/nav-icons/hp.png" alt="" width="40"
                                                            height="40" />
                                                        <p class="pt-1 mb-0 fw-medium text-800 text-truncate fs--2">Hp
                                                        </p>
                                                    </a></div>
                                                <div class="col-12">
                                                    <hr class="my-3 mx-n3 bg-200" />
                                                </div>
                                                <div class="col-4"><a
                                                        class="px-2 py-3 text-center d-block hover-bg-200 rounded-3 text-decoration-none"
                                                        href="#!" target="_blank"><img class="rounded"
                                                            src="assets/img/nav-icons/linkedin.png" alt="" width="40"
                                                            height="40" />
                                                        <p class="pt-1 mb-0 fw-medium text-800 text-truncate fs--2">
                                                            Linkedin</p>
                                                    </a></div>
                                                <div class="col-4"><a
                                                        class="px-2 py-3 text-center d-block hover-bg-200 rounded-3 text-decoration-none"
                                                        href="#!" target="_blank"><img class="rounded"
                                                            src="assets/img/nav-icons/twitter.png" alt="" width="40"
                                                            height="40" />
                                                        <p class="pt-1 mb-0 fw-medium text-800 text-truncate fs--2">
                                                            Twitter</p>
                                                    </a></div>
                                                <div class="col-4"><a
                                                        class="px-2 py-3 text-center d-block hover-bg-200 rounded-3 text-decoration-none"
                                                        href="#!" target="_blank"><img class="rounded"
                                                            src="assets/img/nav-icons/facebook.png" alt="" width="40"
                                                            height="40" />
                                                        <p class="pt-1 mb-0 fw-medium text-800 text-truncate fs--2">
                                                            Facebook</p>
                                                    </a></div>
                                                <div class="col-4"><a
                                                        class="px-2 py-3 text-center d-block hover-bg-200 rounded-3 text-decoration-none"
                                                        href="#!" target="_blank"><img class="rounded"
                                                            src="assets/img/nav-icons/instagram.png" alt="" width="40"
                                                            height="40" />
                                                        <p class="pt-1 mb-0 fw-medium text-800 text-truncate fs--2">
                                                            Instagram</p>
                                                    </a></div>
                                                <div class="col-4"><a
                                                        class="px-2 py-3 text-center d-block hover-bg-200 rounded-3 text-decoration-none"
                                                        href="#!" target="_blank"><img class="rounded"
                                                            src="assets/img/nav-icons/pinterest.png" alt="" width="40"
                                                            height="40" />
                                                        <p class="pt-1 mb-0 fw-medium text-800 text-truncate fs--2">
                                                            Pinterest</p>
                                                    </a></div>
                                                <div class="col-4"><a
                                                        class="px-2 py-3 text-center d-block hover-bg-200 rounded-3 text-decoration-none"
                                                        href="#!" target="_blank"><img class="rounded"
                                                            src="assets/img/nav-icons/slack.png" alt="" width="40"
                                                            height="40" />
                                                        <p class="pt-1 mb-0 fw-medium text-800 text-truncate fs--2">
                                                            Slack</p>
                                                    </a></div>
                                                <div class="col-4"><a
                                                        class="px-2 py-3 text-center d-block hover-bg-200 rounded-3 text-decoration-none"
                                                        href="#!" target="_blank"><img class="rounded"
                                                            src="assets/img/nav-icons/deviantart.png" alt="" width="40"
                                                            height="40" />
                                                        <p class="pt-1 mb-0 fw-medium text-800 text-truncate fs--2">
                                                            Deviantart</p>
                                                    </a></div>
                                                <div class="col-4"><a
                                                        class="px-2 py-3 text-center d-block hover-bg-200 rounded-3 text-decoration-none"
                                                        href="app/events/event-detail.html" target="_blank">
                                                        <div class="avatar avatar-2xl">
                                                            <div
                                                                class="avatar-name rounded-circle bg-soft-primary text-primary">
                                                                <span class="fs-2">E</span>
                                                            </div>
                                                        </div>
                                                        <p class="mb-0 fw-medium text-800 text-truncate fs--2">Events
                                                        </p>
                                                    </a></div>
                                                <div class="col-12"><a class="mt-4 btn btn-outline-primary btn-sm"
                                                        href="#!">Show more</a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item dropdown"><a class="nav-link pe-0 ps-2" id="navbarDropdownUser"
                                role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <div class="avatar avatar-xl">
                                    <img class="rounded-circle" src="assets/img/team/3-thumb.png" alt="" />
                                </div>
                            </a>
                            <div class="py-0 dropdown-menu dropdown-caret dropdown-menu-end"
                                aria-labelledby="navbarDropdownUser">
                                <div class="py-2 bg-white dark__bg-1000 rounded-2">
                                    <a class="dropdown-item fw-bold text-warning" href="#!"><span
                                            class="fas fa-crown me-1"></span><span>admin Page</span></a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#!">All Customers</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="pages/authentication/card/logout.html">Logout</a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </nav>

                <script>
                    var navbarPosition = localStorage.getItem('navbarPosition');
                    var navbarVertical = document.querySelector('.navbar-vertical');
                    var navbarTopVertical = document.querySelector('.content .navbar-top');
                    var navbarTop = document.querySelector('[data-layout] .navbar-top:not([data-double-top-nav');
                    var navbarDoubleTop = document.querySelector('[data-double-top-nav]');
                    var navbarTopCombo = document.querySelector('.content [data-navbar-top="combo"]');

                    if (localStorage.getItem('navbarPosition') === 'double-top') {
                        document.documentElement.classList.toggle('double-top-nav-layout');
                    }

                    if (navbarPosition === 'top') {
                        navbarTop.removeAttribute('style');
                        navbarTopVertical.remove(navbarTopVertical);
                        navbarVertical.remove(navbarVertical);
                        navbarTopCombo.remove(navbarTopCombo);
                        navbarDoubleTop.remove(navbarDoubleTop);
                    } else if (navbarPosition === 'combo') {
                        navbarVertical.removeAttribute('style');
                        navbarTopCombo.removeAttribute('style');
                        navbarTop.remove(navbarTop);
                        navbarTopVertical.remove(navbarTopVertical);
                        navbarDoubleTop.remove(navbarDoubleTop);
                    } else if (navbarPosition === 'double-top') {
                        navbarDoubleTop.removeAttribute('style');
                        navbarTopVertical.remove(navbarTopVertical);
                        navbarVertical.remove(navbarVertical);
                        navbarTop.remove(navbarTop);
                        navbarTopCombo.remove(navbarTopCombo);
                    } else {
                        navbarVertical.removeAttribute('style');
                        navbarTopVertical.removeAttribute('style');
                        navbarTop.remove(navbarTop);
                        navbarDoubleTop.remove(navbarDoubleTop);
                        navbarTopCombo.remove(navbarTopCombo);
                    }
                </script>
                {{$slot}}
                <!-- Find the JS file for the following chart at: src/js/charts/echarts/top-products.js-->
                <!-- If you are not using gulp based workflow, you can find the transpiled code at: public/assets/js/theme.js-->
                <!-- <div class="echart-bar-top-products h-100" data-echart-responsive="true"></div> -->
            </div>
        </div>
        </div>
        </div>
        <footer class="footer">

        </footer>
        </div>
        <div class="modal fade" id="authentication-modal" tabindex="-1" role="dialog"
            aria-labelledby="authentication-modal-label" aria-hidden="true">
            <div class="mt-6 modal-dialog" role="document">
                <div class="border-0 modal-content">
                    <div class="px-5 modal-header position-relative modal-shape-header bg-shape">
                        <div class="position-relative z-index-1 light">
                            <h4 class="mb-0 text-white" id="authentication-modal-label">Register</h4>
                            <p class="mb-0 text-white fs--1">Please create your free Falcon account</p>
                        </div><button class="top-0 mt-2 btn-close btn-close-white position-absolute end-0 me-2"
                            data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="px-5 py-4 modal-body">
                        <form>
                            <div class="mb-3"><label class="form-label" for="modal-auth-name">Name</label><input
                                    class="form-control" type="text" autocomplete="on" id="modal-auth-name" /></div>
                            <div class="mb-3"><label class="form-label" for="modal-auth-email">Email
                                    address</label><input class="form-control" type="email" autocomplete="on"
                                    id="modal-auth-email" /></div>
                            <div class="row gx-2">
                                <div class="mb-3 col-sm-6"><label class="form-label"
                                        for="modal-auth-password">Password</label><input class="form-control"
                                        type="password" autocomplete="on" id="modal-auth-password" /></div>
                                <div class="mb-3 col-sm-6"><label class="form-label"
                                        for="modal-auth-confirm-password">Confirm Password</label><input
                                        class="form-control" type="password" autocomplete="on"
                                        id="modal-auth-confirm-password" /></div>
                            </div>
                            <div class="form-check"><input class="form-check-input" type="checkbox"
                                    id="modal-auth-register-checkbox" /><label class="form-label"
                                    for="modal-auth-register-checkbox">I accept the <a href="#!">terms </a>and <a
                                        href="#!">privacy policy</a></label></div>
                            <div class="mb-3"><button class="mt-3 btn btn-primary d-block w-100" type="submit"
                                    name="submit">Register</button></div>
                        </form>
                        <div class="mt-5 position-relative">
                            <hr />
                            <div class="divider-content-center">or register with</div>
                        </div>
                        <div class="mt-2 row g-2">
                            <div class="col-sm-6"><a class="btn btn-outline-google-plus btn-sm d-block w-100"
                                    href="#"><span class="fab fa-google-plus-g me-2" data-fa-transform="grow-8"></span>
                                    google</a></div>
                            <div class="col-sm-6"><a class="btn btn-outline-facebook btn-sm d-block w-100"
                                    href="#"><span class="fab fa-facebook-square me-2"
                                        data-fa-transform="grow-8"></span> facebook</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </main><!-- ===============================================-->
    <!--    End of Main Content-->
    <!-- ===============================================-->



    <!-- ===============================================-->
    <!--    JavaScripts-->
    <!-- ===============================================-->
    <script src="vendors/popper/popper.min.js"></script>
    <script src="vendors/bootstrap/bootstrap.min.js"></script>
    <script src="vendors/anchorjs/anchor.min.js"></script>
    <script src="vendors/is/is.min.js"></script>
    <script src="vendors/echarts/echarts.min.js"></script>
    <script src="vendors/fontawesome/all.min.js"></script>
    <script src="vendors/lodash/lodash.min.js"></script>
    <script src="../../../polyfill.io/v3/polyfill.min58be.js?features=window.scroll"></script>
    <script src="vendors/list.js/list.min.js"></script>
    <script src="assets/js/theme.js"></script>

    @yield('content')

<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Initialize Alpine.js if it's not already initialized
        if (window.Alpine) {
            window.Alpine.start();
        }

        // Add event listeners to dynamically enable/disable the button
        const payedPriceInput = document.querySelector('[x-ref="payed_price"]');
        const totalPriceInput = document.querySelector('[x-ref="total_price"]');
        const createButton = document.querySelector('[x-ref="create_button"]');

        function updateButtonState() {
            if (payedPriceInput && totalPriceInput && createButton) {
                createButton.disabled = !payedPriceInput.value || !totalPriceInput.value;
            }
        }

        // Attach event listeners to input fields
        payedPriceInput?.addEventListener('input', updateButtonState);
        totalPriceInput?.addEventListener('input', updateButtonState);

        // Initial button state update
        updateButtonState();
    });
</script>
</body>


<!-- Mirrored from prium.github.io/falcon/v3.14.0/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 19 Feb 2023 06:10:55 GMT -->

</html>
