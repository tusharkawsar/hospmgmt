
        <div class="left_side_bar"> 
          <? php echo anchor('doc/view_patient_info','See Patient Info');?>
          <div class="col_1">
            <h1>Patient Menu</h1>
            <div class="box">
              <ul>
                <li><?php echo anchor('doc/index','Home');?></li></br>
                <li><?php echo anchor('doc/view_patient_history','See Patient History');?></li></br>
                <li><?php echo anchor('doc/give_prescription','Give Prescription');?></li></br>
              </ul>
            </div>
          </div>
          
          <div class="col_1">
            <h1>Doctor Menu</h1>
            <div class="box">
              <ul>

                <li><?php echo anchor('doc/edit_info','Edit Info');?></li></br>
                <li><?php echo anchor('doc/view_schedule','View Schedule');?></li></br>
                <li><?php echo anchor('doc/change_password','Change Password');?></li></br>
                <li><?php echo anchor('doc/log_out','Log Out');?></li></br>
              </ul>
            </div>
          </div>

        </div>

                <div class="right_section">
          <div class="common_content">
            <h2>Edit Information</h2>
            <?php echo form_open('doc/update_info'); ?>

            <ul style="text-decoration: none;">
              <li>
                <?php 
                  echo form_label('Name:  ', '1');
                  echo form_input('docname',$name); 
                ?>
              </li>
              <li>
                <?php 
                  echo form_label('Adress:  ', 'pw');
                  echo form_input('docaddress',$address); 
                ?>
              </li>
              <li>
                <?php 
                  echo form_label('Age:  ', 'pw');
                  echo form_input('docage',$age); 
                ?>
              </li>
              <li>
                <?php 
                  echo form_label('Phone:  ', 'pw');
                  echo form_input('docphone',$phone); 
                ?>
              </li>
              <li>
                <?php 
                  echo form_label('Email:  ', 'pw');
                  echo form_input('docemail',$email); 
                ?>
              </li>
              <li>
                <?php 
                  echo form_label('Qualification:  ', 'pw');
                  echo form_textarea('docqualification',$qualification); 
                ?>
              </li>
              <li>
                <?php 
                  echo form_label('Specialization:  ', 'pw');
                  echo form_textarea('docspecialization',$specialization); 
                ?>
              </li>
              <?php 
                echo form_submit('Submit','Update'); 
              ?>
            </ul>

          </div>
          
        </div>

        <div class="clear"></div>
       
        