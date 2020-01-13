
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
            <div id='patient_input_form' style="margin: auto; text-align:center">

              <?php echo form_open('admin/create_employee_account'); 
                echo form_label("EMP:",'');
                echo form_dropdown('EMPtype', $emptype,$emptype[0]);
              ?>

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
                    echo form_label('Phone: ', 'phone');
                    echo form_input('Phone',''); 
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
                    echo form_label('Email: ', 'email');
                    echo form_input('Email',''); 
                  ?>
                </li>
                <li>
                  <?php 
                    echo form_label('Qualification: ', 'qual');
                    echo form_input('Qualification',''); 
                  ?>
                </li>
                <li>
                  <?php 
                    echo form_label('Specialization(Only Doc):  ', 'spec');
                    echo form_input('Specialization',''); 
                  ?>
                </li>
                <li>
                  <?php 
                    echo form_label('Salary:  ', 'salary');
                    echo form_input('Salary',''); 
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
       
        