

        <div class="left_side_bar"> 
          <? php echo anchor('doc/view_patient_info','See Patient Info');?>
          <div class="col_1">
            <h1>Genaral Menu</h1>
            <div class="box">
              <ul>
                <li><?php echo anchor('patient/index','Home');?></li></br>
                <li><?php echo anchor('patient/edit_info','Edit Info');?></li></br>
              </ul>
            </div>
          </div>
          
          <div class="col_1">
            <h1>Medical Menu</h1>
            <div class="box">
              <ul>
                <li><?php echo anchor('patient/search_for_doctors','Search For Doctors');?></li></br>  
                <li><?php echo anchor('patient/view_medical_history','View Medical History');?></li></br>
                <li><?php echo anchor('patient/view_prescription','View Prescription');?></li></br>
                <li><?php echo anchor('patient/view_appointment_schedule','View Appointment Schedule');?></li></br>             
                <li><?php echo anchor('patient/change_password','Change Password');?></li></br>
                <li><?php echo anchor('patient/log_out','Log Out');?></li></br>
              </ul>
            </div>
          </div>

        </div>

        <div class="right_section">
          <div class="common_content">
            <?php echo form_open('patient/update_password'); ?>

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
      
        