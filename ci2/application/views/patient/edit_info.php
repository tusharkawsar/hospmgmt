

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
            <h2>Edit Information</h2>
            <?php echo form_open('patient/update_info'); ?>

            <ul style="text-decoration: none;">
              <li>
                <?php 
                  echo form_label('Name:  ', '1');
                  echo form_input('ptname',$name); 
                ?>
              </li>
              <li>
                <?php 
                  echo form_label('Adress:  ', 'pw');
                  echo form_input('ptaddress',$address); 
                ?>
              </li>
              <li>
                <?php 
                  echo form_label('Age:  ', 'pw');
                  echo form_input('ptage',$age); 
                ?>
              </li>
              <li>
                <?php 
                  echo form_label('Phone:  ', 'pw');
                  echo form_input('ptphone',$phone); 
                ?>
              </li>
              <li>
                <?php 
                  echo form_label('Email:  ', 'pw');
                  echo form_input('ptemail',$email); 
                ?>
              </li>
              <?php 
                echo form_submit('Submit','Update'); 
              ?>
            </ul>

          </div>
          
        </div>

        <div class="clear"></div>
       
        