    // Typed.js Strings
    document.addEventListener('DOMContentLoaded', function(){
        if(document.getElementById("typestrings") != null){
          var strings = document.getElementById("typestrings").innerHTML;
          var res = new Array();
          res = strings.split(", ");
          Typed.new('.typed', {
            strings: res,
            typeSpeed: 80,
            starDelay: 1000,
            backDelay: 2000,
            loop: true,
          });
        }
      });

 