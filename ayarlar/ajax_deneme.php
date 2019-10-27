<html>
    
    <head>
        <link href="/css/plugins.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">
    <link href="/css/responsive.css" rel="stylesheet">
    <link href="/css/header.css" rel="stylesheet">
    <link href="/css/sozluk.css" rel="stylesheet">
        <script src="http://code.jquery.com/jquery-3.4.1.js"  integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="  crossorigin="anonymous"></script>

        
    </head>
    
    <body data-animation-in="fadeIn"  data-animation-out="fadeOut" data-icon="12" data-icon-color="#76aa00" data-speed-in="1000" data-speed-out="500">
        
        <form method="post" onsubmit="return false;">
            
            ad: <input type="text" name="ad"><br>
            <br>
            soyad: <input type="text" name="soyad"><br>
            
            <br>
            <input id="notify_btn" type="submit" value="KAYDET" onclick="gonder();">
            
            <div id="sonuc"></div>
            
    
        </form>
        
        
        <script type="text/javascript">
            
            function gonder()
            {
                
                var ad=$("input[name='ad']").val();
                var soyad=$("input[name='soyad']").val();
                
            
                $.ajax({
                    
                    type:"POST",
                    url:"e-posta-islem.php",
                    data:{ad,soyad},
                    success:function(sonuc){
                        $("#sonuc").html(sonuc);
                    }
                    
                })
                
                
                
                
            }
            
            
        </script>
       


     <script src="js/jquery.js"></script>
    <script src="js/plugins.js"></script>

    <!--Template functions-->
    <script src="js/functions.js"></script>
   
        
        
        
        
    </body>
    
    
    
</html>

