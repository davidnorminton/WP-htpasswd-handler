(function( $ ) {
	'use strict';

$(document).ready(function(event){
   setTimeout(function(){
       $('.output').hide();
       $('.outputerror').hide();},3000);
});
 $(document).on('click', '#add_users', function(){
   $('#tab1').show();
   $('#add_users').attr('class', 'active');
   $('#tab2').hide();
   $('#delete_user').attr('class', 'tabs');
   $('#tab3').hide();
   $('#recover_password').attr('class', 'tabs'); 
   $('#tab4').hide();
   $('#change_password').attr('class', 'tabs');      
 });
 $(document).on('click', '#delete_user', function(){   
   $('#tab2').show();
   $('#delete_user').attr('class', 'active');      
   $('#tab1').hide();
   $('#add_users').attr('class', 'tabs');      
   $('#tab3').hide();
   $('#recover_password').attr('class', 'tabs');     
   $('#tab4').hide();
   $('#change_password').attr('class', 'tabs');      
 });

 $(document).on('click', '#change_password', function(){
   $('#tab4').show();
   $('#change_password').attr('class', 'active');      
   $('#tab1').hide();
   $('#add_users').attr('class', 'tabs');   
   $('#tab2').hide();
   $('#delete_user').attr('class', 'tabs'); 
   $('#tab3').hide();
   $('#recover_password').attr('class', 'tabs');       
 }); 
})( jQuery );

