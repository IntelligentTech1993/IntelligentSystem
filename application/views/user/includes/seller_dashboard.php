<style>
    /* Profile container */

    .sticky-sidebar.affix,
    .sticky-sidebar.affix-bottom {

        position: fixed;
        width: 311px;
        max-width: 100%;
    }

    .sticky-sidebar.affix {

        transition:0.5s all;
        -webkit-transition:0.5s all;
        -moz-transition:0.5s all;
        -o-transition:0.5s all;
        -ms-transition:0.5s all;
        top:23px;
    }
    .profile {
        margin: 20px 0;
    }

    /* Profile sidebar */
    .profile-sidebar {
        padding: 20px 0 10px 0;
        background: #4f556b;
    }

    .profile-userpic img {
        float: none;
        margin: 0 auto;
        width: 23%;
        height: 50%;
        -webkit-border-radius: 50% !important;
        -moz-border-radius: 50% !important;
        border-radius: 50% !important;
    }

    .profile-usertitle {
        text-align: center;
        margin-top: 20px;
    }

    .profile-usertitle-name {
        color: #fff;
        font-size: 16px;
        font-weight: 600;
        margin-bottom: 7px;
    }

    .profile-usertitle-job {
        text-transform: uppercase;
        color: #e7e7e7;
        font-size: 12px;
        font-weight: 600;
        margin-bottom: 15px;
    }

    .profile-userbuttons {
        text-align: center;
        margin-top: 10px;
    }

    .profile-userbuttons .btn {
        text-transform: uppercase;
        font-size: 11px;
        font-weight: 600;
        padding: 6px 15px;
        margin-right: 5px;
    }

    .profile-userbuttons .btn:last-child {
        margin-right: 0px;
    }

    .profile-usermenu {
        margin-top: 30px;
    }

    .profile-usermenu ul li {
        border-bottom: 1px solid #f0f4f7;
    }

    .profile-usermenu ul li:last-child {
        border-bottom: none;
    }

    .profile-usermenu ul li a {
        color: #fff;
        font-size: 14px;
        font-weight: 400;
    }

    .profile-usermenu ul li a i {
        margin-right: 8px;
        font-size: 14px;
    }

    .profile-usermenu ul li a:hover {
        background-color: #b3b3b3;
        color: #ffffff;
    }

    .profile-usermenu ul li.active {
        border-bottom: none;
    }

    .profile-usermenu ul li.active a {
        color: #fff;
        background-color: #b3b3b3;
        border-left: 2px solid #333;
        margin-left: 0px;
    }

    @media only screen and (max-width: 1199px) {
        .sticky-sidebar.affix {
            top:140px;
        }   
        .sticky-sidebar.affix,
        .sticky-sidebar.affix-bottom {

            width: 302px;        
        }
    }

    @media only screen and (max-width: 767px)
    .sticky-sidebar.affix {
        position: relative;
        width: auto;
        max-width: 100%;
        top: auto;
    }    

</style>
                <?php $image = base_url()."assets/images/avatar-lg.jpg"; if(!empty($profile['user_profile_image'])){ $image = base_url().$profile['user_profile_image'];} 

                    $name = $profile['username'];
                    $email = $profile['email'];

                            $username = $profile['username'];

                            if(!empty($profile['fullname']))

                            {

                                $name = $profile['fullname'];

                            }                     

                    ?>
                    <div class="sticky-sidebar" data-spy="affix" data-offset-top="320" data-offset-bottom="410">
                        <div class="profile-sidebar">
                            <!-- SIDEBAR USERPIC -->
                            <div class="profile-userpic">
                                <img src="<?php echo $image;?>" class="img-circle center-block" width="50">
                            </div>
                            <!-- END SIDEBAR USERPIC -->
                            <!-- SIDEBAR USER TITLE -->
                            <div class="profile-usertitle">
                                <div class="profile-usertitle-name">
                                    <?php echo ucfirst($name); ?>
                                </div>
                                <!-- <div class="profile-usertitle-job">
                                    Developer
                                </div> -->
                            </div>
                            <!-- END SIDEBAR USER TITLE -->
                            <!-- SIDEBAR BUTTONS -->
                            <div class="profile-userbuttons">
                                <a href="<?php echo base_url();?>profile" class="btn btn-success btn-sm">Edit Profile</a>
                                <!-- <button type="button" class="btn btn-success btn-sm">Edit Profile</button> -->
                            </div> 
                            <!-- END SIDEBAR BUTTONS -->
                            <!-- SIDEBAR MENU -->
                            <div class="profile-usermenu">
                                <ul class="nav">
                                                                             
                                </ul>
                            </div>
                            <!-- END MENU -->
                        </div>
                    </div>

