<?php include "header.php"; ?>
<div class="body-wrap">
    <div class="login login-v3 register">
        <!-- begin news-feed -->
        <div class="news-feed">
            <div class="news-image">
                        </div>
        </div>
        <!-- end news-feed -->
        <!-- begin right-content -->
        <div class="right-content fullvh">
            <!-- begin login-header -->
            <div class="login-header">
                <div class="brand">
                   Admin
                    <small>responsive bootstrap 4 admin template</small>
                </div>
                <div class="icon">
                    <i class="ion-log-in"></i>
                </div>
            </div>
            <!-- end login-header -->
            <!-- begin login-content -->
            <div class="login-content">
                <form id="myForm" class="margin-bottom-0">
                    <div id="result"></div>
                    <div class="row mb-3">
                        <div class="col-lg-6 sm-form-design">
                            <input type="text" name="user_name" class="form-control h5-email" placeholder="Shop name entry" autocomplete="off">
                            <label class="control-label">Kullanıcı Adı</label>
                        </div>

                        <div class="col-lg-6 sm-form-design res-md-m-t-16 res-xs-m-t-16">
                            <input type="text" class="form-control h5-email" name="email" placeholder="enter your e-mail" autocomplete="off">
                            <label class="control-label">E-mail</label>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-lg-12 sm-form-design">
                            <input type="password" class="form-control h5-email" name="password" placeholder="enter your email id" autocomplete="off">
                            <label class="control-label">Password</label>
                        </div>

                    
                    </div>

                   

                    <div class="mt-1 mb-3">
                        <small class="">By clicking "Sign up" you agree to our terms and conditions</small>
                    </div>

                    <div class="login-buttons m-t-20 m-b-40 p-b-40 text-inverse f-s-12">
                        <button class="registerPost btn btn-success btn-block btn-lg sm_bg_6 border-0">Register me in</button>
                     
                    </div>
                    <hr>
                    <p class="text-center f-s-12">
                        © Perfectin. Aarvi All Right Reserved 2018
                    </p>
                </form>
            </div>
            <!-- end login-content -->
        </div>
        <!-- end right-container -->
    </div>
</div>
<?php
/*
$data=array(
    "userId"    =>  2,
    "userName"  =>  "oner",
);
*/


$resultParametre=array(
    array(
        "result"            =>  1,
        "message"           => "Mağazanız oluşturuldu.",
        "messageStyle"      =>  "success",
        "script"            =>  "",
        "resultPrintTo"       =>  "#result",
        "resultPrintStyle"  => "default"
    ),
    array(
        "result"            =>  2,
        "message"           => "Bu mağaza adı başkası tarafından kullanılıyor.",
        "messageStyle"      =>  "warning",
        "script"            =>  "",
        "resultPrintTo"       =>  "#result",
        "resultPrintStyle"  => "default"
    ),
    array(
        "result"            =>  3,
        "message"           => "E-mail adresi başkası tarafından kullanılıyor.",
        "messageStyle"      =>  "warning",
        "script"            =>  "",
        "resultPrintTo"       =>  "#result",
        "resultPrintStyle"  => "default"
    ) 
);
$data="#myForm";
$ajaxContent=$ajax->add("click",".registerPost","post",$url="controller/user-controller.php?action=register",$data,$resultParametre,1);
include "footer.php";

?>