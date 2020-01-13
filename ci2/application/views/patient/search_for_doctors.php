

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
            <h2>Information</h2>
            <hr>
            <ul><li>
            <?php 
                echo form_open('patient/search_for_doctors');
                echo form_label("Write Doctor's Name :   ",'');
                echo form_input('searchDOCbyname','');
                echo form_submit('Submit','Search');?></li>
              <li>  <?php
                echo form_open('patient/search_for_doctors');
                //if($this->input->post('doctors')!=null)
                echo form_label("Select Doctor's Name :   ",'');
                echo form_dropdown('doctors', $queryAll['name'],$queryAll['name'][0]);
                echo form_submit('Submit','Go');?></li>
                <?php
                
                
                if(isset($query)){
                  echo $this->table->generate($query);
                }
                else if(isset($docinfo)){
                  echo $this->table->generate($docinfo);
                }
            ?>
           
          </div>
          
        </div>

        <div class="clear"></div>
       
        