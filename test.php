<html>
    <head>
        <title>Auto Content Loading on Page Scroll - jQuery</title>
        <script src="js/jquery-3.2.1.js"></script>
        <script src="plugins/infinite/jquery.waypoints.min.js" type="text/javascript"></script>
        <script src="plugins/infinite/infinite.min.js" type="text/javascript"></script>
        <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js?ver=1.6.1"></script>-->
        <script type="text/javascript">
            $(document).ready(function () {
                var infinite = new Waypoint.Infinite({
                    element: $('.infinite-container')[0]
                })
            });
        </script>
        <style>
            .infinite-item {

                background: #555;
                color: #fff;
                padding: 40px 10px;
                margin-top: 10px;

            }
        </style>
    </head>
    <body>
        <div class="infinite-container waypoint">
            <div class="infinite-item">1</div>
            <div class="infinite-item">2</div>
            <div class="infinite-item">3</div>
            <div class="infinite-item">4</div>
            <div class="infinite-item">5</div>
            <div class="infinite-item">6</div>
            <div class="infinite-item">7</div>
            <div class="infinite-item">8</div>
            <div class="infinite-item">9</div>
            <div class="infinite-item">10</div>
            <div class="infinite-item">11</div><div class="infinite-item">12</div><div class="infinite-item">13</div><div class="infinite-item">14</div><div class="infinite-item">15</div><div class="infinite-item">16</div><div class="infinite-item">17</div><div class="infinite-item">18</div><div class="infinite-item">19</div><div class="infinite-item">20</div><div class="infinite-item">21</div><div class="infinite-item">22</div><div class="infinite-item">23</div><div class="infinite-item">24</div><div class="infinite-item">25</div><div class="infinite-item">26</div><div class="infinite-item">27</div><div class="infinite-item">28</div><div class="infinite-item">29</div><div class="infinite-item">30</div><div class="infinite-item">31</div><div class="infinite-item">32</div><div class="infinite-item">33</div><div class="infinite-item">34</div><div class="infinite-item">35</div><div class="infinite-item">36</div><div class="infinite-item">37</div><div class="infinite-item">38</div><div class="infinite-item">39</div><div class="infinite-item">40</div></div>
        <a class="infinite-more-link" href="/next/page">More</a>
    </body>
</html>
