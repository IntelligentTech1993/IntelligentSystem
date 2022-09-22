
<section style="padding: 20px 0px;">

        <div class="container">
            <div class="row">      

                <div class="col-md-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading" style="background: #4f556b;">
                            <h3 class="panel-title"><?php echo (!empty($user_language[$user_selected]['lg_gigs_sales']))?$user_language[$user_selected]['lg_gigs_sales']:$default_language['en']['lg_gigs_sales']; ?> (<?php echo date('Y');?>)</h3>
                        </div>
                        <div class="panel-body">
                            <div id="morris-bar-chart"></div>
                            <!-- <div class="text-right">
                                <a href="#">View Details <i class="fa fa-arrow-circle-right"></i></a>
                            </div> -->
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="panel panel-primary">
                                <div class="panel-heading" style="background: #4f556b;">
                                    <h3 class="panel-title" ><?php echo (!empty($user_language[$user_selected]['lg_gigs_status']))?$user_language[$user_selected]['lg_gigs_status']:$default_language['en']['lg_gigs_status']; ?> (<?php echo date('Y');?>)</h3>
                                </div>
                                <div class="panel-body">
                                    <div id="morris-donut-chart"></div>
                                    <!-- <div class="text-right">
                                        <a href="#">View Details <i class="fa fa-arrow-circle-right"></i></a>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="panel panel-primary">
                                <div class="panel-heading" style="background: #4f556b;">
                                    <h3 class="panel-title" ><?php echo (!empty($user_language[$user_selected]['lg_gigs_sale_amount']))?$user_language[$user_selected]['lg_gigs_sale_amount']:$default_language['en']['lg_gigs_sale_amount']; ?> (<?php echo date('Y');?>)</h3>
                                </div>
                                <div class="panel-body">
                                    <div id="morris-line-chart"></div>
                                    <!-- <div class="text-right">
                                        <a href="#">View Details <i class="fa fa-arrow-circle-right"></i></a>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>