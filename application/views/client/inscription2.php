<?php
   //  c'est propre mais dégueulasse
 
    echo form_open('clientCtrl/inscription2');
 
      $nom= array(
 
        'name'=>'nom',
 
        'id'=>'nom',
 
        'placeholder'=>'Nom',
 
        'value'=>set_value('nom')
 
      );
      echo form_input($nom);
      $prenom= array(
 
        'name'=>'prenom',
 
        'id'=>'prenom',
 
        'placeholder'=>'Prenom',
 
        'value'=>set_value('prenom')
 
      );
      echo form_input($prenom);
      $mail= array(
 
        'name'=>'mail',
 
        'id'=>'mail',
 
        'placeholder'=>'Email',
 
        'value'=>set_value('mail')
 
      );
      echo form_input($mail);
    echo form_submit('envoi', 'Valider');
 
    echo form_close();
 
?>