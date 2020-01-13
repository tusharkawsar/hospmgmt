
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
            <?php
                echo form_open('rcp/appointment_assign');
                echo form_label("Choose Patient :",'');
                echo form_dropdown('choosePTbyPID',$ptlist,$ptlist[0]);                

                echo form_label("Choose Doctor :",'');
                echo form_dropdown('chooseDOCbyDID',$doclist,$doclist[0]);   

                echo form_label("Choose Date :",'');
                echo form_dropdown('chooseDate',$date,$date[0]);   

                echo form_label("Choose month :",'');
                echo form_dropdown('choosemonth',$month,$doclist[0]);  

                echo form_label("Choose Year :",'');
                echo form_dropdown('chooseYear',$year,$year[0]);  

                echo form_submit('Submit','Add Appointment');
                if($this->input->post('choosePTbyPID')!=null)
                  echo $this->table->generate($query);

              ?>
              
                </form>
          </div>
          
        </div>

        <div class="clear"></div>
       
        