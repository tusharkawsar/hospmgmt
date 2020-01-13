
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
            <h2>Information</h2>
            <?php 
                echo form_open('rcp/view_patient_profile');
                echo form_label("Write Name :",'');
                echo form_input('searchPTByName','');
                echo form_submit('Submit1','Search');

                echo form_open('rcp/view_patient_profile');
                echo form_label("Write Phone No :",'');
                echo form_input('searchPTByPhone','');
                
                echo form_submit('Submit2','Search');

                echo form_open('rcp/view_patient_profile');
                echo form_label("Choose Patient By status :",'');
                echo form_dropdown('searchPTBystatus',$status,$status[0]);                

                echo form_label("Choose Patient By Type :",'');
                echo form_dropdown('searchPTByType',$type,$type[0]);                
                echo form_submit('Submit3','Search');


                if($this->input->post('searchPTByName')!=null && 
                  $this->input->post('searchPTByPhone')==null )
                {
                  //echo $query;
                  echo $this->table->generate($query);
                  //echo "Name";
                }
                else if($this->input->post('searchPTByPhone')!=null && 
                  $this->input->post('searchPTByName')==null){
                  echo $this->table->generate($query);
                  //echo "Phone";
                }
                else if($this->input->post('searchPTBystatus')!=null || 
                  $this->input->post('searchPTByType')!=null ){
                  echo $this->table->generate($query);
                }
                               
            ?>
          </div>
          
        </div>

        <div class="clear"></div>
       
        