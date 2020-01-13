

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
            <p><strong>Something</strong></p>
            <p>Something else</p>
            <a href="#">Read more</a> 
            <hr>
            <p>More things</p><br>
          </div>
          
        </div>

        <div class="clear"></div>
       
        