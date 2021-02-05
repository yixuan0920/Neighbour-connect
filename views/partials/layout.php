<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
        <!-- slick slide -->
        <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css" integrity="sha512-17EgCFERpgZKcm0j0fEq1YCJuyAWdz9KUtv1EjVuaOz8pDnh/0nZxmU6BBXwaaxqoi9PQXnRWqlcDB027hgv9A==" crossorigin="anonymous" /> -->
        <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css" integrity="sha512-yHknP1/AwR+yx26cB1y0cjvQUMvEa2PFzt1c9LlS4pRQ5NOTZFWbhBig+X9G9eYW/8m0/4OXNx8pxJ6z57x0dw==" crossorigin="anonymous" /> -->
        <!-- Style CSS -->
        <link rel="stylesheet" type="text/css" href="/assets/css/style.css">
        <!-- AOS CSS -->
        <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
        <!-- Font Animation -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
        <!-- Bulma CSS -->
        <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.1/css/bulma.min.css"> -->
        <!-- Get Icon -->
        <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Cardo&family=Indie+Flower&family=Kaushan+Script&display=swap+Big+Shoulders+Display:wght@300&family=Lato:wght@100&family=Potta+One&display=swap&family=Big+Shoulders+Display" rel="stylesheet">
        <!-- <link rel="stylesheet" type="text/css" href="../../assets/css/slick.css"/> -->
        <!-- <link rel="stylesheet" type="text/css" href="../../assets/css/slick-theme.css"/> -->
        <title>Neigbour Shop  </title>
    </head>

    <body>
        <main>
            <?php get_content() ?>
        </main>

        <!-- Option 1: Bootstrap Bundle with Popper -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <script src="../../assets/js/slick.js"></script>
        <script src="../../assets/js/jquery-3.5.1.min.js"></script>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js" integrity="sha512-HGOnQO9+SP1V92SrtZfjqxxtLmVzqZpjFFekvzZVWoiASSQgSr4cw9Kqd2+l8Llp4Gm0G8GIFJ4ddwZilcdb8A==" crossorigin="anonymous"></script> -->

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

        <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>

        <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>

        <!-- AOS animation -->
        <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

        <!-- <script>
            $('.slider1').slick({
                slidesToShow: 3,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 2000,
            });
        </script> -->

        <script type="text/javascript">
            let addToCartButtons = document.querySelectorAll('.add-to-cart');
            addToCartButtons.forEach((indiv_button, i) => {
                indiv_button.addEventListener('click', () => {
                    let id = indiv_button.getAttribute("data-id")
                    let quantity = indiv_button.previousElementSibling.value

                    // alert("Item id: " + id + " quantity added: " + quantity);
                    let formBody = new FormData;
                    formBody.append('id', id);
                    formBody.append('quantity', quantity);

                    //fetch("url", options)
                    fetch("/controllers/cart/add_to_cart.php", {
                        method: "POST",
                        body: formBody
                    })
                    .then(res => res.text())
                    .then(data => {
                        let cartCount = document.getElementById('cart_count')
                        if(cartCount.innerHTML != "") {
                            cartCount.innerHTML = parseInt(cartCount.innerHTML) + parseInt(quantity);
                        } else {
                            cartCount.innerHTML = parseInt(quantity);
                        }
                    })
                })
            })

        </script>

        <script>
            var myIndex = 0;
            carousel();

            function carousel() {
            var i;
            var x = document.getElementsByClassName("mySlides");
            for (i = 0; i < x.length; i++) {
                x[i].style.display = "none";  
            }
            myIndex++;
            if (myIndex > x.length) {myIndex = 1}    
            x[myIndex-1].style.display = "block";  
            setTimeout(carousel, 2000); // Change image every 2 seconds
            }
        </script>

    </body>
    <script>
  AOS.init();
</script>
</html>