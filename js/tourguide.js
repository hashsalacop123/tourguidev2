jQuery(document).ready(function($) {    
   Fancybox.bind('[data-fancybox="gallery"]', {
        //
      });  
    $(".edit-profile-link2").click(function() {
  
      Fancybox.show([{ src: "#edit-profile-link2", type: "inline" }])
          // Prevent the link from following its href
          return false;
    
  });

    $(".edit-profile-link").click(function() {
  
      Fancybox.show([{ src: "#edit-profile-link", type: "inline" }])
          // Prevent the link from following its href
          return false;
    
  });

});