<?php
$getprofile="SELECT * from CC_profile";
     $getprofile2=mysql_query($getprofile) or die($no_profile_error);
     $getprofile3=mysql_fetch_array($getprofile2);
     if(strlen($getprofile3[name])>1)
        {
        echo "$profile_name_label $getprofile3[name]<br>";
     }
     if(strlen($getprofile3[birthdate])>1)
        {
        echo "$profile_birthdate_label $getprofile3[birthdate]<br>";
     }
     if(strlen($getprofile3[gender])>1)
        {
        echo "$profile_gender_label $getprofile3[gender]<br>";
     }
     if(strlen($getprofile3[location])>1)
     {
        echo "$profile_location_label $getprofile3[location]<br>";
     }
     if(strlen($getprofile3[hobbies])>1)
        {
        echo "$profile_hobbies_label $getprofile3[hobbies]<br>";
     }
     if(strlen($getprofile3[job])>1)
        {
        echo "$profile_job_label $getprofile3[job]<br>";
     }
     if(strlen($getprofile3[email])>1)
        {
        echo "$profile_email_label $getprofile3[email]<br>";
     }
     if(strlen($getprofile3[quote])>1)
        {
        echo "$profile_quote_label $getprofile3[quote]<br>";
}
?>