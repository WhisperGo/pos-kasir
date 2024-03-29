<?php
$db         = \Config\Database::connect();

$level      = session()->get('level');
$on         = 'user.level=level.id_level';
$namalevel  = $db->table('user')->join('level', $on, 'left')->where('level.id_level', $level)->get()->getRow();

$id_user = session()->get('id');
$user = $db->table('user')->where('id_user', $id_user)->get()->getRow();

// if (!empty($user->foto)) {
//   $foto = base_url('images/' . $user->foto);
// } else {
//   $foto = base_url('images/default.png');
// }

?>

<div class="sidebar-footer"></div>
</aside>    <main class="main-content">
  <div class="position-relative iq-banner">
    <!--Nav Start-->
    <nav class="nav navbar navbar-expand-lg navbar-light iq-navbar">
      <div class="container-fluid navbar-inner">
        <a href="<?=base_url('dashboard')?>" class="navbar-brand">
          <!--Logo start-->
          <!--logo End-->

          <!--Logo start-->
          <div class="logo-main">
            <div class="logo-normal">
              <svg class="text-primary icon-30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="-0.757324" y="19.2427" width="28" height="4" rx="2" transform="rotate(-45 -0.757324 19.2427)" fill="currentColor"/>
                <rect x="7.72803" y="27.728" width="28" height="4" rx="2" transform="rotate(-45 7.72803 27.728)" fill="currentColor"/>
                <rect x="10.5366" y="16.3945" width="16" height="4" rx="2" transform="rotate(45 10.5366 16.3945)" fill="currentColor"/>
                <rect x="10.5562" y="-0.556152" width="28" height="4" rx="2" transform="rotate(45 10.5562 -0.556152)" fill="currentColor"/>
              </svg>
            </div>
            <div class="logo-mini">
              <svg class="text-primary icon-30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="-0.757324" y="19.2427" width="28" height="4" rx="2" transform="rotate(-45 -0.757324 19.2427)" fill="currentColor"/>
                <rect x="7.72803" y="27.728" width="28" height="4" rx="2" transform="rotate(-45 7.72803 27.728)" fill="currentColor"/>
                <rect x="10.5366" y="16.3945" width="16" height="4" rx="2" transform="rotate(45 10.5366 16.3945)" fill="currentColor"/>
                <rect x="10.5562" y="-0.556152" width="28" height="4" rx="2" transform="rotate(45 10.5562 -0.556152)" fill="currentColor"/>
              </svg>
            </div>
          </div>
          <!--logo End-->

          <h4 class="logo-title">GT Kasir</h4>
        </a>

        <div class="sidebar-toggle" data-toggle="sidebar" data-active="true">
          <i class="icon">
           <svg  width="20px" class="icon-20" viewBox="0 0 24 24">
            <path fill="currentColor" d="M4,11V13H16L10.5,18.5L11.92,19.92L19.84,12L11.92,4.08L10.5,5.5L16,11H4Z" />
          </svg>
        </i>
      </div>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon">
          <span class="mt-2 navbar-toggler-bar bar1"></span>
          <span class="navbar-toggler-bar bar2"></span>
          <span class="navbar-toggler-bar bar3"></span>
        </span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="mb-2 navbar-nav ms-auto align-items-center navbar-list mb-lg-0">
          <li class="nav-item dropdown">
            <a class="py-0 nav-link d-flex align-items-center" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <!-- <img src="../assets/images/avatars/01.png" alt="User-Profile" class="theme-color-default-img img-fluid avatar avatar-50 avatar-rounded"> -->
              <img src="<?=base_url('profile/default.png')?>" class="theme-color-default-img img-fluid avatar avatar-50 avatar-rounded">
              <div class="caption ms-3 d-md-block ">
                <h6 class="mb-0 caption-title"><?= session()->get('username') ?></h6>
                <p class="mb-0 caption-sub-title"><?=$namalevel->nama_level?></p>
              </div>
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
        <!-- <li><a class="dropdown-item" href="../dashboard/app/user-profile.html">Profile</a></li>
        <li><a class="dropdown-item" href="../dashboard/app/user-privacy-setting.html">Privacy Setting</a></li>
        <li><hr class="dropdown-divider"></li> -->
        <li><a class="dropdown-item" href="<?=base_url('login/log_out')?>">Logout</a></li>
      </ul>
    </li>
  </ul>
</div>
</div>
</nav>          <!-- Nav Header Component Start -->

<div class="iq-navbar-header" style="height: 215px;">
 <div class="container-fluid iq-container">
   <div class="row">
     <div class="col-md-12">
       <div class="flex-wrap d-flex justify-content-between align-items-center">
         <div>
           <h1><?=$title?></h1>
           <p><?=$desc?></p>
         </div>
       </div>
     </div>
   </div>
 </div>
 <div class="iq-header-img">
   <img src="<?=base_url('assets/images/dashboard/top-header.png')?>" alt="header" class="theme-color-default-img img-fluid w-100 h-100 animated-scaleX">
   <img src="<?=base_url('assets/images/dashboard/top-header1.png')?>" alt="header" class="theme-color-purple-img img-fluid w-100 h-100 animated-scaleX">
   <img src="<?=base_url('assets/images/dashboard/top-header2.png')?>" alt="header" class="theme-color-blue-img img-fluid w-100 h-100 animated-scaleX">
   <img src="<?=base_url('assets/images/dashboard/top-header3.png')?>" alt="header" class="theme-color-green-img img-fluid w-100 h-100 animated-scaleX">
   <img src="<?=base_url('assets/images/dashboard/top-header4.png')?>" alt="header" class="theme-color-yellow-img img-fluid w-100 h-100 animated-scaleX">
   <img src="<?=base_url('assets/images/dashboard/top-header5.png')?>" alt="header" class="theme-color-pink-img img-fluid w-100 h-100 animated-scaleX">
 </div>
</div>          <!-- Nav Header Component End -->
<!--Nav End-->
</div>