

        <div class="left_side_bar"> 
          <? php echo anchor('doc/view_patient_info','See Patient Info');?>
          <div class="col_1">
            <h1>Genaral Menu</h1>
            <div class="box">
              <ul>
                <li><?php echo anchor('nurse/index','Home');?></li></br>
                <li><?php echo anchor('nurse/edit_info','Edit Info');?></li></br>
                <li><?php echo anchor('nurse/view_schedule','View Schedule');?></li></br>
                <li><?php echo anchor('nurse/change_password','Change Password');?></li></br>
                <li><?php echo anchor('nurse/log_out','Log Out');?></li></br>
              </ul>
            </div>
          </div>
          
          
        </div>

         <div class="right_section">
                    <div class="common_content">
            <h2>Edit Information</h2>
            <?php echo form_open('nurse/update_info'); ?>

            <ul style="text-decoration: none;">
              <li>
                <?php 
                  echo form_label('Name:  ', '1');
                  echo form_input('nursename',$name); 
                ?>
              </li>
              <li>
                <?php 
                  echo form_label('Adress:  ', 'pw');
                  echo form_input('nurseaddress',$address); 
                ?>
              </li>
              <li>
                <?php 
                  echo form_label('Age:  ', 'pw');
                  echo form_input('nurseage',$age); 
                ?>
              </li>
              <li>
                <?php 
                  echo form_label('Phone:  ', 'pw');
                  echo form_input('nursephone',$phone); 
                ?>
              </li>
              <li>
                <?php 
                  echo form_label('Email:  ', 'pw');
                  echo form_input('nurseemail',$email); 
                ?>
              </li>
              <li>
                <?php 
                  echo form_label('Qualification:  ', 'pw');
                  echo form_textarea('nursequalification',$qualification); 
                ?>
              </li>
              <?php 
                echo form_submit('Submit','Update'); 
              ?>
            </ul>

          </div>
          
        </div>
          
     

        <div class="clear"></div>
       
        