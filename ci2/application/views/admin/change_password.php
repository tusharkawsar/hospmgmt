
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
            <?php echo form_open('admin/update_password'); ?>

              <ul style="text-decoration: none;">
                <li>
                  <?php 
                    echo form_label('Current Password:  ', '');
                    echo form_password('curPassword',''); 
                  ?>
                </li>
                <li>
                  <?php 
                    echo form_label('New Password:  ', 'pw');
                    echo form_password('NewPassword',''); 
                  ?>
                </li>
                <li>
                  <?php 
                    echo form_label('Again:  ', 'pw');
                    echo form_password('NewPasswordAgain',''); 
                  ?>
                </li>
                <?php 
                  echo form_submit('Submit','Change Password'); 
                ?>
              </ul>
          </div>
          
        </div>

        <div class="clear"></div>
       
        