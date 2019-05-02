<section class="main-banner-wrap-layout1 bg-common overlay-dark-30 bg--gradient-top-30" data-bg-image="img/site-main-figure1.jpg" style="background-image: url(&quot;img/banner.jpg&quot;);">
    <div class="container">
        <div class="main-banner-box-layout1">
            <p class="item-sub-title">Browse &amp; connect with great places around the world</p>
            <h1 class="item-title">Let’s Browse </h1>
            <!--Search Box-->
            <div class="col col-xl-12 order-xl-1 col-lg-12 order-lg-1 col-md-12 col-sm-12 col-12">
                <div class="s002">
                    <form action="advertisements.php" method="get">
                        <div class="inner-form">
                            <div class="input-field fouth-wrap">
                                <div class="custom-select icon-wrap">
                                    <svg height="24" viewBox="0 -52 512 512" width="24" xmlns="http://www.w3.org/2000/svg">
                                        <path d="m0 0h113.292969v113.292969h-113.292969zm0 0"/>
                                        <path d="m149.296875 0h362.703125v113.292969h-362.703125zm0 0"/>
                                        <path d="m0 147.007812h113.292969v113.292969h-113.292969zm0 0"/>
                                        <path d="m149.296875 147.007812h362.703125v113.292969h-362.703125zm0 0"/>
                                        <path d="m0 294.011719h113.292969v113.296875h-113.292969zm0 0"/>
                                        <path d="m149.296875 294.011719h362.703125v113.296875h-362.703125zm0 0"/>
                                    </svg>
                                    <select class="category-select-box" name="category">
                                        <option value="">Category</option>
                                        <?php
                                        foreach (BusinessCategory::all() as $key => $category) {
                                            if ($category1 == $category['id']) {
                                                $selected = 'selected';
                                            } else {
                                                $selected = '';
                                            }
                                            ?>
                                            <option value="<?php echo $category['id']; ?>" <?php echo $selected; ?>><?php echo $category['name']; ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="input-field second-wrap">
                                <div class="icon-wrap iw-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                        <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"></path>
                                    </svg>
                                </div>
                                <input type="text" id="autocomplete" placeholder="Location" onFocus="geolocate()">
                                    <input type="hidden" name="location" id="city"  value=""/>
                            </div>
                            <div class="input-field first-wrap">
                                <div class="icon-wrap iw-2">
                                    <i class="fa fa-search"></i>
                                </div>
                                <input id="search" type="text" name="keyword" placeholder="What are you looking for?" value="<?php echo $keyword; ?>"/>
                            </div>
                            <div class="input-field fifth-wrap">
                                <button class="btn-search" type="submit">SEARCH</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- End Search Box-->
        </div>
    </div>
</section>


<script>
    var x, i, j, selElmnt, a, b, c;
    /*look for any elements with the class "custom-select":*/
    x = document.getElementsByClassName("custom-select");
    for (i = 0; i < x.length; i++) {
        selElmnt = x[i].getElementsByTagName("select")[0];
        /*for each element, create a new DIV that will act as the selected item:*/
        a = document.createElement("DIV");
        a.setAttribute("class", "select-selected");
        a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
        x[i].appendChild(a);
        /*for each element, create a new DIV that will contain the option list:*/
        b = document.createElement("DIV");
        b.setAttribute("class", "select-items select-hide");
        for (j = 1; j < selElmnt.length; j++) {
            /*for each option in the original select element,
             create a new DIV that will act as an option item:*/
            c = document.createElement("DIV");
            c.innerHTML = selElmnt.options[j].innerHTML;
            c.addEventListener("click", function (e) {

                /*when an item is clicked, update the original select box,
                 and the selected item:*/
                var y, i, k, s, h;
                s = this.parentNode.parentNode.getElementsByTagName("select")[0];
                h = this.parentNode.previousSibling;
                for (i = 0; i < s.length; i++) {
                    if (s.options[i].innerHTML == this.innerHTML) {
                        s.selectedIndex = i;
                        h.innerHTML = this.innerHTML;
                        y = this.parentNode.getElementsByClassName("same-as-selected");
                        for (k = 0; k < y.length; k++) {
                            y[k].removeAttribute("class");
                        }
                        this.setAttribute("class", "same-as-selected");
                        break;
                    }
                }
                h.click();
            });
            b.appendChild(c);
        }
        x[i].appendChild(b);
        a.addEventListener("click", function (e) {
            /*when the select box is clicked, close any other select boxes,
             and open/close the current select box:*/
            e.stopPropagation();
            closeAllSelect(this);
            this.nextSibling.classList.toggle("select-hide");
            this.classList.toggle("select-arrow-active");
            $('.iw-1').toggleClass('hidden');
            $('.iw-2').toggleClass('hidden');
        });
    }
    function closeAllSelect(elmnt) {
        /*a function that will close all select boxes in the document,
         except the current select box:*/
        var x, y, i, arrNo = [];
        x = document.getElementsByClassName("select-items");
        y = document.getElementsByClassName("select-selected");
        for (i = 0; i < y.length; i++) {
            if (elmnt == y[i]) {
                arrNo.push(i)
            } else {
                y[i].classList.remove("select-arrow-active");
            }
        }
        for (i = 0; i < x.length; i++) {
            if (arrNo.indexOf(i)) {
                x[i].classList.add("select-hide");
            }
        }
    }
    /*if the user clicks anywhere outside the select box,
     then close all select boxes:*/
    document.addEventListener("click", closeAllSelect);

    $('.select-selected').click(function () {

    });
</script>