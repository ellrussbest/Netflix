<?php
    include_once("./includes/header.php")
?>

<div class="textboxContainer">
    <input type="text" class="searchInput" placeholder="search for something" />
</div>

<div class="results"> </div>

<script>
    $(() => {
        let username = '<?php echo $userLoggedIn; ?>';
        let timer;

        $(".searchInput").keyup(() => {
            clearTimeout(timer);

            timer = setTimeout(() => {
                let val = $(".searchInput").val();

                if(val !== "") {
                    $.post("ajax/getSearchResults.php", {
                        term: val,
                        username
                    }, 
                    (data)=> {
                       $(".results").html(data); 
                    })
                }else{
                    $(".results").html("");
                }
                
            }, 500);
        })
    });
</script>