
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
             <?php

                $pt = $this->input->post('pt');

                echo form_open('admin/view_patient_profile');
                echo form_label("Write Patient Name :",'');
                echo form_input('searchPTByName','');
                echo form_submit('Submit','Search');

                echo form_open('admin/view_patient_profile');
                echo form_label("Patients:",'');
                echo form_dropdown('pt', $ptlist,$ptlist[0]);
                echo form_submit('Submit','Go');
                
                
                if(isset($query)){
                  echo $this->table->generate($query);
                }
                else if(isset($ptinfo)){
                  echo $this->table->generate($ptinfo);
                }

            ?>
          </div>
          
        </div>

        <div class="clear"></div>
       
        