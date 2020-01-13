
        <div class="left_side_bar"> 
          <? php echo anchor('doc/view_patient_info','See Patient Info');?>
          <div class="col_1">
            <h1>Genaral Menu</h1>
            <div class="box">
              <ul>
                <li><?php echo anchor('admin/index','Home');?></li></br>

                <li><?php echo anchor('admin/edit_info','Edit Info');?></li></br>
                <li><?php echo anchor('admin/view_schedule','View Schedule');?></li></br>
              </ul>
            </div>
          </div>
          
          <div class="col_1">
            <h1>Employee Menu</h1>
            <div class="box">
              <ul>
                <li><?php echo anchor('admin/create_employee_account','Create Employee Account');?></li></br>  
                <li><?php echo anchor('admin/view_employee_profile','View Employee Profile');?></li></br>
                <li><?php echo anchor('admin/view_patient_profile','View Patient Profile');?></li></br>
                <li><?php echo anchor('admin/view_bed_status','View Bed Status');?></li></br>
                <li><?php echo anchor('admin/view_employee_schedule','View Employee Schedule');?></li></br>             
                <li><?php echo anchor('admin/change_password','Change Password');?></li></br>
                <li><?php echo anchor('admin/log_out','Log Out');?></li></br>
              </ul>
            </div>
          </div>

        </div>

        <div class="right_section">
          <div class="common_content">
            <h2>Information</h2>
            <hr>
            
            <h3><?php echo "Welcome $username" ?></h3>
            <hr>
            <p><?php echo $this->table->generate($query['info']);?></p>
          </div>
          
        </div>

        <div class="clear"></div>
       
        