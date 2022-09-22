<div class="content-page">
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-sm-8">
                    <h4 class="page-title m-b-20 m-t-0">Terms Menu</h4>
                </div>
                <div class="col-sm-4 text-right m-b-20">
                <?php 
                    if (!empty($lists)) {
                           $count=count($lists);
                           if($count<2)
                           {
                    ?>
                    <a href="<?php echo base_url('admin/dashboard/termcreate/' ); ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Add Menu</a>
                    <?php 
                           }}else{ ?>
                <a href="<?php echo base_url('admin/dashboard/termcreate/' ); ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Add Menu</a>
                           <?php } ?>
                </div>
            </div>
            <?php if($this->session->userdata('message')) {  ?>
            <?php echo $this->session->userdata('message');?>
            <?php } ?> 
            <div class="panel">
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped releasetable m-b-0">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" id="ckbCheckAll" /> Check All</th>
                                    <th>#</th>
                                    <th>Terms title</th>
                                    <th>Page Description</th>                                  
                                    <th class="text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody >
                                <?php 
                                
                                if (!empty($lists)) {
                                    $sno = 1;
                                    foreach ($lists as $row) {
                                      
                                        $_id = isset($row['id']) ? $row['id'] : '';
                                         if (!empty($_id)) {
                                            $sub_menu = $row['footer_submenu'] ;                              
                                            if(isset($row['page_desc']))
                                            {
                                               $page_content = $row['page_desc'] ;
                                            }                                                
                                            ?>
                                            <tr>
                                                <td><input type="checkbox" class="checkBoxClass" value="<?php echo $row['id']; ?>" /></td>
                                                <td> <?php echo $sno?></td>
                                                <td> <?php echo  $sub_menu?></td>
                                                <td> <?php echo substr(strip_tags($page_content), 0,20);?><?php if(strlen($page_content)>20){?> ...<?php } ?> </td>                                              
                                                <td class="text-right">
                                                    <a href="<?php echo base_url('admin/dashboard/termsedit/' . $_id); ?>" class="on-default view-row table-action-btn" title="Edit"><i class="mdi mdi-pencil text-success"></i></a>&nbsp;
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                   $sno = $sno +1;
                                        }
                                } else {
                                    ?>
                                    <tr>
                                        <td colspan="11"><p class="text-danger text-center m-b-0">No Records Found</p></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                            <?php 
                                     if(!empty($lists)) 
                                    {
                                        ?>
                                <tfoot>
                                    <td colspan="4"><form method="post" id="multi_deletes_form" action="<?php echo base_url();?>gigs/multiple_delete"><input id="multi_Delete" type="hidden" name="multi_Delete"><input type="submit" name="" class="btn btn-primary btn-sm" value="Delete"></form></td>
                                </tfoot>
                                <?php } ?>
                        </table>
                    </div>
                </div>
            </div>
        </div> 
    </div>