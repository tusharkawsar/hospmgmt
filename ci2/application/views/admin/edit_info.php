
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
            <h2>Edit Information</h2>
            <?php echo form_open('admin/update_info'); ?>

            <ul style="text-decoration: none;">
              <li>
                <?php 
                  echo form_label('Name:  ', '1');
                  echo form_input('adname',$name); 
                ?>
              </li>
              <li>
                <?php 
                  echo form_label('Adress:  ', 'pw');
                  echo form_input('adaddress',$address); 
                ?>
              </li>
              <li>
                <?php 
                  echo form_label('Age:  ', 'pw');
                  echo form_input('adage',$age); 
                ?>
              </li>
              <li>
                <?php 
                  echo form_label('Phone:  ', 'pw');
                  echo form_input('adphone',$phone); 
                ?>
              </li>
              <li>
                <?php 
                  echo form_label('Email:  ', 'pw');
                  echo form_input('ademail',$email); 
                ?>
              </li>
              <li>
                <?php 
                  echo form_label('Qualification:  ', 'pw');
                  echo form_textarea('adqualification',$qualification); 
                ?>
              </li>
              <?php 
                echo form_submit('Submit','Update'); 
              ?>
            </ul>

          </div>
          
        </div>

        <div class="clear"></div>
       
        