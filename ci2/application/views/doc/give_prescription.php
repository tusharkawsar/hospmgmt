
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
            <?php 
                //echo $ptlist;
                
                echo form_open('Doc/add_prescription');
                echo form_label("Select Patient :",'');
                if($ptlist != null)
                    echo form_dropdown('ptList', $ptlist, $ptlist[0]);
                else echo "No Patient Today";

                echo form_label("Select Medicine :",'');
                echo form_dropdown('medList',$queryAll['name'],$queryAll['name'][0]);
                
                echo form_label("Select Dosage :",'');
                echo form_dropdown('medDose',$dosage,$dosage[0]);

                echo form_label("Select Duration :",'');
                echo form_input('medDuration','');
                
                echo form_label("Select number of medicine :",'');
                echo form_input('numberofMed','');

                echo form_submit('Submit','Add');
                if($this->input->post('medList')!=null && $this->input->post('medDose')!=null
                  && $this->input->post('medDuration')!=null && $this->input->post('numberofMed')!=null)
                {
                  
                  echo $this->table->generate($query);
                }
                               
            ?>
          </div>
          
        </div>

        <div class="clear"></div>
       
        