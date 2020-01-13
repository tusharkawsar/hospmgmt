
        <div class="left_side_bar"> 
          <? php echo anchor('doc/view_patient_info','See Patient Info');?>
          <div class="col_1">
            <h1>Genaral Menu</h1>
            <div class="box">
              <ul>
                <li><?php echo anchor('rcp/index','Home');?></li></br>
     
                <li><?php echo anchor('rcp/edit_info','Edit Info');?></li></br>
                <li><?php echo anchor('rcp/view_schedule','View Schedule');?></li></br>
              </ul>
            </div>
          </div>
          
          <div class="col_1">
            <h1>Employee Menu</h1>
            <div class="box">
              <ul>
                <li><?php echo anchor('rcp/create_patient_account','Create Patient Account');?></li></br>   
                <li><?php echo anchor('rcp/view_patient_profile','View Patient Profile');?></li></br>
                <li><?php echo anchor('rcp/appointment_assign','Appoointmnet Assign');?></li></br>
                <li><?php echo anchor('rcp/bed_assign','Bed Assign');?></li></br>             
          
                <li><?php echo anchor('rcp/change_password','Change Password');?></li></br>
                <li><?php echo anchor('rcp/log_out','Log Out');?></li></br>
              </ul>
            </div>
          </div>

        </div>

        <div class="right_section">
          <div class="common_content">
            <div id='patient_input_form' style="margin: auto; text-align:center">

              <?php echo form_open('rcp/create_patient_account'); ?>

              <ul style="text-decoration: none;">
                <li>
                  <?php 
                    echo form_label('Name:  ', 'name');
                    echo form_input('Name',''); 
                  ?>
                </li>
                <?php 
                    echo form_label('Address: ', 'add');
                    echo form_input('Address',''); 
                  ?>
                </li>
                <li>
                  <?php 
                    echo form_label('Age: ', 'age');
                    echo form_input('Age',''); 
                  ?>
                </li>
                <li>
                  <?php 
                    echo form_label('Phone: ', 'phone');
                    echo form_input('Phone',''); 
                  ?>
                </li>
                <li>
                  <?php 
                    echo form_label('Blood Group: ', 'bgroup');
                    echo form_input('Blood Group',''); 
                  ?>
                </li>
                <li>
                  <?php 
                    echo form_label('Email: ', 'email');
                    echo form_input('Email',''); 
                  ?>
                </li>
                <li>
                  <?php 
                    echo form_label('Ptype: ', 'ptype');
                    echo form_input('Ptype',''); 
                  ?>
                </li>
                <?php 
                  echo form_submit('Submit','Create'); 

                  if(isset($success)){
                    echo "Successfully Inserted Data";
                  }
                ?>
              </ul>

            </div>
          </div>
          
        </div>

        <div class="clear"></div>
       
        