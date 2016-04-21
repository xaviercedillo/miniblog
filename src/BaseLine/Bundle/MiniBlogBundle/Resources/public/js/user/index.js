/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function(){
   
   $(".showUser").click(function(e){
        var path=$(this).attr("href");
        console.log(path);
        $.ajax({
            type: 'GET',
            url: path,
            success: function(data) {
                $("#myModal").html(data);
                
                $("#myModal").modal('show');
            }
        });
        
        e.preventDefault();
    });
});


